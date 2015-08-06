<?php
require_once('common.php');

authentication_require_role ('mm');

$error_text = "";
if (function_exists ("mysqli_connect")) {
	$link_mm = mysqli_connect ($MM['database_host'], $MM['database_user'], $MM['database_password']) or $error_text .= ("<p />DEBUG INFORMATION:<br />Connect: " .  mysqli_connect_error () . "$DEBUG_TEXT");
	if ($link_mm) {
		mysqli_query($link_mm,"SET CHARACTER SET utf8");
		mysqli_query($link_mm,"SET COLLATION_CONNECTION='utf8_general_ci'");
		$success = mysqli_select_db ($link_mm, $MM['database_name']) or $error_text .= ("<p />DEBUG INFORMATION:<br />MySQLi Select Database: " .  mysqli_error ($link_mm) . "$DEBUG_TEXT");
	}
} else {
	$error_text .= "<p />DEBUG INFORMATION:<br />MySQL 4.1 functions not available! (php5-mysqli installed?)<br />";
}
print "$error_text";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if (isset ($_POST['fName'])) $fName = safepost('fName');
	if (isset ($_POST['fSchedula'])) $fSchedula = safepost('fSchedula');

	if ($fSchedula == "Crea una nuova lista") { 

		if ($fName == "") {
			flash_error("Per cortesia inserire un nome per la nuova lista");
		} else {

			$query = "	SELECT
						liste.id
					FROM
						liste
					JOIN
						utenze ON utenze.id = liste.id_utenze
					WHERE
						utenze.mail = '".authentication_get_username()."' 
					AND
						liste.nome = '$fName'
			";
			$result = mysqli_query ($link_mm, $query);
			$num = mysqli_num_rows ($result);

			if ($num == 0) {
				$query =	"INSERT INTO
							liste
							(id_utenze, data, nome)
							SELECT id, NOW(), '$fName' FROM utenze WHERE utenze.mail = '".authentication_get_username()."'
				";
				$result = mysqli_query ($link_mm, $query);
			} else {
				flash_error("Nome di lista gia' esistente");
			}
		}
	}
}


$query	= "	SELECT 
			liste.id AS id,
			liste.nome AS nome,
			DATE_FORMAT(liste.data, '%d.%m.%Y %T') AS modifica,
			COUNT(destinatari.id) AS quanti
		FROM 
			liste
		JOIN 
			utenze ON utenze.id = liste.id_utenze
		LEFT JOIN
			destinatari ON utenze.id = destinatari.id_utenze AND destinatari.id_liste = liste.id
		WHERE
			utenze.mail = '".authentication_get_username()."'
		GROUP BY
			nome, modifica
		";

//print "$query";

$result = mysqli_query ($link_mm, $query);
$num = mysqli_num_rows ($result);

include ("$incpath/templates/header.php");
include ("$incpath/templates/users_menu.php");
include ("$incpath/templates/list-mm.php");
include ("$incpath/templates/footer.php");

/* vim: set expandtab softtabstop=3 tabstop=3 shiftwidth=3: */
?>
