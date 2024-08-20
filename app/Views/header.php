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
  class="light-style layout-menu-fixed"
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

    <title><?= $satu->nama_Logo ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="description" content="" />

    <!-- Favicon -->
    <link href="<?= base_url('assets/img/custom/' . htmlspecialchars($satu->icon)) ?>" rel="icon">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link href="<?=base_url('assets/vendor/fonts/boxicons.css')?>" rel="stylesheet"> 

    <!-- Core CSS -->
    <link href= "<?=base_url('assets/vendor/css/core.css')?>" rel="stylesheet"> 
    <link href="<?=base_url('assets/vendor/css/theme-default.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/demo.css')?>" rel="stylesheet"> 

    <!-- Vendors CSS -->
    <link href="<?=base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')?>" rel="stylesheet"> 

    <link href="<?=base_url('assets/vendor/libs/apex-charts/apex-charts.css')?>" rel="stylesheet">
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?=base_url('assets/vendor/js/helpers.js')?>"></script>
    
    <script src="<?=base_url('assets/js/config.js')?>"></script>
    <style>
         body {
      margin: 0;
      font-family: "Times New Roman", Times, serif;
      color: #000; /* Set text color to black */
      background-color: light gray; /* Set background color to black */
    }
    </style>
  </head> 