<!DOCTYPE html>

<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>PlayTech</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/14273d579a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>   
        <script src="https://kit.fontawesome.com/14273d579a.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;1,100&family=Rubik+Distressed&display=swap" rel="stylesheet">


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
                <a class="nav-link" href="gallery.html">Gallery</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="gestion.html">Se connecter</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>









<?php if(isset($_GET['error'])): ?>
    <p><?php echo $_GET['error'] ?></p>
<?php endif ?>

<div class="container">

<div class="row">

<form method="POST" action="addproduct.php" enctype="multipart/form-data">
    <div class="mb-3 chmp">
        <label for="nomproduit" class="form-label label-f">Nom</label>
        <input type="text" class="form-control" id="nomproduit" name="nomproduit" required>
    </div>
    <div class="mb-3 chmp">
      <label for="picproduit" class="form-label label-f">Picture</label>
      <input class="form-control" type="file" id="picproduit" name="picproduit">
    </div>
    <div class="mb-3 chmp">
        <label for="quantiteproduit" class="form-label label-f">Quantité</label>
        <input type="nombre" class="form-control" id="quantiteproduit" name="quantiteproduit" required>
    </div>
    <div class="mb-3 chmp">
        <label for="prixproduit" class="form-label label-f">Prix</label>
        <input type="nombre" class="form-control" id="prixproduit" name="prixproduit" required>
    </div>





    <div class="mb-3">
        <label for="categorie" class="form-label label-f">Categorie</label>
        <select class="form-select mb-3" aria-label="Default select example" name="categorieproduit" id="categorie" required>
               <option value=""></option>
               <option value="clavier">Keyboard</option>
               <option value="pc gaming">Gaming PC</option>
               <option value="mouse"> Mouse</option>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>


</div>

</div>







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