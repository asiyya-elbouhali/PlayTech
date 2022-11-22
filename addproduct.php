<?php

//l'ajout d'un noveau produit
if(!isset($_POST['idproduit'])){

if (isset($_POST['nomproduit']) && isset($_POST['quantiteproduit']) && isset($_POST['categorieproduit']) && isset($_POST['prixproduit']) && isset($_FILES['picproduit'])){

    include 'db_conn.php';

    $nomproduit=$_POST['nomproduit'];
    $quantiteproduit=$_POST['quantiteproduit'];
    $categorieproduit=$_POST['categorieproduit'];
    $prixproduit=$_POST['prixproduit'];

    $picname=$_FILES['picproduit']['name'];
    $pictmpname=$_FILES['picproduit']['tmp_name'];


  
//verification la non existence prealable de produit

$sqlQuery = "SELECT libelle FROM produit WHERE libelle = :nomproduit";

$productver = $mysqlClient->prepare($sqlQuery);
$productver->execute([
  'nomproduit' => $nomproduit,
]);

foreach ($productver as $ver) {
  $em="produit deja ajouté vous etes sure!!";
  header("Location: add.php?error=$em");
}


//traitement de la photo



if($_FILES['picproduit']['error']===0){

  if($_FILES['picproduit']['size']>100000000){
      $em = "sorry your file is too large";
      header("Location: add.php?error=$em");
  }else{
      $img_ex = pathinfo($picname, PATHINFO_EXTENSION);
      $img_ex_lc = strtolower($img_ex);

      $allowed_exs=array("jpg","jpeg","png");

      if(in_array($img_ex_lc,$allowed_exs)){

          $new_img_name=uniqid("IMG-",true).'.'.$img_ex_lc;
          $img_upload_path='uploads/'.$new_img_name;
          move_uploaded_file($pictmpname,$img_upload_path);
      }else{

          $em="only jpg,jpeg,png extensions are allowed";
          header("Location: add.php?error=$em");
      }
  }
}else{
  header("Location: addproduct.php");
}

unset($_FILES['picproduit']);




$sqlQuery = "SELECT id FROM categorie WHERE nom = :categorie";

$getcategorieid = $mysqlClient->prepare($sqlQuery);
$getcategorieid->execute([
  'categorie' => $categorieproduit,
]);






foreach ($getcategorieid as $categoriid) {

  $sqlQuery = 'INSERT INTO produit(libelle, quantite, id_categorie, prix, img) VALUES (:nomproduit, :quantiteproduit, :categorieproduit, :prixproduit, :new_img_name)';


$addproductStatement = $mysqlClient->prepare($sqlQuery);
$addproductStatement->execute([
  'nomproduit' => $nomproduit,
  'quantiteproduit' => $quantiteproduit,
  'categorieproduit' => $categoriid['id'],
  'prixproduit' => $prixproduit,
  'new_img_name'=>$new_img_name,
]);
}

}
header("Location: gallery-gestion.php");
}else{
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
if(isset($_FILES['picproduit'])){


    $picname=$_FILES['picproduit']['name'];
    $pictmpname=$_FILES['picproduit']['tmp_name'];


  if($_FILES['picproduit']['error']===0){

    if($_FILES['picproduit']['size']>100000000){
        $em = "sorry your file is too large";
        header("Location: add.php?error=$em");
    }else{
        $img_ex = pathinfo($picname, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
  
        $allowed_exs=array("jpg","jpeg","png");
  
        if(in_array($img_ex_lc,$allowed_exs)){
  
            $new_img_nom=uniqid("IMG-",true).'.'.$img_ex_lc;
            $img_upload_path='uploads/'.$new_img_nom;
            move_uploaded_file($pictmpname,$img_upload_path);
        }else{
  
            $em="unknown error occured";
            header("Location: add.php?error=$em");
        }
    }
  }else{
    header("Location: addproduct.php");
  }
  



  foreach ($getcategorieid as $categoriid) {

    $sqlQuery = 'UPDATE produit SET libelle=:nomproduit, quantite=:quantiteproduit, id_categorie=:categorieproduit, prix=:prixproduit img=:new_img_name WHERE id=:productid';
  
  
  $addproductStatement = $mysqlClient->prepare($sqlQuery);
  $addproductStatement->execute([
    'nomproduit' => $nomproduit,
    'quantiteproduit' => $quantiteproduit,
    'categorieproduit' => $categoriid['id'],
    'prixproduit' => $prixproduit,
    'productid' => $productid,
    'new_img_name'=> $new_img_nom,
  ]);
  
  }





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





}
header("Location: gallery-gestion.php");
}


}

?>