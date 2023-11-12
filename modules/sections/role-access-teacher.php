<?php
if ($_SESSION['permissions'] != 'teacher') {
    header('Location: /');
    exit();
}