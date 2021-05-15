<?php
    require_once('sistema.controller.php');
    
    /*Clase principal para pacientes */
    class Paciente extends Sistema{
        var $id_paciente;
        var $nombre;
        var $apaterno;
        var $amaterno;
        var $nacimiento;
        var $domicilio;
        var $fotografía;

        function getId_Paciente(){
            return $this->id_paciente;
        }
        function setId_Paciente($id_paciente){
            $this->id_paciente = $id_paciente;
        }

        function getNombre(){
            return $this->nombre;
        }
        function setNombre($nombre){
            $this->nombre = $nombre;
        }

        function getApaterno(){
            return $this->apaterno;
        }
        function setApaterno($apaterno){
            $this->apaterno = $apaterno;
        }

        function getAmaterno(){
            return $this->amaterno;
        }
        function setAmaterno($amaterno){
            $this->amaterno = $amaterno;
        }

        function getNacimiento(){
            return $this->nacimiento;
        }
        function setNacimiento($nacimiento){
            $this->nacimiento = $nacimiento;
        }

        function getDomicilio(){
            return $this->domicilio;
        }
        function setDomicilio($domicilio){
            $this->domicilio = $domicilio;
        }

        function getFotografia(){
            return $this->fotografia;
        }
        function setFotografia($fotografia){
            $this->fotografia = $fotografia;
        }

        /*
        Método para crear un paciente
        params  String @nombre nombre del paciente
                String @apaterno apellido paterno del paciente
                String @amaterno apellido materno del paciente
                Date   @nacimiento fecha de nacimiento del paciente
                String @domicilio domicilio del paciente del paciente
        returns integer
        */

        function create($nombre, $apaterno, $amaterno, $nacimiento, $domicilio){
            $dbh = $this->connect();
            $foto = $this->guardarFotografia();
            if($foto){
                $sentencia = "INSERT INTO paciente (nombre, apaterno, amaterno, nacimiento, domicilio, fotografia) values(:nombre, :apaterno, :amaterno, :nacimiento, :domicilio, :fotografia)"; 
                $stmt = $dbh->prepare($sentencia);
                $stmt->bindParam(':fotografia',$foto, PDO::PARAM_STR);
            }else{
                $sentencia = "INSERT INTO paciente (nombre, apaterno, amaterno, nacimiento, domicilio) values(:nombre, :apaterno, :amaterno, :nacimiento, :domicilio)"; 
                $stmt = $dbh->prepare($sentencia);
            }            
            $stmt->bindParam(':nombre',$nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apaterno',$apaterno, PDO::PARAM_STR);
            $stmt->bindParam(':amaterno',$amaterno, PDO::PARAM_STR);
            $stmt->bindParam(':nacimiento',$nacimiento, PDO::PARAM_STR);
            $stmt->bindParam(':domicilio',$domicilio, PDO::PARAM_STR);            
            $resultado = $stmt->execute();
            return $resultado;
        }

        function guardarFotografia(){
            $archivo = $_FILES['fotografia'];
            $tipos = array('image/jpeg', 'image/gif', 'image/png');
            if($archivo['error']==0){
                if(in_array($archivo['type'], $tipos)){
                    if($archivo['size'] <= 2097152){
                        $a = explode('/',$archivo['type']);
                        $nuevoNombre = md5(time()).'.'.$a[1];
                        if(move_uploaded_file($_FILES['fotografia']['tmp_name'], 'archivos/'.$nuevoNombre)){
                            return $nuevoNombre;
                        }
                    }               
                }
            }
            return false;
        }
        /*
        Metodo para obtener todos los pacientes
        returns array
        */
        function read(){
            $dbh = $this->connect();
            $sentencia = "SELECT * FROM paciente";
            $stmt = $dbh->prepare($sentencia);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        /*
        metodo para obtener un paciente
        params int @id id del paciente
        returns array
        */
        function readOne($id){
            $dbh = $this->connect();            
            $sentencia = "SELECT * FROM paciente where id_paciente=:id_paciente";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_paciente',$id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        /*
        Método para acyualizar un paciente
        params  int @id id del paciente
                String @nombre nombre del paciente
                String @apaterno apellido paterno del paciente
                String @amaterno apellido materno del paciente
                Date   @nacimiento fecha de nacimiento del paciente
                String @domicilio domicilio del paciente del paciente
        returns int
        */
        function update($id, $nombre, $apaterno, $amaterno, $nacimiento, $domicilio){
            $dbh = $this->connect();
            $foto = $this->guardarFotografia();
            if($foto){
                $sentencia = "UPDATE paciente set nombre=:nombre, apaterno=:apaterno, amaterno=:amaterno, nacimiento=:nacimiento, domicilio=:domicilio, fotografia=:fotografia where id_paciente=:id_paciente"; 
                $stmt = $dbh->prepare($sentencia);
                $stmt->bindParam(':fotografia',$foto, PDO::PARAM_STR);
            }else{
                $sentencia = "UPDATE paciente set nombre=:nombre, apaterno=:apaterno, amaterno=:amaterno, nacimiento=:nacimiento, domicilio=:domicilio where id_paciente=:id_paciente"; 
                $stmt = $dbh->prepare($sentencia);
            }
            $stmt->bindParam(':id_paciente',$id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre',$nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apaterno',$apaterno, PDO::PARAM_STR);
            $stmt->bindParam(':amaterno',$amaterno, PDO::PARAM_STR);
            $stmt->bindParam(':nacimiento',$nacimiento, PDO::PARAM_STR);
            $stmt->bindParam(':domicilio',$domicilio, PDO::PARAM_STR);
            $resultado = $stmt->execute();           
            return $resultado;
        }
        
        /*
        metodo para eliminar un paciente
        params  int @id id del paciente
        returns int
        */
        function delete($id){
            $dbh = $this->connect();
            $sentencia = "DELETE FROM paciente where id_paciente=:id_paciente";
            $stmt = $dbh->prepare($sentencia);            
            $stmt->bindParam(':id_paciente',$id, PDO::PARAM_INT);
            $resultado = $stmt->execute();           
            return $resultado;
        }
    }

    
    

?>