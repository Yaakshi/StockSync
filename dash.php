<?php 

session_start();

if(!isset($_SESSION['user_id'])) header('location: index.php');

$user['id'] = $_SESSION['user_id'];
$user['fullname'] = $_SESSION['user_name'];
$user['email'] = $_SESSION['user_email'];


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | StockSync</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="dashboard.css">
  </head>
  <body>
    <aside class="sidebar">
      <div class="logo">
        <img src="images/logo.jpg" alt="logo">
        <h2>StockSync</h2>
      </div>
      <div class="profilename">
        <h3><?= $user['fullname']?></h3>
      </div>
      <ul class="links">
        <li>
          <span class="material-symbols-outlined white-icon">dashboard</span>
          <a href="#">Dashboard</a>
        </li>
        <li>
          <span class="material-symbols-outlined white-icon">show_chart</span>
          <a href="#">Reports</a>
        </li>
        <hr>
        <h4><strong>Product</strong></h4>
        <li>
          <span class="material-symbols-outlined white-icon">person</span>
          <a href="#">View Product</a>
        </li>
        <li>
          <span class="material-symbols-outlined white-icon">group</span>
          <a href="#">Add Product</a>
        </li>
        <hr>
        <h4><strong>Supplier</strong></h4>
        <li>
          <span class="material-symbols-outlined white-icon">bar_chart</span>
          <a href="#">View Supplier</a>
        </li>
        <li>
          <span class="material-symbols-outlined white-icon">mail</span>
          <a href="#">Add Supplier</a>
        </li>
        <hr>
        <h4><strong>Purchase Order</strong></h4>
        <li>
          <span class="material-symbols-outlined white-icon">person</span>
          <a href="#">View Orders</a>
        </li>
        <li>
          <span class="material-symbols-outlined white-icon">group</span>
          <a href="#">Create Order</a>
        </li>
        <hr>
        <h4><strong>Users</strong></h4>
        <li>
          <span class="material-symbols-outlined white-icon">person</span>
          <a href="view_users.php" onclick="loadContent('view_users')">View Users</a>
        </li>
        <hr>
        <li>
          <span class="material-symbols-outlined white-icon">settings</span>
          <a href="#">Settings</a>
        </li>
        <li class="logout-link">
          <span class="material-symbols-outlined white-icon">logout</span>
          <a href="database/logout.php">Logout</a>
        </li>
      </ul>
    </aside>
  </body>
</html>