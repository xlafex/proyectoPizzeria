<?php

    $serverName = "localhost";
    $connectionInfo = array("Database"=>"TECNOLOGICO","UID"=>"admin1","PWD"=>"test123","CharacterSet"=>"UTF-8");

    $con = sqlsrv_connect($serverName, $connectionInfo);

    if($con){
        echo "conexion exitosa";

    }else{
        echo "fallo en conexion";
    }


?>