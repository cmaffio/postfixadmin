
<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<div id="footer">
<?php 
if(isset($_SESSION['sessid']['username'])) {
    printf($PALANG['pFooter_logged_as'],authentication_get_usertype ()." ". authentication_get_username());
}
?> 
</div>
</body>
</html>
