function changeView(){
    var signupBox = document.getElementById("signupBox");
    var signinBox = document.getElementById("signinBox");

    signupBox.classList.toggle("d-none");
    signinBox.classList.toggle("d-none");
}

function signup(){
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var mobile = document.getElementById("mobile").value;
    var gender = document.getElementById("gender").value;

    alert(fname + " " + lname + " " + email + " " + password + " " + mobile + " " + gender)
}

function signin(){
    alert("Signin button clicked");
}