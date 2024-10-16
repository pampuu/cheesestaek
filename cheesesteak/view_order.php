<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];

// Fetch order details
$stmt = $conn->prepare("SELECT * FROM orders WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$order = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch ordered products
$stmt = $conn->prepare("SELECT order_items.*, products.name,products.price,products.image FROM order_items JOIN products ON order_items.product_id = products.id WHERE order_items.order_id = :order_id");
$stmt->bindParam(':order_id', $id);
$stmt->execute();
$order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'; ?>

<div class="container">
    <h1>Order Details (Order ID: <?= $order['id'] ?>)</h1>
    <p>User ID: <?= $order['user_id'] ?></p>
    <p>Total: <?= $order['total'] ?></p>
    <p>Order Date: <?= $order['order_date'] ?></p>

    <h2>Ordered Products</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order_items as $item): ?>
                <tr>
                    <td><?= $item['name'] ?></td>
                    <td><img width="100" src="<?= $item['image'] ?>" /></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= $item['price'] * $item['quantity']  ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>