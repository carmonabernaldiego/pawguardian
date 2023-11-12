<?php
include_once '../security.php';
include_once '../conexion.php';
include_once '../notif_info_msgbox.php';

require_once($_SESSION['raiz'] . '/modules/sections/role-access-admin-editor.php');

$_POST['txtgroup'] = trim($_POST['txtgroup']);

if (empty($_POST['txtgroup'])) {
    header('Location: /');
    exit();
}
if ($_POST['txtgroup'] == '') {
    Error('Ingrese un ID de grupo correcto.');
    header('Location: /modules/groups');
    exit();
}

if (isset($_POST['btn']) && $_POST['btn'] === 'form_add_group') {
    $sql = "SELECT * FROM groupschool WHERE id_group = '" . $_POST['txtgroup'] . "' AND school_period = '" . $_SESSION['school_period'] . "'";

    if ($result = $conexion->query($sql)) {
        if ($row = mysqli_fetch_array($result)) {
            $_SESSION['msgbox_info'] = 0;
            $_SESSION['msgbox_error'] = 1;
            $_SESSION['text_msgbox_error'] = 'El grupo que intenta crear ya existe.';

            header('Location: /modules/groups');
        } else {
            // Escapar caracteres especiales y aplicar trim a los valores
            $id_group = mysqli_real_escape_string($conexion, trim($_POST['txtgroup']));
            $school_period = mysqli_real_escape_string($conexion, trim($_SESSION['school_period']));
            $name_group = mysqli_real_escape_string($conexion, trim($_POST['txtgroupname']));
            $grade_group = intval($_POST['txtgroupgrade']); // Convertir a entero directamente
            $subject_group = mysqli_real_escape_string($conexion, trim($_POST['selectsubject']));
            $teacher_group = mysqli_real_escape_string($conexion, trim($_POST['selectteacher']));

            // Consulta SQL para insertar en la tabla de grupos
            $sql_insert_group = "INSERT INTO groupschool(id_group, school_period, name, grade, subject, teacher) VALUES ('" . $id_group . "', '" . $school_period . "', '" . $name_group . "', '" . $grade_group . "', '" . $subject_group . "', '" . $teacher_group . "')";

            if (mysqli_query($conexion, $sql_insert_group)) {
                foreach ($_POST['selectstudents'] as $student) {
                    $student = mysqli_real_escape_string($conexion, trim($student));
                    if ($student != '') {
                        // Consulta SQL para insertar en la tabla de grupos de estudiantes
                        $sql_insert_students = "INSERT INTO groupschool_students(id_group, school_period, student) VALUES ('" . $id_group . "', '" . $school_period . "', '" . $student . "')";

                        mysqli_query($conexion, $sql_insert_students);
                    }
                }

                $_SESSION['msgbox_error'] = 0;
                $_SESSION['msgbox_info'] = 1;
                $_SESSION['text_msgbox_info'] = 'Registro cargado correctamente.';
            } else {
                $_SESSION['msgbox_info'] = 0;
                $_SESSION['msgbox_error'] = 1;
                $_SESSION['text_msgbox_error'] = 'Error al guardar datos en tabla.';
            }
            header('Location: /modules/groups');
        }
    }
} else {
    header('Location: /');
    exit();
}