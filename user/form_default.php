<?php
require_once($_SESSION['raiz'] . '/modules/sections/role-access-all.php');

include_once 'load_data.php';

$date_time_start = date_create($_SESSION['image_updated_at']);
$date_time_end = date_create(date('Y-m-d'));
$interval = date_diff($date_time_start, $date_time_end);
$days = intval($interval->format('%a'));

if ($days >= 15 or $_SESSION['image_updated_at'] == null or $_SESSION['user_image'] == 'user.png') {
	$disabledUploadImage = 'false';
} else {
	$disabledUploadImage = 'disabled';
	if ((15 - $days) >= 1) {
		$_SESSION['msgbox_info'] = 1;
		$_SESSION['msgbox_error'] = 0;
		$_SESSION['text_msgbox_info'] = 'Imagen de usuario actualizada recientemente.';
	}
}

?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Configuración</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar perfil</li>
  </ol>
</nav>
<?php
include_once '../modules/notif_info.php';
?>
<div class="row">
  <?php
  include_once 'form_image.php';
  ?>
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="config-data-user">
          <div id="txtgroupemail" class="input-group mb-4" title="Actualizar correo electrónico">
            <input id="txtemailupdate" type="email" name="txtemailupdate" class="form-control"
              value="<?php echo $_SESSION['email']; ?>" maxlength="200" placeholder="Correo electrónico"
              autocomplete="off" required disabled>
            <span class="input-group-append">
              <button type="button" class="btn-edit-email btn btn-primary btn-icon-text btn-block">
                <i class="btn-icon-prepend" data-feather="edit-3"></i>Editar
              </button>
            </span>
          </div>
          <form action="" method="POST" class="mb-4">
            <button type="submit" name="btn" value="form_update" class="btn btn-primary btn-icon-text btn-block">
              <i class="btn-icon-prepend" data-feather="edit"></i>
              Información personal
            </button>
          </form>
          <form action="" method="POST">
            <button type="submit" name="btn" value="form_update_pass" class="btn btn-primary btn-icon-text btn-block">
              <i class="btn-icon-prepend" data-feather="key"></i>
              Cambiar contraseña
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="/js/modules/user.js" type="text/javascript"></script>