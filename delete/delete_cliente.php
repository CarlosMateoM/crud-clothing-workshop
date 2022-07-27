<?php

include("../conexion.php");
$con=conectar();

$id_client=$_GET['id_cliente'];

$sql="DELETE FROM cliente  WHERE id_cliente=".$id_client;
echo $sql;

$query=mysqli_query($con,$sql);
if($query)
{ 
Header("Location:".$_SERVER['HTTP_REFERER']);
}
?>

