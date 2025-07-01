<?php 

session_start();

if(!isset($_SESSION['user_id'])) header('location: index.php');

if (isset($_GET['alert']) && $_GET['alert'] === 'unauthorized') {
    echo '<script>alert("You are not authorized to access the view_users page.");</script>';
}

$user['id'] = $_SESSION['user_id'];
$user['fullname'] = $_SESSION['user_name'];
$user['email'] = $_SESSION['user_email'];
$user['mobile'] = $_SESSION['mobile'];
$user['user_role']=$_SESSION['user_role'];

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | StockSync</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style type="text/css">
      @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@200;300;400;500;600;700&display=swap");
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Monoton&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');

body {
    font-family: "Poppins", sans-serif;
    margin: 0;
    padding: 0;
    height: 100vh;
    width: 100%;
    background-image: url("images/hero-bg.jpg");
    background-position: center;
    background-size: cover;
}

.service-buttons {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    padding: 40px;
}

.service-button {
    
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(8px);
    --webkit-backdrop-filter: blur(17px);
    border-right: 1px solid rgba(255, 255, 255, 0.7);
    border-radius: 15px;
    padding: 20px;
    width: 200px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-decoration: none;
    color: #333;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.3); 
}

.service-button:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.service-button .icon {
    font-size: 40px;
    margin-bottom: 10px;
    color: #ffffff; /* Change icon color to match the frosted style */
}

.service-button h3 {
    margin: 10px 0;
    font-size: 1.2em;
    color: #ffffff; /* White text for title */
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2); /* Subtle shadow for readability */
}

.navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar a {
      color: white;
      text-decoration: none;
      margin: 0 15px;
      font-size: 16px;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }

    .navbar a:hover {
      color: #007bff;
    }

    .navbar .logout-button {
      background: rgba(255, 255, 255, 0.2); /* Semi-transparent red */
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.3); /* Light border */
      padding: 10px 20px;
      color: white;
      font-size: 16px;
      cursor: pointer;
      border-radius: 10px;
      transition: background-color 0.3s ease;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
      position: absolute;
      top: 10px;
      right: 25px;
      margin: 10px 0;
    font-size: 1.2em;
    color: #ffffff;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);

    }

    .navbar .logout-button:hover {
      background: rgba(255, 255, 255, 0.4); /* Darker red on hover */
    }

</style>
</head>
<body>


  <div class="navbar">
    <button class="logout-button" style=" top: 10px;
      right: 1350px;"><h3><?= $user['fullname']?></h3></button>
    <a href="profile.php"><button class="logout-button" style=" top: 10px;
      right: 135px;">Profile</button></a>
    <a href="logout.php"><button class="logout-button" onclick="logout()">Logout</button></a>
  </div>



    <div class="service-buttons">
        <a href="#service1" class="service-button">
            <div class="icon"><i class="fa fa-dashboard" style="font-size:48px;color:#7fcef3"></i></div>
            <h3>Dashboard</h3>
        </a>
        <a href="#service2" class="service-button">
            <div class="icon"><i class="fa fa-pie-chart" style="font-size:48px;color:#7fcef3"></i></div>
            <h3>Reports</h3>
        </a>
    </div>
    <div class="service-buttons">
        <a href="#service1" class="service-button">
            <div class="icon"><i class="fa fa-cube" style="font-size:48px;color:#7fcef3"></i></div>
            <h3>View Product</h3>
        </a>
        <a href="#service2" class="service-button">
            <div class="icon"><i class="fa fa-cubes" style="font-size:48px;color:#7fcef3"></i></div>
            <h3>Add Product</h3>
        </a>
        <a href="#service2" class="service-button">
            <div class="icon"><i class="material-icons" style="font-size:48px;color:#7fcef3">assignment</i></div>
            <h3>View Orders</h3>
        </a>
        <a href="#service2" class="service-button">
            <div class="icon"><i class="material-icons" style="font-size:48px;color:#7fcef3">add_shopping_cart</i></div>
            <h3>Create Orders</h3>
        </a>
    </div>
    <div class="service-buttons">
        <a href="#service1" class="service-button">
            <div class="icon"><i class="fa fa-truck" style="font-size:48px;color:#7fcef3"></i></div>
            <h3>View Supplier</h3>
        </a>
        <a href="#service2" class="service-button">
            <div class="icon"><i class="fa fa-ambulance" style="font-size:48px;color:#7fcef3"></i></div>
            <h3>Add Supplier</h3>
        </a>

        <?php if ($_SESSION['user_role'] === 'admin'): ?>
        <a href="view_users.php" class="service-button">
            <div class="icon"><i class="fa fa-address-card" style="font-size:48px;color:#7fcef3"></i></div>
            <h3>View Users</h3>
        </a>
        <?php else: ?>
            <a href="view_users.php" class="service-button" onclick="alert('You are not authorised to access this page!'); return false;">
            <div class="icon"><i class="fa fa-address-card" style="font-size:48px;color:#7fcef3"></i></div>
            <h3>View Users</h3>
        </a>
        <?php endif; ?>

        <a href="update_profile.php" class="service-button">
            <div class="icon"><i class="material-icons" style="font-size:48px;color:#7fcef3">person_add</i></div>
            <h3>Update Profile</h3>
        </a>

    </div>
</body>
</html>