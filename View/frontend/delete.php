<?php
  include_once dirname(__FILE__). '/../../Controller/ClientC.php';

  $clientC = new ClientC();

  $clientC->deleteClient($_COOKIE['idClient']);

  setcookie('loggedin', false, time() + 3600, '/');
  setcookie('firstname', '', time() + 3600, '/');
  setcookie('lastname', '', time() + 3600, '/');
  setcookie('idClient', '', time() + 3600, '/');

  header('Location: ./index.php');
  exit();
  
?>
