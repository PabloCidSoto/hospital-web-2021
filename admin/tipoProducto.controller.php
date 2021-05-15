<?php 
    require_once('sistema.controller.php');

    /*Clase principal para tipo producto*/
    
    class TipoProducto extends Sistema{
        var $idTipoProducto;
        var $tipoProducto;

        function getIdProducto(){
            return $this->idTipoProducto;
        }
        function setIdProducto($idTipoProducto){
            $this->idTipoProducto = $idTipoProducto;
        }

        function getTipoProducto(){
            return $this->tipoProducto;
        }
        function setTipoProducto($tipoProducto){
            $this->tipoProducto = $tipoProducto;
        }

        function create($tipoProducto){
            $dbh = $this->connect();
            $sentencia = "INSERT INTO tipo_producto (tipo_producto) values(:tipo_producto)"; 
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':tipo_producto',$tipoProducto, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            return $resultado;
        }

        function read(){
            $dbh = $this->connect();
            $sentencia = "SELECT * FROM tipo_producto";
            $stmt = $dbh->prepare($sentencia);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        function readOne($id){
            $dbh = $this->connect();            
            $sentencia = "SELECT * FROM tipo_producto where id_tipo_producto = :id_tipo_producto";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_tipo_producto',$id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        function update($id, $tipoProducto){
            $dbh = $this->connect();
            $sentencia = "UPDATE tipo_producto set tipo_producto = :tipo_producto where id_tipo_producto = :id_tipo_producto"; 
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_tipo_producto',$id, PDO::PARAM_INT);
            $stmt->bindParam(':tipo_producto',$tipoProducto, PDO::PARAM_STR);            
            $resultado = $stmt->execute();           
            return $resultado;
        }

        function delete($id){
            $dbh = $this->connect();
            $sentencia = "DELETE FROM tipo_producto where id_tipo_producto = :id_tipo_producto";
            $stmt = $dbh->prepare($sentencia);            
            $stmt->bindParam(':id_tipo_producto',$id, PDO::PARAM_INT);
            $resultado = $stmt->execute();           
            return $resultado;
        }
    }
?>