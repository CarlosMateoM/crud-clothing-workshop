<?php

include("../conexion.php");
$con=conectar();

$id_client=$_POST['id_factura'];
$nombre=$_POST['nombre'];
$fecha=$_POST['fecha'];

$sql = "UPDATE `factura` SET `id_factura`='$id_client',`fecha`='$fecha' WHERE id_factura =".$id_client;

$query=mysqli_query($con,$sql);

    if($query){
    Header("Location: ../pages/facturas_page.php");
        
    }
?>