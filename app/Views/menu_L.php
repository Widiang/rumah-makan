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
  <?php
 $userLevel = session()->get('level');
 $allowedLevels = ['Petugas', 'admin','manager','Koki'];

 if (in_array($userLevel, $allowedLevels)) {
?> 
  <li class="menu-item <?php if($uri->getSegment(2) == "dashboard_L"){echo "active";}?>">
    <a href="<?= base_url("Home/dashboard_L") ?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-home-circle"></i>
      <div data-i18n="Analytics">Dashboard</div>
    </a>
</li>
<?php } ?>

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

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
            
              <ul class="navbar-nav flex-row align-items-center ms-auto">


                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="<?php echo base_url('assets/img/custom/'.$user->foto)?>" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="<?php echo base_url('assets/img/custom/'.$user->foto)?>" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?=session()->get('username')?></span>
                            <small class="text-muted"><?=session()->get('level')?></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="<?= base_url('Home/Profile/'.session()->get('id_user'))?>">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="<?= base_url("Home/logout")?>">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->