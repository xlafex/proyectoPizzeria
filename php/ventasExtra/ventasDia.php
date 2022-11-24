<!DOCTYPE html>
<?php
    include("../conexion.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="../../librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body>
    <header>
        <nav class="menu">
            <div class="logo" id="logo">
                <h1 id="Pitzeria">Pitzeria</h1>
            </div>
            <div class="menudata">
                <p><a href="../clientes.php">Clientes</a></p>
                <p><a href="../categorias.php">Categorias</a></p>
                <p><a href="../imagenes.php">Imagenes</a></p>
                <p><a href="../productos.php">Producto</a></p>
                <p><a href="">Empleados</a></p>
                <p><a href="../ventas.php">Ventas</a></p>
            </div>
        </nav>
    </header>
    <div class="col-md-8 col-md-offset-2">
        <h1>Ventas del Dia</h1>
        <p><a href="../ventas.php">Regresar.</a></p>
    </div>
<br /><br/> <br/>
    <div class="form-group">
        <input type="submit" name="verVentasDia" class="btn btn-warning" value="Ver Ventas Del Dia."><br />
     </div>
    <div class="col-md-8 col-md-offset-2">
        <table class="table table-bordered table-responsive">
            <tr>
                <td>ID_Venta</td>
                <td>Cliente</td>
                <td>Venta Total</td>
                <td>Fecha de Venta</td>
                <td>Acción</td>
            </tr>

            <?php
                $diaHoy = date("Y/m/d");
                
                $consulta = "SELECT * from VENTAS";

                $ejecutar = sqlsrv_query($conn, $consulta);

                $i = 0;

                while($fila = sqlsrv_fetch_array($ejecutar)){
                    $idVenta = $fila['Id_Venta'];
                    $idCliente = $fila['Id_Cliente'];
                    $PrecioTotal = $fila['Precio_Total'];
                    $FechaVentaDateTime = $fila['Fecha_Venta'];

                    $fechaVenta = $FechaVentaDateTime->format('Y-m-d');
                    
                    $consultaClient = "SELECT * from CLIENTES where Id_Cliente = $idCliente";
                    $ejecutarClient = sqlsrv_query($conn, $consultaClient);
                    $filaClient = sqlsrv_fetch_array($ejecutarClient);

                    $i++;
            ?>

            <tr align="center">
                <td><?php echo $idVenta?></td>
                <td><?php echo $filaClient['Nombre']?><p> </p><?php echo $filaClient['Apellido']?></td>
                <td><?php echo $PrecioTotal?></td>
                <td><?php echo $fechaVenta?></td>
                <td><a href="historialVentas.php?borrar=<?php echo $idVenta;?>">Borrar</a></td>
            </tr>

            <?php } ?>

        </table>
    </div>
    
<?php
/* falta arreglar el boton y tambien falta ventas detalladas */
        if(isset($_POST['verVentasDia'])){
            $diaHoy = date("Y/m/d");
            
            $consulta = "Execute VentasDelDia @Fecha = '$diaHoy' ";

            $ejecutar = sqlsrv_query($conn, $consulta);

            $i = 0;

            $ventasTotalesDiario = 0;
            while($fila = sqlsrv_fetch_array($ejecutar)){
                
                $ventasTotalesDiario += $fila['Precio'];
                $i++;
            }   
            echo "<script>alert('Ventas del dia de Hoy:</script>"+ $ventasTotalesDiario +"<script>')</script>";
        }

        if(isset($_GET['borrar'])){
            $borrar_id = $_GET['borrar'];

            $borrar = "DELETE from VENTAS where Id_Venta='$borrar_id'";

            $ejecutar = sqlsrv_query($conn, $borrar);

            if($ejecutar){
                echo "<script>alert('Venta eliminada.')</script>";
                echo "<script>window.open('historialVentas.php','_self')</script>";
            }
    
        }
?>   

</body>
</html>






