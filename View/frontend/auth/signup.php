<?php
  include_once dirname(__FILE__). '/../../../Model/Client.php';
  include_once dirname(__FILE__). '/../../../Controller/ClientC.php';

  $sucessMsg = '';
  // Error Messeges
  $firstNameErr = '';
  $lastNameErr = '';
  $passwordErr = '';
  $emailErr = '';
  $phoneErr = '';

  // Password Checks
  $length_ok = false;
  $uppercase_ok = false;
  $lowercase_ok = false;
  $digit_ok = false;
  $special_ok = false;

  $email = '';

  if (
    isset($_POST['firstName'])
    && isset($_POST['lastName'])
    && isset($_POST['email'])
    && isset($_POST['password'])
    && isset($_POST['phone'])
  ) {
    if (empty($_POST['firstName'])) {
      $firstNameErr = 'First Name is Required!';
    }

    if (empty($_POST['lastName'])) {
      $lastNameErr = 'Last Name is Required!';
    }

    if (empty($_POST['password'])) {
      $passwordErr = 'Password is Required!';
    } else {
      // Check the length of the password
      if (strlen($_POST['password']) >= 8) {
        $length_ok = true;
      }

      // Check for uppercase letters
      if (preg_match("/[A-Z]/", $_POST['password'])) {
        $uppercase_ok = true;
      }

      // Check for lowercase letters
      if (preg_match("/[a-z]/", $_POST['password'])) {
        $lowercase_ok = true;
      }

      // Check for digits
      if (preg_match("/\d/", $_POST['password'])) {
        $digit_ok = true;
      }

      // Check for special characters
      if (preg_match("/[\W]/", $_POST['password'])) {
        $special_ok = true;
      }

      if (!$length_ok || !$uppercase_ok || !$lowercase_ok || !$digit_ok || !$special_ok) {
        $passwordErr = 'Password is weak!';
      }
    }

    if (empty($_POST['email'])) {
      $emailErr = 'Email is Required!';
    } else {
      $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Email address is not Valid!";
      } 
    }

    if (empty($_POST['phone'])) {
      $phoneErr = 'Phone Number is Required!';
    }

    if (
      $firstNameErr == ''
      && $lastNameErr == ''
      && $passwordErr == ''
      && $emailErr == ''
      && $phoneErr == ''
    ) {
      try {
        $clientC = new ClientC();
        $clientExists = $clientC->getClientByEmail($_POST['email']);
  
        if (!$clientExists) {
          $client = new Client(
            null,
            $_POST['firstName'],
            $_POST['lastName'],
            $_POST['email'],
            password_hash($_POST['password'], PASSWORD_DEFAULT),
            $_POST['phone'],
          );
  
          $clientC->addClient($client);


          header("Location: login.php?accountCreated=".true);
          exit();
        } else {
          $emailErr= 'This Email Already Exists!';
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
  <title>Sign Up</title>
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
    <form action="/zeineb-main/View/frontend/auth/signup.php" method="post">
      <section>
        <div class="inner">
          <a href="#" class="avartar">
            <img src="images/avartar.png" alt="">
          </a>
          <div class="form-row form-group">
            <div class="form-holder">
              <input type="text" name="firstName" class="form-control" placeholder="First Name">
              <span><?php echo $firstNameErr; ?></span>
            </div>
            <div class="form-holder">
              <input type="text" name="lastName" class="form-control" placeholder="Last Name">
              <span><?php echo $lastNameErr; ?></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-holder">
              <input type="password" name="password" class="form-control" placeholder="Password">
              <i class="zmdi zmdi-lock-open small"></i>
            </div>
            <span><?php echo $passwordErr; ?></span>
          </div>
          <div class="form-row">
            <div class="form-holder">
              <input type="email" name="email" class="form-control" placeholder="Email">
              <i class="zmdi zmdi-email small"></i>
            </div>
            <span><?php echo $emailErr; ?></span>
          </div>
          <div class="form-row">
            <div class="form-holder">
              <input type="text" name="phone" class="form-control" placeholder="Phone">
              <i class="zmdi zmdi-smartphone-android"></i>
            </div>
            <span><?php echo $phoneErr; ?></span>
          </div>
          <button class="btn-primary" type="submit">Sign Up</button>
        </div>
      </section>
    </form>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>

  <script src="js/main.js"></script>

</body>

</html>