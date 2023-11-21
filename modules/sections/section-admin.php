<?php
include_once 'security.php';

require_once($_SESSION['raiz'] . '/modules/sections/role-access-admin.php');

$url_actual = $_SERVER["REQUEST_URI"];

if (strpos($url_actual, 'modules')) {
    $input = $url_actual;
    preg_match('~modules/(.*?)/~', $input, $output);
    $output[1];
} elseif (strpos($url_actual, 'user')) {
    $input = $url_actual;
    preg_match('~/(.*?)/~', $input, $output);
    $output[1];
} else {
    $output[1] = 'home';
}
?>
<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      PG <span>PRO</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Inicio</li>
      <li class="nav-item <?php if ($output[1] == 'home') {
                            echo 'active';
                        } ?>">
        <a href="/home" class="nav-link">
          <i class="link-icon" data-feather="pie-chart"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
    </ul>
  </div>
</nav>