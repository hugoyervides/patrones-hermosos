<?php
    //Incluir archivo de configuracion MySQL
    include("config.php");
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
        //Declaracion del constructor con parametros
        function __construct($username, $nombre, $apellido, $mail, $telefono, $password, $telefonoPadres, $direccion, $fechaNacimiento, $rango ) {
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
        //Metodos setters
        function setNombre($newName){ $this->nombre=$newName; }
        function setApellido($apellido){ $this->apellido=$apellido;}
        function setMail($mail){ $this->mail=$mail;}
        function setTelefono($telefono){ $this->telefono=$telefono;}
        function setDireccion($direccion){ $this->direccion=$direccion;}
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
                    $this->email=$row["email"];
                    $this->telefono=$row["telefono"];
                    $this->password=$row["password"];
                    $this->telefonoPadres=$row["telefonoPadres"];
                    $this->direccon=$row["direccion"];
                    $this->fechaNacimiento=$row["fechaNacimiento"];
                    $this->rango=$row["rango"];
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
    }
?>
