<?php
include_once '../security.php';
include_once '../conexion.php';
include_once '../notif_info_msgbox.php';

require_once($_SESSION['raiz'] . '/modules/sections/role-access-teacher.php');

if (isset($_POST['btn']) && $_POST['btn'] === 'form_add_group') {
    $id_group = mysqli_real_escape_string($conexion, trim($_POST['txtgroup']));
    $school_period = mysqli_real_escape_string($conexion, trim($_POST['txtgroupschoolperiod']));

    // Eliminar registros anteriores de calificaciones para el grupo y periodo
    $sql_delete_califications = "DELETE FROM califications WHERE id_group = '$id_group' AND school_period = '$school_period'";
    mysqli_query($conexion, $sql_delete_califications);

    // Recorremos los datos de los alumnos y calculamos el promedio
    if (isset($_POST['alumnos']) && is_array($_POST['alumnos'])) {
        foreach ($_POST['alumnos'] as $studentId => $grades) {
            $parcial1 = mysqli_real_escape_string($conexion, intval($grades['parcial1']));
            $parcial2 = mysqli_real_escape_string($conexion, intval($grades['parcial2']));
            $parcial3 = mysqli_real_escape_string($conexion, intval($grades['parcial3']));

            // Calcular el promedio de las calificaciones parciales
            $final_grade = ($parcial1 + $parcial2 + $parcial3) / 3;

            $sql_insert_calification = "INSERT INTO califications(id_group, id_student, school_period, grade_partial1, grade_partial2, grade_partial3, final_grade)
                                    VALUES ('$id_group', '$studentId', '$school_period', '$parcial1', '$parcial2', '$parcial3', '$final_grade')";

            mysqli_query($conexion, $sql_insert_calification);
        }
    }

    $_SESSION['msgbox_error'] = 0;
    $_SESSION['msgbox_info'] = 1;
    $_SESSION['text_msgbox_info'] = 'Calificaciones actualizadas correctamente.';
    header('Location: /modules/califications');
} else {
    header('Location: /');
    exit();
}
