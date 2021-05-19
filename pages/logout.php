<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?php
session_start();
unset($_SESSION['user']);
echo "<script> alert('You have been logged out sucsesfully');</script>";
echo "<script> window.location='login.php' </script>";
?>