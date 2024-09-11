<?php

session_start();

if(isset($_SESSION['user_id'])) header('location: dashboard.php');

$error_message='';

if($_POST){

  include("database/connection.php");

  $fullname = $_POST['fullname'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $password = $_POST['pwd'];
  $confirmpwd = $_POST['confirmpwd'];

  if ($password === $confirmpwd) {

  $query = "INSERT INTO users (fullname, mobile, email, pwd) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($query);

  $stmt->bind_param("ssss", $fullname, $mobile, $email, $password);

  if ($stmt->execute()) {
    echo "<script>
          alert('Registration successful! You will now be redirected to the login page.');
          window.location.href = 'login.php';
          </script>";
    }
    else {
            $error_message="Passwords do not match!";
            exit();
        }

    $stmt->close();
    $conn->close();

}
else{
  $error_message="Passwords do not match!";
}
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up | StockSync</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php if ($error_message): ?>
        <script type="text/javascript">
            alert("<?php echo addslashes($error_message); ?>");
        </script>
  <?php endif; ?>
  <div class="wrapper">
    <a href="index.php">
    <h1>StockSync</h1>
    </a>
    <form action="signup.php" method="POST">
      <h2>Sign up</h2>
      <div class="input-field">
        <input name='fullname' id='fullname' type="text" required>
        <label>Enter your full name</label>
      </div>
      <div class="input-field">
        <input name='mobile' id='mobile' type="tel" required>
        <label>Enter your mobile number</label>
      </div>
        <div class="input-field">
        <input name='email' id='email' type="text" required>
        <label>Enter your email</label>
      </div>     
      <div class="input-field">
        <input name='pwd' id='pwd' type="password" required>
        <label>Enter your password</label>
      </div>
      <div class="input-field">
        <input name='confirmpwd' id='confirmpwd' type="password" required>
        <label>Confirm your password</label>
      </div>
      <button type="submit">Signup</button>
      <div class="register">
        <p>Already have an account? <a href="login.php">Log in</a></p>
      </div>
    </form>
  </div>
</body>
</html>