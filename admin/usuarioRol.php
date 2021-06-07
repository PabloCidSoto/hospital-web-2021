<?php    
    include('usuarioRol.controller.php');
    include('usuario.controller.php');
    $sistema = new Sistema();      
    $usuario = new Usuario();    
    $usuarioRol = new UsuarioRol();
    $sistema->verificarRoles('Administrador');
    $action = (isset($_GET['action'])) ? $_GET['action'] : 'read';
    include('views/header.php');    
    switch($action){
        case 'create':
            $id_usuario = $_GET['id_usuario'];            
            $datos = $usuario->readOne($id_usuario);
            $rolesDeUsuario = $sistema->getRolesById($id_usuario);                       
            $roles = $usuarioRol->readRoles();                           
            include('views/usuario_rol/form.php');
            break;
        case 'save':
            $ur = $_POST['usuario'];            
            $resultado = $usuarioRol->create($ur['id_rol'], $ur['id_usuario']);
            $datos = $usuarioRol->readOneUser($ur['id_usuario']);
            include('views/usuario_rol/index.php');            
            break;
        case 'delete':
            $id_rol = $_GET['id_rol'];
            $id_usuario = $_GET['id_usuario'];
            $resultado = $usuarioRol->delete($id_rol, $id_usuario);
            $datos = $usuarioRol->readOneUser($id_usuario);
            include('views/usuario_rol/index.php');            
            break;
        case 'show':            
            $id_usuario = $_GET['id_usuario'];
            $datos = $usuarioRol->readOneUser($id_usuario);
            include('views/usuario_rol/index.php');          
            break;
        case 'update':
            $ur = $_POST['usuario'];
            $resultado = $usuarioRol->update($ur['id_rol'], $ur['id_usuario']);
            $datos = $usuarioRol->read();
            include('views/usuario_rol/index.php');   
            break;         
        default:
            $id_usuario = $_GET['id_usuario'];
            $datos = $usuarioRol->readOneUser($id_usuario);
            include('views/usuario_rol/index.php');          
            break;            
    } 
    include('views/footer.php');  
?>