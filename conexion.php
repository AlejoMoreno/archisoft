<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>



<body>
<?php

$tutorial = "MySQL 5.5 database added.  Please make note of these credentials:

   Root User: adminJBN34JZ
   Root Password: Xz6F5M8sT9xH
   Database Name: prueba

Connection URL: mysql://$OPENSHIFT_MYSQL_DB_HOST:$OPENSHIFT_MYSQL_DB_PORT/

You can manage your new MySQL database by also embedding phpmyadmin.
The phpmyadmin username and password will be the same as the MySQL credentials above.

PHPmyADMIN
Please make note of these MySQL credentials again:
  Root User: adminJBN34JZ
  Root Password: Xz6F5M8sT9xH
URL: https://prueba-invensoft.rhcloud.com/phpmyadmin/";
	
	function conexion()
	{
	    $db_connection =  mysqli_connect("localhost", "root", "admin");
	
        	if (!$db_connection) {
			echo 'conexion';
		    die('No pudo conectarse: ' . mysqli_error($db_connection));
		}
		//--------------------------------------------------------------
		mysqli_select_db($db_connection,"archivo") or die(mysqli_error($db_connection));
		return $db_connection;

	}
?>

</body>
</html>