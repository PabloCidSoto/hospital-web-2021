<?php
    include('pacientes.controller.php');
    include('consulta.controller.php');    
    $pacientes = new Paciente();
    $sistema = new Sistema();
    $consulta = new Consulta();
    
    //$sistema->verificarRoles('Doctor');
    $action = $_SERVER['REQUEST_METHOD'];

    
    switch($action){       
        case 'DELETE':
            if(isset($_GET['id_paciente'])){
                $id_paciente = $_GET['id_paciente'];
                $pacientes->destroy($id_paciente);
            }
            break;
        case 'POST';
            $data = file_get_contents("php://input");    
            
            if(isset($_GET['id_paciente'])){
                /*Update*/
                $id_paciente = $_GET['id_paciente'];
                $pacientes->updateJson($data, $id_paciente);                
            }else{
                /*insert*/
                $data = file_get_contents("php://input");            
                $pacientes->createJson($data); 
            }
            break;
        case 'GET':
        default:        
            if(isset($_GET['id_paciente'])){
                $id_paciente = $_GET['id_paciente'];
                header('Content-Type: application/json');
                echo $pacientes->exportOne($id_paciente);
                
            }else{
                $data = file_get_contents("php://input");   
                header('Content-Type: application/json');
                echo $pacientes->export($data); 
            }
            break;
    }        
    //     case 'insert':
    //         $data = file_get_contents("php://input");            
    //         $pacientes->createJson($data);             
    //         break;
    //     case 'export':
    //         header('Content-Type: application/json');
    //         echo $pacientes->export();
    //         break;
    //     case 'exportOne':
    //         $id_paciente = $_GET['id_paciente'];
    //         header('Content-Type: application/json');
    //         echo $pacientes->exportOne($id_paciente);
    //         break;
    //     case 'destroy':
    //         $id_paciente = $_GET['id_paciente'];
    //         header('Content-Type: application/json');
    //         echo $pacientes->destroy($id_paciente);
    //         break;
    //     default:
    //         $datos = $pacientes->read();
    //         include('views/pacientes/index.php');            
    // } 
     
?>