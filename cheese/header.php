<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cheese Factory</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
    <h1 style="font-size: 2.5rem; color: #4A148C; font-family: 'Arial', sans-serif; font-weight: bold; letter-spacing: 1px;">
    <a href="index.php" style="text-decoration: none; color: Skyblue; transition: color 0.3s ease;">
        Cheese Factory
    </a>
</h1>
        <div class="navbar">
            <!-- Logo on the left -->
            <div class="logo-container">
                <a href="index.php">
                    <img src="logo.png" alt="Cheese Factory Logo"style="width: 160px; height: 100px; object-fit: contain;">
                </a>
            </div>
            
           <h>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <?php if (isset($_SESSION['user_email'])): ?>
                        <li><a href="your_orders.php">Your Orders</a></li>
                    <?php endif; ?>

                    <li><a href="review.php">Leave a Review</a></li>
                    <li><a href="about.php">About</a></li>

                    <!-- Corrected: Check if user_email exists in the session -->
                    <?php if (!isset($_SESSION['user_email'])): ?>
                        <!-- If not logged in, show login link -->
                        <li><a href="login.php">Login</a></li>
                    <?php else: ?>
                        <!-- If logged in, show logout link and email -->
                        <li><a href="booking.php">Booking</a></li>
                        <li><a href="logout.php">Logout (<?php echo $_SESSION['user_email']; ?>)</a></li>
                        
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
</body>

</html>