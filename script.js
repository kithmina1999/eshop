function changeView() {
  var signupBox = document.getElementById("signupBox");
  var signinBox = document.getElementById("signinBox");

  signupBox.classList.toggle("d-none");
  signinBox.classList.toggle("d-none");
}

function signup() {
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var mobile = document.getElementById("mobile").value;
  var gender = document.getElementById("gender").value;

  var f = new FormData();
  f.append("f", fname);
  f.append("l", lname);
  f.append("e", email);
  f.append("p", password);
  f.append("m", mobile);
  f.append("g", gender);

  var req = new XMLHttpRequest();
  req.onreadystatechange = () => {
    if (req.readyState == 4 && req.status == 200) {
      if (req.responseText.trim() === "success") {
        document.getElementById("msg").innerHTML = req.responseText;
        document.getElementById("msg").className = "alert alert-success";
        document.getElementById("msgdiv").className = "d-block";
      } else {
        document.getElementById("msg").innerHTML = req.responseText;
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  };
  req.open("POST", "signupProcess.php", true);
  req.send(f);
}

function signin() {
  var email = document.getElementById("email2").value;
  var password = document.getElementById("password2").value;
  var remembarme = document.getElementById("rememberMe").checked;

  var f = new FormData();
  f.append("e", email);
  f.append("p", password);
  f.append("r", remembarme ? "1" : "0");

  var req = new XMLHttpRequest();
  req.onreadystatechange = () => {
    if (req.readyState == 4 && req.status == 200) {
      if (req.responseText.trim() === "success") {
        window.location.href = "home.php";
      } else {
        document.getElementById("msg2").innerHTML = req.responseText;
        document.getElementById("msgdiv2").className = "d-block";
      }
    }
  };
  req.open("POST", "signinProcess.php", true);
  req.send(f);
}
var forgotPasswordModal;

function forgotPassword() {
  var email = document.getElementById("email2").value;

  var request = new XMLHttpRequest();
  request.onreadystatechange = () => {
    if (request.readyState == 4 && request.status == 200) {
      if (request.responseText === "success") {
        alert(
          "Password reset link has been sent to your email. Please check your inbox."
        );
        var modal = document.getElementById("fpmodal");
        forgotPasswordModal = new bootstrap.Modal(modal);
        forgotPasswordModal.show();
      } else {
        document.getElementById("msg2").innerHTML = request.responseText;
        document.getElementById("msgdiv2").className = "d-block";
      }
    }
  };
  request.open("GET", "forgotPasswordProcess.php?e=" + email, true);
  request.send();
}

function showPassword1() {
  var textfield = document.getElementById("np");
  var button = document.getElementById("npb");

  if (textfield.type === "password") {
    textfield.type = "text";
    button.innerText = "Hide";
  } else {
    textfield.type = "password";
    button.innerText = "Show";
  }
}

function showPassword2() {
  var textfield = document.getElementById("cnp");
  var button = document.getElementById("cnpb");

  if (textfield.type === "password") {
    textfield.type = "text";
    button.innerText = "Hide";
  } else {
    textfield.type = "password";
    button.innerText = "Show";
  }
}

function resetPassword() {
  var email = document.getElementById("email2").value;
  var newPassword = document.getElementById("np").value;
  var confirmNewPassword = document.getElementById("cnp").value;
  var verificationCode = document.getElementById("vcode").value;

  var f = new FormData();
  f.append("e", email);
  f.append("np", newPassword);
  f.append("cnp", confirmNewPassword);
  f.append("vc", verificationCode);

  var request = new XMLHttpRequest();
  request.onreadystatechange = () => {
    if (request.readyState == 4 && request.status == 200) {
      if (request.responseText.trim() === "success") {
        alert(
          "Password has been reset successfully. Please sign in with your new password."
        );
        forgotPasswordModal.hide();
      } else {
        alert(request.responseText);
      }
    }
  };
  request.open("POST", "resetPasswordProcess.php", true);
  request.send(f);
}
