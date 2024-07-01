<?php
include("../../../config/db.php");
include("../../../src/views/header.php");
// Verificar si se ha pasado un parámetro cod_local por GET
if (isset($_GET['cod_local'])) {
    $cod_local = $_GET['cod_local'];

    // Consulta para obtener los datos actuales de la novedad
    $query = "SELECT * FROM locales WHERE cod_local = $cod_local";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nombre_local = $row['nombre_local'];
        $ubicacion_local = $row['ubicacion_local'];
        $rubro_local = $row['rubro_local'];
        $cod_usuario = $row['cod_usuario'];
        $url_logo = $row['url_logo'];
        // Puedes agregar más campos según sea necesario
    } else {
        // Manejo de error si no se encuentra la novedad
        echo "Local no encontrada.";
        exit();
    }
} else {
    // Manejo de error si no se proporciona cod_novedad
    echo "Parámetro cod_local no especificado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
    <title>Editar Local</title>
</head>
<body>
    <h2 style="text-align: center;">Editar Local</h2>
    <div class="container" style="align: center; width: 60%;">
        <form action="procesar_edicion_local.php" method="POST" style="margin: 0 auto; width: 50%;">
            <input type="hidden" name="cod_local" value="<?php echo $cod_local; ?>">
            <input type="hidden" name="url_logo" value="<?php echo $url_logo; ?>">

            <label style="text-align: center; font-weight: bold; font-size: 18px;">Local:</label><br>
            <input type="text" name="nombre_local" rows="4" cols="50" style="width: 100%; height: 60px; font-size: 20px; border-radius: 10px;" value="<?php echo $nombre_local; ?>" required><br>

            <label style="text-align: left; font-weight: bold; font-size: 18px;">Ubicacion:</label><br>
            <input type="text" name="ubicacion_local" style="width: 35%; height: 60px; font-size: 20px; text-align: left; border-radius: 10px;" value="<?php echo $ubicacion_local; ?>" required><br>

            <label style="text-align: left; font-weight: bold; font-size: 18px;">Rubro:</label><br>
            <input type="text" name="rubro_local" style="width: 35%; height: 60px; font-size: 20px; text-align: left; border-radius: 10px;" value="<?php echo $rubro_local; ?>" required><br>

            <label style="text-align: left; font-weight: bold; font-size: 18px;"> ID Dueño:</label><br>
            <input type="text" name="cod_usuario" style="width: 35%; height: 60px; font-size: 20px; text-align: left; border-radius: 10px;" value="<?php echo $cod_usuario; ?>" required><br>

            <br>
            <input type="submit" name="edit_local" value="Guardar Cambios" style="background-color: #4CAF50; color: white; padding: 10px 25px; border: none; cursor: pointer; border-radius: 10px;">
        </form>
    </div>
</body>
</html>
