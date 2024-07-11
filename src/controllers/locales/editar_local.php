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
    } else {
        echo "Local no encontrada.";
        exit();
    }
} else {
    // Manejo de error si no se proporciona cod_novedad
    echo "Parámetro cod_local no especificado.";
    exit();
}

$userQuery = "SELECT * FROM usuarios WHERE tipo_usuario = 'dueno de local'";
$userResult = mysqli_query($conn, $userQuery);

$categoryQuery = "SELECT * FROM cateogrias_locales";
$categoryResult = mysqli_query($conn, $categoryQuery);

?>

<div class="container p-4" style="display: flex; justify-content: center; align-items: center; flex-direction: column">

    <h2 style="text-align: center;">Editar Local</h2>

    <div class="card w-100" style="max-width: 500px;">
        <div class="card-body">
            <form action="procesar_edicion_local.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="cod_local" value="<?php echo $cod_local; ?>">
                <input type="hidden" name="url_logo" value="<?php echo $url_logo; ?>">

                <!-- Input Texto -->
                <div class="mb-3">
                    <label for="" class="form-label">Nombre Local</label>
                    <input type="text" class="form-control"  name="nombre_local"  value="<?php echo $nombre_local; ?>" autofocus required>
                </div>

                <!-- Input Logo Local -->
                <div>
                    <label for="">Nuevo Logo</label>
                    <input type="file" name="imagen_local" class="form-control">
                </div>

                <!-- Input Texto -->
                <div class="mb-3">
                    <label for="" class="form-label">Ubicacion Local</label>
                    <input type="text" class="form-control"  name="ubicacion_local"  value="<?php echo $ubicacion_local; ?>" required>
                </div>

                <!-- Input Rubro -->
                <div class="mb-3">
                    <label for="" class="form-label">Rubro Local</label>
                    <select name="rubro_local" class="form-control" required>
                        <?php
                        echo '<option disabled>Seleccionar Rubro</option>';
                        while ($categoryRow = mysqli_fetch_array($categoryResult)) {
                            echo '<option value="' . $categoryRow['categoria'] . '"' . (strtolower($categoryRow['categoria']) == strtolower($rubro_local) ? "selected" : "") . '>' . $categoryRow['categoria'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <!-- Input usuario -->
                <div class="mb-3">
                    <label for="" class="form-label">Usuario</label>
                    <select name="cod_usuario" class="form-control" required>
                        <?php
                        echo '<option disabled>Seleccionar Usuario</option>';
                        while ($userRow = mysqli_fetch_array($userResult)) {
                            echo '<option value="' . $userRow['cod_usuario'] . '"' . ($userRow['cod_usuario'] == $cod_usuario ? "selected" : "") . '> [' . $userRow['cod_usuario'] . '] - ' . $userRow['nombre_usuario'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                
                <input type="submit" class="btn btn-primary" name="edit_local" value="Guardar Cambios"> 
                <button href="javascript:history.back()" class="btn btn-secondary">Cancelar</button>

            </form>

        </div>
    </div>

</div>

 
<?php include("../../../src/views/footer.html"); ?>