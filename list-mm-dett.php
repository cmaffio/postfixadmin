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
}


        if ($fSchedula == "Annulla") {
        }



if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if (isset ($_POST['fName'])) $fName = safepost('fName');
	if (isset ($_POST['idl'])) $idl = safepost('idl');
	if (isset ($_POST['fSchedula'])) $fSchedula = safepost('fSchedula');
	if (isset ($_POST['fTipo'])) $fTipo = safepost('fTipo');
	if (isset ($_POST['fNome'])) $fNome = safepost('fNome');
	if (isset ($_POST['fMail'])) $fMail = safepost('fMail');

	if ($fSchedula == "Torna") {
		header ("Location: ".$CONF['postfix_admin_url']."/list-mm.php");
		exit(0);
	}

	if ($fSchedula == "Aggiungi indirizzi") {
		if (isset($_FILES['fFile'])) {
			$file = $_FILES['fFile'];
			if($file['error'] == UPLOAD_ERR_OK and is_uploaded_file($file['tmp_name'])) {
				$righe = file ($file['tmp_name']);

				switch ($fTipo) {
					case 'Base':
						$pattern = '/^"?([^"^<]*)"?\s*"?\s*<?([^@]+@[^>^\s]+)>?"?/';
					break;
					case 'Thunderbird':
						$pattern = '/^[^,]*,[^,]*,([^,]*),[^,]*,([^,]+),[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*,[^,]*/';
					break;
					default:
						flash_error("Formato non riconosciuto");
				}

				$importati = $errati = 0;
				foreach($righe as $line) {
					$rit = preg_match($pattern, $line, $matches);
					if ($rit) {
						$mail = $matches[2];
						$nome = $matches[1];


						if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

							$query = "	INSERT INTO
										destinatari
									SET
										id_utenze = (SELECT id FROM utenze WHERE mail = '".authentication_get_username()."'),
										id_liste = $idl,
										data_ins = NOW(),
										data_mod = NOW(),
										indirizzo = '$mail',
										nome = '$nome',
										errori = 0,
										stato = 1
									ON DUPLICATE KEY UPDATE
										id = id
							";

							//print "$query<br>";
							$result = mysqli_query ($link_mm, $query);
							$importati++;
						} else {
							$errati++;
						}


					} else {
						$errati++;
					}

				}

			}
		}

	}

	if ($fSchedula == "Rinomina lista") {
		if ($fName == "") {
			flash_error("Per cortesia inserire un nome per la nuova lista");
		} else {
			$query = "	UPDATE
						liste
					SET
						nome = '$fName',
						data = NOW()
					WHERE
						id = $idl
			";
			$result = mysqli_query ($link_mm, $query);
		}
	}

	if ($fSchedula == "Aggiungi") {
		if ($fNome == "" || $fMail == "") {
			flash_error("Inserire nome ed indirizzo mail");
		} else {


			if (filter_var($fMail, FILTER_VALIDATE_EMAIL)) {
				$query = "	INSERT INTO
							destinatari
						SET
							id_utenze = (SELECT id FROM utenze WHERE mail = '".authentication_get_username()."'),
							id_liste = $idl,
							data_ins = NOW(),
							data_mod = NOW(),
							indirizzo = '$fMail',
							nome = '$fNome',
							errori = 0,
							stato = 1
						ON DUPLICATE KEY UPDATE
							id = id
					";

//				print "$query<br>";
				$result = mysqli_query ($link_mm, $query);
			} else {
				flash_error("Formato indirizzo maili errato");
			}
		}
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
			id_liste = $idl
		ORDER BY
			indirizzo
";

$query_n = "	SELECT
			nome
		FROM
			liste
		WHERE
			id = $idl
";

//print "$query";

$result = mysqli_query ($link_mm, $query);
$result_n = mysqli_query ($link_mm, $query_n);
$num = mysqli_num_rows ($result);

include ("$incpath/templates/header.php");
include ("$incpath/templates/users_menu.php");
include ("$incpath/templates/list-mm-det.php");
include ("$incpath/templates/footer.php");

/* vim: set expandtab softtabstop=3 tabstop=3 shiftwidth=3: */
?>
