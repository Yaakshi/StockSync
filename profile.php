<?php

session_start();

$error_message='';

$user['id'] = $_SESSION['user_id'];
$user['fullname'] = $_SESSION['user_name'];
$user['email'] = $_SESSION['user_email'];
$user['mobile']=$_SESSION['mobile'];
$user['profile_photo'] = $_SESSION['profile_photo'] ?? 'uploads/default.jpg';

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title> My Profile </title>
  <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
.main{
  width: 100%;
  height: 100%;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: url("images/hero-bg2.jpg"), #000;
  background-position: center;
  background-size: cover;
}
.profile-card{
  color: white;
  display: flex;
  flex-direction: column;
  align-items: center;
  max-width: 400px;
  width: 100%;
  border-radius: 25px;
  padding: 30px;
  border: 1px solid #ffffff40;
  box-shadow: 0 5px 20px rgba(0,0,0,0.4);
  border: 1px solid rgba(255, 255, 255, 0.5);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
}
.image{
  position: relative;
  height: 150px;
  width: 150px;
}
.image .profile-pic{
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
  box-shadow: 0 5px 20px rgba(0,0,0,0.4);
}
.data{
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 15px;
}
.data h2{
  font-size: 33px;
  font-weight: 600;
}
span{
  font-size: 18px;
}
.row{
  display: flex;
  align-items: center;
  margin-top: 30px;
}
.row .info{
  text-align: center;
  padding: 0 20px;
}
.buttons{
  display: flex;
  align-items: center;
  margin-top: 30px;
}

button {
  background: #fff;
  color: #000;
  font-weight: 600;
  border: none;
  padding: 12px 20px;
  cursor: pointer;
  border-radius: 3px;
  font-size: 16px;
  border: 2px solid transparent;
  transition: 0.3s ease;
}

button:hover {
  color: #fff;
  border-color: #fff;
  background: rgba(255, 255, 255, 0.15);
}

.buttons .btn{
  color: #fff;
  text-decoration: none;
  margin: 0 20px;
  padding: 8px 25px;
  border-radius: 25px;
  font-size: 18px;
  white-space: nowrap;
  background: skyblue;
}

.buttons .btn:hover{
  box-shadow: inset 0 5px 20px rgba(255,255,255,0.4);
}

.profile-photo {
    display: flex;
    justify-content: center; /* Center the image horizontally */
    align-items: center; /* Center the image vertically */
    margin-bottom: 20px; /* Space below the profile photo */
}

.profile-photo img {
    width: 170px; /* Set the width of the profile photo */
    height: 170px; /* Set the height of the profile photo */
    border-radius: 50%; /* Make the profile photo circular */
    border: 4px solid skyblue; /* White border around the profile photo */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow for a 3D effect */
    object-fit: cover;
}

</style>
</head>
<body>
  <section class="main">
  <div class="profile-card">
    <div class="profile-photo">
        <img src="<?php echo htmlspecialchars($user['profile_photo']); ?>" alt="Profile Photo">
    </div>
    <div class="data">
      <h2><?= $user['fullname']?></h2>
    </div>
    <div class="buttons">
      <p href="#" class="btn"><strong>Mobile: </strong><?= $user['mobile']?></p>
    </div>
    <div class="buttons">
      <p href="#" class="btn"><strong>Email: </strong><?= $user['email']?></p>
    </div><br>
  </div>
</section>
</body>
</html>