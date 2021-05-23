<?php
    require('sistema.controller.php');

    class Rol extends Sistema{
        var $idRol;
        var $rol;

        function getIdRol(){
            return $this->idRol;
        }
        function setIdRol($idRol){
            $this->idRol = $idRol;
        }

        function getrRol(){
            return $this->rol;
        }
        function setRol($rol){
            $this->rol = $rol;
        }

        function create($rol){
            $dbh = $this->connect();
            $sentencia = "INSERT INTO rol (rol) values(:rol)";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':rol', $rol, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            return $resultado;
        }

        function read(){
            $dbh = $this->connect();
            $sentencia = "SELECT * FROM rol";
            $stmt = $dbh->prepare($sentencia);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        function readOne($id){
            $dbh = $this->connect();            
            $sentencia = "SELECT * FROM rol where id_rol = :id_rol";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_rol', $id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        function update($id, $rol){
            $dbh = $this->connect();
            $sentencia = "UPDATE rol set rol = :rol where id_rol = :id_rol"; 
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_rol', $id, PDO::PARAM_INT);
            $stmt->bindParam(':rol', $rol, PDO::PARAM_STR);            
            $resultado = $stmt->execute();           
            return $resultado;
        }

        function delete($id){
            $dbh = $this->connect();
            $sentencia = "DELETE FROM rol where id_rol = :id_rol";
            $stmt = $dbh->prepare($sentencia);            
            $stmt->bindParam(':id_rol',$id, PDO::PARAM_INT);
            $resultado = $stmt->execute();           
            return $resultado;
        }
    }
?>