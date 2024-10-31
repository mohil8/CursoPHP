<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen</title>
</head>
<body>
    <form action="#" method="POST">
        <label for="peli">Titulo de la Pelicula</label><br>
        <input type="text" id="peli" name="titulo" value="<?php echo isset($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : ''; ?>">
        <br>
        <input type="date" id="idFecha" name="fecha" value="<?php echo date('Y-m-d');?>" 
        value="<?php echo isset($_POST['fecha']) ? htmlspecialchars($_POST['fecha']) : ''; ?>">
        <br>
        <label>Genero</label><br>
        <select name="genero"  multiple="multiple">
            <option value="Comedia">Comedia</option>
            <option value="Drama">Drama</option>
            <option value="Terror">Terror</option>
            <option value="Aventura">Aventura</option>
        </select>
        <br>
        <label>Tipo</label><br>
        <input type="radio" name="tipo" id="idPeli" value="Pelicula" <?php echo isset($_POST['tipo']) && $_POST['tipo'] == "Pelicula" ? 'checked' : ''; ?> checked> 
        <label for="idPeli">Pelicula</label>
        <input type="radio" name="tipo" id="idSerie" value="Serie" <?php echo isset($_POST['tipo']) && $_POST['tipo'] == "Serie" ? 'checked' : ''; ?>>
        <label for="idSerie">Serie</label>
        <br>
        <label for="idCap">Nº Capítulos</label><br>
        <input type="number" name="numero" id="idCap" value="<?php echo isset($_POST['numero']) ? htmlspecialchars($_POST['numero']) : ''; ?>" >
        <br><br>
        <input type="submit" name="guardar" value="Guardar">
    </form>

    <?php
    

    if (isset($_POST['guardar'])) {
        
       //Creamos el array donde almacenamos los errores
        $errores = [];

        if (empty($_POST['titulo']) || empty($_POST['fecha']) || empty($_POST['numero']) ||  empty($_POST['genero'])) {
            $errores[] = "Algún campo no está rellenado";
        }

        if (isset($_POST['tipo']) && $_POST['tipo'] == "Serie" && $_POST['numero'] <=1) {
            $errores[] = "Si eliges serie no puedes tener solo 1 capitulo";
        }


        //Si el array errores tiene algo dentro te salta el error
        if (!empty($errores)) {
            echo "<h3>Se encontraron los siguientes errores:</h3><ul>";
            foreach ($errores as $err) {
                echo "<li>" . htmlspecialchars($err) . "</li>";
            }
            echo "</ul>";
        } else {

            // Incluimos el fichero pelicula y creamos una pelicula
            include 'Pelicula.php';
            $pelicula = new Pelicula($_POST['titulo'],$_POST['fecha'],$_POST['genero'],$_POST['tipo'],$_POST['numero']);
            $pelicula->guardar();

            
            echo "<h1>Datos Correctos</h1>";
            // Si elegimos pelicula imprime una cosa y si elegimos serie otra
            if($_POST['tipo']==='Pelicula'){
                echo "<h1>Pelicula: ".$_POST['titulo']."</h1>";
            }elseif($_POST['tipo' ]==='Serie'){
                echo "<h1>Serie: ".$_POST['titulo']."</h1>";
            }
            echo "<h1>Genero: ".$_POST['genero']."</h1>";

        }

        //Si existe el fichero recoge los datos opr lineas , las separa en un array y las introduce a la tabla
        if (file_exists('pelicula.txt')) {
            $pelicula = file('pelicula.txt', FILE_IGNORE_NEW_LINES);
            if ($pelicula) {
                echo "<h2>Lista de Peliculas:</h2>";
                echo "<table border='1'>";
                echo "<tr><th>Titulo</th><th>Fecha</th><th>Género</th><th>Tipo</th><th>Capitulos</th>";
                
                foreach ($pelicula as $peli) {
                    $datos = explode(';', $peli);
                    echo "<tr>";
                    foreach ($datos as $dato) {
                        echo "<td>" . htmlspecialchars($dato) . "</td>";
                    }
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<h3>No hay peliculas registradas.</h3>";
            }
        } else {
            echo "<h3>No se encontró el archivo de peliculas.</h3>";
        }

        
    }


    
    ?>
</body>
</html>