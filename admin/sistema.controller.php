<?php
    class Sistema{
        var $dsn = 'mysql:host=localhost;dbname=hospital';
        var $user = 'hospital';
        var $password = '123';

        function connect(){
            $dbh = new PDO($this->dsn,$this->user,$this->password);
            return $dbh;
        }

        function validarUsuario($correo,$contrasena){
            $contrasena = md5($contrasena);
            $dbh = $this->connect();
            $sentencia = "SELECT * from usuario where contrasena = :contrasena and correo = :correo"; 
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':correo',$correo, PDO::PARAM_STR);
            $stmt->bindParam(':contrasena',$contrasena, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            $rows = $stmt->fetchAll();
            return isset($rows[0]['correo'])?  true: false;
        }

        function validarEmail($correo){
            return (false !== filter_var($correo, FILTER_VALIDATE_EMAIL));
        }

        function getRoles($correo){
            $dbh = $this->connect();
            $sentencia = "SELECT r.id_rol,r.rol from usuario u join usuario_rol ur on u.id_usuario=ur.id_usuario 
                                                                                            join rol r on ur.id_rol= r.id_rol
                                                                                            where u.correo = :correo"; 
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':correo',$correo, PDO::PARAM_STR);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }
        
        function getPermisos($correo){
            $dbh = $this->connect();
            $sentencia = "SELECT p.id_permiso, p.permiso from usuario u join usuario_rol ur on u.id_usuario=ur.id_usuario 
                                                                                            join rol r on ur.id_rol= r.id_rol
                                                                                            join rol_permiso rp on r.id_rol=rp.id_rol
                                                                                            join permiso p on rp.id_permiso=p.id_permiso
                                                                                            where u.correo = :correo"; 
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':correo',$correo, PDO::PARAM_STR);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }
    }
    
?>