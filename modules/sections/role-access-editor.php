<?php
if ($_SESSION['permissions'] != 'editor') {
    header('Location: /');
    exit();
}