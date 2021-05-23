<?php
    require('sistema.controller.php');

    class Permiso extends Sistema{
        var $idPermiso;
        var $permiso;

        function getIdPermiso(){
            return $this->idPermiso;
        }
        function setIdPermiso($idPermiso){
            $this->idPermiso = $idPermiso;
        }

        function getPermiso(){
            return $this->permiso;
        }
        function setPermiso($permiso){
            $this->permiso = $permiso;
        }

        function create($permiso){
            $dbh = $this->connect();
            $sentencia = "INSERT INTO permiso (permiso) values(:permiso)";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':permiso', $permiso, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            return $resultado;
        }

        function read(){
            $dbh = $this->connect();
            $sentencia = "SELECT * FROM permiso";
            $stmt = $dbh->prepare($sentencia);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        function readOne($id){
            $dbh = $this->connect();            
            $sentencia = "SELECT * FROM permiso where id_permiso = :id_permiso";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_permiso', $id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        function update($id, $permiso){
            $dbh = $this->connect();
            $sentencia = "UPDATE permiso set permiso = :permiso where id_permiso = :id_permiso"; 
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_permiso', $id, PDO::PARAM_INT);
            $stmt->bindParam(':permiso', $permiso, PDO::PARAM_STR);            
            $resultado = $stmt->execute();           
            return $resultado;
        }

        function delete($id){
            $dbh = $this->connect();
            $sentencia = "DELETE FROM permiso where id_permiso = :id_permiso";
            $stmt = $dbh->prepare($sentencia);            
            $stmt->bindParam(':id_permiso',$id, PDO::PARAM_INT);
            $resultado = $stmt->execute();           
            return $resultado;
        }
    }
?>