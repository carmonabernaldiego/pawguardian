<?php
require_once($_SESSION['raiz'] . '/modules/sections/role-access-student.php');

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
        <h1 class="titulo">Actualizar</h1>
    </div>
    <div class="body">
        <form name="form-update-groups" action="#" method="POST" autocomplete="off" autocapitalize="on">
            <div class="wrap">
                <div class="first">
                    <label for="txtgroupid" class="label">Grupo</label>
                    <input style="display: none;" type="text" name="txtgroup"
                           value="<?php echo $_SESSION['group_id']; ?>" maxlength="50">
                    <input style="display: none;" type="text" name="txtgroupschoolperiod"
                           value="<?php echo $_SESSION['group_school_period']; ?>" maxlength="20">
                    <input id="txtgroupid" class="text" type="text" name="txt"
                           value="<?php echo $_SESSION['group_id']; ?>" maxlength="20"
                           onkeyup="this.value = this.value.toUpperCase()" autofocus disabled/>

                    <label for="txtgroupgrade" class="label">Grado</label>
                    <input id="txtgroupgrade" class="text" type="number" name="txtgroupgrade"
                           value="<?php echo $_SESSION['group_grade']; ?>" maxlength="2"
                           min="1" max="3" list="defaultgrades" disabled/>
                </div>
                <div class="last">
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
                </div>
                <div class="content-full">
                    <table class="student-grades-table">
                        <thead>
                        <tr>
                            <th>Alumno</th>
                            <th>Parcial 1</th>
                            <th>Parcial 2</th>
                            <th>Parcial 3</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $studentId = $_SESSION['user']; // ID del estudiante que ha iniciado sesión

                        // Consulta para obtener las calificaciones del estudiante
                        $calificationsSql = "SELECT grade_partial1, grade_partial2, grade_partial3 FROM califications WHERE id_group = '" . $_SESSION['group_id'] . "' AND id_student = '$studentId' AND school_period = '" . $_SESSION['group_school_period'] . "'";
                        $calificationsResult = $conexion->query($calificationsSql);
                        $calificationsRow = mysqli_fetch_array($calificationsResult);

                        // Obtener el nombre y apellidos del estudiante desde la tabla students
                        $studentInfoSql = "SELECT name, surnames FROM students WHERE user = '$studentId'";
                        $studentInfoResult = $conexion->query($studentInfoSql);
                        $studentInfoRow = mysqli_fetch_array($studentInfoResult);
                        $studentName = $studentInfoRow['name'];
                        $studentSurnames = $studentInfoRow['surnames'];

                        // Mostrar los campos de calificaciones
                        echo '<tr>';
                        echo '<td>' . $studentName . ' ' . $studentSurnames . '</td>';
                        if ($calificationsRow) {
                            echo '<td><input class="grade-input" type="number" name="alumnos[' . $studentId . '][parcial1]" min="1" max="10" value="' . $calificationsRow['grade_partial1'] . '" required></td>';
                            echo '<td><input class="grade-input" type="number" name="alumnos[' . $studentId . '][parcial2]" min="1" max="10" value="' . $calificationsRow['grade_partial2'] . '" required></td>';
                            echo '<td><input class="grade-input" type="number" name="alumnos[' . $studentId . '][parcial3]" min="1" max="10" value="' . $calificationsRow['grade_partial3'] . '" required></td>';
                        } else {
                            echo '<td><input class="grade-input" type="number" name="alumnos[' . $studentId . '][parcial1]" min="1" max="10" required></td>';
                            echo '<td><input class="grade-input" type="number" name="alumnos[' . $studentId . '][parcial2]" min="1" max="10" required></td>';
                            echo '<td><input class="grade-input" type="number" name="alumnos[' . $studentId . '][parcial3]" min="1" max="10" required></td>';
                        }
                        echo '</tr>';
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <button id="btnSave" class="btn icon" type="submit" autofocus>done</button>
        </form>
    </div>
</div>
<style>
    .form-data .body .content-full {
        display: block;
        width: 98%;
    }

    .student-grades-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .student-grades-table input {
        text-align: center; /* Centra el texto dentro de los campos de entrada */
    }

    .student-grades-table th,
    .student-grades-table td {
        border: 1px solid #2f4e71;
        padding: 8px;
        text-align: center;
    }

    .student-grades-table th {
        background-color: #2f4e71;
    }

    .grade-input {
        width: 60px;
    }

    @media (max-width: 600px) {
        .student-grades-table {
            font-size: 12px;
        }

        .student-grades-table th,
        .student-grades-table td {
            padding: 5px;
        }

        .grade-input {
            width: 40px;
        }
    }
</style>

<div class="content-aside">
    <?php include_once "../sections/options-disabled.php"; ?>
</div>
<script src="/js/modules/addGroup.js" type="text/javascript"></script>
