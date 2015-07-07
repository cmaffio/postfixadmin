<?php
require_once('common.php');

authentication_require_role ('mr');

if(!is_file("$incpath/conf/config.mr.php")) {
    die("config.mr.php is missing!");
}
require_once("$incpath/conf/config.mr.php");

$error_text = "";
if (function_exists ("mysqli_connect")) {
	$link_mr = mysqli_connect ($MR['database_host'], $MR['database_user'], $MR['database_password']) or $error_text .= ("<p />DEBUG INFORMATION:<br />Connect: " .  mysqli_connect_error () . "$DEBUG_TEXT");
	if ($link_mr) {
		mysqli_query($link_mr,"SET CHARACTER SET utf8");
		mysqli_query($link_mr,"SET COLLATION_CONNECTION='utf8_general_ci'");
		$success = mysqli_select_db ($link_mr, $MR['database_name']) or $error_text .= ("<p />DEBUG INFORMATION:<br />MySQLi Select Database: " .  mysqli_error ($link_mr) . "$DEBUG_TEXT");
	}
} else {
	$error_text .= "<p />DEBUG INFORMATION:<br />MySQL 4.1 functions not available! (php5-mysqli installed?)<br />";
}
print "$error_text";

//if (authentication_has_role('global-admin')) { }

$fAccount = safepost('account', safeget('account')); # escaped below
$fMese = safepost('mese', safeget('mese')); # escaped below
$pezzi = explode(".", $fMese);

	$query = "SELECT 
			email, 
			FROM_UNIXTIME(data_attivazione, '%d.%m.%Y') AS data_inizio, 
			FROM_UNIXTIME(data_disattivazione, '%d.%m.%Y') AS data_fine, 
			DATE_FORMAT(ultimoaggiornamento, '%d.%m.%Y') AS data_agg, 
			invio_totale_corrente, 
			limiteinvio,
			autorinnovo
		FROM account
		WHERE
			email = '$fAccount'
	";

$result = mysqli_query ($link_mr, $query);
$num_mr = mysqli_num_rows ($result);


	$query = "SELECT
			DATE_FORMAT(giorno, '%d.%m.%Y') AS giorno, 
			SUM(numero_invii) AS invii
		FROM archivio
		WHERE
			account = '$fAccount'
		AND
			giorno LIKE '".$pezzi[1]."-".$pezzi[0]."%'
		GROUP BY 
			YEAR(giorno), 
			MONTH(giorno),
			DAY(giorno)
	";

$result_month = mysqli_query ($link_mr, $query);
$num_mr_month = mysqli_num_rows ($result);

include ("$incpath/templates/header.php");
include ("$incpath/templates/users_menu.php");
include ("$incpath/templates/utenza-mr-mese.php");
include ("$incpath/templates/footer.php");

/* vim: set expandtab softtabstop=3 tabstop=3 shiftwidth=3: */
?>
