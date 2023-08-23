<!DOCTYPE html> 
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Medication Reminder System</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        /* Add your additional CSS styling here */
    </style>
</head>
<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <label class="logo">ATAMRS</label>
    </nav>
    <div class="container-login">
        <div class="regstudent">
            <div class="title">Login</div>
            <form action="" method="POST">
                <div class="login-details">
                    <fieldset>
                        <legend>Login as Admin</legend>
                        <div class="input-box">
                            <label for="username">Username</label><br>
                            <input id="username" name="username" type="text" placeholder="Enter username" required>
                            <div class="input-box">
                            <label for="password">Password</label><br>
                            <input id="password" name="password" type="password" placeholder="Enter password" required>
                        </div>
                        <div class="button">
                            <input type="submit" value="Login">
                        </div>
                        </div>
                    
                        
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST["username"]) && isset($_POST["password"])) { // Corrected typo here
        if ($_POST["username"] == "ChrislandUniversity" && $_POST["password"] == "shinethelight") {
            header("Location: register.php"); // Redirect to newmedschedule
            exit();
        } else {
            // Handle other cases if needed
        }
    }
}
?>
