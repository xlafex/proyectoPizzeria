<!DOCTYPE html>
<?php
    include("conexion.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="../librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <header>
        <nav class="menu">
            <div class="logo" id="logo">
                <h1 id="Pitzeria">Pitzeria</h1>
            </div>
            <div class="menudata">
                <p><a href="clientes.php">Clientes</a></p>
                <p><a href="categorias.php">Categorias</a></p>
                <p><a href="historialProductos.php">Historial Productos</a></p>
                <p><a href="productos.php">Producto</a></p>
                <p class="btn btn-warning"><a href="index.php">Ventas</a></p>
            </div>
        </nav>
    </header>
    <div class="col-md-8 col-md-offset-2">
        <h1>Historial de Productos</h1>
    </div>
<br /><br/> <br/>

    <div class="col-md-8 col-md-offset-2">
        <table class="table table-bordered table-responsive">
            <tr>
                <td>ID_Historial</td>
                <td>Id_Producto</td>
                <td>Acción</td>
                <td>Fecha</td>
                <td>Hora</td>
                <td></td>
            </tr>

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

            <tr align="center">
                <td><?php echo $idHistorial?></td>
                <td><?php echo $idProducto?></td>
                <td><?php echo $Accion?></td>
                <td><?php echo $DateMod?></td>
                <td><?php echo $HourMod?></td>
                <td><a href="historialProductos.php?borrar=<?php echo $idHistorial;?>">Borrar</a></td>
            </tr>

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






