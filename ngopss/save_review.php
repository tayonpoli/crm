<?php
include('koneksi.php');
session_start();
      if(!isset($_SESSION['login_user'])) {
        header("location: login.php");
      }else{

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $koneksi->real_escape_string($_POST['name']);
    $review = $koneksi->real_escape_string($_POST['review']);
    $rating = intval($_POST['rating']);

    $sql = "INSERT INTO reviews (name, review, rating, created_at) VALUES ('$name', '$review', '$rating', NOW())";

    if ($koneksi->query($sql) === TRUE) {
        $message = "Review berhasil ditambahkan";
    } else {
        $message = "Error: " . $sql . "<br>" . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Ngopss</title>
    <style>
        /* Tambahan styling khusus untuk halaman ini */
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .review-form {
            margin-bottom: 30px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .review-form h2 {
            margin-bottom: 20px;
            font-size: 1.8rem;
            color: #333;
        }

        .review-form form {
            display: grid;
            grid-gap: 10px;
        }

        .review-form label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .review-form input[type="text"],
        .review-form textarea,
        .review-form select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .review-form button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .reviews {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
        }

        .reviews h2 {
            margin-bottom: 20px;
            font-size: 1.8rem;
            color: #333;
        }

        .review-item {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .review-item h3 {
            margin-bottom: 5px;
            font-size: 1.2rem;
            color: #333;
        }

        .review-item p {
            margin-bottom: 10px;
            color: #666;
        }

        .review-item small {
            color: #999;
        }

        .alert {
            margin-top: 20px;
            padding: 10px;
            background-color: #f2dede;
            border: 1px solid #ebccd1;
            color: #a94442;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
        
    <div class="container" style="margin-bottom: 8rem;">
        <!-- Display message after form submission -->
        <?php if (isset($message)): ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>

        <div class="review-form">
            <h2>Leave a Review</h2>
            <form id="reviewForm" action="save_review.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="review">Review:</label>
                <textarea id="review" name="review" rows="4" required></textarea>
                <label for="rating">Rating:</label>
                <select id="rating" name="rating" required>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Good</option>
                    <option value="3">3 - Average</option>
                    <option value="2">2 - Poor</option>
                    <option value="1">1 - Terrible</option>
                </select>
                <button type="submit">Submit</button>
            </form>
        </div>

        <div class="reviews">
            <h2>Recent Reviews</h2>
            <div id="reviewList">
                <?php
                $sql = "SELECT name, review, rating, created_at FROM reviews ORDER BY created_at DESC";
                $result = $koneksi->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='review-item'>";
                        echo "<h3>" . htmlspecialchars($row['name']) . " - " . $row['rating'] . " Stars</h3>";
                        echo "<p>" . htmlspecialchars($row['review']) . "</p>";
                        echo "<small>Reviewed on " . $row['created_at'] . "</small>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No reviews yet!</p>";
                }

                $koneksi->close();
                ?>
            </div>
        </div>
    </div>

    <footer class="footer" id="contact">
      <div class="section__container footer__container">
        <div class="footer__col">
          <div class="logo footer__logo">
          <a href=""><img style="height: 45px; width: 200px;" src="assets/logo.png" alt="logo"></a>
          </div>
          <p class="section__description">
           Brewing Moments and Sipping Memories, where every sip tells
            a story and every coffee is brew to perfection.
          </p>
        </div>
        <div class="footer__col">
          <h4>Privacy</h4>
          <ul class="footer__links">
            <li><a href="#">Terms of Use</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Cookies</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>Product</h4>
          <ul class="footer__links">
            <li><a href="#">Menu</a></li>
            <li><a href="#">Special Offer</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>Information</h4>
          <ul class="footer__links">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Career</a></li>
            <li><a href="#">Contact Us</a></li>
          </ul>
        </div>
      </div>
      <div class="footer__bar">
        Copyright © 2024 Tayonpoli. All rights reserved.
      </div>
    </footer>
</body>
</html>
<?php } ?>