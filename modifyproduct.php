<?php
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

$idproduct=5;

$sqlQuery = "SELECT * FROM produit WHERE id = :idproduct";

$productmodify = $mysqlClient->prepare($sqlQuery);
$productmodify->execute([
  'idproduct' => $idproduct,
]);


foreach ($productmodify as $product) {

    $_POST["productname"]=$product["libelle"];
    $_POST["productprice"]=$product["prix"];
    $_POST["productquantite"]=$product["quantite"];
    $_POST["productcategorieid"]=$product["id_categorie"];

  
  }

  $sqlQuery = "SELECT nom FROM categorie WHERE id = :idcategorie";

  $getcategorienom = $mysqlClient->prepare($sqlQuery);
  $getcategorienom->execute([
  'idcategorie' => $_POST["productcategorieid"],
  ]);


  foreach ($getcategorienom as $catogoriename) {

    $_POST["productcategoriename"]=$catogoriename["nom"];

  }

  header("Location: modify.php");





?>