<?php

include("../conexion.php");
$con=conectar();

$id_fact=$_GET['id_factura'];

$sql="DELETE FROM factura  WHERE id_factura=".$id_fact;
echo $sql;

$query=mysqli_query($con,$sql);

if($query){  
    Header("Location:".$_SERVER['HTTP_REFERER']);
}
?>
