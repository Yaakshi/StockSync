<?php

use Firebase\Auth\Token\Exception\InvalidToken;

session_start();

if(isset($_SESSION['user_id'])) header('location: dash.php');

include("dbcon.php");

$error_message='';

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log in | StockSync</title>
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
    <form id="login" action="loginphone.php" method="POST">
      <h2>Log in</h2>

        <div class="input-field">
        <input name="mobile" id="mobile" type="text" required>
        <label>Enter your phone number</label>
      </div>

      <div class="recaptcha-container" id="recaptcha-container"></div>

      <button onclick="sendotp()" type="button">Send OTP</button>

      <br>

      <div class="input-field">
        <input name="otp" id="otp" type="otp" required>
        <label>Enter your OTP</label>
      </div>

      <button type="button">Verify OTP</button>

      <div class="register">
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
      </div>
    </form>
  </div>
  <script src="https://www.gstatic.com/firebasejs/ui/6.1.0/firebase-ui-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/5.3.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/5.3.0/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/5.3.0/firebase-database.js"></script>
  <script src="phonelogin.js"></script>
</body>
</html>