<?php
  include_once dirname(__FILE__). '/../../Model/Admin.php';
  include_once dirname(__FILE__). '/../../Controller/AdminC.php';

  $firstNameErr = '';
  $lastNameErr = '';
  $emailErr = '';

  $adminC = new AdminC();

  $currentAdmin = $adminC->showAdmin($_COOKIE['idAdmin']);

  $firstNameErr = "";
  $lastNameErr = "";
  $emailErr = "";
  $phoneErr = "";

  if (
    isset($_POST['firstName'])
    && isset($_POST['lastName'])
    && isset($_POST['email'])
  ) {

    if (empty($_POST['firstName'])) {
      $firstNameErr = 'First Name is Required!';
    }

    if (empty($_POST['lastName'])) {
      $lastNameErr = 'Last Name is Required!';
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
      && $emailErr == ''
    ) {
      try {

        $adminExists = $adminC->getAdminByEmail($_POST['email']);
  
        if (
          !$adminExists
          || ($adminExists && $adminExists['idAdmin'] == $_COOKIE['idAdmin'])
        ) {
          $admin = new Admin(
            null,
            $_POST['firstName'],
            $_POST['lastName'],
            $_POST['email'],
            null,
          );
  
          $adminC->updateAdmin($admin, $_COOKIE['idAdmin']);

          header("Location: ".$_SERVER['PHP_SELF']."?accountUpdated=".true);
          exit();
        } else {
          $emailErr= 'This Email Already Exists!';
        }
      } catch (Exception $e) {
        echo $e;
      } 
    } else {
      header("Location: ".$_SERVER['PHP_SELF']);
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
    <link href="assets/img/favicon.ico" rel="icon">

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
assets/
<body>
  <div class="container-fluid position-relative d-flex p-0">
      <!-- Spinner Start -->
      <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
          <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
              <span class="sr-only">Loading...</span>
          </div>
      </div>
      <!-- Spinner End -->

      <?php include './partials/sidebar.php' ?>

      <!-- Content Start -->
      <div class="content">
        <?php include './partials/navbar.php' ?>

          <!-- Form Start -->
        <div class="container-fluid pt-4 px-4">
          <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded h-100 p-4">
                  <h6 class="mb-4">Update Profile</h6>
                  <form action="/zeineb-main/View/backend/profile.php" method="post">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First name</label>
                        <input type="text" name="firstName" class="form-control" id="firstname" 
                            aria-describedby="firstnameHelp"
                            value=<?php echo $currentAdmin['firstName'] ?>>
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last name</label>
                        <input type="text" name="lastName" class="form-control" id="lastname"
                            aria-describedby="lastnameHelp"
                            value=<?php echo $currentAdmin['lastName'] ?>>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                          aria-describedby="emailHelp"
                          value=<?php echo $currentAdmin['email'] ?>>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>
                </div>
              </div>


              <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded h-100 p-4">
                  <h6 class="mb-4">Delete Profile</h6>
                  <form action="/zeineb-main/View/backend/delete-profile.php" method="post">
                    <button type="submit" class="btn btn-primary">Delete</button>
                  </form>
                </div>
              </div>
            </div>
      
        <!-- Form End -->


        <!-- Footer Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary rounded-top p-4">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-start">
                        &copy; <a href="#">Cultrify</a>, All Right Reserved. 
                    </div>
                    <div class="col-12 col-sm-6 text-center text-sm-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
      </div>
      <!-- Content End -->


      <!-- Back to Top -->
      <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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