<?php
  include_once dirname(__FILE__). '/../../../Model/Client.php';
  include_once dirname(__FILE__). '/../../../Controller/ClientC.php';

  $sucessMsg = '';
  $errMsg = '';
  // Error Messeges

  $passwordErr = '';
  $emailErr = '';

  if (isset($_GET['accountCreated'])) {
    $accountCreated = $_GET['accountCreated'];

    if($accountCreated == true) {
      $sucessMsg = 'Your Account is Successfully Created!';
    }
  }

  if (
    isset($_POST['email'])
    && isset($_POST['password'])
  ) {
    
    if (empty($_POST['password'])) {
      $passwordErr = 'Password is Required!';
    }
  
    if (empty($_POST['email'])) {
      $emailErr = 'Email is Required!';
    }
    
    if (
      $passwordErr == ''
      && $emailErr == ''
    ) {
      try {
        $clientC = new ClientC();
        $clientExists = $clientC->getClientByEmail($_POST['email']);
  
        if (!$clientExists) {
          $errMsg = 'This Account doesn not exist';
        } else {
          if (password_verify($_POST['password'], $clientExists['password'])) {
            setcookie('loggedin', true, time() + 3600, '/');
            setcookie('firstname', $clientExists['firstname'], time() + 3600, '/');
            setcookie('lastname', $clientExists['lastname'], time() + 3600, '/');
            setcookie('idClient', $clientExists['idClient'], time() + 3600, '/');

            header('Location: ../index.php');
            exit();
          } else {
            $passwordErr = 'Your Password is incorrect!';
          }
        }

      } catch (Exception $e) {
        echo $e;
      } 
    }

  }
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- MATERIAL DESIGN ICONIC FONT -->
  <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.css">
  <!-- STYLE CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="wrapper">
    <?php 
      if ($sucessMsg !== '') {
        echo '<div class="success-msg">'.$sucessMsg.'</div>' ;
      }
    ?>
    <?php 
      if ($errMsg !== '') {
        echo '<div class="err-msg">'.$errMsg.'</div>' ;
      }
    ?>
    <form action="/zeineb-main/View/frontend/auth/login.php" method="post">
      <section>
        <div class="inner">
          <a href="#" class="avartar">
            <img src="images/avartar.png" alt="">
          </a>
          <div class="form-row">
            <div class="form-holder">
              <input type="email" name="email" class="form-control" placeholder="Email">
              <i class="zmdi zmdi-email small"></i>
            </div>
            <span><?php echo $emailErr; ?></span>
          </div>
          <div class="form-row">
            <div class="form-holder">
              <input type="password" name="password" class="form-control" placeholder="Password">
              <i class="zmdi zmdi-lock-open small"></i>
            </div>
            <span><?php echo $passwordErr; ?></span>
          </div>
          <button class="btn-primary" type="submit">login</button>
        </div>
      </section>
    </form>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>

  <script src="js/main.js"></script>

</body>

</html>