<?php

    include("../conexion.php");
    include("../menu.html");

    $con = conectar();

    $sql = "SELECT f.id_factura,d.id_detalles,c.id_cliente,c.nombre,f.fecha FROM cliente c JOIN factura f  on f.id_cliente=c.id_cliente
    JOIN detalles_factura d on f.id_factura=d.id_factura";
    $query = mysqli_query($con, $sql);

    $sql1 = "SELECT p.id_producto,d.id_detalles,c.id_cliente,p.nombre,p.talla,p.numero,p.observacion  
    FROM productos p JOIN detalles_factura d on p.id_detalles=d.id_detalles 
    JOIN factura f on f.id_factura=d.id_factura 
    JOIN cliente c on c.id_cliente=f.id_cliente ORDER BY c.id_cliente ASC";
    $query1 = mysqli_query($con, $sql1);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Facturas</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CRUD_DATASET/fontawesome/css/all.css">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
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
                <div class="col">
                    <table id="Factura" class="table table-dark table-striped table-bordered shadow-lg mt-4" style="width:100%">
                        <thead class="bg-warning">
                            <tr align="center">
                                <th color=green>ID Factura</th>
                                <th>ID Detalles</th>
                                <th>ID Cliente</th>
                                <th>Cliente</th>
                                <th>Fecha De Compra</th>
    

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <th><?php echo $row['id_factura'] ?></th>
                                    <th><?php echo $row['id_detalles'] ?></th>
                                    <th><?php echo $row['id_cliente'] ?></th>
                                    <th><?php echo $row['nombre'] ?></th>
                                    <th><?php echo $row['fecha'] ?></th>
                                  

                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- titulo de factura seleccionada  -->

            <!--div class="row">
                
                <h3><span class="badge bg-success">ID Factura Seleccionada: 1 // Cliente: Flacao // Fecha: 2022-07-07 </span></h3>
            </div-->



            <!-- formulario de productos  -->

            <div class="row">

                <div class="col-md-3">
                    <h2><span class="badge bg-warning">Nueva prenda</span></h2>
                    <form action="../insert/insertar_producto.php" method="POST">

                        <!--input type="number" class="form-control mb-3" name="idP" placeholder="ID Producto" required-->
                        <input type="number" class="form-control mb-3" name="idD" placeholder="ID Detalles" required>
                        <input type="text" class="form-control mb-3" name="nom" placeholder="Nombre del producto" required>
                        <input type="text" class="form-control mb-3" name="tal" placeholder="talla" maxlength="200" required>
                        <input type="number" class="form-control mb-3" name="num" placeholder="Numero (Opcionel)">
                        <textarea  class="form-cotrol mb-3" name="obs" placeholder="Observacion" cols="32" rows="10" maxlength="200"></textarea>

                        <input type="submit" class="btn btn-primary" value="Registrar">

                    </form>
                </div>

                <div class="col-md-8">
                    <table id="Factura" class="table table-dark table-striped table-bordered shadow-lg mt-4" style="width:100%">
                        <thead class="bg-warning">
                            <tr align="center">
                                <th color=green>ID Producto</th>
                                <th>ID Detalles</th>
                                <th>ID cliente</th>
                                <th>Nombre</th>
                                <th>Talla</th>
                                <th>Numero</th>
                                <th>Observacion</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($query1)) {
                            ?>
                                <tr>
                                    <th><?php echo $row['id_producto'] ?></th>
                                    <th><?php echo $row['id_detalles'] ?></th>
                                    <th><?php echo $row['id_cliente'] ?></th>
                                    <th><?php echo $row['nombre'] ?></th>
                                    <th><?php echo $row['talla'] ?></th>
                                    <th><?php echo $row['numero'] ?></th>
                                    <th><?php echo $row['observacion'] ?></th>
                                    <th style="text-align:center"><a href="../update/update_producto.php?id_producto=<?php echo $row['id_producto'] ?>"> <button type="button" class="btn btn-info"><i class="fa-solid fa-pencil"></i></button></a></th>
                                    <th style="text-align:center"><a href="../delete/delete_producto.php?id_producto=<?php echo $row['id_producto'] ?>"> <button type="button" class="btn btn-danger" onclick="return confirmDelete()"><i class="fa-solid fa-trash-can"></i></button></a></th>
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