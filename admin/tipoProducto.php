<?php
    include('tipoProducto.controller.php');
    $tipoProducto = new TipoProducto();
    $action = (isset($_GET['action'])) ? $_GET['action'] : 'read';
    include('views/header.php');
    switch($action){
        case 'create':
            include('views/tipoProducto/form.php');
            break;
        case 'save':
            $producto = $_POST['producto'];
            $resultado = $tipoProducto->create($producto['tipo_producto']);
            $datos = $tipoProducto->read();
            include('views/tipoProducto/index.php');            
            break;
        case 'delete':
            $id_tipo_producto = $_GET['id_tipo_producto'];
            $resultado = $tipoProducto->delete($id_tipo_producto);
            $datos = $tipoProducto->read();
            include('views/tipoProducto/index.php');            
            break;
        case 'show':
            $id_tipo_producto = $_GET['id_tipo_producto'];
            $datos = $tipoProducto->readOne($id_tipo_producto);
            include('views/tipoProducto/form.php');          
            break;
        case 'update':
            $producto = $_POST['producto'];
            $resultado = $tipoProducto->update($producto['id_tipo_producto'],$producto['tipo_producto']);
            $datos = $tipoProducto->read();
            include('views/tipoProducto/index.php');   
            break;         
        default:
            $datos = $tipoProducto->read();
            include('views/tipoProducto/index.php');            
    } 
    include('views/footer.php');  
?>