<?php
session_start();

// Initialize cart if not already
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

// Handle Add to Cart action
if (isset($_GET['add'])) {
  $product = $_GET['add'];
  if (!isset($_SESSION['cart'][$product])) {
    $_SESSION['cart'][$product] = 1;
  } else {
    $_SESSION['cart'][$product]++;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Essentials - Product Catalog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style_.css">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="#">Essentials</a>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" href="../html/homepage.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="cart.php">Cart 
            <span class="badge bg-primary">
              <?php echo array_sum($_SESSION['cart']); ?>
            </span>
          </a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Product Catalog -->
  <section class="products py-5 bg-light">
    <div class="container">
      <h2 class="fw-semibold mb-4 text-center">Available Products</h2>
      <div class="row g-4">

        <?php
        $products = [
          ["name" => "Chocolate Bar", "price" => 5],
          ["name" => "Bottled Water", "price" => 3],
          ["name" => "Cookies", "price" => 8],
          ["name" => "Toilet Roll", "price" => 10],
        ];

        foreach ($products as $p) {
          echo '
          <div class="col-md-3 col-sm-6">
            <div class="card product-card border-0 shadow-sm">
              <img src="https://via.placeholder.com/200" class="card-img-top" alt="' . $p["name"] . '">
              <div class="card-body text-center">
                <h6 class="card-title">' . $p["name"] . '</h6>
                <p class="text-muted small mb-2">₵' . $p["price"] . '.00</p>
                <a href="?add=' . urlencode($p["name"]) . '" class="btn btn-sm btn-primary">Add to Cart</a>
              </div>
            </div>
          </div>
          ';
        }
        ?>

      </div>
    </div>
  </section>

  <footer class="py-3 text-center text-muted small bg-white border-top">
    <p class="mb-0">© 2025 Essentials Supermarket</p>
  </footer>

</body>
</html>
