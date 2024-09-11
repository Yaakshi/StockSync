<?php

session_start();

$error_message='';

$user_id = $_SESSION['user_id'];

if ($_POST)
{

  include("database/connection.php");

  $new_fullname = $_POST['fullname'];
  $new_mobile = $_POST['mobile'];
  $new_email = $_POST['email'];
  $new_password = $_POST['newpwd'];
  $confirmnewpwd = $_POST['confirmnewpwd'];


  if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] !== UPLOAD_ERR_NO_FILE)
  {

    if ($_FILES['profile_photo']['error'] === UPLOAD_ERR_OK)
    {

      $targetDir = "uploads/";
      $fileName = basename($_FILES["profile_photo"]["name"]);
      $targetFilePath = $targetDir . $fileName;
      $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
      $allowTypes = ['jpg', 'jpeg', 'png'];

      if (in_array($fileType, $allowTypes))
      {
          if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $targetFilePath))
          {
            $_SESSION['profile_photo'] = $fileName;
          }
          else
          {
            $error_message="There was an error uploading your file.";
          }
      }
      else
      {
        $error_message = "Sorry, only JPG, JPEG, and PNG files are allowed.";
      }
    }
    else
    {
        $error_message = "Sorry, only JPG, JPEG, PNG files are allowed.";
    }
  }
  $error_message = "An error occurred during the file upload.";

  if ($new_password === $confirmnewpwd)
  {
    if (!empty($fileName))
    {
      $query = "UPDATE users SET fullname = ?, mobile = ?, email = ?, pwd = ?, profile_photo = ? WHERE id = ?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("sssssi", $new_fullname, $new_mobile, $new_email, $new_password, $targetFilePath, $user_id);
    }
    else
    {
      $query = "UPDATE users SET fullname = ?, mobile = ?, email = ?, pwd = ? WHERE id = ?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("ssssi", $new_fullname, $new_mobile, $new_email, $new_password, $user_id);
    }
  }
  else
  {
    $error_message = "Passwords do not match!";
  }
  if ($stmt->execute())
  {
    $_SESSION['user_name'] = $new_fullname;
    echo "<script>
    alert('Profile updated successfully!');
    window.location.href = 'dashboard.php';
    </script>";
  }
  else
  {
    $error_message="Profile updation failed!";
    exit();
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
  <title>Update Profile | StockSync</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php if ($error_message): ?>
        <script type="text/javascript">
            alert("<?php echo addslashes($error_message); ?>");
        </script>
  <?php endif; ?>
  <div class="wrapper">
    <form action="update_profile.php" method="POST" enctype="multipart/form-data">
      <h2>Update Profile</h2>
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
        <input name='newpwd' id='newpwd' type="password" required>
        <label>Enter your new password</label>
      </div>
      <div class="input-field">
        <input name='confirmnewpwd' id='confirmnewpwd' type="password" required>
        <label>Confirm your new password</label>
      </div>
      <div class="input-field">
        <input name='profile_photo' id='profile_photo' type="file" accept="image/*">
        <label style="font-size: 16px;">Profile Photo</label>
      </div>
      <button type="submit">Update</button>
    </form>
  </div>
</body>
</html>