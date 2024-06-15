<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Puntual</title>
    <style>

        h1{
            
            padding: 2%;
            margin: -3%;

        }
        h2{
            
            padding: 4%;
            margin: -4.1%;
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
            width: 19%;
            display: inline-block;
        }

        /* Estilos para el segundo botón */
        .button-2 {
            padding: 14px 20px;
            margin: 0px 0px 0px;
            border: 1px solid #ccc;
            background-color: white;
            width: 19%;
            display: inline-block;
        }


        /* Estilos para el tercer botón */
        .button-3 {
            padding: 14px 20px;
            margin: 0px 0px 0px;
            border: 1px solid #ccc;
            background-color: white;
            width: 19%;
            display: inline-block;
        }

        /* Estilos para el cuarto botón */
        .button-4 {
            padding: 14px 20px;
            margin: 0px 0px 0px;
            border: 1px solid #ccc;
            background-color: white;
            width: 19%;
            display: inline-block;
        }

        /* Estilos para el quinto botón */
        .button-5 {
            padding: 14px 20px;
            margin: 0px 0px 0px;
            border: 1px solid #ccc;
            background-color: white;
            width: 19%;
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
            padding: 42px;
            width: 86%;
            margin: 20px auto;
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
            <h2>Por favor ingresa los Datos de la muestra:</h2>
        <form method="post">
        <?php
        session_start();
        
        if(isset($_SESSION['muestra'])){
            $muestra = $_SESSION['muestra'];
            $campos_por_seccion = 10;
            $secciones = ceil($muestra / $campos_por_seccion); // Calcular el número de secciones necesarias
            
            for ($s = 0; $s < $secciones; $s++) {
                echo "<div class='seccion'>";
                echo "<br></br>";
                echo "<table>"; // Inicio de la tabla de la sección
                for ($d = 1 + ($s * $campos_por_seccion); $d <= min(($s + 1) * $campos_por_seccion, $muestra); $d++) {
                    echo "<tr>";
                    echo "<td>Dato $d:</td>";
                    echo "<td><input type='text' name='dato_$d' value='" . (isset($_POST['dato_'.$d]) ? $_POST['dato_'.$d] : '') . "'></td>";
                    echo "</tr>";
                }
                echo "</table>"; // Fin de la tabla de la sección
                echo "</div>";
            }
        } 
        ?>
    
</div>
</div>
    
<tr>
<div class="form-2">
<h1>Calculadora</h1>
<a href="Index.php" class="scroll-button">Regresar</a>

<?php
echo "<div class='blue-box'>";
    if(isset($_POST['calcular_media']) || isset($_POST['calcular_mediana']) || isset($_POST['calcular_moda']) || isset($_POST['calcular_varianza']) || isset($_POST['calcular_desviacion'])) {
    
    //se presiono el boton de Media?  
    $muestra = $_SESSION['muestra'];
    $datos = array();
    $suma_de_datos = 0;

    for ($i = 1; $i <= $muestra; $i++) {
        if(isset($_POST['dato_'.$i]) && is_numeric($_POST['dato_'.$i])){
            $datos[] = $_POST['dato_'.$i];
            $suma_de_datos += $_POST['dato_'.$i];
        }
    }
    
    $suma_de_datos= floatval($suma_de_datos);
    $muestra= floatval($muestra);
    $resultm=$suma_de_datos/$muestra;
         
    if(isset($_POST['calcular_media'])){
        echo "<span class='resultado'>Media = $resultm </span>";
        }
   
    //se presiono el boton de Mediana?

    sort($datos); // Ordenar los datos de menor a mayor
    
    $num_datos = count($datos);
    $indice_central = floor($num_datos / 2); // Índice central
    
    if($num_datos % 2 == 0){ // Si el número de datos es par
        $mediana = ($datos[$indice_central - 1] + $datos[$indice_central]) / 2;
    } else { // Si el número de datos es impar
        $mediana = $datos[$indice_central];
    }
   
     if(isset($_POST['calcular_mediana'])){
    echo "<span class='resultado'>Mediana = $mediana</span>";
    }
   

    //se presiono el boton de Moda?
   
    if(isset($_POST['calcular_moda'])){
    $frecuencias = array_count_values($datos);
    arsort($frecuencias); // Ordenar las frecuencias de mayor a menor

    $modas = array_keys($frecuencias, max($frecuencias));
    if (count($modas) == count($datos)) {
        echo "<span class='resultado'>No hay moda</span>";
    } else {
        echo "<span class='resultado'>Moda = " . implode(", ", $modas) . "</span>";
    }
}
    //se presiono el boton de Varianza? 
    $muestra = $_SESSION['muestra'];
    $datos = array();
    $suma_de_datos_cuadrados = 0;
        
        for ($i = 1; $i <= $muestra; $i++) {
            if(isset($_POST['dato_'.$i]) && is_numeric($_POST['dato_'.$i])){
                $datos[] = $_POST['dato_'.$i];
                $suma_de_datos_cuadrados += pow($_POST['dato_'.$i], 2);
                }
            }
                $suma_de_datos_cuadrados= $suma_de_datos_cuadrados;
                $resultv= pow($resultm,2);
                $resultv= $muestra * $resultv;
                $resultv = $suma_de_datos_cuadrados - $resultv;
                $resultv = $resultv / ($muestra - 1);
                $resultv = floatval($resultv);



    if(isset($_POST['calcular_varianza'])){
        echo "<span class='resultado'>Varianza = $resultv</span>";

    }
    

    //se presiono el boton de Desviacion?
    $resultd= sqrt($resultv);
    if(isset($_POST['calcular_desviacion'])){
        echo "<span class='resultado'>Desviación estándar = $resultd</span>";
    }
    
    }

echo "</div>";



?>

        <div class="button-container">
        <button type="submit" class="button-1" name="calcular_media">Media</button>
        <button type="submit" class="button-2" name="calcular_mediana">Mediana</button>
        <button type="submit" class="button-3" name="calcular_moda">Moda</button>
        <button type="submit" class="button-4" name="calcular_varianza">Varianza</button>
        <button type="submit" class="button-5" name="calcular_desviacion">Desviacion</button>
        </div>
</form>
</div>
</div>

    </div>
    <div style="position: fixed; bottom: 10px; left: 10px;">
    <div class="form-1" style="width: 90%; background-color: rgba(255, 255, 255, 0.9); border: 4px solid black; padding: 10px;">
    <h3 style="margin-bottom: 10px; font-weight: normal;">Instrucciones:</h3>
        <form action="">
        <h4 style="margin-bottom: 10px; font-weight: normal;">1- Rellenar todos los datos correctamente</h4>
        <h4 style="margin-bottom: 10px; font-weight: normal;">2- Elegir una opcion a calcular presionando el boton con el nombre</h4>
        <h4 style="margin-bottom: 10px; font-weight: normal;">3- Solo se puede elegir una opción a la vez</h4>
        <h4 style="margin-bottom: 10px; font-weight: normal;">4- Para realizar otra operación solo debe modificar los valores anteriores y presionar el boton de nuevo</h4>
        <h4 style="margin-bottom: 10px; font-weight: normal;">5- Si desea regresar, presionar el boton abajo a la derecha</h4>
        </form>
    </div>
</body>
</html>
    
    

    
