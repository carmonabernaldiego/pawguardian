<?php
require_once($_SESSION['raiz'] . '/modules/sections/role-access-admin-editor.php');

$sql = "SELECT COUNT(subject) AS total FROM subjects";

if ($result = $conexion->query($sql)) {
	if ($row = mysqli_fetch_array($result)) {
		$tpages = ceil($row['total'] / $max);
	}
}

if (!empty($_POST['search'])) {
	$_POST['search'] = trim($_POST['search']);
	$_POST['search'] = mysqli_real_escape_string($conexion, $_POST['search']);
	
	$_SESSION['subject'] = array();
	$_SESSION['subject_name'] = array();
	$_SESSION['subject_grade'] = array();

	$i = 0;

	$sql = "SELECT * FROM subjects WHERE subject LIKE '%" . $_POST['search'] . "%' OR name LIKE '%" . $_POST['search'] . "%' OR grade LIKE '%" . $_POST['search'] . "%' ORDER BY grade, name";

	if ($result = $conexion->query($sql)) {
		while ($row = mysqli_fetch_array($result)) {
			$_SESSION['subject'][$i] = $row['subject'];
			$_SESSION['subject_name'][$i] = $row['name'];
			$_SESSION['subject_grade'][$i] = $row['grade'];

			$i += 1;
		}
	}
	$_SESSION['total_subjects'] = count($_SESSION['subject']);
} else {
	$_SESSION['subject'] = array();
	$_SESSION['subject_name'] = array();
	$_SESSION['subject_grade'] = array();

	$i = 0;

	$sql = "SELECT * FROM subjects ORDER BY grade, name LIMIT $inicio, $max";

	if ($result = $conexion->query($sql)) {
		while ($row = mysqli_fetch_array($result)) {
			$_SESSION['subject'][$i] = $row['subject'];
			$_SESSION['subject_name'][$i] = $row['name'];
			$_SESSION['subject_grade'][$i] = $row['grade'];

			$i += 1;
		}
	}
	$_SESSION['total_subjects'] = count($_SESSION['subject']);
}