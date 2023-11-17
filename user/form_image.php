<?php
require_once($_SESSION['raiz'] . '/modules/sections/role-access-all.php');
?>
<div class="col-md-6 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="section-croppie-image">
        <div class="image-crop"></div>
        <div class="options">
          <a href="#" class="change-btn"><i data-feather="refresh-ccw"></i></a>
          <a href="#" class="crop-btn"><i data-feather="crop"></i></a>
          <a href="/user" class="cancel-btn"><i data-feather="x"></i></a>
        </div>
      </div>
      <div class="section-user-image">
        <img src="<?php echo '/images/users/' . $_SESSION['user_image']; ?>" />
        <a href="#" class="file <?php echo $disabledUploadImage; ?>"><i data-feather="upload-cloud"></i></a>
        <?php 
					if($disabledUploadImage != 'disabled') {
						echo '
							<input id="fileuploadimage" style="display: none;" type="file" name="fileuploadimage"
							accept=".jpg, .jpeg, .png" />
						';
					} 
					?>
        <div class="text-center mt-3">
          <h5><?php echo $_SESSION['name'] . ' ' . $_SESSION['surnames']; ?></h5>
          <h6><?php echo $_SESSION['user_type']; ?></h6>
        </div>
      </div>
    </div>
  </div>
</div>