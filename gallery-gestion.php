<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css ?v=<?php echo time(); ?>
">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>   
        <script src="https://kit.fontawesome.com/14273d579a.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;1,100&family=Rubik+Distressed&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>



<nav class="navbar navbar-expand-lg black-nav ">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"> <img src="img/LOGOO.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <img src="img/toggle.png" alt="" style="height: 40px ;">

          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.html">Home</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="gallery.php">Gallery</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="gestion.html">Se connecter</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>



      



<?php 

include 'db_conn.php';

 $sqlQuery = "SELECT nom FROM categorie";
  $categoriesnom = $mysqlClient->prepare($sqlQuery);
  $categoriesnom->execute();


?>
<form method="POST" action="gallery-gestion.php" class="selection-all" >
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
   $products->execute();?>
   <div class="carte">
  <?php
   foreach ($products as $product) {
   ?>

   <div class="card card2 col-md-5 col-lg-3 col-sm-10" id="<?=$product['id']?>" style="width: 18rem;">
    <img src="uploads/<?=$product['img']?>" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <a href="#" class="btn btn-light">Go somewhere</a>
      <h4><?=$product['prix']?>,00 DH</h4>
      <h4>Qté: <?=$product['quantite']?></h4>

      <a href="supp.php?idproduit=<?=$product['id']?>">supprimer</a>
      <a href="modify.php?idproduit=<?=$product['id']?>">
    modifier
    </a>
    </div>
   </div>
    <?php
   }?>
  </div>
<?php 
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
   ]);?>
   <div class="carte">
  <?php
   foreach ($productsid as $product) {
   ?>
   <div class="card card2 col-md-5 col-lg-3 col-sm-10" id="<?=$product['id']?>" style="width: 18rem;">
    <img src="uploads/<?=$product['img']?>" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <h4><?=$product['prix']?>,00 DH</h4>
      <h4>Qté: <?=$product['quantite']?></h4>
      <a href="#" class="btn btn-light">Go somewhere</a>
      <a href="supp.php?idproduit=<?=$product['id']?>">supprimer</a>
      <a href="modify.php?idproduit=<?=$product['id']?>">modifier</a>
      
    </div>
   </div>
   <?php 
   }?>
   </div>
   <?php
    }
}
}else{

    $sqlQuery = "SELECT * FROM produit";

   $products = $mysqlClient->prepare($sqlQuery);
   $products->execute();
   ?>
   <div class="carte">
   <?php
   foreach ($products as $product) {
   ?>

    <div class="card card2 col-md-5 col-lg-3 col-sm-10" id="<?=$product['id']?>" style="width: 18rem;">
    <img src="uploads/<?=$product['img']?>" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><?=$product['libelle']?></h5>
      <h4><?=$product['prix']?>,00 DH</h4>
      <h4>Qté: <?=$product['quantite']?></h4>
      <a href="#" class="btn btn-light">Go somewhere</a>
      <a href="supp.php?idproduit= <?=$product['id']?>">supprimer</a>
      <a href="modify.php?idproduit=<?=$product['id']?>">modifier</a>
    </div>
   </div>
   <?php 
   }?>
   </div>
   <?php
}
?>




































































 
  


     
          



<!-- ************************************************************************************************* -->
<div class="footer">
        <div class="container">
            <div class="footer-cats row">
                <ul class="footer-cat  col-md-5 col-lg-3 col-sm-10">
                    <li class="footer-titles"> Contact</li>
                    <a href="#">
                        <li> support@gaming-store.com</li>
                    </a>
                </ul>
                <ul class="footer-cat  col-md-5 col-lg-3 col-sm-10">
                    <li class="footer-titles "> Company info</li>
                    <a href="#">
                        <li> About Us</li>
                    </a>
                    <a href="#">
                        <li> Contact Us</li>
                    </a>
                    <a href="#">
                        <li> Privacy Policy</li>
                    </a>
                    <a href="#">
                        <li> Terms & Conditions</li>
                    </a>
                    <a href="#">
                        <li> COVID-19 UPDATE</li>
                    </a>
                </ul>
                <ul class="footer-cat  col-md-5 col-lg-3 col-sm-10">
                    <li class="footer-titles"> Purchase info</li>
                    <a href="#">
                        <li> FAQs</li>
                    </a>
                    <a href="#">
                        <li> Payment Methods</li>
                    </a>
                    <a href="#">
                        <li> Shipping & Delivery</li>
                    </a>
                    <a href="#">
                        <li> Returns Policy</li>
                    </a>
                    <a href="#">
                        <li> Tracking</li>
                    </a>
                </ul>
                <ul class="footer-cat  col-md-5 col-lg-3 col-sm-10">
                    <li class="footer-titles"> Join us On</li>

                </ul>
            </div>

<div class="pay">
    <p>PAYMENT METHODS:</p>
    <img src="img/f1.png" alt="">
    <img src="img/f2.png" alt="">
    <img src="img/f3.png" alt="">
    <img src="img/f4.png" alt="">
    <img src="img/f8.png" alt="">
    <img src="img/f9.png" alt="">


</div>

            <div class="copyright">
                <p>© Copyright 2022. All Rights Reserved</p>
            </div>
        </div>
    </div>
</body>

</html>