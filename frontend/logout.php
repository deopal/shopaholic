<?php
session_start();
unset($_SESSION['front-user']);
echo "<script> alert('You have been logged out sucsesfully');</script>";
echo "<script> window.location='index.php' </script>";
?>