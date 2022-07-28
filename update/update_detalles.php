<?php
include("../conexion.php");
$con = conectar();
$id_detalle = $_GET['id_detalle'];
$sql = "SELECT * FROM detalles_factura WHERE id_detalles ='$id_detalle'";

$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
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
        <form action="update_detalles_query.php" method="POST">
            <input id="id_fact" style="display: none;" class="form-control mb-3" name="id_factura" value="<?php echo $_GET['id_factura'] ?>">
            <input id="id_fact" style="display: none;" class="form-control mb-3" name="nombre" value="<?php echo $_GET['nombre'] ?>">
            <input id="id_fact" style="display: none;" class="form-control mb-3" name="fecha" value="<?php echo $_GET['fecha'] ?>">
            <input id="id_fact" style="display: none;" class="form-control mb-3" name="id_detalle" value="<?php echo $row['id_detalles'] ?>">
            <input type="number" class="form-control mb-3" name="cantidad" placeholder="Cantidad" value="<?php echo $row['cantidad']  ?>">
            <input type="number" class="form-control mb-3" name="valor_unitario" placeholder="Valor Unitario" value="<?php echo $row['valor_unicario']  ?>">
            <textarea class="form-control mb-3" name="descripcion" placeholder="Descripcion" cols="32" rows="10" maxlength="200"><?php echo $row['descripsion']  ?></textarea>

            <input type="submit" class="btn btn-primary btn-block" value="Actualizar">
        </form>

    </div>
</body>

</html>