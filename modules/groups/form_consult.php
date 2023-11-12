<?php
require_once($_SESSION['raiz'] . '/modules/sections/role-access-admin-editor.php');

$sql = "SELECT * FROM groupschool WHERE id_group = '" . $_POST['txtgroup'] . "' AND school_period = '" . $_POST['txtgroupschoolperiod'] . "'";

if ($result = $conexion->query($sql)) {
    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['group_id'] = $row['id_group'];
        $_SESSION['group_school_period'] = $row['school_period'];
        $_SESSION['group_name'] = $row['name'];
        $_SESSION['group_grade'] = $row['grade'];
        $_SESSION['group_subject'] = $row['subject'];
        $_SESSION['group_teacher'] = $row['teacher'];
    }
}
?>
<div class="form-data">
    <div class="head">
        <h1 class="titulo">Consultar</h1>
    </div>
    <div class="body">
        <form name="form-consult-groups" action="#" method="POST">
            <div class="wrap">
                <div class="first">
                    <label for="txtgroupid" class="label">Grupo</label>
                    <input style="display: none;" type="text" name="btn" value="form_default"/>
                    <input id="txtgroupid" class="text" type="text" name="txtgroup"
                           value="<?php echo $_SESSION['group_id']; ?>" maxlength="20"
                           onkeyup="this.value = this.value.toUpperCase()" autofocus disabled/>
                </div>
                <div class="last">
                    <label for="txtgroupgrade" class="label">Grado</label>
                    <input id="txtgroupgrade" class="text" type="number" name="txtgroupgrade"
                           value="<?php echo $_SESSION['group_grade']; ?>" maxlength="2"
                           min="1" max="3" list="defaultgrades" disabled/>
                </div>
                <div class="content-full">
                    <label for="txtgroupname" class="label">Nombre</label>
                    <input id="txtgroupname" class="text" type="text" name="txtgroupname"
                           value="<?php echo $_SESSION['group_name']; ?>" maxlength="100"
                           disabled/>
                    <label for="selectgroupsubject" class="label">Materia</label>
                    <select id="selectgroupsubject" name="selectsubject" disabled>
                        <?php
                        // Consulta para obtener las materias desde la tabla subjects
                        $subjectSql = "SELECT subject, name FROM subjects ORDER BY name";

                        if ($subjectResult = $conexion->query($subjectSql)) {
                            while ($subjectRow = mysqli_fetch_array($subjectResult)) {
                                $subjectId = $subjectRow['subject'];
                                $subjectName = $subjectRow['name'];

                                // Verifica si la materia actual coincide con la materia en la sesión
                                $isSelected = ($_SESSION['group_subject'] === $subjectId) ? 'selected' : '';

                                // Imprime la opción con el atributo "selected" si corresponde
                                echo '<option value="' . $subjectId . '" ' . $isSelected . '>' . $subjectName . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <label for="selectgroupteacher" class="label">Docente</label>
                    <select id="selectgroupteacher" name="selectteacher" disabled>
                        <?php
                        $i = 0;

                        $sql = "SELECT * FROM teachers WHERE user = '" . $_SESSION['group_teacher'] . "' ORDER BY name";

                        if ($result = $conexion->query($sql)) {
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<option value="' . $row['user'] . '">' . $row['name'] . ' ' . $row['surnames'] . '</option>';
                                $i += 1;
                            }
                        }
                        ?>
                    </select>
                    <label for="selectgroupstudents" class="label">Alumnos</label>
                    <select id="selectgroupstudents" name="selectstudents[]" multiple="multiple" disabled>
                        <?php
                        $i = 0;

                        $sql = "SELECT * FROM groupschool_students WHERE id_group = '" . $_SESSION['group_id'] . "' AND school_period = '" . $_SESSION['group_school_period'] . "'";

                        // Obtener IDs de estudiantes preseleccionados
                        $preselectedStudentIds = [];
                        if ($result = $conexion->query($sql)) {
                            while ($row = mysqli_fetch_array($result)) {
                                $preselectedStudentIds[] = $row['student'];
                                $i += 1;
                            }
                        }

                        // Consulta para obtener los nombres y apellidos de estudiantes desde students
                        $allStudentsSql = "SELECT user, name, surnames FROM students ORDER BY name";

                        if ($allStudentsResult = $conexion->query($allStudentsSql)) {
                            while ($allStudentsRow = mysqli_fetch_array($allStudentsResult)) {
                                $studentId = $allStudentsRow['user'];
                                $studentName = $allStudentsRow['name'];
                                $studentSurnames = $allStudentsRow['surnames'];

                                // Determinar si el estudiante está preseleccionado o no
                                if (in_array($studentId, $preselectedStudentIds)) {
                                    echo '<option value="' . $studentId . '" selected>' . $studentName . ' ' . $studentSurnames . '</option>';
                                } else {
                                    echo '<option value="' . $studentId . '">' . $studentName . ' ' . $studentSurnames . '</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <button id="btnSave" class="btn icon" type="submit" autofocus>done</button>
        </form>
    </div>
</div>
<div class="content-aside">
    <?php include_once "../sections/options-disabled.php"; ?>
</div>
<script src="/js/modules/addGroup.js" type="text/javascript"></script>