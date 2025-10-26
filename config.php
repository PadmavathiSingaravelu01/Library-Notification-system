<?php
define('DBSERVER','localhost');
define('DBUSERNAME','siva');
define('DBPASSWORD','lib2023');
define('DBNAME','mydb');

$db =mysqli_connect(DBSERVER,DBUSERNAME,DBPASSWORD,DBNAME);

if($db === false){
	die("Error:connection error." .mysqli_connect_error());
}
?>