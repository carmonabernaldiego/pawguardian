<?php
include_once '../modules/security.php';
include_once '../modules/conexion.php';
include_once '../modules/notif_info_msgbox.php';

require_once($_SESSION['raiz'] . '/modules/sections/role-access-all.php');

if (isset($_POST["txtoldpassword"])) {
    $pass = mysqli_real_escape_string($conexion, $_POST['txtoldpassword']);

    $sql = "SELECT * FROM users WHERE user = '" . $_SESSION['user'] . "' and BINARY pass = '" . $pass . "' LIMIT 1";

    if ($result = $conexion->query($sql)) {
        if ($row = mysqli_fetch_array($result)) {
            if ($_POST['txtnewpassword'] == $_POST['txtconfirmnewpassword'] and $_POST['txtnewpassword'] != "" and $_POST['txtconfirmnewpassword'] != "") {
                $sql_update = "UPDATE users SET pass = '" . $_POST['txtnewpassword'] . "' WHERE user = '" . $_SESSION['user'] . "'";
            }

            if (mysqli_query($conexion, $sql_update)) {
                Info('Contraseña actualizada.');
            } else {
                Error('Error al actualizar contraseña.');
            }
        } else {
            Error('Contraseña incorrecta.');
        }
        header('Location: /user');
        exit();
    }
} else {
    Error('Error al actualizar contraseña.');
    header('Location: /user');
    exit();
}