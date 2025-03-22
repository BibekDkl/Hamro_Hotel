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
                            <li><a href="login.php">Register</a></li>
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
                                    <div id="cart-content" class="cart-content">
                                        <h3 class="text-center">Shopping Cart</h3>
                                        <table class="cart-table">
                                            <?php foreach ($_SESSION['cart'] as $itemId => $item): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                                                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                                    <td>Rs. <?php echo htmlspecialchars($item['price'] * $item['quantity']); ?></td>
                                                    <td>
                                                        <form action="" method="post" style="display:inline;">
                                                            <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">
                                                            <button type="submit" name="remove_from_cart" class="btn-primary">Remove</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </table>
                                        <a href="order.php" class="btn-primary">Confirm Order</a>
                                    </div>
                                </table>
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
                <?php
                $sn = 1;
                $total = 0;
                foreach ($_SESSION['cart'] as $itemId => $item):
                    $itemTotal = $item['price'] * $item['quantity'];
                    $total += $itemTotal;
                ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><img src="img/food/<?php echo strtolower($item['name']) . '.jpg'; ?>" alt="Food"></td>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td>Rs. <?php echo htmlspecialchars($item['price']); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td>Rs. <?php echo htmlspecialchars($itemTotal); ?></td>
                        <td>
                            <form action="" method="post" style="display:inline;">
                                <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">
                                <button type="submit" name="remove_from_cart" class="btn-delete">&times;</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <th colspan="5">Total</th>
                    <th>Rs. <?php echo htmlspecialchars($total); ?></th>
                    <th></th>
                </tr>
            </table>
            <form action="Take_order.php" method="POST" class="form">
                <fieldset>
                    <legend>Delivery Details</legend>
                    <p class="label">Full Name</p>
                    <input type="text" name="name2" id="name2" placeholder="Enter your name..." required>
                    <p class="label">Phone Number</p>
                    <input type="text" name="phone_number" id="phone-number" placeholder="Enter your phone..." required>
                    <p class="label">Email</p>
                    <input type="text" name="email" id="email" placeholder="Enter your email..." required>
                    <p class="label">Address</p>
                    <input type="text" name="address" id="address" placeholder="Enter your address..." required>
                    <button type="submit" class="btn-primary">Confirm Order</button>
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