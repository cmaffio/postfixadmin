?php

class mysql {

	function __construct($host, $user, $pwd, $dbname) {
		private $this->db = mysql_connect($host, $user, $pwd);
		mysql_select_db($dbname, $this->db);
	}

	function __destruct() {
		
	}



}

?>

