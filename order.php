<?php 
session_start(); // Start the session
$isLoggedIn = isset($_SESSION['email']); // Check if user is logged in
$username = $isLoggedIn ? $_SESSION['name'] : ''; // Retrieve the user's name

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Food Delivery Website</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.css">
    <!-- Hover CSS -->
    <link rel="stylesheet" href="css/hover-min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navigation Section Start -->
    <header class="navbar">
        <nav id="site-top-nav" class="navbar-menu navbar-fixed-top">
            <div class="container">
                <!-- logo -->
                <div class="logo">
                    <a href="index.html" title="Logo">
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
                        <?php if ($isLoggedIn): ?>
        <li><a href="#">Welcome, <?php echo htmlspecialchars($username); ?></a></li>
        <li><a href="logout.php">Logout</a></li>
    <?php else: ?>
        <li><a href="login.php">Login</a></li>
    <?php endif; ?>
                        <li>
                            <a id="shopping-cart" class="shopping-cart">
                                <i class="fa fa-cart-arrow-down"></i>
                                <span class="badge">4</span>
                            </a>
                            <div id="cart-content" class="cart-content">
                                <h3 class="text-center">Shopping Cart</h3>
                                <table class="cart-table" border="0">
                                    <tr>
                                        <th>Food</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td><img src="img/food/p1.jpg" alt="Food"></td>
                                        <td>Pizza</td>
                                        <td>$ 8.00</td>
                                        <td>1</td>
                                        <td>$ 8.00</td>
                                        <td><a href="#" class="btn-delete">&times;</a></td>
                                    </tr>
                                    <tr>
                                        <td><img src="img/food/s1.jpg" alt="Food"></td>
                                        <td>Sandwich</td>
                                        <td>$ 8.00</td>
                                        <td>1</td>
                                        <td>$ 8.00</td>
                                        <td><a href="#" class="btn-delete">&times;</a></td>
                                    </tr>
                                    <tr>
                                        <td><img src="img/food/b1.jpg" alt="Food"></td>
                                        <td>Burder</td>
                                        <td>$ 8.00</td>
                                        <td>1</td>
                                        <td>$ 8.00</td>
                                        <td><a href="#" class="btn-delete">&times;</a></td>
                                    </tr>
                                    <tr>
                                        <th colspan="4">Total</th>
                                        <th>$24.00$</th>
                                        <th></th>
                                    </tr>
                                </table>
                                <a href="order.html" class="btn-primary">Confirm Order</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- Navigation Section End -->

    <!-- Food Order Section Start -->
    <section class="order">
        <div class="container">
            <h2 class="text-center">Fill this form to confirm your order.</h2>
            <table class="tbl-full" border="0">
                <tr>
                    <th>S.N.</th>
                    <th>Food</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td><img src="img/food/p1.jpg" alt="Food"></td>
                    <td>Pizza</td>
                    <td>$ 8.00</td>
                    <td>1</td>
                    <td>$ 8.00</td>
                    <td><a href="#" class="btn-delete">&times;</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><img src="img/food/s1.jpg" alt="Food"></td>
                    <td>Sandwich</td>
                    <td>$ 8.00</td>
                    <td>1</td>
                    <td>$ 8.00</td>
                    <td><a href="#" class="btn-delete">&times;</a></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><img src="img/food/b1.jpg" alt="Food"></td>
                    <td>Burder</td>
                    <td>$ 8.00</td>
                    <td>1</td>
                    <td>$ 8.00</td>
                    <td><a href="#" class="btn-delete">&times;</a></td>
                </tr>
                <tr>
                    <th colspan="5">Total</th>
                    <th>$24.00</th>
                    <th></th>
                </tr>
            </table>
            <form action="Take_order.php" method="POST" class="form">
                <fieldset>
                    <legend>Delivery Details</legend>
                    <p class="label" >Full Name</p>
                    <input type="text" name="name2" id ="name2" placeholder="Enter your name..." required >
                    <p class="label">Phone Number</p>
                    <input type="text" name="phone_number" id ="phone-number" placeholder="Enter your phone..." required>
                    <p class="label">Email</p>
                    <input type="text" name="email" id ="email" placeholder="Enter your email..." required>
                    <p class="label">Address</p>
                    <input type="text"name="address" id ="address" placeholder="Enter your address..." required>
                    <button type= "submit" >Conform Order</button>
                </fieldset>
            </form>
        </div>
    </section>
    <!-- Food Order Section End -->

    <!-- Footer Section Start -->
    <section class="footer">
        <div class="container">
            <div class="grid-3">
                <div class="text-center">
                    <h3>About Us</h3><br>
                    <p>Foodie Fly is a fast and reliable food delivery service connecting you with top restaurants for a seamless dining experience. 
                        With a diverse menu, real-time tracking, and swift deliveries, we ensure your favorite meals arrive fresh and on time. 
                        Enjoy convenience at your fingertips—because great food should never wait! </p>
                </div>
                <div class="texr-center">
                    <h3>Site Map</h3><br>
                    <div class="site-links">
                        <a href="categories.html">Categories</a>
                        <a href="foods.html">Foods</a>
                        <a href="order.html">Order</a>
                        <a href="contact.html">Contact</a>
                        <a href="login.php">Login</a>
                    </div>
                </div>
                <div class="social-links">
                    <h3>Social Links</h3><br>
                    <div class="social">
                        <ul>
                            <li><a href="#"><img src="https://img.icons8.com/color/48/null/facebook-new.png"/></a></li>
                            <li><a href="#"><img src="https://img.icons8.com/fluency/48/null/instagram-new.png"/></a></li>
                            <li><a href="#"><img src="https://img.icons8.com/color/48/null/twitter--v1.png"/></a></li>
                            <li><a href="#"><img src="https://img.icons8.com/color/48/null/linkedin-circled--v1.png"/></a></li>
                            <li><a href="#"><img src="https://img.icons8.com/color/48/null/youtube-play.png"/></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer Section End -->

    <!-- Copyright Section start -->
    <section class="copyright">
        <div class="container text-center">
            <p>All rights reserved. Design By <a href="#">Code Arcade</a></p>
        </div>
        <a id="back-to-top" class="btn-primary">
            <i class="fa fa-angle-double-up"></i>
        </a>
    </section>
    <!-- Copyright Section End -->

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!-- Jquery UI -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <!-- Custom JS -->
    <script src="js/custom.js"></script>
</body>
</html>