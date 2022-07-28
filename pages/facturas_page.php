<?php

include("../conexion.php");
include("../menu.html");

$con = conectar();
$id_factura = $_GET['id_factura'];

$sql = "SELECT f.id_factura,c.nombre,f.fecha FROM factura f JOIN cliente c on f.id_cliente=c.id_cliente";

$sql_productos; 

if(!empty($id_factura)){
    $sql_productos = "SELECT * FROM `detalles_factura` WHERE id_factura = ".$id_factura;
}else {
    $sql_productos = "SELECT * FROM `detalles_factura` WHERE id_factura = 0";
}

$query = mysqli_query($con, $sql);
$query_productos = mysqli_query($con, $sql_productos);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Facturas</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="C:\Users\minic\OneDrive\Documents\Xampp\htdocs\crud_dataset\fontawesome/css/all.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href=" https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cliente').DataTable({
                "lengthMenu": [
                    [5, 10, 50, -1],
                    [5, 10, 50, "All"]
                ]
            });
        });
    </script>
</head>
<script type="text/javascript">
    function cargarFactura(id, nombre, fecha) {
        let label = document.getElementById("info_factura");
        let fact = document.getElementById("id_fact");
        fact.setAttribute("value", id);
        label.innerHTML = "ID: " + id + " | Nombre: " + nombre + " | Fecha: " + fecha;

    }


    function confirmDelete() {

        var respuesta = confirm("Seguro que desea borrar?");
        if (respuesta == true) {
            alert("Registro Borrado");
            return true;
        } else {
            alert("Ha decidido no borrar el registro");
            return false;
        }
    }
</script>

<body>
    <div class="content">
        <div class="container mt-5">
            <div class="row">

                <div class="col-md-3">
                    <h1><span class="badge bg-warning">Nueva Factura</span></h1>
                    <form action="../insert/insert_factura.php" method="POST">

                        <input type="date" class="form-control mb-3" name="fec">
                        <input type="number" class="form-control mb-3" name="idc" placeholder="ID Cliente" required>
                        <input type="submit" class="btn btn-primary" value="Registrar">

                    </form>
                </div>

                <div class="col-md-8">
                    <table id="Factura" class="table table-dark table-striped table-bordered shadow-lg mt-4" style="width:100%">
                        <thead class="bg-warning">
                            <tr align="center">
                                <th color=green>ID Factura</th>
                                <th>Cliente</th>
                                <th>Fecha De Compra</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                                <th>Cargar</th>

                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <th><?php echo $row['id_factura'] ?></th>
                                    <th><?php echo $row['nombre'] ?></th>
                                    <th><?php echo $row['fecha'] ?></th>
                                    <th style="text-align:center"><a href="actualizar.php?id_factura=<?php echo $row['id_factura'] ?>"> <button type="button" class="btn btn-info">Editar</button></a></th>
                                    <th style="text-align:center"><a href="../delete/delete_factura.php?id_factura=<?php echo $row['id_factura'] ?>"> <button type="button" class="btn btn-danger" onclick="return confirmDelete()">Eliminar</button></a></th>
                                    <th style="text-align:center"><a href="facturas_page.php?id_factura=<?php echo $row['id_factura'] ?>"> <button type="button" class="btn btn-light" onclick="cargarFactura('<?php echo $row['id_factura'] ?>',' <?php echo $row['nombre'] ?>','<?php echo $row['fecha'] ?>')">Cargar</button></a></th>

                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- titulo de factura seleccionada  -->

            <div class="row">
                <h1><span id="info_factura" class="badge bg-info">Cargue una factura</span></h1>
            </div>

            <!-- formulario de productos  -->

            <div class="row">

                <div class="col-md-3">
                    <h1><span class="badge bg-warning">Nuevo Producto</span></h1>
                    <form action="../insert/insert_detalles.php" method="POST">

                        <input id="id_fact" style="visibility: visible;" class="form-control mb-3" name="id_factura" placeholder="">
                        <input type="number" class="form-control mb-3" name="id_producto" placeholder="ID Producto">
                        <input type="number" class="form-control mb-3" name="cantidad" placeholder="Cantidad">
                        <input type="number" class="form-control mb-3" name="valor_unitario" placeholder="Valor Unitario">
                        <textarea class="form-cotrol mb-3" name="descripcion" placeholder="Descripcion" cols="32" rows="10" maxlength="200"></textarea>

                        <input type="submit" class="btn btn-primary" value="Registrar">

                    </form>
                </div>

            <!--cargue de productos-->

                <div class="col-md-8">
                    <table id="Factura" class="table table-dark table-striped table-bordered shadow-lg mt-4" style="width:100%">
                        <thead class="bg-warning">
                            <tr align="center">
                                <th color=green>ID Producto</th>
                                <th>Cantidad</th>
                                <th>Valor Unitario</th>
                                <th>Descripcion</th>
                                <th>Subtotal</th>
                                <th>Editar</th>
                                <th>Eliminar</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($query_productos)) {
                            ?>
                                <tr>
                                    <th><?php echo $row['id_detalles'] ?></th>
                                    <th><?php echo $row['cantidad'] ?></th>
                                    <th><?php echo $row['valor_unicario'] ?></th>
                                    <th><?php echo $row['descripsion'] ?></th>
                                    <th><?php echo $row['subtotal'] ?></th>

                                    <th style="text-align:center"><a href="actualizar.php?id_factura=<?php echo $row['id_factura'] ?>"> <button type="button" class="btn btn-info">Editar</button></a></th>

                                    <th style="text-align:center"><a href="../delete/delete_factura.php?id_factura=<?php echo $row['id_factura'] ?>"> <button type="button" class="btn btn-danger" onclick="return confirmDelete()">Eliminar</button></a></th>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    </div>
</body>

</html>