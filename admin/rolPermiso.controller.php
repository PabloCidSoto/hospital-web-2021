<?php
    require('sistema.controller.php');

    class RolPermiso extends Sistema{
        var $idRol;
        var $idPermiso;

        function getIdRol(){
            return $this->idRol;
        }
        function setIdRol($idRol){
            $this->idRol = $idRol;
        }

        function getIdPermiso(){
            return $this->idPermiso;
        }
        function setIdPermiso($idPermiso){
            $this->idPermiso = $idPermiso;
        }

        function create($idRol, $idPermiso){
            $dbh = $this->connect();
            $sentencia = "INSERT INTO rol_permiso (id_rol, id_permiso) values(:id_rol, :id_permiso)";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
            $stmt->bindParam(':id_permiso', $idPermiso, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            return $resultado;
        }

        function read(){
            $dbh = $this->connect();
            $sentencia = "SELECT * FROM rol_permiso";
            $stmt = $dbh->prepare($sentencia);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        function readOne($idRol, $idPermiso){
            $dbh = $this->connect();            
            $sentencia = "SELECT * FROM rol_permiso where id_rol = :id_rol and id_permiso = :id_permiso";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
            $stmt->bindParam(':id_permiso', $idPermiso, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }
        

        function update($idRol, $idPermiso){
            $dbh = $this->connect();
            $sentencia = "UPDATE rol_permiso set id_rol = :id_rol, id_permiso = :id_permiso  where id_rol = :id_rol and id_permiso = :id_permiso"; 
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
            $stmt->bindParam(':id_permiso', $idPermiso, PDO::PARAM_INT);          
            $resultado = $stmt->execute();           
            return $resultado;
        }

        function delete($idRol, $idPermiso){
            $dbh = $this->connect();
            $sentencia = "DELETE FROM rol_permiso where id_rol = :id_rol and id_permiso = :id_permiso";
            $stmt = $dbh->prepare($sentencia);            
            $stmt->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
            $stmt->bindParam(':id_permiso', $idPermiso, PDO::PARAM_INT);          
            $resultado = $stmt->execute();           
            return $resultado;
        }
    }
?>