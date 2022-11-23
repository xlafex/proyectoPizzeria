<!DOCTYPE html>
<script src="test.js"></script>
<?php
    include("conexion.php");
    
?>

    <?php
        $name = $_GET['nombre'];

        if(isset($_POST['insert_img'])){


            $nombre_imagen = $_POST['nombre_img'];
            
            $route = $_POST['ruta_img'];

            
            //change (id_cliente), it needs to be auto incremental in the DB so we can delete the parameter
            // and make it increment automatically.
            $insertar = "INSERT INTO dbo.IMAGENES(Nombre,Ruta)VALUES('$nombre_imagen', '$route')";
            
            $ejecutar = sqlsrv_query($conn, $insertar);

            if($ejecutar){
                echo "<h3>Insertado correctamente</h3>";
            }

        }

    ?>


            <?php
            $i = 1;
            $rows = sqlsrv_query($conn, "SELECT * FROM IMAGENES ORDER BY Id_Imagen DESC")
            ?>
    
            
            <?php
                $consulta = "SELECT * FROM IMAGENES ORDER BY Id_Imagen DESC";
                
                
                $ejecutar = sqlsrv_query($conn, $consulta);
                
                $i = 0;
                
                while($fila = sqlsrv_fetch_array($ejecutar)){
                    $id = $fila['Id_Imagen'];
                    $NombreImg = $fila['Nombre'];
                    $Ruta = $fila['Ruta'];
                    
                    $i++;

                 } ?>
            

    
    <?php
        if(isset($_GET['editar'])){
            include("editar_imagenes.php");
        }

    ?>

<?php
        if(isset($_GET['borrar'])){
            $borrar_id = $_GET['borrar'];

            $borrar = "DELETE from IMAGENES where Id_Imagen='$borrar_id'";

            $ejecutar = sqlsrv_query($conn, $borrar);

            if($ejecutar){
                echo "<script>alert('Imagen eliminada.')</script>";
                echo "<script>window.open('imagenes.php','_self')</script>";
            }
    
        }
?>   

</body>
</html>






