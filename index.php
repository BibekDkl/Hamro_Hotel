<?php
session_start(); // Start the session
$isLoggedIn = isset($_SESSION['email']); // Check if the user is logged in
$username = $isLoggedIn ? $_SESSION['name'] : ''; // Retrieve the user's email (or name if stored)
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
                        <li><a class="hvr-underline-from-center" href="order.php">Order</a></li>
                        <li><a class="hvr-underline-from-center" href="contact.html">Contact</a></li>
                        <?php if ($isLoggedIn): ?>
                            <li><a class="hvr-underline-from-center" href="#">Welcome, <?php echo htmlspecialchars($username); ?></a></li>
                            <li><a class="hvr-underline-from-center" href="logout.php">Logout</a></li>
                        <?php else: ?>
                            <li><a class="hvr-underline-from-center" href="login.php">Register</a></li>
                        <?php endif; ?>
                        <li>
                            <a id="shopping-cart" class="shopping-cart">
                                <i class="fa fa-cart-arrow-down"></i>
                                <span class="badge"></span>
                            </a>
                            <div id="cart-content" class="cart-content">
                                <h3 class="text-center">Shopping Cart</h3>
                                <table class="cart-table">
                                </table>
                                <a href="order.php" class="btn-primary">Confirm Order</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- Navigation Section End -->

    <!-- Rest of your HTML content remains the same -->
    <!-- Food Search Section Start -->
    <section class="food-search text-center">
        <div class="container">
            <form action="food-search.html">
                <input type="search" placeholder="Search for food..." required>
                <input type="submit" value="Search" class="btn-primary">
            </form>
        </div>
    </section>
    <!-- Food Search Section End -->

    <!-- Category Section Start -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <div class="heading-border"></div>

            <div class="grid-3">
                <a href="category-foods.html">
                    <div class="float-container">
                        <img src="img/category/pizza.jpg" class="img-responsive" alt="">
                    </div>
                    <h4 style="margin: 4px 0 0 0;">Pizza</h4>
                </a>
                <a href="category-foods.html">
                    <div class="float-container">
                        <img src="img/category/sandwich.jpg" class="img-responsive" alt="">
                    </div>
                    <h4 style="margin: 4px 0 0 0;">Sandwich</h4>
                </a>
                <a href="category-foods.html">
                    <div class="float-container">
                        <img src="Image.src/drive-download-20250216T024959Z-001/Burgeer4.jpg" class="img-responsive" alt="">
                    </div>
                    <h4 style="margin: 4px 0 0 0;">Burger</h4>
                </a>
            </div>
        </div>
    </section>
    <!-- Category Section End -->

    <!-- Foods Section Start -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <div class="heading-border"></div>
            <div class="grid-2">
                <div class="food-menu-box">
                    <form action="">
                        <div class="food-menu-img">
                            <img src="img/food/p1.jpg" alt="" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4>Pizza</h4>
                            <p class="food-price">$8.00</p>
                            <p class="food-details">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus excepturi porro.</p>
                            <input type="number" value="1" min="1">
                            <input type="submit" class="btn-primary" value="Add To Cart">
                        </div>
                    </form>
                </div>
                <div class="food-menu-box">
                    <form action="">
                        <div class="food-menu-img">
                            <img src="img/food/s1.jpg" alt="" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4>Sandwich</h4>
                            <p class="food-price">$8.00</p>
                            <p class="food-details">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus excepturi porro.</p>
                            <input type="number" value="1" min="1">
                            <input type="submit" class="btn-primary" value="Add To Cart">
                        </div>
                    </form>
                </div>
                <div class="food-menu-box">
                    <form action="">
                        <div class="food-menu-img">
                            <img src="img/food/b1.jpg" alt="" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4>Burger</h4>
                            <p class="food-price">$8.00</p>
                            <p class="food-details">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus excepturi porro.</p>
                            <input type="number" value="1" min="1">
                            <input type="submit" class="btn-primary" value="Add To Cart">
                        </div>
                    </form>
                </div>
                <div class="food-menu-box">
                    <form action="">
                        <div class="food-menu-img">
                            <img src="img/food/p1.jpg" alt="" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4>Pizza</h4>
                            <p class="food-price">$8.00</p>
                            <p class="food-details">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus excepturi porro.</p>
                            <input type="number" value="1" min="1">
                            <input type="submit" class="btn-primary" value="Add To Cart">
                        </div>
                    </form>
                </div>
                <div class="food-menu-box">
                    <form action="">
                        <div class="food-menu-img">
                            <img src="img/food/s1.jpg" alt="" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4>Sandwich</h4>
                            <p class="food-price">$8.00</p>
                            <p class="food-details">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus excepturi porro.</p>
                            <input type="number" value="1" min="1">
                            <input type="submit" class="btn-primary" value="Add To Cart">
                        </div>
                    </form>
                </div>
                <div class="food-menu-box">
                    <form action="">
                        <div class="food-menu-img">
                            <img src="img/food/b1.jpg" alt="" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4>Burger</h4>
                            <p class="food-price">$8.00</p>
                            <p class="food-details">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus excepturi porro.</p>
                            <input type="number" value="1" min="1">
                            <input type="submit" class="btn-primary" value="Add To Cart">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <p class="text-center">
            <a href="foods.html" class="btn-primary">See All Foods</a>
        </p>
    </section>
    <!-- Foods Section End -->

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
                <div class="text-center">
                    <h3>Site Map</h3><br>
                    <div class="site-links">
                        <a href="categories.html">Categories</a>
                        <a href="foods.html">Foods</a>
                        <a href="order.php">Order</a>
                        <a href="contact.html">Contact</a>
                        <a href="login.php">Register</a>
                    </div>
                </div>
                <div class="social-links">
                    <h3>Social Links</h3><br>
                    <div class="social">
                        <ul>
                            <li><a href=""><img src="https://img.icons8.com/color/48/null/facebook-new.png"/></a></li>
                            <li><a href=""><img src="https://img.icons8.com/fluency/48/null/instagram-new.png"/></a></li>
                            <li><a href=""><img src="https://img.icons8.com/color/48/null/twitter--v1.png"/></a></li>
                            <li><a href=""><img src="https://img.icons8.com/color/48/null/linkedin-circled--v1.png"/></a></li>
                            <li><a href=""><img src="https://img.icons8.com/color/48/null/youtube-play.png"/></a></li>
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
            <p>All rights reserved. Design By <a href="#">Foodie Fly</a></p>
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