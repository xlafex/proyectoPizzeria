<!DOCTYPE html>
<?php
    include("conexion.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Productos</title>
    <link rel="stylesheet" href="../librerias/bootstrap/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <header>
    <nav class="menu">
    <nav class="navbar">
    <div class="container">
                
                <img src="../imagenes/logo2.png" alt="" width="150" height="75">
                <ul class="nav">
            <li class="nav-item">
                <a style="color:black;" class="nav-link active" aria-current="page" href="clientes.php">Clientes</a>
            </li>
            <li class="nav-item">
                <a style="color:black;" class="nav-link" href="categorias.php">Categorias</a>
            </li>
            <li class="nav-item">
                <a style="color:black;" class="nav-link" href="historialProductos.php">Historial Productos</a>
            </li>
            <li class="nav-item">
                <a style="color:black;" class="nav-link" href="productos.php">Producto</a>
            </li>
            <li class="nav-item">
                <a style="color:black;" class="nav-link" href="index.php">Ventas</a>
            </li>
            </ul>
            </div>
            </nav>
    </nav>
    </header>
    <div class="col-md-8 col-md-offset-2">
    <label style="font-size:50px;font-family: 'Rubik', sans-serif;" for="">Historial de Productos</label>
    </div>
<br /><br/> <br/>

    <div class="col-md-8 col-md-offset-2">
    <text align="center">
    <table style="font-size:18px;font-family: 'Rubik', sans-serif;" class="table table-bordered table-responsive">
        <thead>
            <tr>
            <th scope="col">ID_Historial</th>
            <th scope="col">Id_Producto</th>
            <th scope="col">Acción</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Acción</th>
            </tr>
            
        </thead>
    </text>

        <!-- <table class="table table-bordered table-responsive">
            <tr>
                <td>ID_Historial</td>
                <td>Id_Producto</td>
                <td>Acción</td>
                <td>Fecha</td>
                <td>Hora</td>
                <td></td>
            </tr> -->

            <?php
                $consulta = "SELECT * from HISTORIAL_PRODUCTOS";

                $ejecutar = sqlsrv_query($conn, $consulta);

                $i = 0;

                while($fila = sqlsrv_fetch_array($ejecutar)){
                    $idHistorial = $fila['Id_Historial'];
                    $idProducto = $fila['Id_Producto'];
                    $Accion = $fila['Accion'];
                    $fechaMod = $fila['Fecha'];
                    $horaMod = $fila['Hora'];
                    

                    $DateMod = $fechaMod->format('Y-m-d');
                    $HourMod = $horaMod->format('h:i:s a');
                    
                    $i++;
            ?>
            <tbody style="font-size:16px;font-family: 'Rubik', sans-serif;">
            <tr align="center">
            <th scope="row"><?php echo $idHistorial?></th>
            <td><?php echo $idProducto?></td>
            <td><?php echo $Accion?></td>
            <td><?php echo $DateMod?></td>
            <td><?php echo $HourMod?></td>
            <td><a href="historialProductos.php?borrar=<?php echo $idHistorial;?>">Borrar</a></td>
           
            </tr>

            <!-- <tr align="center">
                <td><?php echo $idHistorial?></td>
                <td><?php echo $idProducto?></td>
                <td><?php echo $Accion?></td>
                <td><?php echo $DateMod?></td>
                <td><?php echo $HourMod?></td>
                <td><a href="historialProductos.php?borrar=<?php echo $idHistorial;?>">Borrar</a></td>
            </tr> -->

            <?php } ?>

        </table>
    </div>
    
<?php
        if(isset($_GET['borrar'])){
            $borrar_id = $_GET['borrar'];

            $borrar = "DELETE from HISTORIAL_MODIFICACION where Id_Historial='$borrar_id'";

            $ejecutar = sqlsrv_query($conn, $borrar);

            if($ejecutar){
                echo "<script>alert('Registro eliminado.')</script>";
                echo "<script>window.open('historialModificaciones.php','_self')</script>";
            }
    
        }
?>   

</body>
</html>






