function passwordVerify() {
  var confirmPassword = document.getElementById("confirmPassword").value;
  var password = document.getElementById("password").value;

  if (password.length < 8) {
    document.getElementById("password").style.borderColor = "red";
    document.getElementById("passwordSubtext").style.color = "red";
  } else {
    document.getElementById("password").style.borderColor = "green";
    document.getElementById("passwordSubtext").style.color = "gray";
  }

  if (password != "") {
    if (password != confirmPassword) {
      document.getElementById("confirmPassword").style.borderColor = "red";
      document.getElementById("submit").disabled = true;
      document.getElementById("cPsubtext").style.color = "red";
      document.getElementById("cPsubtext").innerHTML =
        "Password does not match!";
    } else {
      document.getElementById("confirmPassword").style.borderColor = "green";
      document.getElementById("submit").disabled = false;
      document.getElementById("cPsubtext").style.color = "green";
      document.getElementById("cPsubtext").innerHTML = "Password Confirmed!";
    }
  } else {
    document.getElementById("cPsubtext").style.color = "red";
    document.getElementById("cPsubtext").innerHTML =
      "There is no set password!";
  }
}

function quantValidityChecker() {
  var inputQuant = document.getElementById("movieQuant").value;
  console.log(inputQuant);

  if (inputQuant <= 0) {
    document.getElementById("purchaseMovie").disabled = true;
  } else {
    document.getElementById("purchaseMovie").disabled = false;
  }
}

function paymentModeSelect() {
  var choice = document.getElementById("selectMode").value;
  var creditCardNumber = document.getElementById("creditCardNumber");
  var expirationDate = document.getElementById("expirationDate");
  var cvv = document.getElementById("cvv");

  if (choice == "Debit/Credit Card") {
    creditCardNumber.disabled = false;
    expirationDate.disabled = false;
    cvv.disabled = false;

    creditCardNumber.required = true;
    expirationDate.required = true;
    cvv.required = true;
  } else {
    creditCardNumber.disabled = true;
    expirationDate.disabled = true;
    cvv.disabled = true;

    creditCardNumber.required = false;
    expirationDate.required = false;
    cvv.required = false;
  }
}
