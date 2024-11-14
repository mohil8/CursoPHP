<?php

require_once 'Modelos.php';
require_once 'Pelicula.php';

$modelo = new Modelo();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <fieldset style="display:inline;">
        <legend>Crear Película</legend>
        <form action="#" method="POST">
            <label for="idTitulo">Título de la película</label><br>
            <input type="text" id="idTitulo" name="titulo" value="<?php echo isset($_POST['titulo']) ? $_POST['titulo']:'';?>">
            <br>
            <label for="idFecha">Fecha de registro</label><br>
            <input type="date" id="idFecha" name="fecha" value="<?php echo isset($_POST['fecha'])?$_POST['fecha']:'';?>">
            <br>
            <label for="idGenero">Género</label><br>
            <select name="genero[]" id="idGenero" multiple="multiple">
                <option value="Comedia">Comedia</option>
                <option value="Drama">Drama</option>
                <option value="Terror">Terror</option>
                <option value="Aventura">Aventura</option>
            </select>
            <br>
            <label for="idTipo">Tipo</label><br>
            <input type="radio" name="tipo" id="idPelicula" value="Pelicula" <?php echo isset($_POST['tipo']) && $_POST['tipo']=='Pelicula'?'checked':''?> checked >
            <label for="idPelicula">Película</label>
            <input type="radio" name="tipo" id="idSerie" value="Serie" <?php echo isset($_POST['tipo']) && $_POST['tipo']=='Serie'?'checked':''?> >
            <label for="idSerie">Serie</label>
            <br>
            <label for="idCapitulos">Nº Capítulos</label><br>
            <input type="number" id="idCapitulos" name="capitulo" value="<?php echo isset($_POST['capitulo'])?$_POST['capitulo']:''?>">
            <br>
            <br>
            <input type="submit" name="guardar" value="Guardar">
        </form>
    </fieldset>

    <?php 
        // Verificar si el formulario se ha enviado
        if(isset($_POST['guardar'])){
            $error = array();

            if(empty($_POST['titulo']) || empty($_POST['fecha']) || empty($_POST['capitulo'])){
                $error[] = 'El campo título, fecha y capítulo no pueden estar vacíos';
            } elseif(isset($_POST['tipo']) && $_POST['tipo'] == 'Serie' && $_POST['capitulo'] < 2){
                $error[] = 'El número de capítulos de la serie debe ser mayor que dos';
            } elseif(empty($_POST['genero']) || sizeof($_POST['genero']) < 1){
                $error[] = 'Al menos se debe marcar un género';
            }

            if($error != null){
                echo '<h1 style="color:red;">Errores</h1><br>';
                echo '<ul>';
                foreach($error as $err){
                    echo '<li>'.$err.'</li>';
                }
                echo '</ul>';
            } else {
                // Guardar la película en el archivo
                $pelicula = new Peliculaa($_POST['titulo'], $_POST['fecha'], implode('/', $_POST['genero']), $_POST['tipo'], $_POST['capitulo']);
                $modelo->rellenarFichero($pelicula);
            }
        }

        // Obtener todas las películas guardadas en el archivo
        $peliculas = $modelo->obtenerPeliculas();
    ?>

    <!-- Mostrar todas las películas en una tabla -->
    <table border="1">
        <tr>
            <th>Título</th>
            <th>Fecha</th>
            <th>Géneros</th>
            <th>Tipo</th>
            <th>Capítulos</th>
        </tr>
        
        <?php 
            foreach($peliculas as $pel) {
                echo '<tr>';
                echo '<td>'.$pel->getTitulo().'</td>';
                echo '<td>'.$pel->getFecha().'</td>';
                echo '<td>'.$pel->getGenero().'</td>';
                echo '<td>'.$pel->getTipo().'</td>';
                echo '<td>'.$pel->getCapitulos().'</td>';
                echo '</tr>';
            }
        ?>
    </table>

</body>
</html>
