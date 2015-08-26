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
	if (isset ($_GET['idm'])) $idm = safeget('idm');

}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if (isset ($_POST['idl'])) $idl = safepost('idl');
	if (isset ($_POST['idm'])) $idm = safepost('idm');
	if (isset ($_POST['fSchedula'])) $fSchedula = safepost('fSchedula');
	if (isset ($_POST['fNome'])) $fnome = safepost('fNome');
	if (isset ($_POST['fMail'])) $fmail = safepost('fMail');

	if ($fSchedula == "Torna") {
		header ("Location: ".$CONF['postfix_admin_url']."/list-mm-dett.php?idl=$idl");
		exit(0);
	} elseif ($fSchedula == "Attiva" || $fSchedula == "Disattiva") {

		$query = "	UPDATE
					destinatari
				SET
					stato = (stato + 1) MOD 2,
					data_mod = NOW()
				WHERE
					id = $idm
		";
//		print "$query";
		$result = mysqli_query ($link_mm, $query);
	} elseif ($fSchedula == "Aggiorna") {

		$query = "	UPDATE
					destinatari
				SET
					indirizzo = '$fmail',
					nome = '$fnome',
					data_mod = NOW()
				WHERE
					id = $idm
		";
//		print "$query";
		$result = mysqli_query ($link_mm, $query);
	}


}

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
			id = $idm
		ORDER BY
			indirizzo
";

$query_m = "	SELECT 
			invii.id AS id,
			invii.id_scheduler AS scheduler,
			ricezioni.oggetto AS oggetto,
			DATE_FORMAT(invii.data, '%d.%m.%Y %T') AS data,
			invii.stato AS stato,
			invii.action AS action,
			invii.status AS status,
			invii.dc AS dc,
			DATE_FORMAT(invii.data_reply, '%d.%m.%Y %T') AS data_reply
		FROM
			invii
		JOIN
			ricezioni ON ricezioni.id = invii.id_ricezione
		WHERE
			invii.id_destinatari = $idm
		ORDER BY
			data
";


//print "$query_m";

$result = mysqli_query ($link_mm, $query);
$result_m = mysqli_query ($link_mm, $query_m);

include ("$incpath/templates/header.php");
include ("$incpath/templates/users_menu.php");
include ("$incpath/templates/list-mm-mail.php");
include ("$incpath/templates/footer.php");

/* vim: set expandtab softtabstop=3 tabstop=3 shiftwidth=3: */
?>
