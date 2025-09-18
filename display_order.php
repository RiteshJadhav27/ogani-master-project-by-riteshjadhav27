<?php
session_start();
include './Backend/database.php'; // Database connection

// Debugging: Check session values
if (!isset($_SESSION['user'])) { // Use 'user' instead of 'email'
    echo "<script>alert('Please log in to view your orders.'); window.location.href='login.html';</script>";
    exit();
}

$user_email = $_SESSION['user']; // Correct session key

// Fetch orders for the logged-in user
$sql = "SELECT * FROM orders WHERE email = ? ORDER BY order_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="my_orders.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
     <!-- Google Font -->
     <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

<!-- Css Styles -->
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
<link rel="stylesheet" href="css/nice-select.css" type="text/css">
<link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
<link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
<link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header">
      
      <div class="container">
          <div class="row">
              <div class="col-lg-3">
                  <div class="header__logo">
                      <a href="./index.html"><img src="img/logo.png" alt=""></a>
                  </div>
              </div>
              <div class="col-lg-6">
                  <nav class="header__menu">
                      <ul>
                          <li class="active"><a href="./index.html">Home</a></li>
                          <li><a href="./shop-grid.html">Shop</a></li>
                          <li><a href="#">Menu</a>
                              <ul class="header__menu__dropdown">
                                  <li><a href="./shop-details.html">Shop Details</a></li>
                                  <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                  <li><a href="./checkout.html">Check Out</a></li>
                                  <li><a href="./display_order.php">View Orders</a></li>
                                  
                              </ul>
                          </li>
                          <li><a href="./shop-details.html">Shop Details</a></li>
                          <li><a href="./contact.html">Contact</a></li>
                      </ul>
                  </nav>
              </div>
              <div class="col-lg-3">
                  <div class="header__cart">
                      <ul>
                          <li><a href="shoping-cart.html"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li>
                      </ul>
                      <div class="header__top__right__auth">
                          <button id="headLoginButton" onclick="window.location.href='./sign.html'" style="color: white;" class="button"> 
                              <i class="fa fa-user"></i> Login
                          </button>
                      </div>
                  </div>
                  
              </div>
          </div>
          <div class="humberger__open">
              <i class="fa fa-bars"></i>
          </div>
      </div>
  </header>
    
<div class="container mt-5">
    <h2 class="text-center">My Orders</h2>

    <?php if ($result->num_rows > 0) { ?>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Order Details</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td>#<?php echo $row['order_id']; ?></td>
                        <td><?php echo $row['order_details']; ?></td>
                        <td>₹<?php echo $row['total_amount']; ?></td>
                        <td><span class="badge bg-<?php echo ($row['status'] == 'Completed') ? 'success' : 'warning'; ?>">
                            <?php echo $row['status']; ?>
                        </span></td>
                        <td><?php echo $row['order_date']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center text-danger">You have not placed any orders yet.</p>
    <?php } ?>
</div>

<footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 16 Street Gangapur Road Nashik</li>
                            <li>Phone: +91 1800 450 444</li>
                            <li>Email: organicfruitmart@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="shop-details.html">About Us</a></li>
                            <li><a href="">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="contact.html">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                       
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/logcheck.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
