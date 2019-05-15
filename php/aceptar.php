<?php
    //INlcuir el archivo de configuracion
    include("config.php");
    //obtener el valor POST
    if(isset($_GET["username"])){
        //Preparamos query
        $query='UPDATE usuario SET estado = "Aceptado" WHERE usuario.username = "'.$_GET["username"].'"';
        $result= $conexionMySQL->query($query);
    }
    header("Location: ../tutores.php");
    die();
?>