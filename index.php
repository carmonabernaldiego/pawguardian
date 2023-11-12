<?php
session_start();

header('Content-Type: text/html; charset=UTF-8');

include_once 'modules/conexion.php';
include_once 'modules/cookie.php';


if (!empty($_SESSION['authenticate']) == 'go-' . !empty($_SESSION['usuario'])) {
	header('Location: home');
	exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PawGuardian Pro</title>
  <!-- core:css -->
  <link rel="stylesheet" href="/assets/vendors/core/core.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- end plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/assets/fonts/feather-font/css/iconfont.css">
  <link rel="stylesheet" href="/assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="/assets/css/demo_1/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="/images/logo.png" />
  <script src="/js/external/jquery.min.js" type="text/javascript"></script>
  <script src="/js/external/prefixfree.min.js" type="text/javascript"></script>
  <script type="text/javascript">
  $(window).load(function() {
    $(".loader").fadeOut("slow");
  });
  </script>
</head>

<body>
  <div class="loader"></div>
  <div class="main-wrapper">
    <div class="page-wrapper full-page">
      <div class="page-content d-flex align-items-center justify-content-center">

        <div class="row w-100 mx-0 auth-page">
          <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
              <div class="row">
                <div class="col-md-4 pr-md-0">
                  <div class="auth-left-wrapper">

                  </div>
                </div>
                <div class="col-md-8 pl-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="noble-ui-logo d-block mb-2">PawGuardian <span>PRO</span></a>
                    <h5 class="text-muted font-weight-normal mb-4">¡Bienvenido! Inicia sesión en tu cuenta.</h5>
                    <form class="forms-sample" name="form-login" action="" method="POST" autocapitalize="off"
                      data-nosnippet>
                      <?php
											include_once 'modules/login/logger.php';
											?>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- core:js -->
  <script src="/assets/vendors/core/core.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- end plugin js for this page -->
  <!-- inject:js -->
  <script src="/assets/vendors/feather-icons/feather.min.js"></script>
  <script src="/assets/js/template.js"></script>
  <!-- endinject -->
  <!-- custom js for this page -->
  <!-- end custom js for this page -->
</body>

</html>