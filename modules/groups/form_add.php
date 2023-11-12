<?php
require_once($_SESSION['raiz'] . '/modules/sections/role-access-admin-editor.php');
?>
<div class="form-data">
    <div class="head">
        <h1 class="titulo">Agregar</h1>
    </div>
    <div class="body">
        <form name="form-add-groups" action="insert.php" method="POST" autocomplete="off" autocapitalize="on">
            <div class="wrap">
                <div class="first">
                    <label for="txtgroupid" class="label">Grupo</label>
                    <input id="txtgroupid" class="text" type="text" name="txtgroup" value="" maxlength="20"
                           onkeyup="this.value = this.value.toUpperCase()" autofocus required/>
                </div>
                <div class="last">
                    <label for="txtgroupgrade" class="label">Grado</label>
                    <input id="txtgroupgrade" class="text" type="number" name="txtgroupgrade" value="" maxlength="2"
                           min="1" max="3" list="defaultgrades" required/>
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
                </div>
                <div class="content-full">
                    <label for="txtgroupname" class="label">Nombre</label>
                    <input id="txtgroupname" class="text" type="text" name="txtgroupname" value="" maxlength="100"
                           required/>
                    <label for="selectgroupsubject" class="label">Materia</label>
                    <select id="selectgroupsubject" name="selectsubject" required>
                        <option value="">Seleccioné</option>
                        <?php
                        $i = 0;

                        $sql = "SELECT * FROM subjects ORDER BY name";

                        if ($result = $conexion->query($sql)) {
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<option value="' . $row['subject'] . '">' . $row['name'] . '</option>';
                                $i += 1;
                            }
                        }
                        ?>
                    </select>
                    <label for="selectgroupteacher" class="label">Docente</label>
                    <select id="selectgroupteacher" name="selectteacher" required>
                        <option value="">Seleccioné</option>
                        <?php
                        $i = 0;

                        $sql = "SELECT * FROM teachers ORDER BY name";

                        if ($result = $conexion->query($sql)) {
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<option value="' . $row['user'] . '">' . $row['name'] . ' ' . $row['surnames'] . '</option>';
                                $i += 1;
                            }
                        }
                        ?>
                    </select>
                    <label for="selectgroupstudents" class="label">Alumnos</label>
                    <select id="selectgroupstudents" name="selectstudents[]" multiple="multiple" required>
                        <?php
                        $i = 0;

                        $sql = "SELECT * FROM students ORDER BY name";

                        if ($result = $conexion->query($sql)) {
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<option value="' . $row['user'] . '">' . $row['name'] . ' ' . $row['surnames'] . '</option>';
                                $i += 1;
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <button class="btn icon" name="btn" value="form_add_group" type="submit">save</button>
        </form>
    </div>
</div>
<div class="content-aside">
    <?php
    include_once "../sections/options-disabled.php";
    ?>
</div>
<script src="/js/modules/addGroup.js"></script>