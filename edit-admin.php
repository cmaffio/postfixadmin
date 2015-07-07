<?php
/** 
 * Postfix Admin 
 * 
 * LICENSE 
 * This source file is subject to the GPL license that is bundled with  
 * this package in the file LICENSE.TXT. 
 * 
 * Further details on the project are available at : 
 *     http://www.postfixadmin.com or http://postfixadmin.sf.net 
 * 
 * @version $Id: edit-admin.php 566 2009-02-15 15:02:26Z christian_boltz $ 
 * @license GNU GPL v2 or later. 
 * 
 * File: edit-admin.php
 * Edits a normal administrator's details.
 *
 * Template File: admin_edit-admin.php
 *
 * Template Variables:
 *
 * tAllDomains
 * tDomains
 * tActive
 * tSadmin
 *
 * Form POST \ GET Variables:
 *
 * fDescription
 * fAliases
 * fMailboxes
 * fMaxquota
 * fActive
 */

require_once('common.php');

authentication_require_role('global-admin');

$error = 1;
if(isset($_GET['username'])) {
    $username = escape_string ($_GET['username']);
    $result = db_query("SELECT * FROM $table_admin WHERE username = '$username'");
    if($result['rows'] == 1) {
        $admin_details = db_array($result['result']);
        $error = 0;
    }
}
if($error == 1){
    flash_error($PALANG['pAdminEdit_admin_result_error']);
    header("Location: list-admin.php");
    exit(0);
}

// we aren't ensuring the password is longer than x characters, should we?
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $fActive=(isset($_POST['fActive'])) ? escape_string ($_POST['fActive']) : FALSE;
    $fSadmin=(isset($_POST['fSadmin'])) ? escape_string ($_POST['fSadmin']) : FALSE;

    $fDomains = false;
    if (isset ($_POST['fDomains'])) $fDomains = $_POST['fDomains'];

    $tAllDomains = list_domains ();

    $fDomains = array();
    if (array_key_exists('fDomains', $_POST)) $fDomains = escape_string ($_POST['fDomains']);
    if ($error != 1)
    {
        if ($fActive == "on")  {
            $sqlActive = db_get_boolean(True);
        }
        else {
            $sqlActive = db_get_boolean(False);
        }

        $result = db_query ("UPDATE $table_admin SET modified=NOW(),active='$sqlActive' WHERE username='$username'");

        if ($fSadmin == "on") $fSadmin = 'ALL';

        // delete everything, and put it back later on..
        db_query("DELETE FROM $table_domain_admins WHERE username = '$username'");
        if($fSadmin == 'ALL') {
            $fDomains = array('ALL');
        }

        foreach($fDomains as $domain) 
        {
            $result = db_query ("INSERT INTO $table_domain_admins (username,domain,created) VALUES ('$username','$domain',NOW())");
        }
        flash_info($PALANG['pAdminEdit_admin_result_success']);
        header("Location: list-admin.php");
        exit(0);
    }
    else {
        flash_error($PALANG['pAdminEdit_admin_result_error']);
    }
}
if (isset($_GET['username'])) $username = escape_string ($_GET['username']);

$tAllDomains = list_domains();
$tDomains = list_domains_for_admin ($username);
$tActive = '';
$tPassword = $admin_details['password'];

if($admin_details['active'] == 't' || $admin_details['active'] == 1) {
    $tActive = $admin_details['active'];
}
$tSadmin = '0';
$result = db_query ("SELECT * FROM $table_domain_admins WHERE username='$username'");
// could/should be multiple matches to query; 
if ($result['rows'] >= 1) {
    $result = $result['result'];
    while($row = db_array($result)) {
        if ($row['domain'] == 'ALL') {
            $tSadmin = '1';
            $tDomains = array(); /* empty the list, they're an admin */
        }
    }
}

include ("$incpath/templates/header.php");
include ("$incpath/templates/users_menu.php");
include ("$incpath/templates/admin_edit-admin.php");
include ("$incpath/templates/footer.php");

/* vim: set expandtab softtabstop=4 tabstop=4 shiftwidth=4: */
?>
