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

<div class="container p-4" style="display: flex; justify-content: center; align-items: center; flex-direction: column">

    <h2 style="text-align: center;">Editar Novedad</h2>

    <div class="card w-100" style="max-width: 500px;">
        <div class="card-body">

            <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger" role="alert">'. $_SESSION['error'] .'</div>';
                unset($_SESSION['error']);
            }
            ?>

            <form action="procesar_edicion_novedad.php" method="POST">

                <input type="hidden" name="cod_novedad" value="<?php echo $cod_novedad; ?>">

                <!-- Input Texto -->
                <div class="mb-3">
                    <label for="" class="form-label">Novedad</label>
                    <input type="text" class="form-control"  name="texto_novedad"  value="<?php echo $texto_novedad; ?>" autofocus required>
                </div>

                <!-- Input Fecha Desde -->
                <div class="mb-3" style="max-width: 200px;">
                    <label for="fechaInicio" class="form-label">Fecha Desde</label>
                    <input type="date" class="form-control" name="fecha_desde" value="<?php echo $fecha_desde; ?>" required>
                </div>

                <!-- Input Fecha Desde -->
                <div class="mb-3" style="max-width: 200px;">
                    <label for="fechaInicio" class="form-label">Fecha Hasta</label>
                    <input type="date" class="form-control" name="fecha_hasta" value="<?php echo $fecha_hasta; ?>" required>
                </div>
                
                <!-- Input Categoria Cliente -->
                <div class="mb-3" style="max-width: 200px;">
                    <label for="selectOpciones" class="form-label">Categoria de cliente</label>
                    <select class="form-select" id="selectOpciones" name="categoria_cliente" required>
                        <option value="inicial" <?php if ($categoria_cliente == 'inicial') echo 'selected'; ?>>Inicial</option>
                        <option value="medium" <?php if ($categoria_cliente == 'medium') echo 'selected'; ?>>Medium</option>
                        <option value="premium" <?php if ($categoria_cliente == 'premium') echo 'selected'; ?>>Premium</option>
                    </select>
                </div>
                
                <input type="submit" class="btn btn-primary" name="edit_novedad" value="Guardar Cambios">

            </form>

        </div>
    </div>

</div>

<?php include("../../../src/views/footer.html"); ?>