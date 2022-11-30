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
    <div class="container">
                
                <img src="../../imagenes/logo2.png" alt="" width="150" height="75">
                <ul class="nav">
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
<form action="ventasDia.php" method="POST">
    <div class="form-group">
        <input type="submit" name="verVentasDia" class="btn btn-warning" value="Ver Ventas Del Dia."><br />
     </div>
    </form>
    <div class="col-md-8 col-md-offset-2">
        <table class="table table-bordered table-responsive">
            <tr>
                <td>Dia</td>
                <td>Total</td>

            </tr>

            <?php
            $totalHoy = 0;
            if(isset($_POST['verVentasDia'])){
                // $diaHoy = date("Y/m/d");

                

                $sql ="execute GananciasDelDia4";

                //$sql_callSP = "EXEC GananciasDelDia2 @Fecha = ? ";
                //$ejecutar = sqlsrv_prepare($conn, $sql_callSP, $params);
                $gananciaQuery = sqlsrv_query($conn,$sql);
                while($row = sqlsrv_fetch_array($gananciaQuery)){
                    $totalHoy = $row['GananciaDiaria'];
                }
                
            }  
            ?>
            <?php /* } */ ?>

            <tr align="center">
                <td><?php echo $diaHoy?></td>
                <td><?php echo $totalHoy?></td>

            </tr>


        </table>
    </div>
    
  
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






