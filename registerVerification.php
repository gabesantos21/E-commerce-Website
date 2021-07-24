<?php
session_start();

if ($_SERVER["HTTPS"] != "on") {
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

include 'db_conn.php';

function getClientIP()
{
    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
        return  $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else if (array_key_exists('REMOTE_ADDR', $_SERVER)) {
        return $_SERVER["REMOTE_ADDR"];
    } else if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    return '';
}


if (
    isset($_POST['username']) && isset($_POST['firstName']) &&
    isset($_POST['lastName']) && isset($_POST['password']) &&
    isset($_POST['confirmPassword'])
) {

    $uname = $_POST['username'];
    $fname = $_POST['firstName'];
    $mname = $_POST['middleName'];
    $lname = $_POST['lastName'];
    $suffix = $_POST['nameSuffix'];
    $pass = md5($_POST['password']);

    // $sql = "select * from user_accounts where username= ? AND password= ?";
    $sqlVerifyUserName = "SELECT * FROM user_accounts WHERE username = ?";
    $stmt2 = $conn->prepare($sqlVerifyUserName);
    $stmt2->bind_param("s", $uname);
    $stmt2->execute();

    $result2 = $stmt2->get_result();
    $resultCount2 = $result2->num_rows;
    $stmt2->close();

    if ($resultCount2 > 0) {
        header("Location: register.php?errorDetails=0");
        exit();
    } else {
        // echo "cool";
        $sql = "INSERT INTO user_accounts(username, password, firstname, middlename, lastname, suffix) VALUES (?,?,?,?,?,?);";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $uname, $pass, $fname, $mname, $lname, $suffix);
        $stmt->execute();

        echo "Successfully registered!";

        $_SESSION['username'] = $uname;
        $_SESSION['userLogged'] = "true";
        $ip = $_SERVER['REMOTE_ADDR']; //get supposed IP
        $dateAndTime = date('d-m-y h:i:s'); //gets current date and time
        $handle = fopen("logs/register_log.txt", "a"); //open log file

        foreach ($_POST as $variable => $value) { //loop through POST vars
            if ($variable == "username") {
                fwrite($handle, $variable . ": " . $value . "\r\n");
            }
        }
        fwrite($handle, "IP Address: " . getClientIP() . "\r\n");
        fwrite($handle, "Date and Time: $dateAndTime \r\n \r\n");
        fclose($handle);
        header("Location: home.php");
    }
} else {
    header("Location: register.php?errorDetails=1");
}
