<?php
    require_once('sistema.controller.php');

    class Producto extends Sistema{
        var $id_producto;
        var $producto;
        var $precio;
        var $id_tipo_producto;
        
        function getId_Producto(){
            return $this->id_producto;
        }
        function setId_Producto($id_producto){
            return $this->id_producto = $id_producto;
        }

        function getProducto(){
            return $this->producto;
        }
        function setProducto($producto){
            return $this->producto = $producto;
        }

        function getPrecio(){
            return $this->precio;
        }
        function setPrecio($precio){
            return $this->precio = $precio;
        }
        
        function getId_Tipo_Producto(){
            return $this->id_tipo_producto;
        }
        function setId_Tipo_Producto($id_tipo_producto){
            return $this->id_tipo_producto = $id_tipo_producto;
        }

        function create($producto, $precio, $id_tipo_producto){
            $dbh = $this->connect();
            $sentencia = "INSERT INTO producto(producto, precio, id_tipo_producto) values(:producto, :precio, :id_tipo_producto)";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':producto',$producto, PDO::PARAM_STR);
            $stmt->bindParam(':precio',$precio, PDO::PARAM_INT);
            $stmt->bindParam(':id_tipo_producto',$id_tipo_producto, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            return $resultado;
        }

        function read(){
            $dbh = $this->connect();
            $sentencia = "SELECT * FROM producto";
            $stmt = $dbh->prepare($sentencia);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        function readOne($id){
            $dbh = $this->connect();            
            $sentencia = "SELECT * FROM producto where id_producto=:id_producto";
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_producto',$id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        function update($id_producto, $producto, $precio, $id_tipo_producto){
            $dbh = $this->connect();
            $sentencia = "UPDATE producto set producto = :producto, precio = :precio, id_tipo_producto = :id_tipo_producto where id_producto = :id_producto"; 
            $stmt = $dbh->prepare($sentencia);
            $stmt->bindParam(':id_producto',$id_producto, PDO::PARAM_INT);
            $stmt->bindParam(':producto',$producto, PDO::PARAM_STR); 
            $stmt->bindParam(':precio',$precio, PDO::PARAM_INT);
            $stmt->bindParam(':id_tipo_producto',$id_tipo_producto, PDO::PARAM_INT);
            $resultado = $stmt->execute();           
            return $resultado;
        }

        function delete($id){
            $dbh = $this->connect();
            $sentencia = "DELETE FROM producto where id_producto = :id_producto";
            $stmt = $dbh->prepare($sentencia);            
            $stmt->bindParam(':id_producto',$id, PDO::PARAM_INT);
            $resultado = $stmt->execute();           
            return $resultado;
        }
    }    

?>