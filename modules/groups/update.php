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

if (isset($_POST['btn']) && $_POST['btn'] === 'form_update_group') {
    // Escapar caracteres especiales y aplicar trim a los valores
    $id_group = mysqli_real_escape_string($conexion, trim($_POST['txtgroup']));
    $school_period = mysqli_real_escape_string($conexion, trim($_POST['txtgroupschoolperiod']));
    $name_group = mysqli_real_escape_string($conexion, trim($_POST['txtgroupname']));
    $grade_group = intval($_POST['txtgroupgrade']); // Convertir a entero directamente
    $subject_group = mysqli_real_escape_string($conexion, trim($_POST['selectsubject']));
    $teacher_group = mysqli_real_escape_string($conexion, trim($_POST['selectteacher']));

    // Consulta SQL para actualizar en la tabla de grupos
    $sql_update_group = "UPDATE groupschool SET name = '" . $name_group . "', grade = " . $grade_group . ", subject = '" . $subject_group . "', teacher = '" . $teacher_group . "' WHERE id_group = '" . $id_group . "' AND school_period = '" . $school_period . "'";

    if (mysqli_query($conexion, $sql_update_group)) {
        // Eliminar estudiantes previamente relacionados con el grupo
        $sql_delete_students = "DELETE FROM groupschool_students WHERE id_group = '" . $id_group . "' AND school_period = '" . $school_period . "'";
        mysqli_query($conexion, $sql_delete_students);

        // Insertar estudiantes seleccionados
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
        $_SESSION['text_msgbox_info'] = 'Registro actualizado correctamente.';
    } else {
        $_SESSION['msgbox_info'] = 0;
        $_SESSION['msgbox_error'] = 1;
        $_SESSION['text_msgbox_error'] = 'Error al actualizar los datos en la tabla.';
    }
    header('Location: /modules/groups');
} else {
    header('Location: /');
    exit();
}
?>