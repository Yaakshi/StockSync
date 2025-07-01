<?php

include("dbcon.php");

session_start();

echo "<script>
      alert('Logout successful!');
      window.location.href = 'index.php';
      </script>";

session_unset();

session_destroy();

?>