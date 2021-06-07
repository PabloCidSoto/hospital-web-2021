<?php
    require('sistema.controller.php');

    class usuarioRol extends Sistema{
        var $idRol;
        var $idUsuario;        

        function create($idRol, $idUsuario){
            $dbh = $this->connect();
            $sentencia = "INSERT INTO usuario_rol (id_rol, id_usuario) values(:id_rol, :id_usuario)";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
            $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            return $resultado;
        }

        function read(){
            $dbh = $this->connect();
            $sentencia = "SELECT * FROM usuario_rol ur join usuario u on ur.id_usuario = u.id_usuario
                                                        join rol r on ur.id_rol = r.id_rol";
            $stmt = $dbh->prepare($sentencia);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        function readOne($idRol, $idUsuario){
            $dbh = $this->connect();            
            $sentencia = "SELECT * FROM usuario_rol where id_rol = :id_rol and id_usuario = :id_usuario";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
            $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        function readOneUser($idUsuario){
            $dbh = $this->connect();            
            $sentencia = "SELECT * FROM usuario_rol ur join usuario u on ur.id_usuario = u.id_usuario
            join rol r on ur.id_rol = r.id_rol where u.id_usuario = :id_usuario";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            if(!$rows){
                $sentencia = "SELECT * FROM usuario where id_usuario = :id_usuario";
                $stmt = $dbh->prepare($sentencia);
                $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
                $stmt->execute();
                $rows = $stmt->fetchAll();
                return $rows;
            }
            return $rows;
        }

        function readRoles(){
            $dbh = $this->connect();
            $sentencia = "SELECT * FROM rol";
            $stmt = $dbh->prepare($sentencia);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        function update($idRol, $idUsuario){
            $dbh = $this->connect();
            $sentencia = "UPDATE usuario_rol set id_rol = :id_rol, id_usuario = :id_usuario  where id_rol = :id_rol and id_usuario = :id_usuario"; 
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
            $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);          
            $resultado = $stmt->execute();           
            return $resultado;
        }

        function delete($idRol, $idUsuario){
            $dbh = $this->connect();
            $sentencia = "DELETE FROM usuario_rol where id_rol = :id_rol and id_usuario = :id_usuario";
            $stmt = $dbh->prepare($sentencia);            
            $stmt->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
            $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);          
            $resultado = $stmt->execute();           
            return $resultado;
        }
    }
?>