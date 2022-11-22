<!DOCTYPE html>

<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>PlayTech</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="index.css">
    <script src="https://kit.fontawesome.com/14273d579a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>

<?php 

include 'db_conn.php';

 $sqlQuery = "SELECT nom FROM categorie";
  $categoriesnom = $mysqlClient->prepare($sqlQuery);
  $categoriesnom->execute();


?>
<form method="POST" action="view.php">
<select class="form-select mb-3" aria-label="Default select example" name="categorieproduit">
      <option selected value="all">all</option>
      <?php
      foreach($categoriesnom as $categorinom){
      ?>
      <option  value="<?php echo $categorinom["nom"]; ?>"><?php echo $categorinom["nom"]; ?></option>
      <?php
      }
      ?>
</select>
<button type="submit" class="btn btn-primary">Filtrer</button>
</form>

<?php

if(isset($_POST['categorieproduit'])){
    $categorieproduit=$_POST['categorieproduit'];

    if($categorieproduit=="all"){

        $sqlQuery = "SELECT * FROM produit";

   $products = $mysqlClient->prepare($sqlQuery);
   $products->execute();
   foreach ($products as $product) {
   ?>
   <div class="item" id="<?=$product['id']?>">
    <img src="uploads/<?=$product['img']?>" alt="">
    <a href="supp.php?idproduit=<?=$product['id']?>">supprimer</a>
    <a href="modify.php?idproduit=<?=$product['id']?>">modifier</a>
   </div>
   <?php 
   }
    }else{


        $sqlQuery = "SELECT id FROM categorie WHERE nom = :categorie";

   $getcategorieid = $mysqlClient->prepare($sqlQuery);
   $getcategorieid->execute([
  'categorie' => $categorieproduit,
   ]);

   foreach ($getcategorieid as $categoriid) {

   $sqlQuery = "SELECT * FROM produit WHERE id_categorie = :id";

   $productsid = $mysqlClient->prepare($sqlQuery);
   $productsid->execute([
  'id' => $categoriid['id'],
   ]);
   foreach ($productsid as $product) {
   ?>
   <div class="item" id="<?=$product['id']?>">
   <img src="uploads/<?=$product['img']?>" alt="">

   </div>
   <?php 
   }
    }
}
}else{

    $sqlQuery = "SELECT * FROM produit";

   $products = $mysqlClient->prepare($sqlQuery);
   $products->execute();
   foreach ($products as $product) {
   ?>
   <div class="item" id="<?=$product['id']?>">
   
    <img src="uploads/<?=$product['img']?>" alt="">
    <h1><?=$product['libelle']?></h1>
   <h1><?=$product['prix']?></h1>
   <h1><?=$product['quantite']?></h1>
    <a href="supp.php?idproduit= ?>">supprimer</a>
    <a href="modify.php?idproduit=<?=$product['id']?>">modifier</a>
   </div>
   <?php 
   }
}
?>
</body>
</html>