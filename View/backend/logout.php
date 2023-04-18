<?php 
  setcookie('adminLoggedin', false, time() + 3600, '/');
  setcookie('adminFirstname', '', time() + 3600, '/');
  setcookie('adminLastname', '', time() + 3600, '/');
  setcookie('idAdmin', '', time() + 3600, '/');

  header('Location: ./login.php');
  exit();
  
?>
