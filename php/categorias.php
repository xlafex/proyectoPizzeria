<!DOCTYPE html>
<?php
    include("conexion.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../librerias/bootstrap/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                <a style="color:black; " class="nav-link active" aria-current="page" href="clientes.php">Clientes</a>
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
    <label style="font-size:50px;font-family: 'Rubik', sans-serif;" for="">Categorias</label>

        <form method="POST" action="categorias.php">
            
            <div class="form-group">
                <label style="font-size:18px;font-family: 'Rubik', sans-serif;" for="">Nombre categoria:</label>
                
                <input style="font-size:16px;font-family: 'Rubik', sans-serif;" type="text" name="nombre_cat" class="form-control" placeholder="Escriba el nombre de categoria"><br />
                
            </div>
            <div class="form-group">
                <label style="font-size:18px;font-family: 'Rubik', sans-serif;" for="">Activa:</label>
                
                <select style="font-size:16px;font-family: 'Rubik', sans-serif;" name="activa" id="active" class="form-control">
                    <option value="Y">Si</option>
                    <option value="N">No</option>
                </select>
                
            </div>
            
            <br>
            <div class="form-group">
                <input style="font-size:18px;font-family: 'Rubik', sans-serif;" type="submit" name="insert" class="btn btn-warning" value="Insertar categoria."><br />
            </div>
        </form>

    </div>
<br /><br/> <br/>

    <?php

        if(isset($_POST['insert'])){
            $nombre_categ = $_POST['nombre_cat'];
            $activ = $_POST['activa'];

            //change (id_cliente), it needs to be auto incremental in the DB so we can delete the parameter
            // and make it increment automatically.
            $insertar = "INSERT INTO dbo.CATEGORIAS(Nombre_Categoria,Activa)VALUES('$nombre_categ', '$activ')";
            
            $ejecutar = sqlsrv_query($conn, $insertar);

            if($ejecutar){
                echo "<h3>Insertado correctamente</h3>";
            }

        }

    ?>
    <div class="col-md-8 col-md-offset-2">
        <text align="center">
    <table style="font-size:18px;font-family: 'Rubik', sans-serif;" class="table table-bordered table-responsive">
        <thead>
            <tr>
            <th scope="col">Id_Categoria</th>
            <th scope="col">Nombre de Categoria</th>
            <th scope="col">Activa</th>
            <th scope="col">Acción</th>
            <th scope="col">Acción</th>
            </tr>
            
        </thead>
    </text>
        <!-- <table class="table table-bordered table-responsive">
            <tr>
                <td>Id_Categoria</td>
                <td>Nombre de Categoria</td>
                <td>Activa</td>
                <td>Acción</td>
                <td>Acción</td>
            </tr> -->

            <?php
                $consulta = "SELECT * from CATEGORIAS";

                $ejecutar = sqlsrv_query($conn, $consulta);

                $i = 0;

                while($fila = sqlsrv_fetch_array($ejecutar)){
                    $id = $fila['Id_Categoria'];
                    $NombreCat = $fila['Nombre_Categoria'];
                    $Activ = $fila['Activa'];
                    
                    $i++;
                

            ?>


            
            
            
            <tbody style="font-size:16px;font-family: 'Rubik', sans-serif;">
            <tr align="center">
            <th scope="row"><?php echo $id?></th>
            <td><?php echo $NombreCat?></td>
            <td><?php echo $Activ?></td>
            <td><a href="categorias.php?editar=<?php echo $id;?>">Editar</a></td>
            <td><a href="categorias.php?borrar=<?php echo $id;?>">Borrar</a></td>
            </tr>


            <!-- <tr align="center">
                <td><?php echo $id?></td>
                <td><?php echo $NombreCat?></td>
                <td><?php echo $Activ?></td>
                <td><a href="categorias.php?editar=<?php echo $id;?>">Editar</a></td>
                <td><a href="categorias.php?borrar=<?php echo $id;?>">Borrar</a></td>
            </tr> -->

            <?php } ?>

        </table>
    </div>
    
    <?php
        if(isset($_GET['editar'])){
            include("editar/editar_categorias.php");
        }

    ?>

<?php
        if(isset($_GET['borrar'])){
            $borrar_id = $_GET['borrar'];

            $borrar = "DELETE from CATEGORIAS where Id_Categoria='$borrar_id'";

            $ejecutar = sqlsrv_query($conn, $borrar);

            if($ejecutar){
                echo "<script>alert('Categoria eliminada.')</script>";
                echo "<script>window.open('categorias.php','_self')</script>";
            }
    
        }
?>   

</body>
</html>






