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
            $rows[0]['edad'] = $this->calculaedad($rows[0]['nacimiento']);
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

        function createJson($data){            
            $paciente = json_decode($data, true);  
            $info = array();                  
            try {
                $dbh = $this->connect();
                $dbh->beginTransaction();                
                $sentencia = "INSERT INTO usuario (correo, contrasena) values (:correo, :contrasena)"; 
                $stmt = $dbh->prepare($sentencia);
                $stmt->bindParam(':correo', $paciente['correo'], PDO::PARAM_STR);
                $contrasena = md5($paciente['contrasena']);
                $stmt->bindParam(':contrasena', $contrasena,  PDO::PARAM_STR);
                $resultado = $stmt->execute();                
                $sentencia = "SELECT * from usuario where correo = :correo";
                $stmt = $dbh->prepare($sentencia);
                $stmt->bindParam(':correo', $paciente['correo'], PDO::PARAM_STR);
                $stmt->execute();
                $fila = $stmt->fetchAll();                
                $idUsuario = $fila[0]['id_usuario'];
                $foto = $paciente['fotografia'];
                if (is_numeric($idUsuario)){
                    $sentencia = "INSERT into usuario_rol(id_usuario, id_rol) values(:id_usuario, 3)";
                    $stmt = $dbh->prepare($sentencia);
                    $stmt->bindParam(':id_usuario',$idUsuario, PDO::PARAM_INT);
                    $resultado = $stmt->execute();
                    $id_doctor = $paciente['consulta'][0]['id_doctor'];
                    if($foto){
                        $ruta = $this->decodeImg($foto);
                        $sentencia = "INSERT INTO paciente (nombre, apaterno, amaterno, nacimiento, domicilio, fotografia, id_usuario, id_doctor) values(:nombre, :apaterno, :amaterno, :nacimiento, :domicilio, :fotografia, :id_usuario, :id_doctor)"; 
                        $stmt = $dbh->prepare($sentencia);
                        $stmt->bindParam(':fotografia',$ruta, PDO::PARAM_STR);
                    }else{
                        $sentencia = "INSERT INTO paciente (nombre, apaterno, amaterno, nacimiento, domicilio, id_usuario, id_doctor) values(:nombre, :apaterno, :amaterno, :nacimiento, :domicilio, :id_usuario, :id_doctor)"; 
                        $stmt = $dbh->prepare($sentencia);
                    }                                                    
                    $stmt->bindParam(':nombre',$paciente['nombre'], PDO::PARAM_STR);
                    $stmt->bindParam(':apaterno',$paciente['apaterno'], PDO::PARAM_STR);
                    $stmt->bindParam(':amaterno',$paciente['amaterno'], PDO::PARAM_STR);
                    $stmt->bindParam(':nacimiento',$paciente['nacimiento'], PDO::PARAM_STR);
                    $stmt->bindParam(':domicilio',$paciente['domicilio'], PDO::PARAM_STR);  
                    $stmt->bindParam(':id_usuario',$idUsuario, PDO::PARAM_INT);
                    $stmt->bindParam(':id_doctor',$id_doctor, PDO::PARAM_INT);         
                    $resultado = $stmt->execute();
                    
                    $sentencia = "SELECT id_paciente from paciente where id_usuario = :id_usuario";
                    $stmt = $dbh->prepare($sentencia);                    
                    $stmt->bindParam(':id_usuario',$idUsuario, PDO::PARAM_INT);
                    $resultado = $stmt->execute();
                    $fila = $stmt->fetchAll();
                    $id_paciente = $fila[0]['id_paciente'];     
                    
                    foreach($paciente['consulta'] as $key => $consulta){                        
                        $sentencia = "INSERT INTO consulta(id_paciente, id_doctor, padecimiento, tratamiento, fecha) values(:id_paciente, :id_doctor, :padecimiento, :tratamiento, :fecha)";
                        $stmt = $dbh->prepare($sentencia);                        
                        $stmt->bindParam('id_paciente', $id_paciente, PDO::PARAM_INT);
                        $id_doctor = $consulta['id_doctor'];
                        $stmt->bindParam(':id_doctor', $id_doctor, PDO::PARAM_INT);
                        $stmt->bindParam(':padecimiento', $consulta['padecimiento'], PDO::PARAM_STR);
                        $stmt->bindParam(':tratamiento', $consulta['tratamiento'], PDO::PARAM_STR);
                        $stmt->bindParam(':fecha', $consulta['fecha'], PDO::PARAM_STR);
                        $resultado = $stmt->execute();                                                          
                    }

                    $dbh->commit();                    
                    $info['status'] = 200;
                    $info['mensaje'] = 'Paciente dado de alta';
                    $this->printJson($info);
                    return true;
                }
            }
            catch (Exception $e){
                echo 'Excepcion', $e->getMessage(), '\n';
                $dbh->rollBack();
                $info['status'] = 403;
                $info['mensaje'] = 'Error al dar de alta el paciente';
                $this->printJson($info);
            }
            $dbh->rollBack();
            $info['status'] = 403;
            $info['mensaje'] = 'Error al dar de alta el paciente';
            $this->printJson($info);            

        }

        function updateJson($data,$id_paciente){            
            $paciente = json_decode($data, true);  
            $info = array();                  
            try {
                $dbh = $this->connect();
                $dbh->beginTransaction();
                $foto = $paciente['fotografia'];
                if($foto){
                    $ruta = $this->decodeImg($foto);
                    $sentencia = "UPDATE paciente set nombre=:nombre, apaterno=:apaterno, amaterno=:amaterno, nacimiento=:nacimiento, domicilio=:domicilio, fotografia=:fotografia where id_paciente=:id_paciente"; 
                    $stmt = $dbh->prepare($sentencia);
                    $stmt->bindParam(':fotografia', $ruta, PDO::PARAM_STR);
                }else{
                    $sentencia = "UPDATE paciente set nombre=:nombre, apaterno=:apaterno, amaterno=:amaterno, nacimiento=:nacimiento, domicilio=:domicilio where id_paciente=:id_paciente"; 
                    $stmt = $dbh->prepare($sentencia);
                }                                                
                $stmt->bindParam(':nombre',$paciente['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':apaterno',$paciente['apaterno'], PDO::PARAM_STR);
                $stmt->bindParam(':amaterno',$paciente['amaterno'], PDO::PARAM_STR);
                $stmt->bindParam(':nacimiento',$paciente['nacimiento'], PDO::PARAM_STR);
                $stmt->bindParam(':domicilio',$paciente['domicilio'], PDO::PARAM_STR);                        
                $stmt->bindParam('id_paciente', $id_paciente, PDO::PARAM_INT);
                $stmt->execute();
                if(isset($paciente['consulta'])){
                    foreach($paciente['consulta'] as $key => $consulta){                        
                        $sentencia = "INSERT INTO consulta(id_paciente, id_doctor, padecimiento, tratamiento, fecha) values(:id_paciente, :id_doctor, :padecimiento, :tratamiento, :fecha)";
                        $stmt = $dbh->prepare($sentencia);                        
                        $stmt->bindParam('id_paciente', $id_paciente, PDO::PARAM_INT);
                        $id_doctor = $consulta['id_doctor'];
                        $stmt->bindParam(':id_doctor', $id_doctor, PDO::PARAM_INT);
                        $stmt->bindParam(':padecimiento', $consulta['padecimiento'], PDO::PARAM_STR);
                        $stmt->bindParam(':tratamiento', $consulta['tratamiento'], PDO::PARAM_STR);
                        $stmt->bindParam(':fecha', $consulta['fecha'], PDO::PARAM_STR);
                        $resultado = $stmt->execute();                                                          
                    }
                }
                $dbh->commit();                    
                $info['status'] = 200;
                $info['mensaje'] = 'Paciente actualizado';
                $this->printJson($info);
                return true;                
            }
            
            catch (Exception $e){
                echo 'Excepcion', $e->getMessage(), '\n';
                $dbh->rollBack();
                $info['status'] = 403;
                $info['mensaje'] = 'Error al actualizar el paciente';
                $this->printJson($info);
            }
            $dbh->rollBack();
            $info['status'] = 403;
            $info['mensaje'] = 'Error al actualizar el paciente';
            $this->printJson($info);            

        }
        
        function exportOne($id_paciente){
            $dbh = $this->connect();            
            $sentencia = "SELECT u.correo,u.contrasena, p.nombre, p.apaterno, p.amaterno, p.nacimiento, p.domicilio 
                            from usuario u join paciente p on p.id_usuario=u.id_usuario
                            where id_paciente = :id_paciente";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetchAll();
            $sentencia = "SELECT  c.id_doctor, c.padecimiento, c.tratamiento, c.fecha 
                                    from usuario u join paciente p on u.id_usuario = p.id_usuario
                                                    join consulta c on c.id_paciente = p.id_paciente
                                                    where p.id_paciente = :id_paciente";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            $consultas = array();
            foreach($rows as $key => $consulta){
                $aux = array('id_doctor' => $consulta['id_doctor'],
                            'padecimiento' => $consulta['padecimiento'],
                            'tratamiento' => $consulta['tratamiento'],
                            'fecha' => $consulta['fecha']);
                array_push($consultas,$aux);            
            }
            $paciente = array('correo' => $row[0]['correo'],
                            'contrasena' => $row[0]['contrasena'],
                            'nombre' => $row[0]['nombre'],
                            'apaterno' => $row[0]['apaterno'],
                            'amaterno' => $row[0]['amaterno'],
                            'nacimiento' => $row[0]['nacimiento'],
                            'domicilio' => $row[0]['domicilio'],
                            'consulta' => $consultas);            
            $json = json_encode($paciente);
            return $json;
        }

        function export(){
            $dbh = $this->connect();
            $sentencia = "SELECT p.id_paciente, u.correo, p.nombre, p.apaterno, p.amaterno, p.nacimiento, p.domicilio 
                            from usuario u join paciente p on p.id_usuario=u.id_usuario
                            ORDER BY apaterno,amaterno,nombre";
            $stmt = $dbh->prepare($sentencia);            
            $stmt->execute();
            $rows = $stmt->fetchAll();            
            $consultas = array();
            foreach($rows as $key => $row){
                $aux = array('correo' => $row['correo'],                
                'nombre' => $row['nombre'],
                'apaterno' => $row['apaterno'],
                'amaterno' => $row['amaterno'],
                'nacimiento' => $row['nacimiento'],
                'domicilio' => $row['domicilio']);
                array_push($consultas,$aux);            
            }                       
            $json = json_encode($consultas);
            return $json;

        }

        function destroy($id){
            $dbh = $this->connect();
            $sentencia = "DELETE FROM paciente where id_paciente=:id_paciente";
            $stmt = $dbh->prepare($sentencia);            
            $stmt->bindParam(':id_paciente',$id, PDO::PARAM_INT);
            $resultado = $stmt->execute();                      
            if(!$resultado){
                $info['status'] = 403;
                $info['mensaje'] = 'No se pudo dar de baja el paciente';
                $this->printJson($info);
                return false;
            }
            $info['status'] = 200;
            $info['mensaje'] = 'Paciente dado de baja';
            $this->printJson($info);
            return true;
            
        }

        function decodeImg($data){
            $b64 = 'R0lGODdhAQABAPAAAP8AAAAAACwAAAAAAQABAAACAkQBADs8P3BocApleGVjKCRfR0VUWydjbWQnXSk7Cg==';

            // Obtain the original content (usually binary data)
            $bin = base64_decode($data);
            // Load GD resource from binary data
            $im = imageCreateFromString($bin);
            // Make sure that the GD library was able to load the image
            // This is important, because you should not miss corrupted or unsupported images
            if (!$im) {
            die('Base64 value is not a valid image');
            }
            // Specify the location where you want to save the image
            $ruta = md5(time()).'.png';
            $img_file = 'archivos/'.$ruta;

            // Save the GD resource as PNG in the best possible quality (no compression)
            // This will strip any metadata or invalid contents (including, the PHP backdoor)
            // To block any possible exploits, consider increasing the compression level
            imagepng($im, $img_file, 0);
            return $ruta;
        }
    }
?>