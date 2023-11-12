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
		<h1 class="titulo">Actualizar</h1>
    </div>
	<div class="body">
		<form name="form-update-subjects" action="update.php" method="POST" onsubmit="return sendTeachers()">
			<div class="wrap">
				<div class="first">
					<label for="txtsubjectid" class="label">Asignatura</label>
					<input id="txtsubjectid" style="display: none;" type="text" name="txtsubject" value="' . $_SESSION['subject'][0] . '"/>
					<input class="text" type="text" name="txtsubject" value="' . $_SESSION['subject'][0] . '" maxlength="20" onkeyup="this.value = this.value.toUpperCase()" disabled/>
					<label for="txtsubjectname" class="label">Nombre</label>
                    <input id="txtsubjectname" class="text" type="text" name="txtsubjectname" value="' . $_SESSION['subject_name'][0] . '" maxlength="100" required autofocus/>
				</div>
				<div class="last">
					<label for="txtsubjectgrade" class="label">Grado</label>
                    <input id="txtsubjectgrade" class="text" type="number" name="txtsubjectgrade" value="' . $_SESSION['subject_grade'][0] . '" maxlength="2" min="1" max="3" required/>
                    <label for="txtsubjectdescription" class="label">Descripción</label>
					<input id="txtsubjectdescription" class="text" type="text" name="txtsubjectdescription" value="' . $_SESSION['subject_description'][0] . '" maxlength="2000" />';
echo '</textarea>
				</div>
			</div>
			<button id="btnSave" class="btn icon" type="submit">save</button>
        </form>
    </div>
</div>
';
echo '<div class="content-aside">';
include_once "../sections/options-disabled.php";
echo '
</div>
<script src="/js/controls/dataexpandable.js"></script>
';
