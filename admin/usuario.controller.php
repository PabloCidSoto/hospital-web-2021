<?php
    include_once('sistema.controller.php');

    class Usuario extends Sistema{
        var $idUsuario;
        var $correo;
        var $contrasena;        

        function create($correo, $contrasena){
            $contrasena = md5($contrasena);            
            $dbh = $this->connect();
            $sentencia = "INSERT into usuario (correo, contrasena) values(:correo, :contrasena)";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            return $resultado;
        }

        function read(){
            $dbh = $this->connect();
            $sentencia = "SELECT * FROM usuario";
            $stmt = $dbh->prepare($sentencia);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        function readOne($id){
            $dbh = $this->connect();
            $sentencia = "SELECT * from usuario where id_usuario = :id_usuario";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam('id_usuario', $id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        function update($id, $correo, $contrasena){
            $dbh = $this->connect();
            $sentencia = "UPDATE usuario SET correo = :correo, contrasena = :contrasena where id_usuario = :id_usuario";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            return $resultado;
        }

        function delete($id){
            $dbh = $this->connect();
            $sentencia = "DELETE from usuario where id_usuario = :id_usuario";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            return $resultado; 
        }
    }
?>