<?php
    include('producto.controller.php');
    include('tipoProducto.controller.php');
    $tipoProducto = new TipoProducto();
    $producto = new Producto();
    $action = (isset($_GET['action'])) ? $_GET['action'] : 'read';
    include('views/header.php');
    $tipos = $tipoProducto->read();
    switch($action){
        case 'create':            
            include('views/producto/form.php');
            break;
        case 'save':
            $product = $_POST['producto'];
            $resultado = $producto->create($product['producto'], $product['precio'], $product['id_tipo_producto']);
            $datos = $producto->read();
            include('views/producto/index.php');            
            break;
        case 'delete':
            $id_producto = $_GET['id_producto'];
            $resultado = $producto->delete($id_producto);
            $datos = $producto->read();
            include('views/producto/index.php');            
            break;
        case 'show':            
            $id_producto = $_GET['id_producto'];
            $datos = $producto->readOne($id_producto);
            include('views/producto/form.php');          
            break;
        case 'update':
            $product = $_POST['producto'];
            $resultado = $producto->update($product['id_producto'], $product['producto'], $product['precio'], $product['id_tipo_producto']);
            $datos = $producto->read();
            include('views/producto/index.php');   
            break;         
        default:
            $datos = $producto->read();
            include('views/producto/index.php');            
    } 
    include('views/footer.php');  
?>