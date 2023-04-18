<?php 
  include_once dirname(__FILE__). '/../../Model/Admin.php';
  include_once dirname(__FILE__). '/../../Controller/AdminC.php';

  $firstNameErr = '';
  $lastNameErr = '';
  $passwordErr = '';
  $emailErr = '';
  $length_ok = '';
  $uppercase_ok = ''; 
  $lowercase_ok= '';
  $digit_ok= '';
  $special_ok= '';


  if(isset($_COOKIE['adminLoggedin'])) {
    if($_COOKIE['adminLoggedin']){
    header('C:/xampp/htdocs/web/View/backend/index.php');
    exit();
    }
  }

  if (
    isset($_POST['firstName'])
    && isset($_POST['lastName'])
    && isset($_POST['email'])
    && isset($_POST['password'])
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

    if (
      $firstNameErr == ''
      && $lastNameErr == ''
      && $passwordErr == ''
      && $emailErr == ''
    ) {
      try {
        $adminC = new AdminC();
        $adminExists = $adminC->getAdminByEmail($_POST['email']);
  
        if (!$adminExists) {
          $admin = new Admin(
            null,
            $_POST['firstName'],
            $_POST['lastName'],
            $_POST['email'],
            password_hash($_POST['password'], PASSWORD_DEFAULT),
          );
  
          $adminC->addAdmin($admin);

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
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cultrify</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <div class="container-fluid position-relative d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
      <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <!-- Spinner End -->

    <!-- Sign Up Start -->
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="index.html" class="">
                          <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Cultrify</h3>
                        </a>
                        <h3>Sign Up</h3>
                    </div>
                    <form action="/web/View/backend/signup.php" method="post">
                      <div class="form-floating mb-3">
                        <input type="text" name="firstName" class="form-control" id="floatingText" placeholder="First name">
                        <label for="floatingText">First name</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input type="text" name="lastName" class="form-control" id="floatingText" placeholder="Last name">
                        <label for="floatingText">Last name</label>
                      </div>
                      <div class="form-floating mb-3">
                          <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                          <label for="floatingInput">Email address</label>
                      </div>
                      <div class="form-floating mb-4">
                          <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                          <label for="floatingPassword">Password</label>
                      </div>
                      <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                      <p class="text-center mb-0">Already have an Account? <a href="login.php">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
      </div>
      <!-- Sign Up End -->
  </div>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/lib/chart/chart.min.js"></script>
  <script src="assets/lib/easing/easing.min.js"></script>
  <script src="assets/lib/waypoints/waypoints.min.js"></script>
  <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="assets/lib/tempusdominus/js/moment.min.js"></script>
  <script src="assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
  <script src="assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- Template Javascript -->
  <script src="assets/js/main.js"></script>
</body>

</html>