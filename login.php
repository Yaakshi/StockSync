<?php

use Firebase\Auth\Token\Exception\InvalidToken;

session_start();

if(isset($_SESSION['user_id'])) header('location: dash.php');

include("dbcon.php");

$error_message='';

if($_POST){

  $usernameemail = $_POST['usernameemail'];
  $password = $_POST['password'];

  try {
    $user = $auth->getUserByEmail( "$usernameemail" );

    $signInResult = $auth->signInWithEmailAndPassword($usernameemail, $password);
    $idTokenString = $signInResult->idToken();

    try {
      $verifiedIdToken = $auth->verifyIdToken($idTokenString);
      $uid = $signInResult->firebaseUserId();

      $_SESSION['user_id'] = $uid  ;
      $_SESSION['idTokenString'] = $idTokenString;

      echo "<script>
      alert('Login successful!');
      window.location.href = 'dash.php';
      </script>";

    } catch (InvalidToken $e) {
      echo 'The token is invalid: '.$e->getMessage();
    }
  }
  catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
    $error_message = "Login failed.";
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
    <form id="login" action="login.php" method="POST">
      <h2>Log in</h2>
        <div class="input-field">
        <input name="usernameemail" id="usernameemail" type="text" required>
        <label>Enter your email</label>
      </div>
      <div class="input-field">
        <input name="password" id="password" type="password" required>
        <label>Enter your password</label>
      </div><br>
      <button type="submit">Log In</button>
      <div class="register">
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
      </div>
    </form>
  </div>
</body>
</html>