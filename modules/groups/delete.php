<?php
include_once '../security.php';
include_once '../conexion.php';
include_once '../notif_info_msgbox.php';

require_once($_SESSION['raiz'] . '/modules/sections/role-access-admin-editor.php');

if (empty($_POST['txtgroupid'])) {
    header('Location: /');
    exit();
}

$sql_delete = "DELETE FROM groupschool WHERE id_group = '" . $_POST['txtgroupid'] . "' AND school_period = '" . $_POST['txtgroupschoolperiod'] . "'";

if (mysqli_query($conexion, $sql_delete)) {
    $sql_delete = "DELETE FROM groupschool_students WHERE id_group = '" . $_POST['txtgroupid'] . "' AND school_period = '" . $_POST['txtgroupschoolperiod'] . "'";

    if (mysqli_query($conexion, $sql_delete)) {
        Error('Grupo eliminado.');
    } else {
        Error('Error al eliminar.');
    }
} else {
    Error('Error al eliminar.');
}
header('Location: /modules/groups');
exit();