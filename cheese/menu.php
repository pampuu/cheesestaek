<?php
session_start();
include 'header.php'; 
include 'db.php'; // Include the header
?>

<main>

<!-- Inline CSS to style the product page -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f3f3f3;
        margin: 0;
        padding: 0;
    }

    .catalogue {
        max-width: 1200px;
        margin: 50px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .catalogue h1 {
        font-size: 40px;
        color: #2c3e50;
        margin-bottom: 30px;
        border-bottom: 2px solid #ffcc00;
        display: inline-block;
        padding-bottom: 10px;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-top: 20px;
    }

    .product {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
        overflow: hidden;
    }

    .product:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    .product img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .product:hover img {
        transform: scale(1.1);
    }

    .product h2 {
        font-size: 24px;
        margin: 15px 0;
        color: #2c3e50;
    }

    .product p {
        font-size: 16px;
        color: #7f8c8d;
        margin: 10px 0;
    }

    .product .btn {
        display: inline-block;
        margin: 15px 0;
        padding: 12px 20px;
        background-color: #ffcc00;
        color: #2c3e50;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .product .btn:hover {
        background-color: #d4a000;
    }

    /* Responsive adjustments for smaller screens */
    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="catalogue">
    <h1>Our Products</h1>
    <div class="product-grid">
        <?php
        // Prepare and execute the SQL query
        $sql = "SELECT * FROM products";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // Fetch all the products
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Loop through the products and display them
        if ($products && count($products) > 0) {
            foreach ($products as $row) {
                echo "<div class='product'>";
                echo "<img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                echo "<p><strong>Price:</strong> $" . htmlspecialchars($row['price']) . "</p>";
                echo "<a href='add_to_cart.php?id=" . htmlspecialchars($row['id']) . "' class='btn'>Add to Cart</a>";
                echo "</div>";
            }
        } else {
            // Message if no products are found
            echo "<p>No products available at the moment.</p>";
        }
        ?>
    </div>
</div>
</main>

<?php
include 'footer.php'; // Include the footer
?>
