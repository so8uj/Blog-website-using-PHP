<?php
// echo base64_encode('1');
// echo $_SERVER['PHP_SELF']; 
// die();
session_start();
// check if has login redirect index
if(isset($_SESSION['login_id'])){
    header('Location:  index.php');
}

// require the database connection
require_once('./admin/db/db.php');

// first check signInBtn click if click then go next step
if(isset($_POST['signInBtn'])){



    // chech the form input values
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = $_POST['remember'];

    // then check the user using email
    $check = mysqli_query($db_con,"SELECT * FROM `users` WHERE `email`='$email'");
    if(mysqli_num_rows($check) > 0){
        $user_data = mysqli_fetch_assoc($check);
        $db_pass = $user_data['password'];
        
        // incript the main password for matching database password
        $incript_password = sha1(md5($password));
        if($db_pass == $incript_password){
            // check user status active and deactive
            if($user_data['status'] == 'Active'){

            
                
                $_SESSION['login_id'] = $user_data['id']; //and uncomment it

                if($user_data['user_type'] == 'Admin'){
                    header('Location:  admin/index.php');
                }else{
                    header('Location:  index.php');
                }
            }else{
                header('Location:  signin.php?status_deacivate');
            }
            
        }else{
            header('Location:  signin.php?password_not_match');
        }
    }else{
        // return with error message
        header('Location:  signin.php?email_not_match');
        
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OneComunity - Sign In</title>


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

        <div class="login_area">

        <?php if(isset($_GET['status_deacivate'])) { ?><div class="alert alert-danger">Your account status id deactivate. Please contact admin for activate.</div> <?php } ?>

            <div class="card-body">
                <h2 class="card-title mb-4">Sing in</h2>

                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" id="signInForm">
                    <div class="mb-4">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="jon.due@gmail.com" required>

                        <!-- error message -->
                        <?php if(isset($_GET['email_not_match'])) { echo "<label id='email-error' class='error'>This email not match</label>"; } ?>
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="******" required>

                        <!-- error message -->
                        <?php if(isset($_GET['password_not_match'])) { echo "<label id='email-error' class='error'>Incorrect password!</label>"; } ?>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" name="signInBtn">Sing in</button>
                        <a href="./signup.php" class="btn out-line-blue">Sing up</a>
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
		    $("#signInForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                },
                messages: {
                    email: "Please enter a valid email address",
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },
                }

            });
        })
    </script>
</body>

</html>