<?php
require_once('../common.php');
authentication_require_role('user');

include ("../templates/header.php");
include ("../templates/users_menu.php");
?>
<div id="main_menu">
<table>
   <tr>
      <td nowrap><a target="_webmail" href="ext/webmail.php">RoundCube WebMail</a></td>
      <td>Nuova versione della webmail da cui si potranno allineare i contatti con rubrica e agenda sul Cloud<br>( <a href="https://cloud.esseweb.eu/public.php?service=files&t=0fb2e9c461cff8377a269a7ab9065584&download&path=//Webmail.pdf">Documentazione</a>&nbsp;&nbsp;).</td>
   </tr>
</table>
</div>

<?php
include ("../templates/footer.php");
?>
