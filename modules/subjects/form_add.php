<?php
require_once($_SESSION['raiz'] . '/modules/sections/role-access-admin-editor.php');
?>
<div class="form-data">
    <div class="head">
        <h1 class="titulo">Agregar</h1>
    </div>
    <div class="body">
        <form name="form-add-subjects" action="insert.php" method="POST" onsubmit="return sendTeachers()">
            <div class="wrap">
                <div class="first">
                    <label for="txtsubjectid" class="label">Asignatura</label>
                    <input id="txtsubjectid" class="text" type="text" id="txtsubject" name="txtsubject" value="" maxlength="20" onkeyup="this.value = this.value.toUpperCase()" autofocus required />
                    <label for="txtsubjectname" class="label">Nombre</label>
                    <input id="txtsubjectname" class="text" type="text" id="txtsubjectname" name="txtsubjectname" value="" maxlength="100" required />
                </div>
                <div class="last">
                    <label for="txtsubjectgrade" class="label">Grado</label>
                    <input class="text" type="number" id="txtsubjectgrade" name="txtsubjectgrade" value="" maxlength="2" min="1" max="3" list="defaultgrades" required />
                    <datalist id="defaultgrades">
                        <?php
                        for ($i = 1; $i <= 3; $i++) {
                            echo
                            '
			<option value="' . $i . '">
		';
                        }
                        ?>
                    </datalist>
                    <label for="txtsubjectdescription" class="label">Descripción</label>
                    <input id="txtsubjectdescription" class="text" type="text" name="txtsubjectdescription" maxlength="2000"  required/>
                </div>
            </div>
            <button id="btnSave" class="btn icon" type="submit">save</button>
        </form>
    </div>
</div>
<div class="content-aside">
    <?php
    include_once "../sections/options-disabled.php";
    ?>
</div>
<script src="/js/controls/dataexpandable.js"></script>