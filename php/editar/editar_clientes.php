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
                <label style="font-size:18px;font-family: 'Rubik', sans-serif;" for="">Nombre:</label>
                <input style="font-size:16px;font-family: 'Rubik', sans-serif;" type="text" name="nombre" class="form-control" value="<?php echo $Nombre; ?>"><br />
            </div>
            <div class="form-group">
                <label style="font-size:18px;font-family: 'Rubik', sans-serif;" for="">Apellido:</label>
                <input style="font-size:16px;font-family: 'Rubik', sans-serif;" type="text" name="apellido" class="form-control" value="<?php echo $Apellido; ?>"><br />
            </div>
            <div class="form-group">
                <label style="font-size:18px;font-family: 'Rubik', sans-serif;" for="">Direccion:</label>
                <input style="font-size:16px;font-family: 'Rubik', sans-serif;" type="text" name="direccion" class="form-control" value="<?php echo $Direccion; ?>"><br />
            </div>
            <div class="form-group">
                <label style="font-size:18px;font-family: 'Rubik', sans-serif;" for="">Telefono:</label>
                <input style="font-size:16px;font-family: 'Rubik', sans-serif;" type="text" name="telefono" class="form-control" value="<?php echo $Telefono; ?>"><br />
            </div>
            <div class="form-group">
                <input style="font-size:18px;font-family: 'Rubik', sans-serif;" type="submit" name="actualizar_cliente" class="btn btn-warning" value="Actualizar Datos."><br />
            </div>
        </form>

</div>

<?php
    if(isset($_POST['actualizar_cliente'])){
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