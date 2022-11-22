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

$idproduct=$_GET['idproduit'];

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

  $sqlQuery = "SELECT nom FROM categorie WHERE id != :idcategorie";
  $categoriesnom = $mysqlClient->prepare($sqlQuery);
  $categoriesnom->execute([
  'idcategorie' => $_POST["productcategorieid"],
  ]);




?>

<div class="container">

<div class="row">

<form method="POST" action="addproduct.php" enctype="multipart/form-data">
<div class="mb-3">
        <label for="idproduit" class="form-label">ID Produit</label>
        <input type="text" class="form-control" id="idproduit" name="idproduit" value="<?php echo $idproduct; ?>">
    </div>
    <div class="mb-3">
        <label for="nomproduit" class="form-label">Nom</label>
        <input type="text" class="form-control" id="nomproduit" name="nomproduit" value="<?php echo $_POST['productname']; ?>">
    </div>
    <div class="mb-3">
      <label for="picproduit" class="form-label">Picture</label>
      <input class="form-control" type="file" id="picproduit" name="picproduit">
    </div>
    <div class="mb-3">
        <label for="quantiteproduit" class="form-label">Quantité</label>
        <input type="nombre" class="form-control" id="quantiteproduit" name="quantiteproduit" value="<?php echo $_POST["productquantite"]; ?>">
    </div>
    <div class="mb-3">
        <label for="prixproduit" class="form-label">Prix</label>
        <input type="nombre" class="form-control" id="prixproduit" name="prixproduit" value="<?php echo $_POST["productprice"]; ?>">
    </div>
    <select class="form-select mb-3" aria-label="Default select example" name="categorieproduit">
      <option selected value="<?php echo $_POST["productcategoriename"]; ?>"><?php echo $_POST["productcategoriename"]; ?></option>
      <?php
      foreach($categoriesnom as $categorinom){
      ?>
      <option value="<?php echo $categorinom["nom"]; ?>"><?php echo $categorinom["nom"]; ?></option>
      <?php
      }
      ?>
    </select>
    <button type="submit" class="btn btn-primary">modifier</button>
</form>


</div>

</div>
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>