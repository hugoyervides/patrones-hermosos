<?php    
    //Funcion para desplegar mensaje de error
    function desplegarMensajeError($mensaje){
        echo $mensaje;
		die();
    }
	//Stat MySQL
	$conexionMySQL =  new mysqli('127.0.0.1','amss','tTVCpYs4OtBNmVaE','amss');
	//Condition if there is an MySQL error
	if($conexionMySQL->connect_error){
		desplegarMensajeError( "Error conectando con base de datos MySQL " . $conexionMySQL->connect_errno);
    }
?>