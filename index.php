<?php 
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EShop</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resource/logo.svg" />
</head>

<body class="main-body">
    <div class="container-fluid d-flex justify-content-center vh-100">
        <div class="row align-content-center">
            <!-- header -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title01">Hi, Welcome to EShop</p>
                    </div>
                </div>
            </div>
            <!-- header -->

            <!-- content -->
            <div class="col-12 p-3">
                <div class="row">
                    <div class="col-6 d-none d-lg-block background" id="">

                    </div>
                    <!-- singup box -->
                    <div class="col-12 col-lg-6" id="signupBox">
                        <div class="row g-2">
                            <!-- title -->
                            <div class="col-12">
                                <p class="title02">Create New Account</p>
                            </div>
                            <!-- alert message -->
                            <div class="col-12">
                                <div class="d-none alert alert-danger" role="alert" id="msg"></div>
                            </div>
                            <!-- first name  -->
                            <div class="col-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" placeholder="ex:- John" id="fname" />
                            </div>
                            <!-- last name  -->
                            <div class="col-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" placeholder="ex:- Doe" id="lname" />
                            </div>
                            <!-- email address -->
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="ex:- John@example.com"
                                    id="email" />
                            </div>
                            <!-- password -->
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="ex:- ********" id="password" />
                            </div>
                            <!-- mobile number -->
                            <div class="col-6">
                                <label class="form-label">Mobile</label>
                                <input type="text" class="form-control" placeholder="ex:- 0712244991" id="mobile" />
                            </div>
                            <!-- gender -->
                            <div class="col-6">
                                <label class="form-label">Gender</label>
                                <select class="form-control" id="gender">
                                    <option value="0" selected disabled>Select gender</option>
                                    <?php
                                    $rs = Database::search("SELECT * FROM `gender`");
                                    $num = $rs->num_rows;
                                    for ($x = 0; $x < $num; $x++) {
                                        $data = $rs->fetch_assoc();
                                        ?>
                                        <option value="<?php echo $data["gender_id"] ?>"><?php echo $data["gender_name"] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- signup btn -->
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="signup();">Sign Up</button>
                            </div>
                            <!-- login btn -->
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-dark" onclick="changeView();">Already have an account? Sign
                                    In</button>
                            </div>
                        </div>
                    </div>
                    <!-- singup box -->

                    <!-- signin box -->
                    <div class=" col-12 col-lg-6 d-none" id="signinBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title02">Sign In to your Account</p>
                            </div>

                            <!-- email address -->
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="ex:- John@example.com" id="email2"
                                    value="" />
                            </div>
                            <!-- password -->
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="ex:- ********" id="password2"
                                    value="" />
                            </div>
                            <!-- remember me -->
                            <div class="col-6">
                                <div class="form-check d-flex align-items-center gap-2 ">
                                    <input type="checkbox" class="form-check-input" id="rememberMe" />
                                    <label class="form-check-label">Remember me</label>
                                </div>
                            </div>
                            <!-- forgot password -->
                            <div class="col-6 text-end">
                                <a href="" class="link-primary">Forgot Password?</a>
                            </div>

                            <!-- signin btn -->
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="signin();">Sign In</button>
                            </div>
                            <!-- Register btn -->
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger" onclick="changeView();">New to EShop? Sign Up</button>
                            </div>
                        </div>
                    </div>
                    <!-- signin box -->

                </div>
            </div>
            <!-- content -->

            <!-- copyright trade mark -->
            <div class="col-12 fixed-bottom text-center d-none d-lg-block">
                <p>&copy; 2025 eShop.lk || All Rights Reserved</p>
            </div>

        </div>
    </div>
    <script src="bootstrap.js"></script>
    <script src="script.js"></script>

</body>

</html>