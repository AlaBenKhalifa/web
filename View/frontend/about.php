<?php
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

  renderHeader('Cultrify - About');
?>
  <!-- about breadcrumb -->
  <section class="w3l-about-breadcrumb text-left">
    <div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4">
      <div class="container py-2">
        <h2 class="title">About Us</h2>
        <ul class="breadcrumbs-custom-path mt-2">
          <li><a href="#url">Home</a></li>
          <li class="active"><span class="fa fa-arrow-right mx-2" aria-hidden="true"></span> About </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- //about breadcrumb -->
  <!-- /about-6-->
  <section class="w3l-cta4 py-5">
      <div class="container py-lg-5">
        <div class="ab-section text-center">
          <h6 class="sub-title">About Us</h6>
          <h3 class="hny-title">What is Cultrify?</h3>
          <p class="py-3 mb-3">We are <b>Cultrify</b>! Our website is based on artistic expression and cultural values. We offer travel accommodation services for reaching festivals... We aim to provide our clients with a simple and efficient experience.
          </p>
            <a href="services.html" class="btn btn-style btn-primary">Voir Nos évenements</a>
        </div>
        <div class="row mt-5">
          <div class="col-md-9 mx-auto">
            <img src="assets/images/banner3.jpg" class="img-fluid" alt="">
          </div>
        </div>
      </div>
  </section>
  <!-- //about-6--
  <!-- stats -->
  <section class="w3l-statshny py-5" id="stats" >
    <div class="container py-lg-5 py-md-4">
      <div class="w3-stats-inner-info">
        <div class="row">
          <div class="col-lg-4 col-6 stats_info counter_grid text-left">
            <span class="fa fa-smile-o"></span>
            <p class="counter">1730</p>
            <h4>Happy Customers</h4>
          </div>
          <div class="col-lg-4 col-6 stats_info counter_grid1 text-left">
            <span class="fa fa-users"></span>
            <p class="counter">730</p>
            <h4>Custom Products</h4>
          </div>
          <div class="col-lg-4 col-6 stats_info counter_grid mt-lg-0 mt-5 text-left">
            <span class="fa fa-database"></span>
            <p class="counter">30</p>
            <h4>branches</h4>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- //stats -->
  <!-- team -->
  <section class="w3l-team" id="team">
    <div class="team-block py-5">
      <div class="container py-lg-5">
        <div class="title-content text-center mb-lg-3 mb-4">
          <h6 class="sub-title">Our team</h6>
          <h3 class="hny-title">Meet our Guides</h3>
        </div>
        <div class="teamm">
          <div class="col-lg-2 col-6 mt-lg-5 mt-4">
            <div class="box16">
              <a href="#url"><img src="assets/images/team1.png" alt="" class="img-fluid" /></a>
              <div class="box-content">
                <h3 class="title"><a href="#url">Saeed Mhamdi</a></h3>
                <span class="post">UI Designer</span>
                <ul class="social">
                  <li>
                    <a href="#" class="facebook">
                      <span class="fa fa-facebook-f"></span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="twitter">
                      <span class="fa fa-linkedin"></span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-6 mt-lg-5 mt-4">
            <div class="box16">
              <a href="#url"><img src="assets/images/team2.jpg" alt="" class="img-fluid" /></a>
              <div class="box-content">
                <h3 class="title"><a href="#url">Ala Sahbani</a></h3>
                <span class="post">Software Developer</span>
                <ul class="social">
                  <li>
                    <a href="#" class="facebook">
                      <span class="fa fa-facebook-f"></span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="twitter">
                      <span class="fa fa-linkedin"></span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-6 mt-lg-5 mt-4">
            <div class="box16">
              <a href="#url"><img src="assets/images/team5.jpg" alt="" class="img-fluid" /></a>
              <div class="box-content">
                <h3 class="title"><a href="#url">Ala Ben Khlifa</a></h3>
                <span class="post">Frontend Developer</span>
                <ul class="social">
                  <li>
                    <a href="https://www.facebook.com/profile.php?id=100009407850464" class="facebook">
                      <span class="fa fa-facebook-f"></span>
                    </a>
                  </li>
                  <li>
                    <a href="https://www.linkedin.com/in/ala-eddine-ben-khalifa-61430b231/" class="twitter">
                      <span class="fa fa-linkedin"></span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-6 mt-lg-5 mt-4">
            <div class="box16">
              <a href="#url"><img src="assets/images/team3.jpg" alt="" class="img-fluid" /></a>
              <div class="box-content">
                <h3 class="title"><a href="#url">Zeineb Roihi</a></h3>
                <span class="post">Backend Developer</a></span>
                <ul class="social">
                  <li>
                    <a href="#" class="facebook">
                      <span class="fa fa-facebook-f"></span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="twitter">
                      <span class="fa fa-linkedin"></span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-6 mt-lg-5 mt-4">
            <div class="box16">
              <a href="#url"><img src="assets/images/team4.png" alt="" class="img-fluid" /></a>
              <div class="box-content">
                <h3 class="title"><a href="#url">Aziz Mabrouki</a></h3>
                <span class="post">Fullstack Developer</a></span>
                <ul class="social">
                  <li>
                    <a href="#" class="facebook">
                      <span class="fa fa-facebook-f"></span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="twitter">
                      <span class="fa fa-linkedin"></span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- //team -->

  <?php include './partials/footer.php' ?>

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

</body>

</html>