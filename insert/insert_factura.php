<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>


    <?php
    include("../conexion.php");
    $con = conectar();



    $fecha = $_POST['fec'];
    $id_cliente = $_POST['idc'];

    if (empty($id_cliente)) {
        echo '<div class="container">
      <div class="row">
     <div class="col-md-3  col-sm-6 col-xs-12">';
        echo '<div class="alert alert-danger" role="alert"> ID de cliente VACIO </div>';
        echo '<th><input type="button" value="Página anterior" onClick="history.go(-1);"></th>';
        echo '</div>
</div>
</div>';
    } else {
       
       try{
        $sql = "INSERT INTO factura (fecha, id_cliente) VALUES ('$fecha','$id_cliente')";
        $query = mysqli_query($con, $sql);
       }catch (Exception $e){

        echo '<div class="container">
        <div class="row">
       <div class="col-md-3  col-sm-6 col-xs-12">';
          echo '<div class="alert alert-danger" role="alert"> Error: El "ID Cliente" no se encuentra registrado </div>';
          echo '<th><input type="button" value="Página anterior" onClick="history.go(-1);"></th>';
          echo '</div>
  </div>
  </div>';

       }
       
    }

    ?>
</body>

</html>