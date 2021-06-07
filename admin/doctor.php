<?php
    include('doctor.controller.php');
    $doctores = new Doctor();
    $sistema = new Sistema();
    $sistema->verificarRoles('Administrador');
    $action = (isset($_GET['action'])) ? $_GET['action'] : 'read';
    include('views/header.php');
    switch($action){
        case 'create':
            include('views/doctor/form.php');
            break;
        case 'save':            
            $doctor = $_POST['doctor'];
            $resultado = $doctores->create($doctor['nombre'], $doctor['apaterno'], $doctor['amaterno'], $doctor['especialidad'], $doctor['especialidad'], $doctor['id_usuario']);
            $datos = $doctores->read();
            include('views/doctor/index.php');            
            break;
        case 'delete':
            $id_doctor = $_GET['id_doctor'];
            $resultado = $doctores->delete($id_doctor);
            $datos = $doctores->read();
            include('views/doctor/index.php');            
            break;
        case 'show':
            $id_doctor = $_GET['id_doctor'];
            $datos = $doctores->readOne($id_doctor);
            include('views/doctor/form.php');          
            break;
        case 'update':            
            $doctor = $_POST['doctor'];            
            $resultado = $doctores->update($doctor['id_doctor'],$doctor['nombre'],$doctor['apaterno'],$doctor['amaterno'],$doctor['especialidad'],$doctor['id_usuario']);
            $datos = $doctores->read();
            include('views/doctor/index.php');   
            break;         
        default:
            $datos = $doctores->read();
            include('views/doctor/index.php');            
    } 
    include('views/footer.php');  
?>