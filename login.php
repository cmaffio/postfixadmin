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
 * @version $Id: login.php 575 2009-03-13 20:48:24Z GingerDog $ 
 * @license GNU GPL v2 or later. 
 * 
 * File: login.php
 * Used to authenticate want-to-be users.
 * Template File: login.php
 *
 * Template Variables:
 *
 *  tMessage
 *  tUsername
 *
 * Form POST \ GET Variables:  
 *
 *  fUsername
 *  fPassword
 *  lang
 */

require_once("common.php");


if ($_SERVER['REQUEST_METHOD'] == "GET")
{
   include ("$incpath/templates/header.php");
   include ("$incpath/templates/users_login.php");
   include ("$incpath/templates/footer.php");
}

if ($_SERVER['REQUEST_METHOD'] == "POST")
{

   $lang = safepost('lang');
   include ("$incpath/admin/procrypt.php");

   if ( $lang != check_language(0) ) { # only set cookie if language selection was changed
      setcookie('lang', $lang, time() + 60*60*24*30); # language cookie, lifetime 30 days
      # (language preference cookie is processed even if username and/or password are invalid)
   }

   $fUsername = escape_string ($_POST['fUsername']);
   $fPassword = escape_string ($_POST['fPassword']);

   if(UserHandler::login($_POST['fUsername'], $_POST['fPassword'])) {
      session_regenerate_id();
      $_SESSION['sessid'] = array();
      $_SESSION['sessid']['roles'] = array();
      $_SESSION['sessid']['roles'][] = 'user';
      $_SESSION['sessid']['type'] = 'user';
      $_SESSION['sessid']['username'] = $fUsername;
      $_SESSION['sessid']['lenpass'] = strlen($fPassword);

      $crypt = new proCrypt;
      $_SESSION['sessid']['forgetdata']=$crypt->encrypt($fPassword);

      is_admin_role ($fUsername, $fPassword);
      is_new($fUsername);
      is_mr_role($fUsername);
      is_mm_role($fUsername);

      header("Location: main.php");
      exit;
   }
   else {   
         $error = 1;
         $tMessage = '<span class="error_msg">' . $PALANG['pLogin_failed'] . '</span>';
         $tUsername = $fUsername;
   }

   include ("$incpath/templates/header.php");
   include ("$incpath/templates/users_login.php");
   include ("$incpath/templates/footer.php");
}
/* vim: set expandtab softtabstop=3 tabstop=3 shiftwidth=3: */
?>
