<?php
    include('pacientes.controller.php');
    include('consulta.controller.php');
    $pacientes = new Paciente();
    $sistema = new Sistema();
    $consulta = new Consulta();
    $sistema->verificarRoles('Doctor');
    $action = (isset($_GET['action'])) ? $_GET['action'] : 'read';
    include('views/header.php');
    switch($action){
        case 'create':
            include('views/pacientes/form.php');
            break;
        case 'save':            
            $paciente = $_POST['paciente'];
            $resultado = $pacientes->create($paciente['nombre'], $paciente['apaterno'], $paciente['amaterno'], $paciente['nacimiento'], $paciente['domicilio'], $paciente['correo']);
            $datos = $pacientes->read();
            include('views/pacientes/index.php');            
            break;
        case 'delete':
            $id_paciente = $_GET['id_paciente'];
            $resultado = $pacientes->delete($id_paciente);
            $datos = $pacientes->read();
            include('views/pacientes/index.php');            
            break;
        case 'show':
            $id_paciente = $_GET['id_paciente'];
            $datos = $pacientes->readOne($id_paciente);
            include('views/pacientes/form.php');          
            break;
        case 'update':            
            $paciente = $_POST['paciente'];
            $resultado = $pacientes->update($paciente['id_paciente'],$paciente['nombre'],$paciente['apaterno'],$paciente['amaterno'],$paciente['nacimiento'],$paciente['domicilio']);
            $datos = $pacientes->read();
            include('views/pacientes/index.php');   
            break;
        case 'my':    
            $datos = $pacientes->read(true);
            include('views/pacientes/index.php');            
            break;
        case 'consulta':
            $id_paciente = $_GET['id_paciente'];
            $datos = $pacientes->readOne($id_paciente);            
            $consultas =  $consulta->read($id_paciente);            
            include('views/pacientes/consulta.php');
            break;
        case 'consulta_nueva':
            $consul = $_POST['consulta'];
            $resultado = $consulta->create($consul['id_paciente'], $consul['padecimiento'], $consul['tratamiento']);
            $id_paciente = $consul['id_paciente'];
            $datos = $pacientes->readOne($id_paciente);            
            $consultas =  $consulta->read($id_paciente);            
            include('views/pacientes/consulta.php');
            break;
        case 'insert':
            $data = file_get_contents("../json/pacientes.json");            
            $pacientes->createJson($data);             
            break;
        case 'export':
            $id_paciente = $_GET['id_paciente'];
            $pacientes->exportOne($id_paciente);
            break;
        default:
            $datos = $pacientes->read();
            include('views/pacientes/index.php');            
    } 
    include('views/footer.php');  
?>