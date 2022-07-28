<?php

include("../conexion.php");
$con=conectar();

$id_product=$_GET['id_producto'];

$sql="DELETE FROM productos  WHERE id_producto=".$id_product;
echo $sql;

$query=mysqli_query($con,$sql);
if($query)
{ 
Header("Location:".$_SERVER['HTTP_REFERER']);
}
?>