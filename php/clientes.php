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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
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
    <label style="font-size:50px;font-family: 'Rubik', sans-serif;" for="">Clientes</label>

        <form method="POST" action="clientes.php">
            <div class="form-group">
                <label style="font-size:18px;font-family: 'Rubik', sans-serif;" for="">Nombre:</label>
                <input style="font-size:16px;font-family: 'Rubik', sans-serif;" type="text" name="nombre" class="form-control" placeholder="Escriba su nombre"><br />
            </div>
            <div class="form-group">
                <label style="font-size:18px;font-family: 'Rubik', sans-serif;" for="">Apellido:</label>
                <input style="font-size:16px;font-family: 'Rubik', sans-serif;" type="text" name="apellido" class="form-control" placeholder="Escriba su apellido"><br />
            </div>
            <div class="form-group">
                <label style="font-size:18px;font-family: 'Rubik', sans-serif;" for="">Direccion:</label>
                <input style="font-size:16px;font-family: 'Rubik', sans-serif;" type="text" name="direccion" class="form-control" placeholder="Escriba su direccion"><br />
            </div>
            <div class="form-group">
                <label style="font-size:18px;font-family: 'Rubik', sans-serif;" for="">Telefono:</label>
                <input style="font-size:16px;font-family: 'Rubik', sans-serif;" type="text" name="telefono" class="form-control" placeholder="Escriba su telefono"><br />
            </div>
            <div class="form-group">
                <input style="font-size:18px;font-family: 'Rubik', sans-serif;" type="submit" name="insert" class="btn btn-warning" value="Insertar cliente."><br />
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
                echo "<script>alert('Cliente insertado.')</script>";
            }

        }

    ?>
    <div class="col-md-8 col-md-offset-2">

    <text align="center">
    <table style="font-size:18px;font-family: 'Rubik', sans-serif;" class="table table-bordered table-responsive">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Direccion</th>
            <th scope="col">Telefono</th>
            <th scope="col">Acción</th>
            <th scope="col">Acción</th>
            </tr>
            
        </thead>
    </text>

        <!-- <table class="table table-bordered table-responsive">
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Direccion</td>
                <td>Telefono</td>
                <td>Acción</td>
                <td>Acción</td>
            </tr> -->

            <?php
                $consulta = "SELECT * from CLIENTES";

                $ejecutar = sqlsrv_query($conn, $consulta);

                $i = 0;

                while($fila = sqlsrv_fetch_array($ejecutar)){
                    $id = $fila['Id_Cliente'];
                    $Nombre = $fila['Nombre'];
                    $Apellido = $fila['Apellido'];
                    $Direccion = $fila['Direccion'];
                    $Telefono = $fila['Telefono'];

                    $i++;
            ?>

            <tbody style="font-size:16px;font-family: 'Rubik', sans-serif;">
            <tr align="center">
            <th scope="row"><?php echo $id?></th>
            <td><?php echo $Nombre?></td>
            <td><?php echo $Apellido?></td>
            <td><?php echo $Direccion?></td>
            <td><?php echo $Telefono?></td>
            <td><a href="clientes.php?editar=<?php echo $id;?>">Editar</a></td>
            <td><a href="clientes.php?borrar=<?php echo $id;?>">Borrar</a></td>
            </tr>

            <!-- <tr align="center">
                <td><?php echo $id?></td>
                <td><?php echo $Nombre?></td>
                <td><?php echo $Apellido?></td>
                <td><?php echo $Direccion?></td>
                <td><?php echo $Telefono?></td>
                <td><a href="clientes.php?editar=<?php echo $id;?>">Editar</a></td>
                <td><a href="clientes.php?borrar=<?php echo $id;?>">Borrar</a></td>
            </tr> -->

            <?php } ?>

        </table>
    </div>
    
    <?php
        if(isset($_GET['editar'])){
            include("editar/editar_clientes.php");
        }

    ?>

<?php
        if(isset($_GET['borrar'])){
            $borrar_id = $_GET['borrar'];

            $borrar = "DELETE from CLIENTES where Id_Cliente='$borrar_id'";

            $ejecutar = sqlsrv_query($conn, $borrar);

            if($ejecutar){
                echo "<script>alert('Cliente eliminado.')</script>";
                echo "<script>window.open('clientes.php','_self')</script>";
            }
    
        }
?>   

</body>
</html>






