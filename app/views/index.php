<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= url('css/foundation.css'); ?>" />
        <link rel="stylesheet" href="<?= url('css/style.css'); ?>" />
    <script src="<?= url('js/vendor/modernizr.js'); ?>"></script>
  </head>
  <body>
    
<header>
  <div class="row">
   <nav class="top-bar" data-topbar>
   <div class="large-4 columns medium-4 column">
  <ul class="title-area">
    <li class="name">
      <h1><a href="#"><img src="<?= url('img/logo.png'); ?>" alt="crowdrooster" /></a></h1>
    </li>
    <li class="toggle-topbar menu-icon"><a href="#"></a></li>
  </ul>
   </div>
   
  <section class="top-bar-section">
  
   <!-- Left Nav Section -->
    <div class="large-5 columns medium-5 column">
    <ul class="left">
      <li><a href="#">Start Making</a></li>
      <li class="has-dropdown">
      <a href="our-world.html">Our World</a>
      <ul class="dropdown">
          <li><a href="#">Blog</a></li>
          <li><a href="#">Forum</a></li>
          <li><a href="#">CR TEAM</a></li>
        </ul>
      </li>
     <li><a href="#">THE INSTRUCTIONS</a></li>
    </ul>
    </div>
    <!-- Right Nav Section -->
    <div class="large-3 columns medium-3 column">
   <div class="logout mar">
                                <ul>
                                    <li class="has-dropdown user">
                                        <a href="#" class="user_name">Hi, Pet <img src="<?= url('img/user.png'); ?>" alt=""></a>
                                        <a href="#" class="user_img"><img src="<?= url('img/user.png'); ?>" alt=""></a>
                                        <ul class="dropdown background">
                                            <li class="profile" ><a href="#">Profile</a></li>
                                            <li class="setting"><a href="#">Settings</a></li>
                                            <li class="logout"><a href="#">Logout</a></li>
                                        </ul>
                                    </li>
                                    
                                </ul>
                            </div>
    </div>

   
  </section>
</nav>
   </div>
  <div class="clearfix"></div>
</header>
  <!--========================================== Thank You Page =========================================================== -->
  
  
  

<?php
if (isset($viewNotification)):
?>
    <?= $viewNotification ?>
<?php
endif;
if (isset($viewBody)):
?>
    <?= $viewBody ?>
<?php
endif;
?>


     <!--============================================ Footer ============================================================= -->                    

<footer class="footer-contener">
  <section class="footer-top">
    <div class="row">
      <div class="large-3 columns medium-3 columns small-4 columns">
        <div class="footer-block">
          <h1>Legal</h1>
          <ul>
            <li><a href="#">Buyers Terms</a></li>
            <li><a href="#">Seller Terms</a></li>
            <li><a href="#">Mangopay Terms</a></li>
            <li><a href="#">Terms of Use</a></li>
          </ul>
        </div>
      </div>
      <div class="large-3 columns medium-3 columns small-4 columns">
        <div class="footer-block">
          <h1>Privacy Policy</h1>
          <ul>
            <li><a href="#">Cookies Policy</a></li>
          </ul>
        </div>
      </div>
      <div class="large-3 columns medium-3 columns small-4 columns">
        <div class="footer-block">
          <h1>Help</h1>
          <ul>
            <li><a href="#">Faq</a></li>
            <li><a href="#">Contact Us</a></li>
          </ul>
        </div>
      </div>
      <div class="large-3 columns medium-3 columns">
        <div class="footer-block newsletter">
          <article class="newsletter-title">
            <h2>Subscribe T0 Our</h2>
            <h1>Newsletter</h1>
          </article>
          <article class="social-link">
            <h2>Social</h2>
            <ul>
              <li><a href="#" class="facebook" title="Facebook"></a></li>
              <li><a href="#" class="twitter" title="Twitter"></a></li>
            </ul>
          </article>
        </div>
      </div>
    </div>
  </section>
  <!--============================================ Footer ============================================================= -->
  <section class="footer-bottom">
    <div class="row">
      <div class="large-9 small-6 medium-9 columns">
        <address class="copy-right">
        &copy; Copyright 2014
        </address>
      </div>
      <div class="large-3 small-6 medium-3 columns">
        <article class="footer-logo"><a href="#"><img src="<?= url('img/footer-logo.png'); ?>" alt=""/></a></article>
      </div>
    </div>
  </section>
  <!--========================================== End of Footer ========================================================= -->
</footer>
    <script src="<?= url('js/vendor/jquery.js'); ?>"></script>
    <script src="<?= url('js/foundation.min.js'); ?>"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
