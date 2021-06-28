<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error{
            color: red;
        }
        .success{
            color: green;
        }
    </style>
</head>
<body>
    <form action="suma.php" method="get">
        <input type="number" name="a" id="a" oninput="validar()">
        <input type="number" name="b" id="b" oninput="validar()">
        <button type="submit" name="sumar" id="sumar" onclick="" disabled>Sumar</button>
    </form>
    <p class="pt" id="sumando"></p>
    <?php 
        if (isset($_GET['sumar'])){
            $a = $_GET['a'];
            $b = $_GET['b'];
            if(is_numeric($a) && is_numeric($b)){
                $resultado = $a + $b;
                echo '<p class="success">La suma es a: '.$resultado.'</p>';
            }else{
                echo '<p class="error">no te pases de lanza</p>';
            }
        }

        
    ?>

    <script>     
    
    function validar(){
        
        var a = document.getElementById("a").value;
        var b = document.getElementById("b").value;
        var button = document.getElementById("sumar");
        var p = document.getElementById("sumando");
        
        a = parseFloat(a);
        b = parseFloat(b);        
        if (!isNaN(b) && !isNaN(a)) {
            suma=a+b; 
            text= suma;
            button.disabled = false;
            p.innerHTML = text;  
            p.setAttribute('class', 'success');            
        }else{
            p.setAttribute('class', 'error'); 
            text = "Es necesarios introducir dos números válidos";  
            button.disabled = true;
            p.innerHTML = text;  
            
        }
    }
    </script>  
</body>

</html>

