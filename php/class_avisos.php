<?php 
    //Declaracion de la clase
    class Avisos{
        //Declaracion de atributos
        var $titulo;
        var $aviso;
        //Declaracion del constructor default
        function __construct($titulo, $aviso){
            $this->titulo=$titulo;
            $this->aviso=$titulo;
        }
        //Declaracion de los geters
        function getTitulo(){ return $this->titulo;}
        function getAviso(){ return $this->aviso; }
        //Declaracion de los setters
        function setTitulo(){ return $this->titulo;}
        function setAviso(){ return $this->aviso;}
        //Declaracion de metodos especiales
        function getAvisosForSede($sedeID){
            //Declaracion de variables
            $returnArray=array();
            global $conexionMySQL;
            //preparamos query
            $query='SELECT A.titulo, A.aviso 
            FROM avisos A JOIN sede S 
            ON A.sedeID=S.sedeID
            WHERE A.sedeID="'.$sedeID.'"';
            //hacemos query
            if($result=$conexionMySQL->query($query)){
                //iteramos por los resultados
                while($row=$result->fetch_assoc()){
                    //Creamos un nuevo objeto de tipo aviso
                    $newAviso = new Avisos($row["titulo"],$row["aviso"]);
                    //metemos el nuevo aviso a nuestroa arreglo
                    array_push($returnArray,$newAviso);
                }
            }
            //Regresamos y liberamos el resultado
            return $returnArray;
        }
    }
?>
