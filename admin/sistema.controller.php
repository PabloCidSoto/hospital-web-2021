<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    require_once '../vendor/autoload.php';
    require_once('init.php');
    session_start();
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

        function validarToken($correo,$token){
                        
            $dbh = $this->connect();
            if (!is_null($token)){
                $sentencia = "SELECT * from usuario where token = :token and correo = :correo"; 
                $stmt = $dbh->prepare($sentencia);
                $stmt->bindParam(':token',$token, PDO::PARAM_STR);
                $stmt->bindParam(':correo',$correo, PDO::PARAM_STR);
                $stmt->execute();
                $rows = $stmt->fetchAll();
                return isset($rows[0]['correo'])?  true: false;
            }else{
                return false;
            }
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
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $roles = array();
            foreach ($rows as $key => $row){
                array_push($roles, $row['rol']);
            }
            return $roles;            
        }

        function getRolesById($id){
            $dbh = $this->connect();
            $sentencia = "SELECT r.id_rol,r.rol from usuario u join usuario_rol ur on u.id_usuario=ur.id_usuario 
                                                                                            join rol r on ur.id_rol= r.id_rol
                                                                                            where u.id_usuario = :id_usuario"; 
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_usuario',$id, PDO::PARAM_STR);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $roles = array();
            foreach ($rows as $key => $row){
                array_push($roles, $row['rol']);
            }
            return $roles;
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
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $permisos = array();
            foreach ($rows as $key => $row){
                array_push($permisos, $row['permiso']);
            }
            return $permisos;            
        }

        function verificarRoles($rol){
            $this->verificarSesion();
            $roles = $_SESSION['roles'];
            if(!in_array($rol,$roles)){
                $mensaje = 'Usted no tiene el rol Adecuado';
                include('../login/header.php');
                include('../login/views/login.php');
                include('../login/footer.php');
                die();

            } 
        }

        function validarRoles($rol){
            $this->verificarSesion();
            $roles = $_SESSION['roles'];
            if(in_array($rol,$roles)){
                return true;
            }
            return false; 
        }

        function validarPermisos($permiso){
            $this->verificarSesion();
            $permisos = $_SESSION['permisos'];
            if(in_array($permiso,$permisos)){
                return true;
            }
            return false;            
        }

        function verificarSesion(){            
            if(!isset($_SESSION['validado'])){
                $mensaje = 'Es necesario iniciar sesión';
                include('../login/header.php');
                include('../login/views/login.php');
                include('../login/footer.php'); 
                die();                
            }
        }

        function getIdDoctor($id_usuario){
            $dbh = $this->connect();
            $sentencia = "SELECT id_doctor from doctor where id_usuario = :id_usuario";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            $dato = $stmt->fetchAll();
            return $dato[0]['id_doctor'];
        }

        function getIdUsuario($correo){
            $dbh = $this->connect();
            $sentencia = "SELECT id_usuario from usuario where correo = :correo";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->execute();
            $dato = $stmt->fetchAll();
            if(isset($dato)){
                return $dato[0]['id_usuario'];
            }
            return null;
        }

        function changePass($correo){
            $id_usuario = $this->getIdUsuario($correo);
            if(!is_null($id_usuario)){                
                $token = substr(crypt(sha1(hash('sha512',md5(rand(1,9999)).$id_usuario)), 'Cruzazul Campeón'),1,10);                
                $dbh = $this->connect();
                $sentencia = "UPDATE usuario SET token = :token where id_usuario = :id_usuario";
                $stmt = $dbh->prepare($sentencia);
                $stmt->bindParam(':token', $token, PDO::PARAM_STR);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
                $mensaje = 'Se ha enviado un correo electrónico a su cuenta';
                require '../vendor/autoload.php';
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->SMTPDebug = SMTP::DEBUG_OFF;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->SMTPAuth = true;
                $mail->Username = '17031200@itcelaya.edu.mx';
                $mail->Password = PASSGMAIL;
                $mail->setFrom('17031200@itcelaya.edu.mx', 'Pablo Cid');
                $mail->addReplyTo('17031200@itcelaya.edu.mx', 'Pablo Cid');
                $mail->addAddress($correo, $correo);
                $mail->Subject = 'Cambio contraseña Hospital';
                $cuerpo ="Estimado usuario porfavor presione la siguente liga para recuperar su contraseña<br><a href='http://127.0.0.1/hospital/login/login.php?action=change_pass&correo=".$correo."&token=".$token."'>Recuperar Contraseña</a>";
                $mail->msgHTML($cuerpo);
                $mail->AltBody = 'Cambio de contraseña';
                if (!$mail->send()) {
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo $mensaje;    
                }
            }
        }

        function resetPass($correo, $token, $contrasena){
            if($this->validarEmail($correo)){
                if($this->validarToken($correo, $token)){
                    $dbh = $this->connect();
                    if (!is_null($token)){
                        $contrasena = md5($contrasena);
                        $sentencia = "UPDATE usuario set contrasena= :contrasena, token = null and correo = :correo"; 
                        $stmt = $dbh->prepare($sentencia);
                        $stmt->bindParam(':contrasena',$contrasena, PDO::PARAM_STR);
                        $stmt->bindParam(':correo',$correo, PDO::PARAM_STR);
                        $row = $stmt->execute();
                        if ($row){
                            return true;
                        }

                        return false;
                    }
                }
            }
            return false;
        }

        function calculaedad($fechanacimiento){
            list($ano,$mes,$dia) = explode("-",$fechanacimiento);
            $ano_diferencia  = date("Y") - $ano;
            $mes_diferencia = date("m") - $mes;
            $dia_diferencia   = date("d") - $dia;
            if ($dia_diferencia < 0 || $mes_diferencia < 0)
              $ano_diferencia--;
            return $ano_diferencia;
          }

        function printJson($info){
            $info = json_encode($info, true);
            echo $info;
            header('Content-Type: application/json');
        }

    }
    
?>