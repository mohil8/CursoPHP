<?php

    require_once 'Modelo.php';
    require_once 'Estancia.php';

    $modelo=new Modelo();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="#" method="POST">
        <h1>CREACIÓN DE ESTANCIA</h1>
        <br>
        <label for="idDni">DNI</label><br>
        <input type="text" id="idDni" name="dni" value="<?php echo isset($_POST['dni'])?$_POST['dni']:'';?>">
        <br>
        <label for="idNombre">Nombre Cliente</label><br>
        <input type="text" id="idNombre" name="nombre" value="<?php echo isset($_POST['nombre'])?$_POST['nombre']:'';?>">
        <br>
        <br>
        <label>Tipo de Habitación</label><br>
        <select name="tipo">
            <option value="Doble" selected>Doble</option>
            <option value="Individual">Individual</option>
            <option value="Suite">Suite</option>
        </select>
        <br>
        <br>
        <label for="idNoches">Nº de Noches</label><br>
        <input type="number" id="idNoches" name="noches" value="<?php echo isset($_POST['noches'])?$_POST['noches']:'';?>">
        <br>
        <label>Estancia</label><br>
        <select name="estancia" > 
            <option value='Diario' <?php echo isset($_POST['estancia']) && $_POST['estancia']=='Diario'?'selected':'';?> selected>Diario</option>
            <option value="finSemana" <?php echo isset($_POST['estancia']) && $_POST['estancia']=='finSemana'?'selected':'';?>>Fin de Semana</option>
            <option value="Promocionado" <?php echo isset($_POST['estancia']) && $_POST['estancia']=='Promocionado'?'selected':'';?>>Promocionado</option>
        </select>
        <br>
        <br>
        <label for="idPago">Pago</label><br>
        <input type="radio" name="pago" id="idEfectivo" value="Efectivo" <?php echo isset($_POST['pago']) && $_POST['pago']=='Efectivo'?'checked':'';?>>
        <label for="idEfectivo">Efectivo</label>
        <input type="radio" name="pago" id="idTarjeta" value="Tarjeta" <?php echo isset($_POST['pago']) && $_POST['pago']=='Tarjeta'?'checked':'';?>>
        <label for="idTarjeta">Tarjeta</label>
        <br>
        <br>
        <label>Opciones</label><br>
        <input type="checkbox" id="idCuna" name="opciones[]" value="cuna">
        <label for="idCuna">Cuna</label>
        <input type="checkbox" id="idCama" name="opciones[]" value="cama">
        <label for="idCama">Cama Supletoria</label>
        <input type="checkbox" id="idLavanderia" name="opciones[]" value="lavanderia">
        <label for="idLavanderia">Lavandería</label>
        <br><br>
        <input type="submit" name="crear" value="Crear Estancia">
    </form>

    <?php
    
    if(isset($_POST['crear'])){

        $error=array();

        if(empty($_POST['dni']) || empty($_POST['nombre']) || empty($_POST['noches']) || empty($_POST['pago'])){
            $error[]='Los campos DNI, NOMBRE DEL CLIENTE ,NOCHES y Pago no pueden estar vacios';
        }elseif(isset($_POST['pago']) && isset($_POST['noches']) && $_POST['pago']=='Efectivo' && $_POST['noches']>1){
            $error[]='No se puede pagar en EFECTIVO por más de 1 noche';
        }elseif (isset($_POST['opciones']) && is_array($_POST['opciones'])) {
            if (in_array('cuna', $_POST['opciones']) && in_array('cama', $_POST['opciones'])) {
                $error[] = 'No puedes elegir Cuna y Cama Supletoria a la vez';
            }
        }
        

        if($error!=null){
            echo '<h1 style="color:red;">ERRORES</h1><br>';
            echo '<ul>';
            foreach($error as $err){
                echo '<li>'.$err.'</li>';
            }
            echo '</ul>';
        }else{
            echo '<h1>Datos introducidos correctamente</h1>';
            
            $precioHabitacion=0;
            $precioTotal=0;

            if($_POST['tipo']=='Individual'){
                $precioHabitacion=45;
            }elseif($_POST['tipo']=='Doble'){
                $precioHabitacion=55;
            }elseif($_POST['tipo']=='Suite'){
                $precioHabitacion=75;
            }

            if ($_POST['estancia'] == 'finSemana') {
                $precioTotal = ($_POST['noches'] * $precioHabitacion) + ($_POST['noches'] * $precioHabitacion * 0.1); // Incremento del 10%
            } elseif ($_POST['estancia'] == 'Promocionado') {
                $precioTotal = ($_POST['noches'] * $precioHabitacion) - ($_POST['noches'] * $precioHabitacion * 0.1); // Descuento del 10%
            } else {
                $precioTotal = $_POST['noches'] * $precioHabitacion; // Sin descuento ni incremento
            }
            
            echo '<h1>El precio de la habitación es '.$precioHabitacion.'€ y el precio total es de '.$precioTotal.'€. </h1>';
            $estancia = new Estancia($_POST['dni'],$_POST['nombre'],$_POST['tipo'],$_POST['noches'],$_POST['estancia'],$_POST['pago'],isset($_POST['opciones']) ? $_POST['opciones'] : []);
            $modelo->rellenarFichero($estancia);
        }
        
       

    }
    
    
    ?>
</body>
</html>