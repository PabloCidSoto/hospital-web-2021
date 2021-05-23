<?php
    include('rol.controller.php');
    $rol = new Rol();
    $action = (isset($_GET['action']))? $_GET['action'] : 'read';
    include('views/header.php');
    switch ($action){
        case 'create':
            include('views/rol/form.php');
            break;
        case 'save':
            $r = $_POST['rol'];
            $resultado = $rol->create($r['rol']);
            $datos = $rol->read();
            include('views/rol/index.php');
            break;
        case 'delete':
            $id_rol = $_GET['id_rol'];
            $resultado = $rol->delete($id_rol);
            $datos = $rol->read();
            include('views/rol/index.php');
            break;
        case 'show':
            $id_rol = $_GET['id_rol'];
            $datos = $rol->readOne($id_rol);
            include('views/rol/form.php');
            break;
        case 'update':
            $r = $_POST['rol'];
            $resultado = $rol->update($r['id_rol'], $r['rol']);
            $datos = $rol->read();
            include('views/rol/index.php');
            break;
        default:
            $datos = $rol->read();
            include('views/rol/index.php');
    }
    include('views/footer.php');  
?>