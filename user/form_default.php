<?php
require_once($_SESSION['raiz'] . '/modules/sections/role-access-all.php');

include_once 'load_data.php';
?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Configuración</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar perfil</li>
  </ol>
</nav>
<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="section-croppie-image">
          <div class="image-crop"></div>
          <div class="options">
            <a href="#" class="change-btn"><span class="icon">sync</span></a>
            <a href="#" class="crop-btn"><span class="icon">crop</span></a>
            <a href="/user" class="cancel-btn"><span class="icon">close</span></a>
          </div>
        </div>
        <div class="section-user-image">
          <img src="<?php echo '/images/users/' . $_SESSION['user_image']; ?>" />
          <?php
					$date_time_start = date_create($_SESSION['image_updated_at']);
					$date_time_end = date_create(date('Y-m-d'));
					$interval = date_diff($date_time_start, $date_time_end);
					$days = intval($interval->format('%a'));

					if ($days >= 15 or $_SESSION['image_updated_at'] == null or $_SESSION['user_image'] == 'user.png') {
						echo '
						<a href="#" class="file"><span class="icon">add_a_photo</span></a>
						<input id="fileuploadimage" style="display: none;" type="file" name="fileuploadimage" accept=".jpg, .jpeg, .png" />
						';
					} else {
						echo '
						<a class="file disabled"><span class="icon">add_a_photo</span></a>
						';
						if ((15 - $days) >= 1) {
							$_SESSION['msgbox_info'] = 1;
							$_SESSION['msgbox_error'] = 0;
							$_SESSION['text_msgbox_info'] = 'Imagen de usuario actualizada recientemente.';
						}
					}
					?>
          <div class="section-user-info">
            <span class="user-name"><?php echo $_SESSION['name'] . ' ' . $_SESSION['surnames']; ?></span>
            <span class="user-id"><?php echo $_SESSION['user_id']; ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="config-data-user">
          <div id="cp1" class="input-group mb-4" title="Actualizar correo electrónico">
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
<?php
include_once '../modules/notif_info.php';
?>
<script src="/js/modules/user.js" type="text/javascript"></script>