<?php
include_once '../modules/security.php';
include_once '../modules/conexion.php';

header('Content-Type: text/html; charset=UTF-8');
header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
header('Cache-Control: no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

require_once($_SESSION['raiz'] . '/modules/sections/role-access-all.php');

// Formulario actual
if (!empty($_POST['btn'])) {
	$view_form = $_POST['btn'] . '.php';
} else {
	$view_form = 'form_default.php';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Editar perfil - PawGuardian Pro</title>
  <!-- core:css -->
  <link rel="stylesheet" href="../assets/vendors/core/core.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <!-- end plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../assets/fonts/feather-font/css/iconfont.css">
  <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../assets/css/demo_1/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="/images/logo.png" />
  <script src="/js/external/jquery.min.js" type="text/javascript"></script>
  <script src="/js/external/prefixfree.min.js" type="text/javascript"></script>
  <script type="text/javascript">
  $(window).load(function() {
    $(".loader").fadeOut("slow");
  });
  </script>
  <link rel="stylesheet" href="/css/croppie.css" media="screen, projection" type="text/css" />
  <script src="/js/controls/unsetnotif.js" type="text/javascript"></script>
  <script src="/js/external/croppie.js" type="text/javascript"></script>
</head>

<body>
  <div class="loader"></div>
  <div class="main-wrapper">

    <?php
        if (isset($_SESSION['user'])) {
            if (isset($_SESSION['section-admin']) && $_SESSION['section-admin'] == 'section-admin-' . $_SESSION['user']) {
                include_once '../modules/sections/section-admin.php';
            } elseif (isset($_SESSION['section-editor']) && $_SESSION['section-editor'] == 'section-editor-' . $_SESSION['user']) {
                include_once '../modules/sections/section-editor.php';
            } elseif (isset($_SESSION['section-teacher']) && $_SESSION['section-teacher'] == 'section-teacher-' . $_SESSION['user']) {
                include_once '../modules/sections/section-teacher.php';
            } elseif (isset($_SESSION['section-student']) && $_SESSION['section-student'] == 'section-student-' . $_SESSION['user']) {
                include_once '../modules/sections/section-student.php';
            }
        }
    ?>

    <div class="page-wrapper">

      <?php
      include_once '../modules/sections/section-info-title.php';
      ?>

      <div class="page-content">
        <?php
				include_once $view_form;
				?>
      </div>

      <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
        <p class="text-muted text-center text-md-left">Copyright © 2023 <a href="#">PawGuardian Pro</a>.
          Todos los derechos reservados.</p>
      </footer>
    </div>
  </div>
  <!-- core:js -->
  <script src="../assets/vendors/core/core.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="../assets/vendors/chartjs/Chart.min.js"></script>
  <script src="../assets/vendors/jquery.flot/jquery.flot.js"></script>
  <script src="../assets/vendors/jquery.flot/jquery.flot.resize.js"></script>
  <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="../assets/vendors/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
  <!-- end plugin js for this page -->
  <!-- inject:js -->
  <script src="../assets/vendors/feather-icons/feather.min.js"></script>
  <script src="../assets/js/template.js"></script>
  <!-- endinject -->
  <!-- custom js for this page -->
  <script src="../assets/js/dashboard.js"></script>
  <script src="../assets/js/datepicker.js"></script>
  <!-- end custom js for this page -->
</body>

</html>