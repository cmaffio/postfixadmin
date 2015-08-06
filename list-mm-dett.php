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

if ($_SERVER['REQUEST_METHOD'] == "GET") {

	if (isset ($_GET['idl'])) $idl = safeget('idl');

	$query	= "	SELECT 
				id,
				DATE_FORMAT(data_ins, '%d.%m.%Y %T') AS creato,
				DATE_FORMAT(data_mod, '%d.%m.%Y %T') AS modificato,
				indirizzo,
				nome,
				errori,
				stato
			FROM 
				destinatari
			WHERE
				id_liste = $idl
			ORDER BY
				indirizzo
			";

//print "$query";

	$result = mysqli_query ($link_mm, $query);
	$num = mysqli_num_rows ($result);


}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

}


include ("$incpath/templates/header.php");
include ("$incpath/templates/users_menu.php");
include ("$incpath/templates/list-mm-det.php");
include ("$incpath/templates/footer.php");

/* vim: set expandtab softtabstop=3 tabstop=3 shiftwidth=3: */
?>
