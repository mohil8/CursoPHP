
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="filtroDatos.php" method="post">

        <h3>Nombre y edad:</h3>
        <label for="nom">Nombre:</label><br>
        <input type="text" id="nom" name="nombre">
        <br>
        <label for="ed">Edad:</label><br>
        <input type="number" id="ed" name="edad">
        <br>

        <h3>Hobbie:</h3>
        <input type="checkbox" id="futbol" name="hobbie[]" value="Fútbol">
        <label >Fútbol</label><br>
        <input type="checkbox" id="hob" name="hobbie[]" value="KickBoxing">
        <label >KickBoxing</label><br>
        <input type="checkbox" id="hob" name="hobbie[]" value="Baloncesto">
        <label >Baloncesto</label><br>
        <input type="checkbox" id="hob" name="hobbie[]" value="K-1">
        <label >K-1</label>

        <h3>Sexo</h3>
        <label for="hom">Hombre</label>
        <input type="radio" id="hom" name="sexo" value="Hombre">
        <label for="muj">Mujer</label>
        <input type="radio" id="muj" name="sexo" value="Mujer">
        <br><br>
        <input type="submit" name="enviar" value="Enviar">

    </form>
    
    
</body>
</html>