<?php
include_once '../security.php';
include_once '../conexion.php';

header('Content-Type: text/html; charset=UTF-8');
header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
header('Cache-Control: no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

require_once($_SESSION['raiz'] . '/modules/sections/role-access-all.php');

// Formulario actual
if (!empty($_POST['btn'])) {
	$view_form = $_POST['btn'] . '.php';
} else {
	$view_form = 'form_default.php';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
	<meta name="robots" content="noindex">
	<meta name="google" value="notranslate">
	<link rel="icon" type="image/png" href="/images/icon_user.png" />
	<title>Ciclo Telesecundaria Emiliano Zapata | Telesecundaria Emiliano Zapata</title>
	<meta name="description" content="Telesecundaria Emiliano Zapata." />
	<link rel="stylesheet" href="/css/style.css?v=<?php echo(rand()); ?>" media="screen, projection" type="text/css" />
	<script src="/js/external/jquery.min.js" type="text/javascript"></script>
    <script src="/js/external/prefixfree.min.js" type="text/javascript"></script>
	<script src="/js/controls/unsetnotif.js"  type="text/javascript"></script>
	<script type="text/javascript">
		$(window).load(function() {
			$(".loader").fadeOut("slow");
		});
	</script>
</head>

<body>
	<div class="loader"></div>
	<header class="header">
		<?php
		include_once "../sections/section-info-title.php";
		?>
	</header>
	<aside>
        <?php
        if (isset($_SESSION['user'])) {
            if (isset($_SESSION['section-admin']) && $_SESSION['section-admin'] == 'section-admin-' . $_SESSION['user']) {
                include_once '../sections/section-admin.php';
            } elseif (isset($_SESSION['section-editor']) && $_SESSION['section-editor'] == 'section-editor-' . $_SESSION['user']) {
                include_once '../sections/section-editor.php';
            } elseif (isset($_SESSION['section-teacher']) && $_SESSION['section-teacher'] == 'section-teacher-' . $_SESSION['user']) {
                include_once '../sections/section-teacher.php';
            } elseif (isset($_SESSION['section-student']) && $_SESSION['section-student'] == 'section-student-' . $_SESSION['user']) {
                include_once '../sections/section-student.php';
            }
        }
        ?>
	</aside>
	<section class="content">
		<?php
		include_once $view_form;
		?>
	</section>
</body>
<script src="/js/controls/buttons.js" type="text/javascript"></script>

</html>