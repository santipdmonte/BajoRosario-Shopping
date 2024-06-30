<?php
include("../../../config/db.php");

// Verificar si se ha pasado un parámetro cod_novedad por GET
if (isset($_GET['cod_novedad'])) {
    $cod_novedad = $_GET['cod_novedad'];

    // Consulta para obtener los datos actuales de la novedad
    $query = "SELECT * FROM novedades WHERE cod_novedad = $cod_novedad";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $texto_novedad = $row['texto_novedad'];
        $fecha_desde = $row['fecha_desde_novedad'];
        $fecha_hasta = $row['fecha_hasta_novedad'];
        $categoria_cliente = $row['categoria_cliente'];
        // Puedes agregar más campos según sea necesario
    } else {
        // Manejo de error si no se encuentra la novedad
        echo "Novedad no encontrada.";
        exit();
    }
} else {
    // Manejo de error si no se proporciona cod_novedad
    echo "Parámetro cod_novedad no especificado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Novedad</title>
</head>
<body>
    <h2>Editar Novedad</h2>
    <form action="procesar_edicion_novedad.php" method="POST">
        <input type="hidden" name="cod_novedad" value="<?php echo $cod_novedad; ?>">
        <label>Texto de la Novedad:</label><br>
        <textarea name="texto_novedad" rows="4" cols="50"><?php echo $texto_novedad; ?></textarea><br>
        
        <label>Fecha Desde:</label><br>
        <input type="date" name="fecha_desde" value="<?php echo $fecha_desde; ?>"><br>
        
        <label>Fecha Hasta:</label><br>
        <input type="date" name="fecha_hasta" value="<?php echo $fecha_hasta; ?>"><br>
        
        <label>Categoría Cliente:</label><br>
        <!--<input type="text" name="categoria_cliente" value="<?php echo $categoria_cliente; ?>"><br>-->
        <!--<label>Tipo de Cliente:</label><br>-->
        <select name="categoria_cliente">
            <option value="inicial" <?php if ($categoria_cliente == 'inicial') echo 'selected'; ?>>Inicial</option>
            <option value="medium" <?php if ($categoria_cliente == 'medium') echo 'selected'; ?>>Medium</option>
            <option value="premium" <?php if ($categoria_cliente == 'premium') echo 'selected'; ?>>Premium</option>
        </select><br>

        <br>
        <input type="submit" name="edit_novedad" value="Guardar Cambios">
    </form>
</body>
</html>
