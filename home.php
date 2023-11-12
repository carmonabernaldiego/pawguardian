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

        <div class="row">
          <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">New Customers</h6>
                      <div class="dropdown mb-2">
                        <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                          <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye"
                              class="icon-sm mr-2"></i> <span class="">View</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2"
                              class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash"
                              class="icon-sm mr-2"></i> <span class="">Delete</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer"
                              class="icon-sm mr-2"></i> <span class="">Print</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download"
                              class="icon-sm mr-2"></i> <span class="">Download</span></a>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">3,897</h3>
                        <div class="d-flex align-items-baseline">
                          <p class="text-success">
                            <span>+3.3%</span>
                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                          </p>
                        </div>
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                        <div id="apexChart1" class="mt-md-3 mt-xl-0"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">New Orders</h6>
                      <div class="dropdown mb-2">
                        <button class="btn p-0" type="button" id="dropdownMenuButton1" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                          <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye"
                              class="icon-sm mr-2"></i> <span class="">View</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2"
                              class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash"
                              class="icon-sm mr-2"></i> <span class="">Delete</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer"
                              class="icon-sm mr-2"></i> <span class="">Print</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download"
                              class="icon-sm mr-2"></i> <span class="">Download</span></a>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">35,084</h3>
                        <div class="d-flex align-items-baseline">
                          <p class="text-danger">
                            <span>-2.8%</span>
                            <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                          </p>
                        </div>
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                        <div id="apexChart2" class="mt-md-3 mt-xl-0"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Growth</h6>
                      <div class="dropdown mb-2">
                        <button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                          <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye"
                              class="icon-sm mr-2"></i> <span class="">View</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2"
                              class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash"
                              class="icon-sm mr-2"></i> <span class="">Delete</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer"
                              class="icon-sm mr-2"></i> <span class="">Print</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download"
                              class="icon-sm mr-2"></i> <span class="">Download</span></a>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">89.87%</h3>
                        <div class="d-flex align-items-baseline">
                          <p class="text-success">
                            <span>+2.8%</span>
                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                          </p>
                        </div>
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                        <div id="apexChart3" class="mt-md-3 mt-xl-0"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- row -->

        <div class="row">
          <div class="col-12 col-xl-12 grid-margin stretch-card">
            <div class="card overflow-hidden">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                  <h6 class="card-title mb-0">Revenue</h6>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="dropdownMenuButton3" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye"
                          class="icon-sm mr-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2"
                          class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash"
                          class="icon-sm mr-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer"
                          class="icon-sm mr-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download"
                          class="icon-sm mr-2"></i> <span class="">Download</span></a>
                    </div>
                  </div>
                </div>
                <div class="row align-items-start mb-2">
                  <div class="col-md-7">
                    <p class="text-muted tx-13 mb-3 mb-md-0">Revenue is the income that a business has from its normal
                      business activities, usually from the sale of goods and services to customers.</p>
                  </div>
                  <div class="col-md-5 d-flex justify-content-md-end">
                    <div class="btn-group mb-3 mb-md-0" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-outline-primary">Today</button>
                      <button type="button" class="btn btn-outline-primary d-none d-md-block">Week</button>
                      <button type="button" class="btn btn-primary">Month</button>
                      <button type="button" class="btn btn-outline-primary">Year</button>
                    </div>
                  </div>
                </div>
                <div class="flot-wrapper">
                  <div id="flotChart1" class="flot-chart"></div>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- row -->

        <div class="row">
          <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">Monthly sales</h6>
                  <div class="dropdown mb-2">
                    <button class="btn p-0" type="button" id="dropdownMenuButton4" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye"
                          class="icon-sm mr-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2"
                          class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash"
                          class="icon-sm mr-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer"
                          class="icon-sm mr-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download"
                          class="icon-sm mr-2"></i> <span class="">Download</span></a>
                    </div>
                  </div>
                </div>
                <p class="text-muted mb-4">Sales are activities related to selling or the number of goods or services
                  sold in a given time period.</p>
                <div class="monthly-sales-chart-wrapper">
                  <canvas id="monthly-sales-chart"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">Cloud storage</h6>
                  <div class="dropdown mb-2">
                    <button class="btn p-0" type="button" id="dropdownMenuButton5" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton5">
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye"
                          class="icon-sm mr-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2"
                          class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash"
                          class="icon-sm mr-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer"
                          class="icon-sm mr-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download"
                          class="icon-sm mr-2"></i> <span class="">Download</span></a>
                    </div>
                  </div>
                </div>
                <div id="progressbar1" class="mx-auto"></div>
                <div class="row mt-4 mb-3">
                  <div class="col-6 d-flex justify-content-end">
                    <div>
                      <label
                        class="d-flex align-items-center justify-content-end tx-10 text-uppercase font-weight-medium">Total
                        storage <span class="p-1 ml-1 rounded-circle bg-primary-muted"></span></label>
                      <h5 class="font-weight-bold mb-0 text-right">8TB</h5>
                    </div>
                  </div>
                  <div class="col-6">
                    <div>
                      <label class="d-flex align-items-center tx-10 text-uppercase font-weight-medium"><span
                          class="p-1 mr-1 rounded-circle bg-primary"></span> Used storage</label>
                      <h5 class="font-weight-bold mb-0">6TB</h5>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary btn-block">Upgrade storage</button>
              </div>
            </div>
          </div>
        </div> <!-- row -->



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
  <script src="../assets/js/dashboard.js"></script>
  <script src="../assets/js/datepicker.js"></script>
  <!-- end custom js for this page -->
</body>

</html>