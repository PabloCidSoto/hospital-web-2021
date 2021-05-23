<?php
    include('../admin/sistema.controller.php');
    include('header.php');
    $sistema = new Sistema();
    $action = (isset($_GET['action'])) ? $_GET['action'] : 'read';
    switch($action){
        case 'validate':
            if(isset($_POST['enviar'])){
                $correo = $_POST['correo'];
                $contrasena = $_POST['contrasena'];
                if($sistema->validarEmail($correo)){
                    if($sistema->validarUsuario($correo,$contrasena)){
                        $roles = $sistema->getRoles($correo);
                        $permisos = $sistema->getPermisos($correo);
                        print_r($roles);
                        print_r($permisos);
                    }else{
                        echo 'Combinación usuario y/o contraseña no valida';
                    }
                }else{
                    echo 'no puedo continuar';
                }
            }
            break;
        default:            
            include('views/login.php');            
    } 
    include('footer.php');
?>