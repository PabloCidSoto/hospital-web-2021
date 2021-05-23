<?php
    include('permiso.controller.php');
    $permiso = new Permiso();
    $action = (isset($_GET['action']))? $_GET['action'] : 'read';
    include('views/header.php');
    switch ($action){
        case 'create':
            include('views/permiso/form.php');
            break;
        case 'save':
            $permi = $_POST['permiso'];
            $resultado = $permiso->create($permi['permiso']);
            $datos = $permiso->read();
            include('views/permiso/index.php');
            break;
        case 'delete':
            $id_permiso = $_GET['id_permiso'];
            $resultado = $permiso->delete($id_permiso);
            $datos = $permiso->read();
            include('views/permiso/index.php');
            break;
        case 'show':
            $id_permiso = $_GET['id_permiso'];
            $datos = $permiso->readOne($id_permiso);
            include('views/permiso/form.php');
            break;
        case 'update':
            $permi = $_POST['permiso'];
            $resultado = $permiso->update($permi['id_permiso'], $permi['permiso']);
            $datos = $permiso->read();
            include('views/permiso/index.php');
            break;
        default:
            $datos = $permiso->read();
            include('views/permiso/index.php');
    }
    include('views/footer.php');  
?>