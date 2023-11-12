<?php
require_once($_SESSION['raiz'] . '/modules/sections/role-access-admin-editor.php');

$_SESSION['subject'] = array();
$_SESSION['subject_name'] = array();
$_SESSION['subject_grade'] = array();
$_SESSION['subject_description'] = array();

$sql = "SELECT * FROM subjects WHERE subject = '" . $_POST['txtsubject'] . "'";

if ($result = $conexion->query($sql)) {
    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['subject'][0] = $row['subject'];
        $_SESSION['subject_name'][0] = $row['name'];
        $_SESSION['subject_grade'][0] = $row['grade'];
        $_SESSION['subject_description'][0] = $row['description'];
    }
}
echo '
<div class="form-data">
	<div class="head">
		<h1 class="titulo">Consultar</h1>
    </div>
	<div class="body">
		<form name="form-consult-subjects" action="" method="POST">
			<div class="wrap">
				<div class="first">
					<label class="label">Asignatura</label>
					<input style="display: none;" type="text" name="txtsubject" value="' . $_SESSION['subject'][0] . '"/>
					<input class="text" type="text" name="txtsubject" value="' . $_SESSION['subject'][0] . '" disabled/>
					<label class="label">Nombre</label>
					<input class="text" type="text" name="txtsubjectname" value="' . $_SESSION['subject_name'][0] . '" maxlength="100" required disabled/>
				</div>
				<div class="last">
					<label class="label">Grado</label>
					<input class="text" type="number" name="txtsubjectgrade" value="' . $_SESSION['subject_grade'][0] . '" maxlength="2" min="1" max="12" disabled/>
					<label class="label">Descripción</label>
					<input class="text" type="text" name="txtsubjectdescription" value="' . $_SESSION['subject_description'][0] . '" disabled/>
				</div>
			</div>
			<button id="btnSave" class="btn icon" type="submit" autofocus>done</button>
        </form>
    </div>
</div>
';
echo '<div class="content-aside">';
include_once "../sections/options-disabled.php";
echo '
</div>
<script src="/js/controls/dataexpandable.js"></script>
<script>
	$(document).ready(function() {
		$(".select").select2({
			minimumResultsForSearch: Infinity
		});
	});
</script>
';
