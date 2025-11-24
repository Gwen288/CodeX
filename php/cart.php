<?php
session_start();

// Remove item
if (isset($_GET['remove'])) {
  $product = $_GET['remove'];
  unset($_SESSION['cart'][$product]);
}

// Get cart items
$cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Cart - Essentials</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="products.php">Essentials</a>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="products.php">Continue Shopping</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="py-5 bg-light">
    <div class="container">
      <h2 class="fw-semibold mb-4 text-center">Your Cart</h2>

      <?php if (empty($cart)) : ?>
        <p class="text-center text-muted">Your cart is empty.</p>
      <?php else: ?>
        <table class="table table-bordered bg-white">
          <thead class="table-light">
            <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($cart as $item => $qty) : ?>
              <tr>
                <td><?php echo htmlspecialchars($item); ?></td>
                <td><?php echo $qty; ?></td>
                <td><a href="?remove=<?php echo urlencode($item); ?>" class="btn btn-sm btn-outline-danger">Remove</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="text-center">
          <a href="#" class="btn btn-success">Proceed to Checkout</a>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <footer class="py-3 text-center text-muted small bg-white border-top">
    <p class="mb-0">© 2025 Essentials Supermarket</p>
  </footer>
</body>
</html>