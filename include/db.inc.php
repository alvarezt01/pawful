<?php

define ('MYSQL_HOSTNAME', 'localhost');
define ('MYSQL_USERNAME', 'root');
define ('MYSQL_PASSWORD', 'Sycamore');
define ('MYSQL_DATABASE', 'pawful');

require_once('mysql_db.class.php');

$db = new mysql_db();
$db->connect(MYSQL_HOSTNAME, MYSQL_USERNAME, MYSQL_PASSWORD) or die(mysql_error());
$db->select_db(MYSQL_DATABASE) or die (mysql_error());
$db->set_magic_quotes_off();

?>












