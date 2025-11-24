<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Essentials - Product Catalog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="#">Essentials</a>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" href="products.php">Home</a></li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php">Cart 
              <span class="badge bg-primary" id="cart-count">
                <?php echo array_sum($_SESSION['cart'] ?? []); ?>
              </span>
            </a>
          </li>
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
                <button class="btn btn-sm btn-primary add-to-cart" data-name="' . $p["name"] . '">Add to Cart</button>
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

  <!-- JavaScript for AJAX Cart -->
  <script>
    document.querySelectorAll('.add-to-cart').forEach(button => {
      button.addEventListener('click', () => {
        const product = button.getAttribute('data-name');
        fetch('cart_api.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: `action=add&product=${encodeURIComponent(product)}`
        })
        .then(res => res.json())
        .then(data => {
          document.getElementById('cart-count').textContent = data.total;
        });
      });
    });
  </script>

</body>
</html>
