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
      <li class="nav-item nav-category">Navegación</li>
      <li class="nav-item <?php if ($output[1] == 'school_periods') {
                            echo 'active';
                        } ?>">
        <a href="/modules/school_periods" class="nav-link">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Ciclo Escolar</span>
        </a>
      </li>
      <li class="nav-item <?php if ($output[1] == 'users') {
                            echo 'active';
                        } ?>">
        <a href="/modules/users" class="nav-link">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">Usuarios</span>
        </a>
      </li>
      <li class="nav-item <?php if ($output[1] == 'administratives') {
                            echo 'active';
                        } ?>">
        <a href="/modules/administratives" class="nav-link">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">Administrativos</span>
        </a>
      </li>
      <li class="nav-item <?php if ($output[1] == 'teachers') {
                            echo 'active';
                        } ?>">
        <a href="/modules/teachers" class="nav-link">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">Docentes</span>
        </a>
      </li>
      <li class="nav-item <?php if ($output[1] == 'students') {
                            echo 'active';
                        } ?>">
        <a href="/modules/students" class="nav-link">
          <i class="link-icon" data-feather="users"></i>
          <span class=" link-title">Alumnos</span>
        </a>
      </li>
      <li class="nav-item <?php if ($output[1] == 'subjects') {
                            echo 'active';
                        } ?>">
        <a href="/modules/subjects" class="nav-link">
          <i class="link-icon" data-feather="bookmark"></i>
          <span class="link-title">Materias</span>
        </a>
      </li>
      <li class="nav-item <?php if ($output[1] == 'groups') {
                            echo 'active';
                        } ?>">
        <a href="/modules/groups" class="nav-link">
          <i class="link-icon" data-feather="layers"></i>
          <span class="link-title">Grupos</span>
        </a>
      </li>
    </ul>
  </div>
</nav>