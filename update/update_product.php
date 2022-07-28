<?php

include("../conexion.php");
$con=conectar();

$id_product=$_POST['id_producto'];
$nombre=$_POST['nombre'];
$talla=$_POST['talla'];
$numero=$_POST['numero'];
$obser_POST['observacion'];
$idD=$_POST['id_detalles'];


$sql="UPDATE productos SET  id_producto='$id_product', nombre='$nombre', talla='$talla', numero='$numero', observacion='$obser', id_detalles='$idD' WHERE id_producto='$id_product'";

$query=mysqli_query($con,$sql);

    if($query){
        header("Location:../pages/productos_page.php");
    }
?>