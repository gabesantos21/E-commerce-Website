<?php
session_start();

if ($_SERVER["HTTPS"] != "on") {
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

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

include 'db_conn.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $uname = $_POST['username'];
    $pass = md5($_POST['password']);

    if (empty($uname)) {
        header("Location: login.php?errorUserName=0");
        exit();
    } else if (empty($pass)) {
        header("Location: login.php?errorUserPass=1");
        exit();
    } else {
        $sql = "select * from user_accounts where username= ? AND password= ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $uname, $pass);
        $stmt->execute();

        $result = $stmt->get_result();
        $resultCount = $result->num_rows;
        $stmt->close();

        if ($resultCount == 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] == $uname && $row['password'] == $pass) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['userLogged'] = "true";
                $ip = $_SERVER['REMOTE_ADDR']; //get supposed IP
                $dateAndTime = date('d-m-y h:i:s'); //gets current date and time
                $handle = fopen("logs/log.txt", "a"); //open log file

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
            header("Location: login.php?errorDetails=2");
        }
    }
} else {
    header("Location: login.php?error");
    exit();
}
