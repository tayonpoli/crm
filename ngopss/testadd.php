<?php
include('koneksi.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to Cart without Refresh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<!-- Product details and Add to Cart button -->
<div id="cart-toast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
      Sucessful added item
     </div>
      <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>

<div class="special__grid">
        <?php
        $query2 = mysqli_query($koneksi, 'SELECT * FROM produk where jenis_menu = "Coffee"');
        $result = mysqli_fetch_all($query2, MYSQLI_ASSOC);
        ?>
        <?php foreach($result as $result) : ?>

            <div class="special__card">
              <img src="upload/<?php echo $result['gambar'] ?>" alt="..."><br>
              <p class="price"><?php echo $result['jenis_menu'] ?></p>
                <h4><?php echo $result['nama_menu'] ?></h4>
                <p class="price">Rp. <?php echo number_format($result['harga']); ?></p><br>
               <div class="special__footer">
               
              <button class="btn add-to-cart" data-product-id="<?php echo $result['id_menu']; ?>">Add to cart</button>
             </div>
              </div>
              <?php endforeach; ?>
      </div>
<div id="product-details">
    <h2>Product Page</h2>
    <p>Product details go here.</p>
    <button id="add-to-cart1" data-product-id="1">Add to Cart</button>
</div>

<!-- Cart display (you should customize this based on your design) -->
<div id="cart">
    <h2>Shopping Cart</h2>
    <ul id="cart-items">
        <!-- Cart items will be displayed here -->
    </ul>
</div>

<!-- Bootstrap Toast -->

<!-- JavaScript to handle the AJAX request and display toast -->
<script>
    $(document).ready(function () {
        // Add to Cart button click event
        $('.add-to-cart').on('click', function () {
            var productId = $(this).data('product-id');
            var toastLiveExample = document.getElementById('cart-toast')
                    var toast = new bootstrap.Toast(toastLiveExample)

                    toast.show()

            // AJAX request to add the product to the cart
            $.ajax({
                type: 'POST',
                url: 'add_to_cart.php',
                data: { product_id: productId },
                success: function (response) {
                    // Update the cart display with the new data
                    $('#cart-items').html(response);
                    
                }
            });
        });
    });
</script>

</body>
</html>
