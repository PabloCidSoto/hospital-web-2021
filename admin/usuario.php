<?php    
    include('usuario.controller.php');
    $usuarios = new Usuario();
    $sistema = new Sistema();
    $action = (isset($_GET['action'])) ? $_GET['action'] : 'read';
    include('views/header.php');
    switch($action){
        case 'create':
            include('views/usuario/form.php');
            break;
        case 'save':            
            $usuario = $_POST['usuario'];
            if($sistema->validarEmail($usuario['correo'])){
            $resultado = $usuarios->create($usuario['correo'], $usuario['contrasena']);
            }else{
                echo 'Correo no válido';
            }
            $datos = $usuarios->read();
            include('views/usuario/index.php');            
            break;
        case 'delete':
            $id_usuario = $_GET['id_usuario'];
            $resultado = $usuarios->delete($id_usuario);
            $datos = $usuarios->read();
            include('views/usuario/index.php');            
            break;
        case 'show':
            $id_usuario = $_GET['id_usuario'];
            $datos = $usuarios->readOne($id_usuario);            
            include('views/usuario/form.php');          
            break;
        case 'update':            
            $usuario = $_POST['usuario'];
            $resultado = $usuarios->update($usuario['id_usuario'],$usuario['correo'],$usuario['contrasena']);
            $datos = $usuarios->read();
            include('views/usuario/index.php');   
            break;         
        default:
            $datos = $usuarios->read();
            include('views/usuario/index.php');            
    } 
    include('views/footer.php');  
?>