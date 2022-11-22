<?php


//modification d'un produit
  $productid=$_POST['idproduit'];
  

  if (isset($_POST['nomproduit']) && isset($_POST['quantiteproduit']) && isset($_POST['categorieproduit']) && isset($_POST['prixproduit'])){



    include 'db_conn.php';

    $nomproduit=$_POST['nomproduit'];
    $quantiteproduit=$_POST['quantiteproduit'];
    $categorieproduit=$_POST['categorieproduit'];
    $prixproduit=$_POST['prixproduit'];



  $sqlQuery = "SELECT id FROM categorie WHERE nom = :categorie";

   $getcategorieid = $mysqlClient->prepare($sqlQuery);
   $getcategorieid->execute([
  'categorie' => $categorieproduit,
   ]);


   //traitement de la photo
if(isset($_FILES['picproduitt'])){

    $picname=$_FILES['picproduitt']['name'];
    $pictmpname=$_FILES['picproduitt']['tmp_name'];


  if($_FILES['picproduitt']['error']===0){

    if($_FILES['picproduitt']['size']>100000000){
        $em = "sorry your file is too large";
        header("Location: modify.php?idproduit=$productid&error=$em");
    }else{
        $img_ex = pathinfo($picname, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
  
        $allowed_exs=array("jpg","jpeg","png");
  
        if(in_array($img_ex_lc,$allowed_exs)){
  
            $new_img_name=uniqid("IMG-",true).'.'.$img_ex_lc;
            $img_upload_path='uploads/'.$new_img_name;
            move_uploaded_file($pictmpname,$img_upload_path);
        }else{
  
            $em="extension non permise";
            header("Location: modify.php?idproduit=$productid&error=$em");
        }
    }
  }else{
    $em="Error";
    header("Location: modify.php?idproduit=$productid&error=$em");

  }

  unset($_FILES['picproduitt']);




  foreach ($getcategorieid as $categoriid) {

    $sqlQuery = 'UPDATE produit SET libelle=:nomproduit, quantite=:quantiteproduit, id_categorie=:categorieproduit, prix=:prixproduit, img=:new_img_name WHERE id=:productid';
  
  
  $addproductStatement = $mysqlClient->prepare($sqlQuery);
  $addproductStatement->execute([
    'nomproduit' => $nomproduit,
    'quantiteproduit' => $quantiteproduit,
    'categorieproduit' => $categoriid['id'],
    'prixproduit' => $prixproduit,
    'productid' => $productid,
    'new_img_name' => $new_img_name,

  ]);
  
  }

  header("Location: gallery-gestion.php");


}else{

    foreach ($getcategorieid as $categoriid) {

        $sqlQuery = 'UPDATE produit SET libelle=:nomproduit, quantite=:quantiteproduit, id_categorie=:categorieproduit, prix=:prixproduit WHERE id=:productid';
      
      
      $addproductStatement = $mysqlClient->prepare($sqlQuery);
      $addproductStatement->execute([
        'nomproduit' => $nomproduit,
        'quantiteproduit' => $quantiteproduit,
        'categorieproduit' => $categoriid['id'],
        'prixproduit' => $prixproduit,
        'productid' => $productid,
      ]);
      
      }


    header("Location: gallery-gestion.php");

}
}else{


  $em="Champs vide";
  header("Location: modify.php?idproduit=$productid&error=$em");

}
  