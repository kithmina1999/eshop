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
