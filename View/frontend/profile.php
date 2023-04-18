<?php
  include_once dirname(__FILE__). '/../../Model/Client.php';
  include_once dirname(__FILE__). '/../../Controller/ClientC.php';

  function renderHeader($pageTitle) {
    $loggedin = $_COOKIE['loggedin'];
    $fullname = $_COOKIE['firstname'].' '.$_COOKIE['lastname'];

    extract([
      'pageTitle' => $pageTitle,
      'loggedIn' => $loggedin,
      'fullname' => $fullname
    ]);

    include './partials/header.php';
  }

  renderHeader('Cultrify - '.$fullname.' - Profile');

  $clientC = new ClientC();

  $currentClient = $clientC->showClient($_COOKIE['idClient']);

  $firstNameErr = "";
  $lastNameErr = "";
  $emailErr = "";
  $phoneErr = "";

  if (
    isset($_POST['firstName'])
    && isset($_POST['lastName'])
    && isset($_POST['email'])
    && isset($_POST['phone'])
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

    if (empty($_POST['phone'])) {
      $phoneErr = 'Phone Number is Required!';
    }

    if (
      $firstNameErr == ''
      && $lastNameErr == ''
      && $emailErr == ''
      && $phoneErr == ''
    ) {
      try {

        $clientExists = $clientC->getClientByEmail($_POST['email']);
  
        if (
          !$clientExists
          || ($clientExists && $clientExists['idClient'] == $_COOKIE['idClient'])
        ) {
          print_r($_POST);

          $client = new Client(
            null,
            $_POST['firstName'],
            $_POST['lastName'],
            $_POST['email'],
            null,
            $_POST['phone'],
          );
  
          echo $_COOKIE['idClient'];
          echo $client->getFirstName();
          $clientC->updateClient($client, $_COOKIE['idClient']);

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
  <div class="container rounded mt-5 mb-5" style="background-color: #faf7fe;">
    <div class="row">
      <div class="col-md-3 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
            width="150px"
            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span
            class="font-weight-bold"><?php echo $currentClient['firstName'].' '.$currentClient['lastName']; ?></span><span class="text-black-50">
              <?php echo $currentClient['email'] ?>
            </span><span> </span>
        </div>
      </div>
      <div class="col-md-5 border-right">
        <form action="/zeineb-main/View/frontend/profile.php" method="post">
          <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h4 class="text-right">Profile Settings</h4>
            </div>
            <div class="row mt-2">
              <div class="col-md-6">
                <label class="labels">First name</label>
                <input type="text" name="firstName" class="form-control"
                  placeholder="first name" value=<?php echo $currentClient['firstName'] ?>>
                <div><?php echo $firstNameErr; ?></div>
              </div>
              <div class="col-md-6">
                <label class="labels">Last name</label>
                <input type="text" name="lastName" class="form-control" value=<?php echo $currentClient['lastName'] ?>
                  placeholder="Last name">
                  <div><?php echo $lastNameErr; ?></div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <label class="labels">Email</label>
                <input type="email" name="email" class="form-control"
                  placeholder="Enter Email" value=<?php echo $currentClient['email'] ?>>
                <div><?php echo $emailErr; ?></div>
              </div>
              <div class="col-md-12"><label class="labels">Phone</label><input type="text" name="phone" class="form-control"
                  placeholder="Enter Phone Number" value=<?php echo $currentClient['phone'] ?>></div>
                  <div><?php echo $phoneErr; ?></div>
            </div>
            
            <div class="mt-5 text-center"><button type="submit" class="btn btn-primary profile-button" type="button">
              Update Profile</button></div>
          </div>
        </form>
        <form action="/zeineb-main/View/frontend/delete.php" method="delete">
          <div class="mt-5 text-center">
            <button type="submit" class="btn btn-danger profile-button" type="button">Delete Account</button>
          </div>
        </form>
      </div>
      <div class="col-md-4">
        <div class="p-3 py-5">
          <div class="d-flex justify-content-between align-items-center experience"><span>Tickets</span></div><br>
          <div class="col-md-12"><label class="labels" aria-readonly="true">Cheb Bechir - Boston ---> Confirmed</label></div> <br>
          <div class="col-md-12"><label class="labels" aria-readonly="true">Yanni - Bali ---> Pending</label></div> <br>
      </div>
    </div>
  </div>
  </div>
  </div>
  <script type='text/javascript'
    src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
  <script type='text/javascript'>var myLink = document.querySelector('a[href="#"]');
    myLink.addEventListener('click', function (e) {
      e.preventDefault();
    });</script>

</body>
<!-- Template JavaScript -->
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/theme-change.js"></script>
<!--/slider-js-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/modernizr-2.6.2.min.js"></script>
<script src="assets/js/jquery.zoomslider.min.js"></script>
<!--//slider-js-->
<script src="assets/js/owl.carousel.js"></script>
<!-- script for tesimonials carousel slider -->
<script>
  $(document).ready(function () {
    $("#owl-demo1").owlCarousel({
      loop: true,
      margin: 20,
      nav: false,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
          nav: false
        },
        736: {
          items: 1,
          nav: false
        },
        1000: {
          items: 1,
          nav: false,
          loop: true
        }
      }
    })
  })
</script>
<!-- //script for tesimonials carousel slider -->
<!-- stats number counter-->
<script src="assets/js/jquery.waypoints.min.js"></script>
<script src="assets/js/jquery.countup.js"></script>
<script>
  $('.counter').countUp();
</script>
<!-- //stats number counter -->

<!--/MENU-JS-->
<script>
  $(window).on("scroll", function () {
    var scroll = $(window).scrollTop();

    if (scroll >= 80) {
      $("#site-header").addClass("nav-fixed");
    } else {
      $("#site-header").removeClass("nav-fixed");
    }
  });

  //Main navigation Active Class Add Remove
  $(".navbar-toggler").on("click", function () {
    $("header").toggleClass("active");
  });
  $(document).on("ready", function () {
    if ($(window).width() > 991) {
      $("header").removeClass("active");
    }
    $(window).on("resize", function () {
      if ($(window).width() > 991) {
        $("header").removeClass("active");
      }
    });
  });
</script>
<!--//MENU-JS-->

<script src="assets/js/bootstrap.min.js"></script>



</html>