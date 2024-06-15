<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estimacion por Intervalos</title>
    <style>

        h1{
            
            padding: 2%;
            margin: -3%;

        }
        h2{
            
            padding: 4%;
            margin: -4.1%;
        }

        h4{
            
            
            margin-top: 0; 
            margin-bottom: -6%; 
            padding-top: 2%;
        }

        .container {
            display: flex;
        }

        .left-column {
            flex: 0;
            padding: 20px;
        }
        /* Estilos CSS para alinear la imagen en el centro */
        .center-align {
            display: block;
            margin: 0 auto;
            position: relative;
        }
       
        /* Estilos CSS para posicionar los botones sobre la imagen */
        .button-container {
            position: relative;
            top: 0%; /* Ajusta la posición vertical de los botones */
            left: 50%; /* Ajusta la posición horizontal de los botones */
            transform: translateX(-50%); /* Centra horizontalmente los botones */
            text-align: center;
        }

            /* Estilos para el primer botón */
        .button-1 {
            padding: 14px 20px;
            margin: 0px 0px 0px;
            border: 1px solid #ccc;
            background-color: white;
            width: 26%;
            display: inline-block;
        }
               

        /* Estilos adicionales para el contenedor del formulario */
        .form-1 {
            border: 5px solid black;
            padding: 19px;
            width: 100%;
            margin: 0% auto;
            background-color: #DAD9D9; 
        }
        .form-2 {
            border: 5px solid black;
            padding: 16px;
            width: 50%;
            margin: 3% auto 48%;
            background-color: #7E7E7E;
        }

        .blue-box {
            border: 3px solid black;
            background-color: #99D9EA;
            padding: 6%;
            width: 86%;
            margin: 25px auto;
            text-align: center;
            color: black;
        }

        .blue-box .resultado {
            font-size: 245%; /* Tamaño de texto más grande para los resultados */
        }

        .blue-box p {
            font-size: 18px; /* Tamaño de texto más grande para los párrafos */
        }

        .scroll-button {
        position:fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
        color: black;
        
    }
    </style>
</head>
    <body   
    background="fondo.jpg" style="background-repeat: no-repeat;
	background-position: center center;
	background-attachment: fixed;
	background-size: cover;">
    

<div class="container">
    <div class="left-column">
        <div class="form-1">
            <h2>Por favor ingresa los Datos de la muestra</h2>
        <form method="post">
        <?php
        session_start();
        if (isset($_POST['resolver'])) {
            $desviacion = floatval($_POST['desviacion']);
            $confianza = ($_POST['confianza']);
            $media = ($_POST['media']);
            
            $_SESSION['desviacion'] = $desviacion;
            $_SESSION['confianza'] = $confianza;
            $_SESSION['media'] = $media;
        } else {
            // Utilizar los valores existentes en la sesión
            $desviacion = isset($_SESSION['desviacion']) ? $_SESSION['desviacion'] : '';
            $confianza = isset($_SESSION['confianza']) ? $_SESSION['confianza'] : '';
            $media = isset($_SESSION['media']) ? $_SESSION['media'] : '';
        }
        $muestra = $_SESSION['muestra'];
        echo "<h3>Tamaño de muestra de: $muestra </h3>";
        echo "<tr>";
        echo "<h4>Inserte la media muestral:</h4><br>";
        echo "<td><input type='number' name='media' placeholder='Media muestral' value='$media' /></td>";
        echo "</tr>";
        echo "<tr>";
        echo "<h4>Inserte la desviación estandar</h4><br>";
        echo "<td><input type='number' name='desviacion' placeholder='Desviacion estandar'step='any' value='$desviacion' /></td>";
        echo "</tr>";
        echo "<tr>";
        echo "<h4>Inserte el nivel de confianza:
        (Números permitidos: 90, 95, 99)</h4><br>";
        echo "<td><input type='number' name='confianza' placeholder='Nivel de Confianza' value='$confianza' /></td>";
        echo "</tr>";
        ?>
    
</div>
</div>
    
<tr>
<div class="form-2">
<h1>Calculadora</h1>
<a href="Index.php" class="scroll-button">Regresar</a>

<?php
echo "<div class='blue-box'>";
    if(isset($_POST['resolver'])) {
    $desviacion = floatval($_POST['desviacion']);
    $confianza = ($_POST['confianza']);
    $media = ($_POST['media']);

    if ($desviacion <= 0 || $media <= 0 ) {
        echo " <h2>Por favor ingrese un número válido</h2>"; // Mensaje de error
    } else {
    
        // Guardar los valores en la sesión
        $_SESSION['desviacion'] = $desviacion;
        $_SESSION['confianza'] = $confianza;
        $_SESSION['media'] = $media;


    $desviacion = floatval($_POST['desviacion']);
    $confianza = ($_POST['confianza']);
    $media = ($_POST['media']);
    $resultado = sqrt($muestra);
    $resultado = number_format($resultado,4);
    $resultado = $desviacion / $resultado;
    $resultado = number_format($resultado,4);
    
   

    if($confianza == 90){    
        
        $confianza =1.645;
        $resultadon = $media - ($confianza * $resultado);
        $resultadon = number_format($resultadon,4);
        
        $resultados = $media + ($confianza * $resultado);
        $resultados = number_format($resultados,4);

       echo "<h2>El intervalo se encuentra desde ($resultadon) a ($resultados)</h2>";
    

    }
    elseif($confianza == 95){    
        
        $confianza =1.96;
        $resultadon = $media - ($confianza * $resultado);
        $resultadon = number_format($resultadon,4);
        
        $resultados = $media + ($confianza * $resultado);
        $resultados = number_format($resultados,4);

       echo "<h2>El intervalo se encuentra desde ($resultadon) a ($resultados)</h2>";
    

    }
    elseif($confianza == 99){    
        
        $confianza =2.575;
        $resultadon = $media - ($confianza * $resultado);
        $resultadon = number_format($resultadon,4);
        
        $resultados = $media + ($confianza * $resultado);
        $resultados = number_format($resultados,4);

        echo "<h2>El intervalo se encuentra desde ($resultadon) a ($resultados)</h2>";
    

    }else{
        echo " <h2>Por favor ingrese un número válido</h2>"; // Mensaje de error
    }
       

echo "</div>";


    }
}
?>
        <div class="button-container">
        <button type="submit" class="button-1" name="resolver">Resolver</button>
        </div>
        
</form>
</div>
</div>
<div style="position: fixed; bottom: 10px; left: 10px;">
    <div class="form-1" style="width: 90%; background-color: rgba(255, 255, 255, 0.9); border: 4px solid black; padding: 10px;">
    <h3 style="margin-bottom: 10px; font-weight: normal;">Instrucciones:</h3>
        <form action="">
        <h4 style="margin-bottom: 10px; font-weight: normal;">1- Rellenar todos los datos correctamente</h4>
        <h4 style="margin-bottom: 10px; font-weight: normal;">2- Para realizar otra operación solo debe modificar los valores anteriores y presionar el boton de nuevo</h4>
        <h4 style="margin-bottom: 10px; font-weight: normal;">3- Si desea regresar, presionar el boton abajo a la derecha</h4>
        </form>
    </div>
</body>
</html>