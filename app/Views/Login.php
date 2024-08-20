<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title><?= $satu->nama_Logo ?></title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/custom/'.$satu->icon)?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link href="<?=base_url('assets/vendor/fonts/boxicons.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/vendor/css/core.css')?>" rel="stylesheet" class="template-customizer-core-css">
    <link href="<?=base_url('assets/vendor/css/theme-default.css')?>" rel="stylesheet" class="template-customizer-theme-css" >
    <link href="<?=base_url('assets/css/demo.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/vendor/css/pages/page-auth.css')?>" rel="stylesheet">
    <script src="<?=base_url('assets/vendor/js/helpers.js')?>"></script>
    <script src="<?=base_url('assets/js/config.js')?>"></script>
    <!-- Google reCAPTCHA API -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
    function validateForm() {
      var backupCaptchaField = document.querySelector('input[name="backup_captcha"]');

      if (navigator.onLine) {
        var response = grecaptcha.getResponse();
        if (response.length === 0) {
          alert('Please complete the CAPTCHA.');
          return false;
        }
        backupCaptchaField.removeAttribute('required');
      } else {
        backupCaptchaField.setAttribute('required', 'required');
        var backupCaptcha = backupCaptchaField.value;
        if (backupCaptcha === '') {
          alert('Please complete the offline CAPTCHA.');
          return false;
        }
      }

      return true;
    }



    function checkInternet() {
    var backupCaptchaField = document.querySelector('input[name="backup_captcha"]');
    if (!navigator.onLine) {
        document.getElementById('offline-captcha').style.display = 'block';
        document.querySelector('.g-recaptcha').style.display = 'none';
        backupCaptchaField.removeAttribute('disabled');
    } else {
        document.getElementById('offline-captcha').style.display = 'none';
        document.querySelector('.g-recaptcha').style.display = 'block';
        backupCaptchaField.setAttribute('disabled', 'disabled');
    }
}

window.addEventListener('load', checkInternet);
window.addEventListener('online', checkInternet);
window.addEventListener('offline', checkInternet);
  </script>
</head>
<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand demo">
                        <?php if (!empty($satu->logos)): ?>
        <img src="<?= base_url('assets/img/custom/' . $satu->logos) ?>" alt="Login Icon"
             class="img-fluid mb-3 logo-login" style="max-width: 100px;"> <?php endif;?>
                        </div>
                        <!-- /Logo -->
                        <form id="formAuthentication" class="mb-3" action="<?= base_url('home/aksi_login') ?>" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autofocus />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <!-- Google reCAPTCHA -->
                            <div class="g-recaptcha" data-sitekey="6LeAgCAqAAAAANyIFIQRqVWfiMIvf1SCnNVLVOST"></div>
                <div id="offline-captcha" style="display:none;">
                  <p>Please enter the characters shown below:</p>
                  <img src="<?= base_url('Home/generateCaptcha') ?>" alt="CAPTCHA">

                  <input type="text" name="backup_captcha" class="form-control mt-2" placeholder="Enter CAPTCHA" required>

                </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?=base_url('assets/vendor/libs/jquery/jquery.js')?>"></script>
    <script src="<?=base_url('assets/vendor/libs/popper/popper.js')?>"></script>
    <script src="<?=base_url('assets/vendor/js/bootstrap.js')?>"></script>
    <script src="<?=base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')?>"></script>
    <script src="<?=base_url('assets/vendor/js/menu.js')?>"></script>
    <script src="<?=base_url('assets/js/main.js')?>"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
