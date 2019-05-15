<?php
    //INcluir clases a usar
    include("class_avisos.php");
    include("class_sede.php");
    //Declaracion de la clase
    class Usuario{
        //Declaracion de los atributos
        var $username;
        var $nombre;
        var $apellido;
        var $mail;
        var $telefono;
        var $password;
        var $telefonoPadres;
        var $direccion;
        var $fechaNacimiento;
        var $rango;
        var $sede;
        var $estado;
        //Declaracion del constructor con parametros
        function __construct($username, $nombre, $apellido, $mail, $telefono, $password, $telefonoPadres, $direccion, $fechaNacimiento, $rango) {
            //Asignacion a los atributos
            $this->username=$username;
            $this->nombre=$nombre;
            $this->apellido=$apellido;
            $this->mail=$mail;
            $this->telefono=$telefono;
            $this->password=$password;
            $this->telefonoPadres=$telefonoPadres;
            $this->direccion=$direccion;
            $this->fechaNacimiento=$fechaNacimiento;
            $this->rango=$rango;
        }
        //Metodos getters
        function getUserFullName(){ return $this->nombre." ".$this->apellido;}
        function getNombre(){ return $this->nombre;}
        function getApellido(){ return $this->apellido;}
        function getMail(){ return $this->mail;}
        function getTelefono(){ return $this->telefono;}
        function getTelefonoPadres(){ return $this->telefonoPadres;}
        function getDireccion(){ return $this->direccion;}
        function getRangoUsuario(){ return $this->rango;}
        function getSede(){ return $this->sede;}
        function getEstado(){ return $this->estado;}
        function getUsername(){ return $this->username;}
        //Metodos setters
        function setNombre($newName){ $this->nombre=$newName; }
        function setApellido($apellido){ $this->apellido=$apellido;}
        function setMail($mail){ $this->mail=$mail;}
        function setTelefono($telefono){ $this->telefono=$telefono;}
        function setDireccion($direccion){ $this->direccion=$direccion;}
        function setEstado($newEstado){ $this->estado=$newEstado;}
        //Funcion para obtener la informacion de la base de datos
        function fetchUserInfoFromDB($username){
            //Declaracion de variables
            global $conexionMySQL;
            //Preparar query
            $query="SELECT * FROM usuario WHERE username='".$username."'";
            //hacer query
            if($result=$conexionMySQL->query($query)){
                if($result->num_rows==1){
                    $row=$result->fetch_assoc();
                    //llenar la informacion que conseguimos de la base de datos en nuestro objeto
                    $this->username=$row["username"];
                    $this->nombre=$row["nombre"];
                    $this->apellido=$row["apellido"];
                    $this->mail=$row["email"];
                    $this->telefono=$row["telefono"];
                    $this->password=$row["password"];
                    $this->telefonoPadres=$row["telefonoPadres"];
                    $this->direccion=$row["direccion"];
                    $this->fechaNacimiento=$row["fechaNacimiento"];
                    $this->rango=$row["rango"];
                    $this->estado=$row["estado"];
                    //conseguirel objeto sede para ponerlo en la base de datos
                    $newSede = new Sede();
                    $newSede->fetchSedeInfoFromDb($row["sedeID"]);
                    $this->sede=$newSede;
                    return true;
                }
                else{
                    return false;
                }
            }else{
                return false;
            }
        }
        //Metodo para enviar la informacion del usuario a la base de datos
        function writeUserToDb(){
            //Declaracion de variables
            global $conexionMySQL;
            //Preparamos query
            $query='INSERT INTO usuario(username, nombre, apellido, email, telefono, password, telefonoPadres, direccion, fechaNacimiento, rango) VALUES ("'.$this->username.'","'.$this->nombre.'","'.$this->apellido.'","'.$this->mail.'","'.$this->telefono.'","'.$this->password.'","'.$this->telefonoPadres.'","'.$this->direccion.'","'.$this->fechaNacimiento.'","'.$this->rango.'")';
            //ejecutamos query
            if($result=$conexionMySQL->query($query)){
                return true;
            }
            else{
                return false;
            }
        }
        //Funcion para verificar contrasenia
        function verifyPassword($password){
            if($this->password==$password){
                return true;
            }
            return false;
        }
        //Metodo que actualiza los datos de usuario en la base de datos
        function updateUserDatatoDB(){
            //Declaracion de variables
            global $conexionMySQL;
            //preparamos query
            $query='UPDATE usuario SET nombre="'.$this->nombre.'",apellido="'.$this->apellido.'",email="'.$this->mail.'",telefono="'.$this->telefono.'",password="'.$this->password.'",telefonoPadres="'.$this->telefonoPadres.'",direccion="'.$this->direccion.'",fechaNacimiento="'.$this->fechaNacimiento.'",rango="'.$this->rango.'" WHERE username="'.$this->username.'"';
            //ejecutamos query
            if($result=$conexionMySQL->query($query)){
                return true;
            }
            else{
                return false;
            }
        }
        //Funcion para obtenr la sede que administra el usuario
        function getManagedSede(){
            //Declaracion de variables
            global $conexionMySQL;
            $query='SELECT S.sedeID FROM sede S JOIN usuario O ON S.instructora=O.username WHERE username="'. $this->username .'"';
            //ver si tenemos resultado
            if($result=$conexionMySQL->query($query)){
                $row=$result->fetch_assoc();
                return $row["sedeID"];
            }else{
                return null;
            }
        }
        //Funcion que arroja toda la lista de usuarios con el filtro de rango
        function getUsersFilteredByRango($filter){
            //Declaracion de variables
            global $conexionMySQL;
            $returnArray = array();
            //preparamos el query
            $query='SELECT username FROM usuario WHERE rango="'.$filter.'"';
            //hacemos query
            if($result=$conexionMySQL->query($query)){
                //navegar por los resultados
                while($row=$result->fetch_assoc()){
                    //metemos el resultado en nuestro arreglo
                    $newUsuario =  new Usuario(null,null,null,null,null,null,null,null,null,null);
                    $newUsuario->fetchUserInfoFromDB($row["username"]);
                    //metemos el nuevo usuario al arreglo de retorno
                    array_push($returnArray,$newUsuario);
                }
                //Regresamos el resultado
                return $returnArray;
            }else{
                return null;
            }
        }
    }
?>
