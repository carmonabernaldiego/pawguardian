<?php
header('Content-Type: text/html; charset=UTF-8');

if (include_once 'modules/security.php') {
    $_SESSION['raiz'] = dirname(__FILE__);
}
include_once 'modules/conexion.php';
include_once 'modules/notif_info_unset.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PawGuardian Pro</title>
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
</head>

<body>
  <div class="loader"></div>
  <div class="main-wrapper">

    <?php
    if (isset($_SESSION['user'])) {
        if (isset($_SESSION['section-admin']) && $_SESSION['section-admin'] == 'section-admin-' . $_SESSION['user']) {
            include_once 'modules/sections/section-admin.php';
        } elseif (isset($_SESSION['section-editor']) && $_SESSION['section-editor'] == 'section-editor-' . $_SESSION['user']) {
            include_once 'modules/sections/section-editor.php';
        } elseif (isset($_SESSION['section-teacher']) && $_SESSION['section-teacher'] == 'section-teacher-' . $_SESSION['user']) {
            include_once 'modules/sections/section-teacher.php';
        } elseif (isset($_SESSION['section-student']) && $_SESSION['section-student'] == 'section-student-' . $_SESSION['user']) {
            include_once 'modules/sections/section-student.php';
        }
    }
    ?>

    <div class="page-wrapper">

      <?php
      include_once 'modules/sections/section-info-title.php';
      ?>

      <div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <div>
            <h4 class="mb-3 mb-md-0">Bienvenido <?php print $_SESSION['name'] . ' ' . $_SESSION['surnames']; ?>.</h4>
          </div>
        </div>

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <div>
            <h4 id="statusPIR" class="mb-3 mb-md-0"></h4>
          </div>
        </div>

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <div>
            <h4 id="statusGas" class="mb-3 mb-md-0"></h4>
          </div>
        </div>

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <div>
            <h4 id="statusWater" class="mb-3 mb-md-0"></h4>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4">
                  <h6 class="card-title mb-0">Temperatura °C</h6>
                </div>
                <br />
                <div class="monthly-sales-chart-wrapper">
                  <canvas id="temperature-chart"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4">
                  <h6 class="card-title mb-0">Humedad</h6>
                </div>
                <br />
                <div id="humidityChart" class="mx-auto"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- row -->

        <div class="row">
          <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4">
                  <h6 class="card-title mb-0">Tabla pH</h6>
                </div>
                <br />

                <div class="table-responsive">
                  <table class="table table-hover" id="phTable">
                    <tr>
                      <th>Fecha</th>
                      <th>Valor de pH</th>
                      <th>Clasificación</th>
                    </tr>
                    <!-- Las filas de datos se insertarán aquí usando JavaScript -->
                  </table>
                </div>

                <br />
                <br />
                <div id="phStats"></div>

              </div>
            </div>
          </div>
        </div>
        <!-- row -->

        <div class="row">
          <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4">
                  <h6 class="card-title mb-0">pH</h6>
                </div>
                <br />
                <canvas id="phChart"></canvas>
              </div>
            </div>
          </div>
        </div>
        <!-- row -->

      </div>

      <!-- partial:partials/_footer.html -->
      <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
        <p class="text-muted text-center text-md-left">Copyright © 2023 <a href="#">PawGuardian Pro</a>.
          Todos los derechos reservados.</p>
      </footer>
      <!-- partial -->

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
  <script src="/js/main.js" type="module"></script>
  <script src="../assets/js/dashboard.js"></script>
  <script src="../assets/js/datepicker.js"></script>
  <!-- end custom js for this page -->
</body>

</html>