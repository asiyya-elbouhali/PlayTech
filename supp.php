<?php

include 'db_conn.php';


$productid=$_GET['idproduit'];




$sqlQuery = "DELETE FROM produit WHERE id=:productid";


$deletproduct = $mysqlClient->prepare($sqlQuery);
$deletproduct->execute([
  'productid' => $productid,
]);

header("Location: gallery-gestion.php");

?>