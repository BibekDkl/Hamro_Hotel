<?php 
include('signup.php');
include('signin.php');


// Display success message if set
if (isset($_SESSION['success'])) {
    echo "<p style='color:green;'>" . $_SESSION['success'] . "</p>";
    unset($_SESSION['success']); // Clear the message after displaying it
}

// Display error message if set
if (isset($_SESSION['error'])) {
    echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']); // Clear the message after displaying it
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Foodie Fly | Login & Registration</title>
</head>

<body>


    <header class="navbar">
        <nav id="site-top-nav" class="navbar-menu navbar-fixed-top">
            <div class="containers">
                <!-- logo -->
                <div class="logo">
                    <a href="index.php" title="Logo">
                        <img src="Image.src/logo.png" alt="Logo" class="img-responsive">
                    </a>
                </div>
                <!-- Main Menu -->
                <div class="menu text-right">
                    <ul>
                        <li><a class="hvr-underline-from-center" href="index.php">Home</a></li>
                        <li><a class="hvr-underline-from-center" href="categories.html">Categories</a></li>
                        <li><a class="hvr-underline-from-center" href="foods.html">Foods</a></li>
                        <li><a class="hvr-underline-from-center" href="order.html">Order</a></li>
                        <li><a class="hvr-underline-from-center" href="contact.html">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <div class="container" id="container">  
        <div class="form-container sign-up">    <!--Sign up form-->
            <form action="signup.php" method="POST">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registeration</span>
                <input type="text" placeholder="Name" id= "namel" name="name">
                <input type="email" placeholder="Email" id= "email" name="email">
                <input type="password" placeholder="Password" id= "password" name="password">
                <button type= "submit" >Sign Up</button>
            </form>
        </div>

<!--Sign in form-->
        <div class="form-container sign-in">        
            <form action="signin.php" method="POST">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="email" placeholder="Email" id= "email2" name="email2">
                <input type="password" placeholder="Password" id= "password2" name="password2">
                <a href="#">Forget Your Password?</a>
                <button type= "submit" >Sign In</button>
            </form>
        </div>

    
<!-- Toggle Panels -->
<div class="toggle-container">
    <div class="toggle">
        <div class="toggle-panel toggle-left">
            <h1 id="left-panel-text">Welcome Back!</h1>
            <p id="left-panel-desc">Login to enjoy delicious deliveries at your doorstep!</p>
            <button class="hidden" id="login">Sign In</button>
        </div>
        <div class="toggle-panel toggle-right">
            <h1>Hello, Foodie!</h1>
            <p>Sign up to satisfy your cravings with Foodie Fly!</p>
            <button class="hidden" id="register">Sign Up</button>
        </div>
    </div>
</div>



<script src="js/custom.js"></script>
<script src="js/login.js"></script>
</body>

</html>