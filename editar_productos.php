<?php
        if(isset($_GET['editar'])){
            $editar_id = $_GET['editar'];

            $consulta = "SELECT * from CLIENTES where Id_Cliente='$editar_id'";

            $ejecutar = sqlsrv_query($conn, $consulta);

            $fila = sqlsrv_fetch_array($ejecutar);

            $Nombre = $fila['Nombre'];
            $Apellido = $fila['Apellido'];
            $Direccion = $fila['Direccion'];
            $Telefono = $fila['Telefono'];

        }
?>

<br />

<div class="col-md-8 col-md-offset-2">
        <form method="POST" action="">
            <div class="form-group">
                <label for="">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo $Nombre; ?>"><br />
            </div>
            <div class="form-group">
                <label for="">Apellido:</label>
                <input type="text" name="apellido" class="form-control" value="<?php echo $Apellido; ?>"><br />
            </div>
            <div class="form-group">
                <label for="">Direccion:</label>
                <input type="text" name="direccion" class="form-control" value="<?php echo $Direccion; ?>"><br />
            </div>
            <div class="form-group">
                <label for="">Telefono:</label>
                <input type="text" name="telefono" class="form-control" value="<?php echo $Telefono; ?>"><br />
            </div>
            <div class="form-group">
                <input type="submit" name="actualizar" class="btn btn-warning" value="Actualizar Datos."><br />
            </div>
        </form>

</div>

<?php
    if(isset($_POST['actualizar'])){
        $actualizar_nombre = $_POST['nombre'];
        $actualizar_apellido = $_POST['apellido'];
        $actualizar_direccion = $_POST['direccion'];
        $actualizar_telefono = $_POST['telefono'];
        

        $consulta = "UPDATE CLIENTES SET Nombre='$actualizar_nombre', Apellido='$actualizar_apellido' , Direccion='$actualizar_direccion', Telefono='$actualizar_telefono' where Id_Cliente='$editar_id'";

        $ejecutar = sqlsrv_query($conn, $consulta);

        if($ejecutar){
            echo "<script>alert('Datos actualizados.')</script>";
            echo "<script>window.open('clientes.php','_self')</script>";
        }

    }


?>





<!-- CODIGO -->

<?php
                $consulta = "SELECT * FROM IMAGENES ORDER BY Id_Imagen DESC";
                
                
                $ejecutar = sqlsrv_query($conn, $consulta);
                
                $i = 0;
                
                while($fila = sqlsrv_fetch_array($ejecutar)){
                    $id = $fila['Id_Imagen'];
                    $NombreImg = $fila['Nombre'];
                    $Ruta = $fila['Ruta'];
                    
                    $i++;

?>

<?php } ?>

<tr align="center">
                <td><?php echo $id?></td>
                <td><?php echo $fila['Nombre']?></td>
                <td><img src="imagenes/<?php echo $fila['ruta_img']; ?>" width = 200 title="<?php echo $NombreImg; ?>"> </td>
                <td><?php echo $Ruta?></td>
                <td><a href="imagenes.php?editar=<?php echo $id;?>">Editar</a></td>
                <td><a href="imagenes.php?borrar=<?php echo $id;?>">Borrar</a></td>
            </tr>