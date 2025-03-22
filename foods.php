<?php
session_start(); // Start the session

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Function to add an item to the cart
function addToCart($itemId, $quantity, $name, $price) {
    if (isset($_SESSION['cart'][$itemId])) {
        $_SESSION['cart'][$itemId]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$itemId] = [
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity
        ];
    }
}

// Function to remove an item from the cart
function removeFromCart($itemId) {
    if (isset($_SESSION['cart'][$itemId])) {
        unset($_SESSION['cart'][$itemId]);
    }
}

// Handle add to cart request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $itemId = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $name = $_POST['item_name'];
    $price = $_POST['item_price'];
    addToCart($itemId, $quantity, $name, $price);
}

// Handle remove from cart request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_cart'])) {
    $itemId = $_POST['item_id'];
    removeFromCart($itemId);
    // Redirect to the same page to refresh the cart
    header("Location: index.php");
    exit();
}

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['email']);
$username = $isLoggedIn ? $_SESSION['name'] : '';
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
                        <li><a class="hvr-underline-from-center" href="foods.php">Foods</a></li>
                        <li><a class="hvr-underline-from-center" href="order.php">Order</a></li>
                        <li><a class="hvr-underline-from-center" href="contact.php">Contact</a></li>
                        <?php if ($isLoggedIn): ?>
                            <li><a href="#">Welcome, <?php echo htmlspecialchars($username); ?></a></li>
                            <li><a href="logout.php">Logout</a></li>
                        <?php else: ?>
                            <li><a href="login.php">Login</a></li>
                        <?php endif; ?>
                        <li>
                            <a id="shopping-cart" class="shopping-cart">
                                <i class="fa fa-cart-arrow-down"></i>
                                <span class="badge"><?php echo count($_SESSION['cart']); ?></span>
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
                                    <?php
                                    $total = 0;
                                    foreach ($_SESSION['cart'] as $itemId => $item):
                                        $itemTotal = $item['price'] * $item['quantity'];
                                        $total += $itemTotal;
                                    ?>
                                        <tr>
                                            <td><img src="img/food/<?php echo strtolower($item['name']) . '.jpg'; ?>" alt="Food"></td>
                                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                                            <td>$ <?php echo htmlspecialchars($item['price']); ?></td>
                                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                            <td>$ <?php echo htmlspecialchars($itemTotal); ?></td>
                                            <td>
                                                <form action="" method="post" style="display:inline;">
                                                    <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">
                                                    <button type="submit" name="remove_from_cart" class="btn-delete">&times;</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <th colspan="4">Total</th>
                                        <th>$ <?php echo htmlspecialchars($total); ?></th>
                                        <th></th>
                                    </tr>
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

    <!-- Food Search Section Start -->
    <section class="food-search text-center">
        <div class="container">
            <form action="">
                <input type="search" placeholder="Search for food..." required>
                <input type="submit" value="Search" class="btn-primary">
            </form>
        </div>
    </section>
    <!-- Food Search Section End -->

    <!-- Foods Section Start -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <div class="heading-border"></div>
            <div class="grid-2">
                <!-- Pizza -->
                <div class="food-menu-box">
                    <form action="" method="post">
                        <div class="food-menu-img">
                            <img src="img/food/p1.jpg" alt="" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4>Pizza</h4>
                            <p class="food-price">Rs. 400</p>
                            <p class="food-details">A delicious, cheesy pepperoni pizza with a crispy crust, topped with fresh tomato sauce and melted mozzarella cheese. Perfect for pizza lovers.</p>
                            <input type="number" name="quantity" value="1" min="1">
                            <input type="hidden" name="item_id" value="pizza_1">
                            <input type="hidden" name="item_name" value="Pizza">
                            <input type="hidden" name="item_price" value="400">
                            <input type="submit" name="add_to_cart" class="btn-primary" value="Add To Cart">
                        </div>
                    </form>
                </div>

                <!-- Burger -->
                <div class="food-menu-box">
                    <form action="" method="post">
                        <div class="food-menu-img">
                            <img src="img/food/b1.jpg" alt="" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4>Burger</h4>
                            <p class="food-price">Rs. 300</p>
                            <p class="food-details">A juicy grilled chicken burger with fresh lettuce, tomatoes, and a special house sauce, served in a soft sesame seed bun. A perfect choice for a satisfying meal.</p>
                            <input type="number" name="quantity" value="1" min="1">
                            <input type="hidden" name="item_id" value="burger_1">
                            <input type="hidden" name="item_name" value="Burger">
                            <input type="hidden" name="item_price" value="300">
                            <input type="submit" name="add_to_cart" class="btn-primary" value="Add To Cart">
                        </div>
                    </form>
                </div>

                <!-- Sandwich -->
                <div class="food-menu-box">
                    <form action="" method="post">
                        <div class="food-menu-img">
                            <img src="img/food/s1.jpg" alt="" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4>Sandwich</h4>
                            <p class="food-price">Rs. 200</p>
                            <p class="food-details">A crispy grilled sandwich filled with fresh vegetables, cheese, and a flavorful sauce, served with a side of crunchy potato chips. Great for a quick and tasty bite!</p>
                            <input type="number" name="quantity" value="1" min="1">
                            <input type="hidden" name="item_id" value="sandwich_1">
                            <input type="hidden" name="item_name" value="Sandwich">
                            <input type="hidden" name="item_price" value="200">
                            <input type="submit" name="add_to_cart" class="btn-primary" value="Add To Cart">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Foods Section End -->

    <!-- Footer Section Start -->
    <section class="footer">
        <div class="container">
            <div class="grid-3">
                <div class="text-center">
                    <h3>About Us</h3><br>
                    <p>Foodie Fly is a fast and reliable food delivery service connecting you with top restaurants for a seamless dining experience.</p>
                </div>
                <div class="text-center">
                    <h3>Site Map</h3><br>
                    <div class="site-links">
                        <a href="categories.html">Categories</a>
                        <a href="foods.html">Foods</a>
                        <a href="order.php">Order</a>
                        <a href="contact.php">Contact</a>
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
            <p>All rights reserved. Design By <a href="index.php">Foodie Fly</a></p>
        </div>
        <a id="back-to-top" class="btn-primary">
            <i class="fa fa-angle-double-up"></i>
        </a>
    </section>
    <!-- Copyright Section End -->

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!-- Custom JS -->
    <script src="js/custom.js"></script>
</body>
</html>