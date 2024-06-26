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

<div class="container p-4" style="display: flex; justify-content: center; align-items: center; flex-direction: column">

    <h2 style="text-align: center;">Editar Local</h2>

    <div class="card w-100" style="max-width: 500px;">
        <div class="card-body">
            <form action="procesar_edicion_local.php" method="POST">

                <input type="hidden" name="cod_local" value="<?php echo $cod_local; ?>">
                <input type="hidden" name="url_logo" value="<?php echo $url_logo; ?>">

                <!-- Input Texto -->
                <div class="mb-3">
                    <label for="" class="form-label">Nombre Local</label>
                    <input type="text" class="form-control"  name="nombre_local"  value="<?php echo $nombre_local; ?>" autofocus required>
                </div>

                <!-- Input Texto -->
                <div class="mb-3">
                    <label for="" class="form-label">Ubicacion Local</label>
                    <input type="text" class="form-control"  name="ubicacion_local"  value="<?php echo $ubicacion_local; ?>" required>
                </div>

                <!-- Input Texto -->
                <div class="mb-3">
                    <label for="" class="form-label">Rubro Local</label>
                    <input type="text" class="form-control"  name="rubro_local"  value="<?php echo $rubro_local; ?>" required>
                </div>

                <!-- Input Texto -->
                <div class="mb-3">
                    <label for="" class="form-label">ID Dueño</label>
                    <input type="text" class="form-control"  name="cod_usuario"  value="<?php echo $cod_usuario; ?>" required>
                </div>
                
                <input type="submit" class="btn btn-primary" name="edit_local" value="Guardar Cambios"> 

            </form>

        </div>
    </div>

</div>

 
<?php include("../../../src/views/footer.html"); ?>