<!DOCTYPE html>
<?php
    include("conexion.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.css">
</head>
<body>
    <div class="col-md-8 col-md-offset-2">
        <h1>CRUD</h1>

        <form method="POST" action="index.php">
            <div class="form-group">
                <label for="">Nombre:</label>
                <input type="text" name="nombre" class="form-control" placeholder="Escriba su nombre"><br />
            </div>
            <div class="form-group">
                <label for="">Apellido:</label>
                <input type="text" name="apellido" class="form-control" placeholder="Escriba su apellido"><br />
            </div>
            <div class="form-group">
                <label for="">Direccion:</label>
                <input type="text" name="direccion" class="form-control" placeholder="Escriba su direccion"><br />
            </div>
            <div class="form-group">
                <label for="">Telefono:</label>
                <input type="text" name="telefono" class="form-control" placeholder="Escriba su telefono"><br />
            </div>
            <div class="form-group">
                <input type="submit" name="insert" class="btn btn-warning" value="Insertar cliente."><br />
            </div>
        </form>

    </div>
<br /><br/> <br/>

    <?php

        if(isset($_POST['insert'])){
            $nombr = $_POST['nombre'];
            $apell = $_POST['apellido'];
            $direcc = $_POST['direccion'];
            $telef = $_POST['telefono'];

            $insertar = "INSERT INTO dbo.CLIENTES(Nombre,Apellido,Direccion,Telefono)VALUES('$nombr', '$apell' , '$direcc' , '$telef')";
            
            $ejecutar = sqlsrv_query($conn, $insertar);

            if($ejecutar){
                echo "<h3>Insertado correctamente</h3>";
            }

        }

    ?>

</body>
</html>






