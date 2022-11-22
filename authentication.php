
<?php
  
  include 'db_conn.php';

  $username = $_POST["username"];
  $password = $_POST["password"];



$sqlQuery = "SELECT id FROM admin WHERE username = :username AND password = :password ";
$authStatement = $mysqlClient->prepare($sqlQuery);
$authStatement->execute([
  'username' => $username,
  'password' => $password,
]);
$auth = $authStatement->fetch();


if(!$auth){
  $em="Ce compte n’existe pas";
  header("Location: gestion.html?error=$em");
  
}else{
  header("Location: management.html");
}

?>
