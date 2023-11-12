<?php
include_once 'security.php';

require_once($_SESSION['raiz'] . '/modules/sections/role-access-all.php');

$name_image_user = $_SESSION['raiz'] . '/images/users/' . $_SESSION['image'];

if (!file_exists($name_image_user)) {
    $sql = "SELECT image FROM users WHERE user = '" . $_SESSION['user'] . "'";

    if ($result = $conexion->query($sql)) {
        if ($row = mysqli_fetch_array($result)) {
            $_SESSION['image'] = $row['image'];
            $name_image_user = $_SESSION['raiz'] . '/images/users/' . $_SESSION['image'];
            
            if (!file_exists($name_image_user)) {
                $_SESSION['image'] = 'user.png';
            }
        }
    }
}

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
<nav class="navbar">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>
  <div class="navbar-content">
    <ul class="navbar-nav">
      <li class="nav-item dropdown nav-profile">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <img src="/images/users/<?php echo $_SESSION['image']; ?>" alt="profile">
        </a>
        <div class="dropdown-menu" aria-labelledby="profileDropdown">
          <div class="dropdown-header d-flex flex-column align-items-center">
            <div class="figure mb-3">
              <img src="/images/users/<?php echo $_SESSION['image']; ?>" alt="">
            </div>
            <div class="info text-center">
              <p class="name font-weight-bold mb-0"><?php print $_SESSION['name'] . ' ' . $_SESSION['surnames']; ?></p>
              <p class="email text-muted mb-3"><?php print $_SESSION['email']; ?></p>
            </div>
          </div>
          <div class="dropdown-body">
            <ul class="profile-nav p-0 pt-3">
              <li class="nav-item">
                <a href="/user" class="nav-link <?php if ($output[1] == 'user') {
                                    echo 'active';
                                } ?>">
                  <i data-feather="edit"></i>
                  <span>Editar perfil</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/modules/logout" class="nav-link">
                  <i data-feather="log-out"></i>
                  <span>Cerrar sesión</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </li>
    </ul>
  </div>
</nav>