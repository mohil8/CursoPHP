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
            <select name="descuentos[]" multiple="multiple">
                <option value="sinDescuento">Sin Descuento</option>
                <option value="Familia Numerosa">Familia Numerosa</option>
                <option value="Abonado">Abonado</option>
                <option value="Día del Espectador">Día del Espectador</option>
            </select>
            <br>
            <br>
            <input type="submit" name="comprar" value="comprar">
        </form>
     </fieldset>
</body>
</html>