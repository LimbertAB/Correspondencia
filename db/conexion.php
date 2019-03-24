<?php
function conectar($host='localhost', $port='5432', $user='postgres', $pass='fersistem', $db='correspondencias'){
$cadena ="host=".$host." port=".$port." user=".$user." password=".$pass." dbname=".$db;
if(!($enlace=pg_connect($cadena)))
	echo "No se puede conectar";
else
	return $enlace;
}
conectar();
?>