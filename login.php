<?php

session_start();

if(isset($_SESSION['user_id'])) header('location: dashboard.php');

$error_message='';

if($_POST){

  include("database/connection.php");

  $usernameemail = $_POST['usernameemail'];
  $password = $_POST['password'];
  $remember_me = isset($_POST['remember_me']);

  $query = "SELECT * FROM users WHERE email = ? AND pwd = ?;";
  $stmt = $conn->prepare($query);

  $stmt->bind_param("ss", $usernameemail, $password);

  $stmt->execute();

  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $allRows = $result->fetch_all(MYSQLI_ASSOC);
    $user = $allRows[0];
    
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['fullname'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['mobile'] = $user['mobile'];
    $_SESSION['profile_photo'] = $user['profile_photo'];
    $_SESSION['user_role'] = $user['user_role'];

    if ($remember_me)
    {
      // Generate a unique token
      $token = bin2hex(random_bytes(16));
      $expiration = date('Y-m-d H:i:s', strtotime('+30 days')); // Set token expiration (30 days)
      
      // Store token in the database
      $query = "INSERT INTO user_sessions (user_id, token, expiration) VALUES (?, ?, ?)"
      $stmt = $conn->prepare($query);
      $stmt->bind_param("iss", $user['id'], $token, $expiration); // Bind parameters
      $stmt->execute(); // Execute the query
      
      // Store token in a secure, HttpOnly cookie
      setcookie('remember_me', $token, time() + (30 * 24 * 60 * 60), "/", "", true, true); // 30 days expiration
    }

    header('Location: dashboard.php');
  }
  else {
      $error_message = "Invalid username/email or password.";
  }
}
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
    <form action="login.php" method="POST">
      <h2>Log in</h2>
        <div class="input-field">
        <input name="usernameemail" id="usernameemail" type="text" required>
        <label>Enter your email</label>
      </div>
      <div class="input-field">
        <input name="password" id="password" type="password" required>
        <label>Enter your password</label>
      </div>
      <br>
      <div style="color: white; text-align: left;">
      <input type="checkbox" id="remember_me" name="remember_me">
      <label>Remember Me</label>
      </div>
      <br>
      <button type="submit">Log In</button>
      <div class="register">
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
      </div>
    </form>
  </div>
</body>
</html>