<?php

session_start();

if(isset($_SESSION['user_id'])) header('location: dashboard.php');

include("database/connection.php");

$error_message='';


if (isset($_COOKIE['remember_me']))
  {
    $token = $_COOKIE['remember_me'];
    $query="SELECT user_id FROM user_tokens WHERE token = ?;";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("s", $token);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0){

    $allRows = $result->fetch_all(MYSQLI_ASSOC);
    $user = $allRows[0];

    $_SESSION['user_id'] = $user['user_id'];
  }
  else {
        setcookie('remember_me', $token, time() - 3600, '/', 'localhost', true, true, ['samesite' => 'Lax']);
    }

}

if($_POST){

  $usernameemail = $_POST['usernameemail'];
  $password = $_POST['password'];

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


    if (isset($_POST['remember_me'])) {
      $token = bin2hex(random_bytes(16));
      // $expiresAt = date('Y-m-d H:i:s', time() + (1 * 60 * 60));

      $query="INSERT INTO user_tokens (user_id, token, expires_at) VALUES (?, ?, NOW() + INTERVAL 1 HOUR);";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("is", $_SESSION['user_id'], $token);

      $stmt->execute();

      setcookie('remember_me', $token, time() + (30 * 24 * 60 * 60), "/", "localhost", true, true);

      }

    header('Location: dashboard.php');
  }
  else {
      $error_message = "Invalid username/email or password.";
  }
  $stmt->close();
  $conn->close();
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
      <div>
        <input type="checkbox" id="remember_me" name="remember_me">
        <label style="color: white;">Remember Me</label>
    </div><br>
      <button type="submit">Log In</button>
      <div class="register">
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
      </div>
    </form>
  </div>
</body>
</html>