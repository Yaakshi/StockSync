<?php

session_start();

$error_message='';

if (!isset($_SESSION['user_role'])) {
    header("Location: login.php");
    exit();
}

else if ($_SESSION['user_role'] !== 'admin') {
    // Redirect to the dashboard with an alert message in the URL
    header("Location: dashboard.php?alert=unauthorized");
    exit();
}

include("database/connection.php");

$query = "SELECT id, fullname, mobile, email FROM users;";
$stmt = $conn->prepare($query);

$stmt->execute();

$result = $stmt->get_result();


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Users</title>
	<link rel="stylesheet" type="text/css" href="view_users.css">
</head>
<body>
    <?php if ($error_message): ?>
        <script type="text/javascript">
            alert("<?php echo addslashes($error_message); ?>");
        </script>
  <?php endif; ?>
    
<div class="container"><br><br>
        <?php 
	if ($result->num_rows > 0) {
    echo '<ul class="responsive-table">';
    echo '<li class="table-header">';
    echo '<div class="col col-1">ID</div>';
    echo '<div class="col col-2">Full Name</div>';
    echo '<div class="col col-3">Mobile</div>';
    echo '<div class="col col-4">Email</div>';
    echo '</li>';
    while($row = $result->fetch_assoc()) {
        echo '<li class="table-row">';
        echo '<div class="col col-1" data-label="ID">'.$row['id'].'</div>';
        echo '<div class="col col-2" data-label="Full Name">'.$row['fullname'].'</div>';
        echo '<div class="col col-3" data-label="Mobile">'.$row['mobile'].'</div>';
        echo '<div class="col col-4" data-label="Email">'.$row['email'].'</div>';
        echo '</li>';
        }
    }
    else {
    echo "No users found.";
}
$conn->close();
?>
    </div>
</body>
</html>
