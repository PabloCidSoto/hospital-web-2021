<?php
    require_once('sistema.controller.php');
    
    /*Clase principal para doctores */
    class Doctor extends Sistema{        

        /*
        Método para crear un doctor
        params  String @nombre nombre del doctor
                String @apaterno apellido paterno del doctor
                String @amaterno apellido materno del doctor
                Date   @nacimiento fecha de nacimiento del doctor
                String @domicilio domicilio del doctor del doctor
        returns integer
        */

        function create($nombre, $apaterno, $amaterno, $especialidad, $id_usuario){
            $dbh = $this->connect();            
            $sentencia = "INSERT INTO doctor (nombre, apaterno, amaterno, especialidad, id_usuario) values(:nombre, :apaterno, :amaterno, :especialidad, :id_usuario)"; 
            $stmt = $dbh->prepare($sentencia);                        
            $stmt->bindParam(':nombre',$nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apaterno',$apaterno, PDO::PARAM_STR);
            $stmt->bindParam(':amaterno',$amaterno, PDO::PARAM_STR);
            $stmt->bindParam(':especialidad',$especialidad, PDO::PARAM_STR);
            $stmt->bindParam(':id_usuario',$id_usuario, PDO::PARAM_INT);            
            $resultado = $stmt->execute();
            return $resultado;
        }
        
        /*
        Metodo para obtener todos los doctores
        returns array
        */
        function read(){
            $dbh = $this->connect();
            $sentencia = "SELECT * FROM doctor";
            $stmt = $dbh->prepare($sentencia);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        /*
        metodo para obtener un doctor
        params int @id id del doctor
        returns array
        */
        function readOne($id){
            $dbh = $this->connect();            
            $sentencia = "SELECT * FROM doctor where id_doctor=:id_doctor";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_doctor',$id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        /*
        Método para acyualizar un doctor
        params  int @id id del doctor
                String @nombre nombre del doctor
                String @apaterno apellido paterno del doctor
                String @amaterno apellido materno del doctor
                Date   @nacimiento fecha de nacimiento del doctor
                String @domicilio domicilio del doctor del doctor
        returns int
        */
        function update($id, $nombre, $apaterno, $amaterno, $especialidad, $id_usuario){
            $dbh = $this->connect();            
            $sentencia = "UPDATE doctor set nombre=:nombre, apaterno=:apaterno, amaterno=:amaterno, especialidad=:especialidad, id_usuario=:id_usuario where id_doctor=:id_doctor"; 
            $stmt = $dbh->prepare($sentencia);            
            $stmt->bindParam(':id_doctor',$id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre',$nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apaterno',$apaterno, PDO::PARAM_STR);
            $stmt->bindParam(':amaterno',$amaterno, PDO::PARAM_STR);
            $stmt->bindParam(':especialidad',$especialidad, PDO::PARAM_STR);
            $stmt->bindParam(':id_usuario',$id_usuario, PDO::PARAM_INT);
            $resultado = $stmt->execute();           
            return $resultado;
        }
        
        /*
        metodo para eliminar un doctor
        params  int @id id del doctor
        returns int
        */
        function delete($id){
            $dbh = $this->connect();
            $sentencia = "DELETE FROM doctor where id_doctor=:id_doctor";
            $stmt = $dbh->prepare($sentencia);            
            $stmt->bindParam(':id_doctor',$id, PDO::PARAM_INT);
            $resultado = $stmt->execute();           
            return $resultado;
        }
    }

    
    

?>