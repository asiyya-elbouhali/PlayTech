<?php
// ******  connection avec la base de données******
try
{
	// Pour se connecter à MySQL
	$mysqlClient = new PDO('mysql:host=localhost;dbname=gaming_store;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, un message d'erreur sera affiche et tout s'arrête
        die('Erreur : '.$e->getMessage());
}

?>