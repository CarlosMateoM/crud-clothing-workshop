<?php 
    include("../conexion.php");
    $con=conectar();

$id_product=$_GET['id_producto'];

$sql="SELECT * FROM productos WHERE id_producto='$id_product'";

$query=mysqli_query($con,$sql);

$row=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <title>Actualizar</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        
    </head>
    <body>
                <div class="container mt-5">
                    <form action="update_product.php?$row[id_producto']&$row['nombre']&$row['talla']&$row['numero']&$row['observacion']&$row['id_detalles']"method="POST">
                                
                    <input type="number" class="form-control mb-3" name="id_producto" placeholder="ID Producto" value="<?php echo $row['id_producto'] ?>" required>
                                <input type="text" class="form-control mb-3" name="nombre" placeholder="Nombre" value="<?php echo $row['nombre']  ?>" required>
                                <input type="text" class="form-control mb-3" name="talla" placeholder="Talla" value="<?php echo $row['talla']  ?>" required>
                                <input type="number" class="form-control mb-3" name="numero" placeholder="Numero" value="<?php echo $row['numero'] ?>" required>
                                <input type="text" class="form-control mb-3" name="observacion" placeholder="observacion" value="<?php echo $row['observacion'] ?>" required>
                                <input type="number" class="form-control mb-3" name="id_detalles" placeholder="ID Detalles" value="<?php echo $row['id_detalles'] ?>" required>
                                
                            <input type="submit" class="btn btn-primary btn-block" value="Actualizar">
                    </form>
                    
                </div>
    </body>
</html>