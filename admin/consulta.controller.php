<?php
    require_once('sistema.controller.php');
    class Consulta extends Sistema{

        function read($id_paciente){
            $dbh = $this->connect();
            $sentencia = "SELECT c.padecimiento,c.id_consulta,c.fecha,CONCAT(d.nombre,' ',d.apaterno,' ',d.amaterno) as doctor  FROM consulta c join doctor d on d.id_doctor=c.id_doctor where id_paciente=:id_paciente";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_paciente',$id_paciente, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        function create($id_paciente,$padecimiento, $tratamiento){
            $dbh = $this->connect();
            $sentencia = "INSERT INTO consulta(id_paciente, id_doctor, padecimiento, tratamiento, fecha) values(:id_paciente, :id_doctor, :padecimiento, :tratamiento, now())";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);
            $id_doctor = $this->getIdDoctor($_SESSION['id_usuario']);
            $stmt->bindParam(':id_doctor', $id_doctor, PDO::PARAM_INT);
            $stmt->bindParam(':padecimiento', $padecimiento, PDO::PARAM_STR);
            $stmt->bindParam(':tratamiento', $tratamiento, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            return $resultado;
        }

        function readReceta($id_consulta){
            $dbh = $this->connect();
            $sentencia = "SELECT c.padecimiento,c.id_consulta,c.fecha,c.tratamiento,CONCAT(d.nombre,' ',d.apaterno,' ',d.amaterno) as doctor  FROM consulta c join doctor d on d.id_doctor=c.id_doctor where id_consulta=:id_consulta";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_consulta',$id_consulta, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }
    }


?>