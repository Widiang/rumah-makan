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
    <?php 
  $uri = service('uri');

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
  </head>

  <body>
    
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
