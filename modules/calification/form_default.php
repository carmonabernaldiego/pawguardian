<?php
require_once($_SESSION['raiz'] . '/modules/sections/role-access-student.php');
?>
<div class="form-gridview">
	<table class="default">
		<?php
		if ($_SESSION['total_groups'] != 0) {
			echo '
					<tr>
						<th>Grupo</th>
						<th>Nombre</th>
						<th class="center">Grado</th>
						<th class="center"><a class="icon">visibility</a></th>
					</tr>
			';
		}
		?>
		<?php
		for ($i = 0; $i < $_SESSION['total_groups']; $i++) {
			echo '
		    		<tr>
		    			<td>' . $_SESSION["group"][$i] . '</td>
						<td>' . $_SESSION["group_name"][$i] . '</td>
						<td class="center">' . $_SESSION["group_grade"][$i] . '</td>
						<td>
							<form action="" method="POST">
								<input style="display:none;" type="text" name="txtgroup" value="' . $_SESSION["group"][$i] . '"/>
								<input style="display:none;" type="text" name="txtgroupschoolperiod" value="' . $_SESSION['group_school_period'][$i] . '"/>
								<button class="btnedit" name="btn" value="form_add" type="submit"></button>
							</form>
						</td>
					</tr>
				';
		}
		?>
	</table>
	<?php
	if ($_SESSION['total_groups'] == 0) {
		echo '<img src="/images/404.svg" class="data-not-found" alt="404">';
	}
	?>
	<div class="pages">
		<ul>
			<?php
			for ($n = 1; $n <= $tpages; $n++) {
				if ($page == $n) {
					echo '<li class="active"><form name="form-pages" action="" method="POST"><button type="submit" name="page" value="' . $n . '">' . $n . '</button></form></li>';
				} else {
					echo '<li><form name="form-pages" action="" method="POST"><button type="submit" name="page" value="' . $n . '">' . $n . '</button></form></li>';
				}
			}
			?>
		</ul>
	</div>
</div>
<div class="content-aside">
	<?php
	include_once '../notif_info.php';
	include_once "../sections/options-search.php";
	?>
</div>