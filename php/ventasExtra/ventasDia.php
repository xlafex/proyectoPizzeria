<!DOCTYPE html>
<?php
    include("../conexion.php");
    $diaHoy = date("Y/m/d");
    $totalHoy = 0;
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
                <p><a href="../historialProductos.php">Historial Productos</a></p>
                <p><a href="../productos.php">Producto</a></p>
                <p><a href="../index.php">Ventas</a></p>
            </div>
        </nav>
    </header>
    <div class="col-md-8 col-md-offset-2">
        <h1>Ventas del Dia</h1>
        <p><a href="../index.php">Regresar.</a></p>
    </div>
<br /><br/> <br/>
    <div class="form-group">
        <input type="submit" name="verVentasDia" class="btn btn-warning" value="Ver Ventas Del Dia."><br />
     </div>
    <div class="col-md-8 col-md-offset-2">
        <table class="table table-bordered table-responsive">
            <tr>
                <td>Dia</td>
                <td>Total</td>

            </tr>

            <?php
            if(isset($_POST['verVentasDia'])){
                // $diaHoy = date("Y/m/d");

                $totalHoy = 0;

                $params = array(   
                    array($diaHoy, SQLSRV_PARAM_INOUT)                
                );

                //$sql_callSP = "EXEC GananciasDelDia2 @Fecha = ? ";
                //$ejecutar = sqlsrv_prepare($conn, $sql_callSP, $params);

                $sql = "EXEC GananciasDelDia2 @Fecha = ? ";
                $stmt = sqlsrv_prepare($conn, $sql, $params);
                if (!sqlsrv_execute($stmt)) {
                    echo "Your code is fail!";
                    die;
                }
                while($row = sqlsrv_fetch_array($stmt)){
                    $totalHoy = $row['GananciaDelDia'];
                }
                
                /* if($result!=true){
                    echo "<script>alert('query ejecutado.')</script>";
                    //$totalToday = sqlsrv_next_result($ejecutar);
                } */


                /* while($fila = sqlsrv_fetch_array($ejecutar)){
                    $idVenta = $fila['Id_Venta'];
                    $idCliente = $fila['Id_Cliente'];
                    $PrecioTotal = $fila['Precio_Total'];
                    $FechaVentaDateTime = $fila['Fecha_Venta'];
                    
                    $fechaVenta = $FechaVentaDateTime->format('Y-m-d');
                    
                    $consultaClient = "SELECT * from CLIENTES where Id_Cliente = $idCliente";
                    $ejecutarClient = sqlsrv_query($conn, $consultaClient);
                    $filaClient = sqlsrv_fetch_array($ejecutarClient);
                    
                    $i++; */
                    
            ?>
            <?php }/* } */ ?>

            <tr align="center">
                <td><?php echo $diaHoy?></td>
                <td><?php echo $totalHoy?></td>

            </tr>


        </table>
    </div>
    
<?php
/* falta arreglar el boton y tambien falta ventas detalladas */
        if(isset($_POST['verVentasDia'])){
            $diaHoy = date("Y/m/d");
            //
            /* $params = array(&$diaHoy); */
                // EXEC the procedure, {call stp_Create_Item (@Item_ID = ?, @Item_Name = ?)} seems to fail with various errors in my experiments
            //$sql = "EXEC VentasDelDia @Fecha = ?";
            
            $sql_callSP = "{call VentasDelDia( ?)}";  
            
            $params = array(   
                array($diaHoy, SQLSRV_PARAM_IN)                
              );  
 

            $ejecutar = sqlsrv_query($conn, $sql_callSP, $params);
            $i = 0;


            while($fila = sqlsrv_fetch_array($ejecutar)){
                

                $i++;
            }   
            if($ejecutar){
                echo "<script>alert('Ventas del dia de Hoy:</script>"+ $ventasTotalesDiario +"<script>')</script>";
            }
        }

        ?>   
<?php

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






