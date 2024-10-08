<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen1</title>
</head>
<body>
    <form action="Ejercicio1_datos.php" method= "POST">
        <label for="cli">Tipo de cliente</label><br>
        <select name="tipo" id="cli">
            <option value="Empresa" selected>Empresa</option>
            <option value="Particular">Particular</option>
            <option value="Organismo Publico">Organismo Publico</option>
        </select>
        <br><br>
        <label for="nomCliente">Nombre Cliente</label><br>
        <input type="text" id="nomCliente" name="cliente">
        <br>
        <label for="email">Email</label><br>
        <input type="text" id="email" name="email">
        <br><br>
        <label for="tipMotor">Tipo de Motor</label><br>
        <input type="radio" name="motor" id="diesel" value="Diesel" checked>
        <label for="diesel">Diesel</label>
        <input type="radio" name="motor" id="gasolina" value="Gasolina">
        <label for="gasolina">Gasolina</label>
        <input type="radio" name="motor" id="camara" value="Camara">
        <label for="camara">Cámara</label>
        <br><br>
        <label>Opciones</label><br>
        <input type="checkbox" name="opc[]" id="idClim" value="Climatizador">
        <label for="idClim">Climatizador</label>
        <input type="checkbox" name="opc[]" id="idGPS" value="GPS">
        <label for="idGPS">GPS</label>
        <input type="checkbox" name="opc[]" id="idCam" value="Camara">
        <label for="idCam">Cámara</label>
        <br><br>
        <label>Selecciona vehículo</label><br>
        <select name="vehiculo">
        <option value="Audi-A3">Audi A3</option>
        <option value="BMW S6">BMW S6</option>
        <option value="Mercedes-Benz">Mercedes Benz</option>
        <option value="Tesla">Tesla</option>
        </select>
        <label for="precio">Precio €</label>
        <input type="number" name="precio" id="precio">
        <br><br>
        <label>Selecciona promoción</label>
        <select name="promocion">
            <option value="Plan Renove">Plan Renove(-2000)</option>
            <option value="Plan Green">Plan Green(-2500)</option>
            <option value="Sin Promocion">Sin Promocion</option>
        </select>
        <br><br>
        <input type="submit" name="enviar" value="Enviar">

    </form>    

    <?php
    
    if(isset($_POST['enviar'])){

        $errores=[];

        if(empty($_POST['cliente']) || empty($_POST['email']) || empty($_POST['precio'])){
            $error[]="Nombre del cliente,Email o Precio vacio";
        }

    }

    ?>
</body>
</html>