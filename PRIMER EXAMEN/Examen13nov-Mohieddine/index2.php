<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <fieldset style="display: inline;">
        <legend>Ventana Entradas</legend>
        <form action="#" method="POST">
            <label for="idNombre">Nombre Completo</label><br>
            <input type="text" id="idNombre" name="nombre" value="<?php echo isset($_POST['nombre'])?$_POST['nombre']:'';?>">
            <br>
            <br>
            <label>Tipo de entrada</label><br>
            <input type="radio" name="entrada" id="idGeneral" value="General" <?php echo isset($_POST['entrada']) && $_POST['entrada'] == "General" ? 'checked' : ''; ?> checked>
            <label for="idGeneral">General</label>
            <input type="radio" name="entrada" id="idMayor" value="Mayor" <?php echo isset($_POST['entrada']) && $_POST['entrada'] == "Mayor" ? 'checked' : ''; ?>>
            <label for="idMayor">Mayor de 60</label>
            <input type="radio" name="entrada" id="idMenor" value="Menor" <?php echo isset($_POST['entrada']) && $_POST['entrada'] == "Menor" ? 'checked' : ''; ?>>
            <label for="idMenor">Menor jde 6 años</label>
            <br>
            <br>
            <label for="idFecha">Fecha del Evento</label><br>
            <input type="date" name="fecha" id="idFecha" value=<?php echo isset($_POST['fecha'])?$_POST['fecha']:date('Y-m-d');?>>
            <br>
            <br>
            <label for="idNum">Número de entradas</label><br>
            <input type="number" name="numeroEnt" id="idNum" value=<?php echo isset($_POST['numeroEnt'])?$_POST['numeroEnt']:'';?>>
            <br>
            <br>
            <label>Descuentos</label><br>
            <select name="descuento[]" multiple='multiple'>
                <option value="sinDes">SinDescuento</option>
                <option value="famNum">FamiliaNumerosa</option>
                <option value="abonado">Abonado</option>
                <option value="diaEspec">DiadelEspectador</option>
            </select>
            <br>
            <br>
            <input type="submit" name="comprar" value="comprar">
        </form>
     </fieldset>

     <?php
     
        if(isset($_POST['comprar'])){

            $error=array();

            if(empty($_POST['nombre']) || empty($_POST['entrada']) || empty($_POST['fecha']) || empty($_POST['numeroEnt'])){
                $error[]='Los campos NOMBRE,ENTRADA,FECHA Y NUMERO DE ENTRADAS deben estar rellenos';
            }elseif(isset($_POST['numeroEnt'])){
                if($_POST['numeroEnt'] < 1 || $_POST['numeroEnt'] > 4){
                    $error[]='El número de entradas debe estar entre el 1 y el 4';
                }
            }

            if($error!=null){

            echo '<h1>Errores</h1>';
            echo '<ul>';
            foreach($error as $err){

                echo '<li>'.$err.'</li>';
            }

            echo '</ul>';


            }else{

                $precioEntrada=0;
                $precioTotal=0;
                $numeroEnt=$_POST['numeroEnt'];

                if($_POST['entrada']=='General'){
                    $precioEntrada=10;
                    $precioTotal = $precioEntrada*$numeroEnt;
                    
                }elseif($_POST['entrada']=='Mayor'){
                    $precioEntrada=8;
                    $precioTotal = $precioEntrada*$numeroEnt;
                }elseif($_POST['entrada']=='General'){
                    $precioEntrada=5;
                    $precioTotal = $precioEntrada*$numeroEnt;
                }


                echo '<table border=1>';
                echo '<tr>';
                echo '<h1>Ticket compra</h1>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>Nombre</th>';
                echo'<td>'.$_POST['nombre'].'</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>Tipo Entrada</th>';
                echo'<td>'.$_POST['entrada'].'</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>Nº entradas</th>';
                echo'<td>'.$_POST['numeroEnt'].'</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>Descuentos</th>';
                echo'<td>'.implode('/',$_POST['descuento']).'</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>Total</th>';
                echo'<td>'.$precioTotal.'</td>';
                echo '</tr>';

                echo '</table>';               



            }

        }

     ?>
</body>
</html>