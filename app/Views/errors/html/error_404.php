<?php 
  $uri = service('uri');

  ?>
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Page Not Found 😭</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-misc.css" />
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
  <?php
           $userLevel = session()->get('level');
           $allowedLevels = [1, 'Manager', 'admin', 'Petugas'];
  
           if (in_array($userLevel, $allowedLevels)) {
        ?> 
	<style>
  #logo-image {
    width: 50px;
    height: auto;
  }

  .app-brand.demo {
    display: flex;
    justify-content: ;
    align-items: right;
    height: 100%; /* Ensure it takes the full height of the menu */
  }
  body {
      margin: 0;
      font-family: "Times New Roman", Times, serif;
      color: #000; /* Set text color to black */
    }

    .main {
      position: relative;
      width: 100%;
      height: auto;
      overflow: hidden;
    }

    .col-md-12 {
      position: relative;
      width: 200%;
      height: auto;
      display: flex;
      animation: slideImages 10s linear infinite; /* Change duration to 20s */
      transition: transform 0.01s ease; /* Smooth transition */
    }

    .col-md-12 img {
      width: 50%;
      max-height: 700px;
      margin-top: 50px;
      user-select: none; /* Prevent images from being selected */
      pointer-events: none; /* Disable pointer events on images */
    }

    
    
  
</style>

  </style>
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
  
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
  <a href="<?= base_url("Home/dashboard_L") ?>" class="app-brand-link">
  <?php if (!empty($satu->logos)): ?>
        <img src="<?= base_url('assets/img/custom/' . $satu->logos) ?>" alt="Login Icon"
             class="img-fluid mb-3 logo-login" style="max-width: 100px;">
   <?php endif; ?>
  </a>

  <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
    <i class="bx bx-chevron-left bx-sm align-middle"></i>
  </a>
</div>


<div class="menu-inner-shadow"></div>

<ul class="menu-inner py-1">
  <!-- Dashboard -->
  <li class="menu-item <?php if($uri->getSegment(2) == "dashboard_L"){echo "active";}?>">
    <a href="<?= base_url("Home/dashboard_L") ?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-home-circle"></i>
      <div data-i18n="Analytics">Dashboard</div>
    </a>
</li>


  <!-- Layouts -->
  <li class="menu-item">
 
    <?php
 $userLevel = session()->get('level');
 $allowedLevels = ['Petugas', 'admin'];

 if (in_array($userLevel, $allowedLevels)) {
?> 
   <li class="menu-item <?php if($uri->getSegment(2) == "order"){echo "active";}?> <?php if($uri->getSegment(2) == "inprogress"){echo "active";}?>  <?php if($uri->getSegment(2) == "history"){echo "active";}?>">
  <a href="<?= base_url("Home/order")?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-layout"></i>
      <div data-i18n="Layouts">Order</div>
    </a>
    
    </li>
    <?php } ?>
    <?php
 $userLevel = session()->get('level');
 $allowedLevels = ['Manager'];

 if (in_array($userLevel, $allowedLevels)) {
?> 
     <li class="menu-item <?php if($uri->getSegment(2) == "history"){echo "active";}?>">
  <a href="<?= base_url("Home/history")?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-layout"></i>
      <div data-i18n="Layouts">history</div>
    </a>
    </li>
    <?php } ?>
    <?php
 $userLevel = session()->get('level');
 $allowedLevels = ['Koki'];

 if (in_array($userLevel, $allowedLevels)) {
?> 
     <li class="menu-item <?php if($uri->getSegment(2) == "OrderK"){echo "active";}?>">
  <a href="<?= base_url("Home/OrderK")?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-layout"></i>
      <div data-i18n="Layouts">Koki</div>
    </a>
    </li>
    <?php } ?>
    <li class="menu-item">
    <?php
 $userLevel = session()->get('level');
 $allowedLevels = ['Manager','Petugas','admin','Koki'];

 if (in_array($userLevel, $allowedLevels)) {
?> 
 <li class="menu-item <?php if($uri->getSegment(2) == "makan"){echo "active";}?> <?php if($uri->getSegment(2) == "minum"){echo "active";}?>  <?php if($uri->getSegment(2) == "MIedit"){echo "active";}?> <?php if($uri->getSegment(2) == "minum"){echo "active";}?>  <?php if($uri->getSegment(2) == "t_minum"){echo "active";}?> <?php if($uri->getSegment(2) == "minum"){echo "active";}?>  <?php if($uri->getSegment(2) == "t_makan"){echo "active";}?>">
  <a href="<?= base_url("Home/makan")?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-food-menu"></i>
      <div data-i18n="Layouts">Menu</div>
    </a>
    </li>
    <?php } ?>
    <?php
 $userLevel = session()->get('level');
 $allowedLevels = ['Manager', 'admin'];

 if (in_array($userLevel, $allowedLevels)) {
?> 
   <li class="menu-item  <?php if($uri->getSegment(2) == "Laporan"){echo "active";}?>">
  <a href="<?= base_url("Home/Laporan")?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-file"></i>
      <div data-i18n="Layouts">Laporan</div>
    </a>
    </li>
    <?php } ?>
    <?php
 $userLevel = session()->get('level');
 $allowedLevels = ['admin'];

 if (in_array($userLevel, $allowedLevels)) {
?> 
     <li class="menu-item <?php if($uri->getSegment(2) == "RestoreM" || $uri->getSegment(2) == "RestoreMI" || $uri->getSegment(2) == "RestoreUser"){echo "active";}?>">
  <a href="<?= base_url("Home/RestoreM")?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-food-menu me-1"></i>
      <div data-i18n="Layouts">Restore</div>
    </a>
    </li>
    <?php } ?>
    <?php
 $userLevel = session()->get('level');
 $allowedLevels = ['Manager', 'admin'];

 if (in_array($userLevel, $allowedLevels)) {
?> 
   <li class="menu-item <?php if($uri->getSegment(2) == "user"){echo "active";}?> <?php if($uri->getSegment(2) == "admin"){echo "active";}?>  <?php if($uri->getSegment(2) == "manager"){echo "active";}?> <?php if($uri->getSegment(2) == "t_admin"){echo "active";}?> <?php if($uri->getSegment(2) == "manager"){echo "active";}?> <?php if($uri->getSegment(2) == "Koki"){echo "active";}?>">
  
  <a href="<?= base_url("Home/user")?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-user"></i>
      <div data-i18n="Layouts">User</div>
    </a>
    </li>
    <?php } ?>
    <?php
 $userLevel = session()->get('level');
 $allowedLevels = ['Manager', 'admin'];

 if (in_array($userLevel, $allowedLevels)) {
?> 
    <li class="menu-item <?php if($uri->getSegment(2) == "setting"){echo "active";}?> ">
  <a href="<?= base_url("Home/setting/1")?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-cog
"></i>

      <div data-i18n="Layouts">Setting</div>
    </a>
    </li>
    <?php } ?>
    <?php
 $userLevel = session()->get('level');
 $allowedLevels = ['admin'];

 if (in_array($userLevel, $allowedLevels)) {
?> 
     <li class="menu-item <?php if($uri->getSegment(2) == "activity_log"){echo "active";}?>">
  <a href="<?= base_url("Home/activity_log")?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-notepad"></i>
      <div data-i18n="Layouts">Activity Log</div>
    </a>
    </li>
    <?php } ?>
    <li class="menu-item">
  <a href="<?= base_url("Home/logout")?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-log-in-circle"></i>
      <div data-i18n="Layouts">Log out</div>
    </a>
    </li>
</ul>
</aside>
        </aside>
        <!-- / Menu -->

      
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
             

           
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->
		  <?php } ?>
    <!-- Error -->
    <div class="container-xxl container-p-y">
      <div class="misc-wrapper">
        <h2 class="mb-2 mx-2">Page Not Found 😭</h2>
        <p style="margin-bottom: 0; margin-left: 0; margin-right: 0;">Oops! 😖 The requested URL was not found on this server.</p>
<p style="margin-bottom: 0; margin-left: 0; margin-right: 0;">Nice try though.</p>
  <br>
  <br>
  <br>
        <a href="<?= base_url("Home")?>" class="btn btn-primary">Back to home</a>
        <div class="mt-3">
          <img
            src="../assets/img/illustrations/page-misc-error-light.png"
            alt="page-misc-error-light"
            width="500"
            class="img-fluid"
            data-app-dark-img="illustrations/page-misc-error-dark.png"
            data-app-light-img="illustrations/page-misc-error-light.png"
          />
        </div>
      </div>
    </div>
    <!-- /Error -->

    <!-- / Content -->

  

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
