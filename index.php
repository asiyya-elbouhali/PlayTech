<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Play Tech -- statistiques</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="statistics.css">
</head>
<body>


    <?php 

    include "db_conn.php";


       $sqlQuery = "SELECT MAX(quantite) FROM produit";

       $maxquantitestatement = $mysqlClient->prepare($sqlQuery);
       $maxquantitestatement->execute();
       $maxquantite = $maxquantitestatement->fetch();
       

       $sqlQuery = "SELECT COUNT( quantite ) FROM produit";

       $totalstatement = $mysqlClient->prepare($sqlQuery);
       $totalstatement->execute();
       $total = $totalstatement->fetch();

       $sqlQuery = "SELECT AVG( quantite * prix) FROM produit";

       $moystatement = $mysqlClient->prepare($sqlQuery);
       $moystatement->execute();
       $moyenne = $moystatement->fetch();



    ?>

    <div class="statistics">
        <div class="content">
            <img src="img/the-sum-of.png" alt="">
            <h3>Total</h3>
            <h6><?php echo $total[0] ?> article(s)</h6>
            <a href="gallery-gestion.php">
            <button class="tot">More infos</button>
            </a>
        </div>



        <div class="content">
            <img src="img/average.png" alt="">
            <h3>Moyenne</h3>
            <h6><?php echo $moyenne[0] ?>$</h6>
            <a href="gallery-gestion.php">
            <button class="moy">More infos</button>
            </a>
        </div>



        <div class="content">
            <img src="img/speedometer.png" alt="">
            <h3>Maximum</h3>
            <h6><?php echo $maxquantite[0] ?> article(s)</h6>
            <a href="gallery-gestion.php">
            <button class="max">More infos</button>
            </a>
        </div>



        <div class="content">
            <img src="img/pourcentage.png" alt="">
            <h3>Pourcentage</h3>
            <h6>----</h6>
            <a href="gallery-gestion.php">
            <button  class="perc">More infos</button>

            </a>
        </div>
    </div>

</body>
</html>