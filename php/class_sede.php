<?php
    //Declaracion de la clase
    class Sede{
        //Declaracion de los atributos
        var $sedeID;
        var $nombre;
        var $ubicacion;
        var $telefono;
        var $maximoAlumnos;
        var $instructora;
        var $avisos;
        //Geters
        function getNombre(){ return $this->nombre;}
        function getAvisos(){ return $this->avisos;}
        function getUbicacion(){ return $this->ubicacion;}
        //Declaracion de los metodos especiales
        function fetchSedeInfoFromDb($sedeID){
            //Declaracion de variables
            global $conexionMySQL;
            $query='SELECT * FROM sede S WHERE S.sedeID="'.$sedeID.'"';
            //Hacer query y ver si tenemos resultados
            if($result=$conexionMySQL->query($query)){
                if($result->num_rows==1){
                    //llenamos la informacion en nuestro objeto
                    $row=$result->fetch_assoc();
                    $this->sedeID=$row["sedeID"];
                    $this->nombre=$row["nombre"];
                    $this->ubicacion=$row["ubicacion"];
                    $this->telefono=$row["telefono"];
                    $this->maximoAlumnos=$row["maximoAlumnos"];
                    //Creamos el objeto de tipo Usuario para tambien constuirlo
                    $newInstructora = new Usuario(null,null,null,null,null,null,null,null,null,null);
                    $newInstructora->fetchUserInfoFromDB($row["instructora"]);
                    $this->instructora=$newInstructora;
                    //Conseguimos los avisos de la sede
                    $this->avisos= Avisos::getAvisosForSede($this->sedeID);
                }
                return false;
            }else{
                return false;
            }
        }
        function addAviso($newAviso){
            //Declaracion de variables
            global $conexionMySQL;
            //preparamos query para inserta
            $query='INSERT INTO avisos(sedeID, titulo, aviso) VALUES ("'.$this->sedeID.'","'.$newAviso->getTitulo().'","'.$newAviso->getAviso().'") ';
            //Hacemos query
            if($result=$conexionMySQL->query($query)){
                return true;
            }else{
                return false;
            }
        }
    }
?>