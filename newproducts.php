
<?php

//cette section a pour objectif de faire montrer les nouveaux produits 


try
{
	// On se connecte à MySQL
	$mysqlClient = new PDO('mysql:host=localhost;dbname=gaming_store;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}


$datecejour = date('y-m-j');

$sqlQuery = "SELECT * FROM produit WHERE dateajout=:dateajout LIMIT 4";



$newproducts = $mysqlClient->prepare($sqlQuery);
$newproducts->execute([
  'dateajout' => $datecejour,
]);


foreach ($newproducts as $newproduct) {

    echo $newproduct['libelle'];

}




?>

