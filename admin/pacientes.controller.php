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

        /*
        Método para crear un paciente
        params  String @nombre nombre del paciente
                String @apaterno apellido paterno del paciente
                String @amaterno apellido materno del paciente
                Date   @nacimiento fecha de nacimiento del paciente
                String @domicilio domicilio del paciente del paciente
        returns integer
        */

        function create($nombre, $apaterno, $amaterno, $nacimiento, $domicilio, $correo){
            try {
                $dbh = $this->connect();
                $dbh->beginTransaction();
                $foto = $this->guardarFotografia();
                $sentencia = "INSERT INTO usuario (correo, contrasena) values (:correo, :contrasena)"; 
                $stmt = $dbh->prepare($sentencia);
                $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
                $contrasena = md5(rand(1,100));
                $stmt->bindParam(':contrasena', $contrasena,  PDO::PARAM_STR);
                $stmt->execute();
                $sentencia = "SELECT * from usuario where correo = :correo";
                $stmt = $dbh->prepare($sentencia);
                $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
                $stmt->execute();
                $fila = $stmt->fetchAll();
                $idUsuario = $fila[0]['id_usuario'];
                if (is_numeric($idUsuario)){
                    $sentencia = "INSERT into usuario_rol(id_usuario, id_rol) values(:id_usuario, 3)";
                    $stmt = $dbh->prepare($sentencia);
                    $stmt->bindParam(':id_usuario',$idUsuario, PDO::PARAM_INT);
                    $stmt->execute();                                    
                    $id_doctor = $this->getIdDoctor($_SESSION['id_usuario']);
                    if($foto){
                        $sentencia = "INSERT INTO paciente (nombre, apaterno, amaterno, nacimiento, domicilio, fotografia, id_usuario, id_doctor) values(:nombre, :apaterno, :amaterno, :nacimiento, :domicilio, :fotografia, :id_usuario, :id_doctor)"; 
                        $stmt = $dbh->prepare($sentencia);
                        $stmt->bindParam(':fotografia',$foto, PDO::PARAM_STR);
                    }else{
                        $sentencia = "INSERT INTO paciente (nombre, apaterno, amaterno, nacimiento, domicilio, id_usuario, id_doctor) values(:nombre, :apaterno, :amaterno, :nacimiento, :domicilio, :id_usuario, :id_doctor)"; 
                        $stmt = $dbh->prepare($sentencia);
                    }            
                    $stmt->bindParam(':nombre',$nombre, PDO::PARAM_STR);
                    $stmt->bindParam(':apaterno',$apaterno, PDO::PARAM_STR);
                    $stmt->bindParam(':amaterno',$amaterno, PDO::PARAM_STR);
                    $stmt->bindParam(':nacimiento',$nacimiento, PDO::PARAM_STR);
                    $stmt->bindParam(':domicilio',$domicilio, PDO::PARAM_STR);  
                    $stmt->bindParam(':id_usuario',$idUsuario, PDO::PARAM_INT);
                    $stmt->bindParam(':id_doctor',$id_doctor, PDO::PARAM_INT);         
    
                    $resultado = $stmt->execute();                    
                    $dbh->commit();
                    return $resultado;
                }
            }
            catch (Exception $e){
                echo 'Excepcion', $e->getMessage(), '\n';
                $dbh->rollBack();
            }
            $dbh->rollBack();
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
        function read($my = false){
            $dbh = $this->connect();
            if($my){
                $id_doctor = $this->getIdDoctor($_SESSION['id_usuario']);
                $sentencia = "SELECT * from paciente where id_doctor = :id_doctor";
                $stmt = $dbh->prepare($sentencia);
                $stmt->bindValue(':id_doctor', $id_doctor, PDO::PARAM_INT);                              
            }else{
                $sentencia = "SELECT * FROM paciente";
                $stmt = $dbh->prepare($sentencia);
            }            
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