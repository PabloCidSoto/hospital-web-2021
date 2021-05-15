<?php
    class Sistema{
        var $dsn = 'mysql:host=localhost;dbname=hospital';
        var $user = 'hospital';
        var $password = '123';

        function connect(){
            $dbh = new PDO($this->dsn,$this->user,$this->password);
            return $dbh;
        }

        
    }
?>