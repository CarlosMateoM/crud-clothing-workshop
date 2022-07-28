<?php

include("conexion.php");
$con=conectar();

$id_product=$_POST['id_producto'];
$nombre=$_POST['nombre'];
$talla=$_POST['talla'];
$numero=$_POST['numero'];
$obs_POST['Observacion'];
$idD=$_POST['id_detalles'];


$sql="UPDATE productos SET  id_producto='$id_product',nombre='$nombre',talla='$talla',numero='$numero',observacion='$obs',id_detalles='$idD' WHERE id_producto='$id_product'";

$query=mysqli_query($con,$sql);

    if($query){
        header("Location:".$_SERVER['HTTP_REFERER']);
    }
?>