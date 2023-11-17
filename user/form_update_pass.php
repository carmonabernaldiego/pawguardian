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
    <li class="breadcrumb-item"><a href="/user">Configuración</a></li>
    <li class="breadcrumb-item active" aria-current="page">Cambiar contraseña</li>
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
        <form name="form-update-pass" action="update_pass.php" method="POST" autocomplete="off" autocapitalize="off"
          onsubmit="return confirmPass()">
          <div class="form-group">
            <label for="txtoldpassword">Contraseña antigua</label>
            <input id="txtoldpassword" class="form-control" type="password" name="txtoldpassword" value=""
              maxlength="50" autofocus required />
          </div>
          <div class="form-group">
            <label for="txtnewpassword">Nueva contraseña</label>
            <input id="txtnewpassword" class="form-control" type="password" name="txtnewpassword" value=""
              maxlength="50" required />
          </div>
          <div class="form-group">
            <label for="txtconfirmnewpassword" id="labelHide">Confirmar nueva contraseña</label>
            <label for="txtconfirmnewpassword" id="labelError" style="color: red; font-weight: bold;">Las
              contraseñas no coinciden.</label>
            <input id="txtconfirmnewpassword" class="form-control" type="password" name="txtconfirmnewpassword" value=""
              maxlength="50" required />
          </div>
          <button id="btnSave" class="btn btn-primary mr-2" type="submit">Guardar</button>
          <a href="/user" class="btn btn-light">Cancelar</a>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
include_once '../modules/notif_info.php';
?>
<script src="/js/modules/userUpdatePass.js" type="text/javascript"></script>
<script src="/js/modules/user.js" type="text/javascript"></script>