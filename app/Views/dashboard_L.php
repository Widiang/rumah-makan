<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Title</title>
  <style>
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
      width: 197%;
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

    @keyframes slideImages {
      0% {
        transform: translateX(0);
      }
      25% {
        transform: translateX(0);
      }
      50% {
        transform: translateX(-50%);
      }
      75% {
        transform: translateX(-50%);
      }
      100% {
        transform: translateX(0);
      }
    }
    
  </style>
</head>
<body>
<main id="main" class="main">
  <div class="col-md-12">
    <img src="<?php echo base_url('assets/img/custom/'.$satu->anima1)?>" id="image1" />
    <img src="<?php echo base_url('assets/img/custom/'.$satu->anima2)?>" id="image2" />
  </div>
</main><!-- End #main -->

</body>
</html>
