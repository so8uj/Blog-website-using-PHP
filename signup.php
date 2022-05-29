<?php

// require the database connection
require_once('./admin/db/db.php');

// first check signUpBtn click if click then go next step
if(isset($_POST['signUpBtn'])){

    // chech the form input values
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $gender = $_POST['gender'];
    $birth = $_POST['birth'];
    $addr = $_POST['addr'];
    $institute = $_POST['institute'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];
    

    // then check email if email is unique go next step either show error
    $check = mysqli_query($db_con,"SELECT * FROM `users` WHERE `email`='$email'");
    if(mysqli_num_rows($check) > 0){
        // return with error message
        header('Location:  signup.php?unique_email');
    }else{
        // incript the main password for security
        $incript_password = sha1(md5($password));
        $query = "INSERT INTO `users` (`f_name`, `l_name`, `email`, `city`, `country`, `gender`, `birth`, `addr`,`institute`,`password`,`user_type`) VALUES ('$f_name', '$l_name', '$email', '$city', '$country', '$gender', '$birth', '$addr','$institute','$incript_password','$user_type')";
        $run_query = mysqli_query($db_con,$query);

        // return back with success message
        header('Location: signup.php?signup_done');
        mysqli_close($db_con);

    }


}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OneComunity - Sign Up</title>


    <!-- CSS FILES -->

    <!-- bootstrap css -->
    <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">

    <!-- style css -->
    <link rel="stylesheet" href="./asset/css/style.css">

</head>

<body>



    <!-- main content container -->

    <div class="main-content">

        <!-- page content -->

        <div class="signup_area">
            <div class="card-body">
                <h2 class="card-title mb-5 text-center text-bold">Sing up</h2>

                <!-- show the signup done message -->

                <?php if(isset($_GET['signup_done'])){ ?> <div class="alert alert-success">Registraion done. You can signin now with your email and password</div> <?php }?>

                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" id="SignUpForm">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-4">
                                <label for="f_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="f_name" id="f_name" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-4">
                                <label for="l_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="l_name" id="l_name" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <div class="input-group-text">@</div>
                                    <input type="email" class="form-control" id="email" name="email" required>

                                    <!-- show the error  message for unique email  -->
                                    <?php if(isset($_GET['unique_email'])) { echo "<label id='email-error' class='error'>This email already token</label>"; } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-sm-3">
                            <div class="mb-4">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" name="city" id="city" placeholder="Dhaka" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-4">
                                <label for="country" class="form-label">Country</label>
                                <select id="country" class="form-select" name="country" aria-label="Select Country" required>
                                    <option value="#">Select Country</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="India">India</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="United States">United States</option>
                                    <option value="Canada">Canada</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="mb-4">
                                <label for="gender" class="form-label">Gender</label>
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="Female" required>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-4">
                                <label for="birth" class="form-label"> Birthday</label>
                                <input type="date" name="birth" class="form-control" id="birth" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-4">
                                <label for="addr" class="form-label">Address</label>
                                <input type="text" class="form-control" name="addr" id="addr" placeholder="Road no 130" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-4">
                                <label for="institute" class="form-label">University name</label>
                                <input type="text" class="form-control" name="institute" id="institute" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-2">
                                <label for="user_type" class="form-label">User Type</label>
                                <select id="user_type" class="form-select" name="user_type" aria-label="Select User Type" required>
                                    <option value="#">Select User Type</option>
                                    <option value="Student">Student</option>
                                    <option value="Teacher">Teacher</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-2">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="********" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-2">
                                <label for="confrim_password" class="form-label">Confrim Password</label>
                                <input type="password" class="form-control" name="confrim_password" id="confrim_password" placeholder="********" required>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" value="Agree" name="agree" id="agree" required>
                        <label class="form-check-label" for="agree">Agree to terms and conditions</label>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="signUpBtn" class="btn btn-primary">Sing up</button>
                        <a href="./signin.php" class="btn out-line-blue">Sing in</a>
                    </div>
                    <div class="mb-4">
                    </div>
                </form>

            </div>
        </div>


        <!-- footer -->

        <footer>
            <div class="footer_text">
                <b>OneComunity</b>
                <b>2022</b>
            </div>
        </footer>
    </div>

    <!-- javascript files for validation -->

    <script src="./asset/js/jquery.min.js"></script>
    <script src="./vendor/jqueryvalidator/lib/jquery.js"></script>
	<script src="./vendor/jqueryvalidator/dist/jquery.validate.js"></script>

    <script>
        $().ready(function() {
		    // validate the comment form when it is submitted
		    $("#SignUpForm").validate({
                // validation rules like required , minimum lenght , math password etc
                rules: {
                    f_name: "required",
                    l_name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    confrim_password: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    },
                    city: "required",
                    country: "required",
                    gender: "required",
                    birth: "required",
                    addr: "required",
                    institute: "required",
                    user_type: "required",
                    agree: "required",
			    },
                // validation message for each field
                messages: {
                    f_name: "Please enter your firstname",
                    l_name: "Please enter your lastname",
                    email: "Please enter a valid email address",
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    confrim_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long",
                        equalTo: "Please enter the same password as above"
                    },
                    
                    city: "Please provide a valid city",
                    country: "Please provide a valid country",
                    gender: "",
                    birth: "Please enter your dath of birth",
                    addr: "Please provide a valid address",
                    institute: "Please enter you institute name",
                    user_type: "Please Select user type",
                    agree: "Please accept our policy",
                }
            });
        })
    </script>


</body>

</html>