<?php

use app\core\Application;

?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">

    <title>Trinity Recovery</title>
  </head>
  <body>




<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
  <div class="container d-flex justify-content-between">
    <div class="social-links">
      <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
      <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
      <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
      <a href="#" class="skype"><i class="icofont-skype"></i></a>
      <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
    </div>
  </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">

    <h1 class="logo me-auto"><a href="/">Trinity Recovery</a></h1>
   
    <?php if (Application::IsGuest()): ?>
     

        <nav class="nav-menu d-none d-lg-block">
          <ul>
            <li class="active"><a href="/">Home</a></li>
            <li><a href="/appointment">Appointments</a></li>
            <li><a href="/pricing">Pricing</a></li>
            <li><a href="/contact">Contact a Doctor</a></li>

          </ul>
        </nav><!-- .nav-menu -->

        <?php elseif(Application::$app->user->FindDoctor()):?>

        
       <nav class="nav-menu d-none d-lg-block">
          <ul>
            <li><a href="/doctor/appointments"> My Appointments</a></li>
            <li><a href="/contact/chat">Client Chats</a></li>
            <li><a href="/doctor/messages">Client Messages</a></li>

          </ul>
        </nav><!-- .nav-menu -->


        <?php else:?>


          <nav class="nav-menu d-none d-lg-block">
          <ul>
            <li class="active"><a href="/">Home</a></li>
            <li><a href="/appointment">Appointments</a></li>
            <li><a href="/pricing">Pricing</a></li>
            <li><a href="/contact">Contact a Doctor</a></li>

          </ul>
        </nav><!-- .nav-menu -->

    <?php endif;?>








    <?php if (Application::IsGuest()): ?>
    <a href="/login" class="appointment-btn scrollto">Login</a>
    <?php endif;?>




    <nav class="nav-menu d-none d-lg-block float-right">

          <ul>

            <?php if (Application::IsGuest()): ?>

              <li><a href="/register">Register</a></li>

            <?php elseif(Application::$app->user->FindDoctor()):?>

              <li ><a href="/logout">Welcome Dr. <?php echo Application::$app->user->getLastName() ?>!    (Logout)</a></li>

            <?php else:?>


              <li ><a href="/logout">Welcome <?php echo Application::$app->user->getUserName() ?>!    (Logout)</a></li>

              

            <?php endif;?>

          </ul>
    </nav><!-- .nav-menu -->
    
  </div>
</header><!-- End Header -->


<!--Toast messages-->
<?php if(Application::$app->session->getFlash('success')):?>
  <?php
   echo '<script>console.log("Your stuff here")</script>';
?>


<div class="toast" role="alert"  aria-live="assertive" autohide: false aria-atomic="true" style="position: absolute; top: 0; right: 0; z-index:5000;" data-bs-delay="2000">
  <div class="toast-header">
    <strong class="me-auto">Thank You!</strong>
    <small class="text-muted">1 min ago</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
  <?php echo Application::$app->session->getFlash('success')?>  
  </div>
</div>

<?php endif; ?>








{{Content}}

 <!-- ======= Footer ======= -->
 <footer id="footer">

  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 col-md-6 footer-contact">
          <h3>Trinity Recovery</h3>
          <p>
            1111 Yellow Brick Rd.<br>
            USA, USA 99999<br>
            United States <br><br>
            <strong>Phone:</strong>(999) 999-9999<br>
            <strong>Email:</strong> trinityrecovery@example.com<br>
          </p>
        </div>

        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
          </ul>
        </div>

      

        

      </div>
    </div>
  </div>

  <div class="container d-md-flex py-4">

    <div class="me-md-auto text-center text-md-start">
      <div class="copyright">
        &copy; Copyright <strong><span>Trinity Recovery</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
       
         Front End Styling Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
         Back End Designed by <a href="">Chris Lopes</a>
      </div>
    </div>
    <div class="social-links text-center text-md-right pt-3 pt-md-0">
      <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
      <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
      <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
      <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
      <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
    </div>
  </div>
</footer><!-- End Footer -->

    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
    
  </body>
</html>