<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen</title>
</head>
<body>
    <form action="#" method="post">
        <label for="dni">DNI</label><br>
        <input type="text" id="dni" name="dni" required>
        <br>
        <label for="nomCliente">Nombre del Cliente</label><br>
        <input type="text" id="nomCliente" name="cliente" required>
        <br><br>
        <label for="idHab">Tipo de Habitación</label><br>
        <select name="habitacion" id="idHab">
            <option value="Doble" <?php echo isset($_POST['habitacion']) && $_POST['habitacion'] == "Doble" ? 'selected' : ''; ?>>Doble</option>
            <option value="Individual" <?php echo isset($_POST['habitacion']) && $_POST['habitacion'] == "Individual" ? 'selected' : ''; ?>>Individual</option>
            <option value="Suite" <?php echo isset($_POST['habitacion']) && $_POST['habitacion'] == "Suite" ? 'selected' : ''; ?>>Suite</option>
        </select>
        <br><br>
        <label for="numNoches">Nº noches</label><br>
        <input type="number" id="numNoches" name="noches" required>
        <br>
        <label for="idEstancia">Estancia</label><br>
        <select name="estancia" id="idEstancia">
            <option value="Diario" <?php echo isset($_POST['estancia']) && $_POST['estancia'] == "Diario" ? 'selected' : ''; ?>>Diario</option>
            <option value="Fin de semana" <?php echo isset($_POST['estancia']) && $_POST['estancia'] == "Fin de semana" ? 'selected' : ''; ?>>Fin de semana</option>
            <option value="Promocionado" <?php echo isset($_POST['estancia']) && $_POST['estancia'] == "Promocionado" ? 'selected' : ''; ?>>Promocionado</option>
        </select>
        <br><br>
        <label for="idPago">Pago</label><br>
        <input type="radio" id="efectivo" name="pago" value="Efectivo" <?php echo isset($_POST['pago']) && $_POST['pago'] == "Efectivo" ? 'checked' : ''; ?>>
        <label for="efectivo">Efectivo</label>
        <input type="radio" id="tarjeta" name="pago" value="Tarjeta" <?php echo isset($_POST['pago']) && $_POST['pago'] == "Tarjeta" ? 'checked' : ''; ?>>
        <label for="tarjeta">Tarjeta</label>
        <br><br>
        <label for="idOpc">Opciones</label><br>
        <input type="checkbox" id="cuna" name="opc[]" value="Cuna" <?php echo isset($_POST['opc']) && in_array("Cuna", $_POST['opc']) ? 'checked' : ''; ?>>
        <label for="cuna">Cuna</label>
        <input type="checkbox" id="cama" name="opc[]" value="Cama" <?php echo isset($_POST['opc']) && in_array("Cama", $_POST['opc']) ? 'checked' : ''; ?>>
        <label for="cama">Cama</label>
        <input type="checkbox" id="lavanderia" name="opc[]" value="Lavanderia" <?php echo isset($_POST['opc']) && in_array("Lavanderia", $_POST['opc']) ? 'checked' : ''; ?>>
        <label for="lavanderia">Lavandería</label>
        <br><br>
        <input type="submit" name="validar" value="Crear Instancia">
        <input type="submit" name="ver" value="Ver Estancia">
    </form>

    <?php
    // Incluir la clase Estancia
    include 'Estancia.php';

    if (isset($_POST['validar'])) {
        // Verificación de datos y creación del objeto
        $errores = [];

        if (empty($_POST['dni']) || empty($_POST['cliente']) || empty($_POST['noches'])) {
            $errores[] = "Algún campo no está rellenado";
        }

        if (isset($_POST['pago']) && $_POST['pago'] == "Efectivo" && $_POST['noches'] > 2) {
            $errores[] = "No puedes pagar en efectivo si son más de dos noches";
        }

        if (in_array('Cama', $_POST['opc']) && in_array('Cuna', $_POST['opc'])) {
            $errores[] = "No se puede seleccionar una cuna y una cama supletoria a la vez";
        }

        if (!empty($errores)) {
            echo "<h3>Se encontraron los siguientes errores:</h3><ul>";
            foreach ($errores as $err) {
                echo "<li>" . $err . "</li>";
            }
            echo "</ul>";
        } else {
            // Crear objeto Estancia y guardarlo
            $estancia = new Estancia($_POST['dni'], $_POST['cliente'], $_POST['habitacion'], $_POST['noches'], $_POST['estancia'], $_POST['pago'], $_POST['opc']);
            $estancia->guardar();

            echo "<h1>Registro creado correctamente.</h1>";
        }
    }

    if (isset($_POST['ver'])) {
        // Leer y mostrar las estancias
        if (file_exists('estancias.txt')) {
            $estancias = file('estancias.txt', FILE_IGNORE_NEW_LINES);
            if ($estancias) {
                echo "<h2>Lista de Estancias:</h2>";
                echo "<table border='1'>";
                echo "<tr><th>DNI</th><th>Cliente</th><th>Habitación</th><th>Noches</th><th>Estancia</th><th>Pago</th><th>Cuna</th><th>Cama</th><th>Lavandería</th></tr>";
                
                foreach ($estancias as $estancia) {
                    $datos = explode(';', $estancia);
                    echo "<tr>";
                    foreach ($datos as $dato) {
                        echo "<td>" . htmlspecialchars($dato) . "</td>";
                    }
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<h3>No hay estancias registradas.</h3>";
            }
        } else {
            echo "<h3>No se encontró el archivo de estancias.</h3>";
        }
    }
    ?>
</body>
</html>
