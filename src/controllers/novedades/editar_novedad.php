<?php
include("../../../config/db.php");
include("../../../src/views/header.php");
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
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
    <title>Editar Novedad</title>
</head>
<body>
    <h2 style="text-align: center;">Editar Novedad</h2>
    <div class="container" style="align: center; width: 60%;">
        <form action="procesar_edicion_novedad.php" method="POST" style="margin: 0 auto; width: 50%;">
            <input type="hidden" name="cod_novedad" value="<?php echo $cod_novedad; ?>">
            <label style="text-align: center; font-weight: bold; font-size: 18px;">Novedad:</label><br>
            <input type="text" name="texto_novedad" rows="4" cols="50" style="width: 100%; height: 60px; font-size: 20px; border-radius: 10px;" value="<?php echo $texto_novedad; ?>" required></input><br>

            <label style="text-align: left; font-weight: bold; font-size: 18px;">Fecha Desde:</label><br>
            <input type="date" name="fecha_desde" style="width: 35%; height: 60px; font-size: 20px; text-align: left; border-radius: 10px;" value="<?php echo $fecha_desde; ?>" required><br>

            <label style="text-align: left; font-weight: bold; font-size: 18px;">Fecha Hasta:</label><br>
            <input type="date" name="fecha_hasta" style="width: 35%; height: 60px; font-size: 20px; text-align: left; border-radius: 10px;" value="<?php echo $fecha_hasta; ?>" required><br>

            <label style="text-align: left; font-weight: bold; font-size: 18px;">Categoría Cliente:</label><br>

            <select name="categoria_cliente" style="width: 35%; height: 60px; font-size: 20px; text-align: left; border-radius: 10px;" value="<?php echo $categoria_cliente; ?>" required>
                <option value="inicial" <?php if ($categoria_cliente == 'inicial') echo 'selected'; ?>>Inicial</option>
                <option value="medium" <?php if ($categoria_cliente == 'medium') echo 'selected'; ?>>Medium</option>
                <option value="premium" <?php if ($categoria_cliente == 'premium') echo 'selected'; ?>>Premium</option>
            </select><br>

        <br>
        <input type="submit" name="edit_novedad" value="Guardar Cambios">
    </form>
</body>
</html>
<?php include("../../../src/views/footer.html"); ?>