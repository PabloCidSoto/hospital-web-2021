<?php
    
    $data = file_get_contents('pacientes.json');
    $paciente = json_decode($data, true);
    
?>