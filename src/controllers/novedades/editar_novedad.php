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

    <div class="container p-4" style="display: flex; justify-content: center; align-items: center; flex-direction: column">

    <div class="card w-100" style="max-width: 500px;">
        <div class="card-body">
            <form action="procesar_edicion_novedad.php" method="POST">
                <input type="hidden" name="cod_novedad" value="<?php echo $cod_novedad; ?>">
                <!-- TODO: Validacion de inputs -->

                <!-- Input Texto -->
                <div class="mb-3">
                    <!--<label for="" class="form-label">Texto Promoción</label>-->
                    <!--<input type="text" name="texto_promo" class="form-control" autofocus required>-->
                    <label class="form-label">Texto de la Novedad:</label><br>
                    <textarea name="texto_novedad" rows="4" cols="50" class="form-control"><?php echo $texto_novedad; ?></textarea><br>
                </div>

                <!-- Input Fecha Ini -->
                <div class="mb-3" style="max-width: 200px;">
                    <!--<label for="fechaInicio" class="form-label">Promoción Desde</label>-->
                    <!--<input type="date" class="form-control" name="fecha_inicio" required>-->
                    <label  class="form-label">Fecha Desde:</label><br>
                    <input type="date" name="fecha_desde" class="form-control" value="<?php echo $fecha_desde; ?>"><br>
                </div>

                <!-- Input fecha Hasta -->
                <div class="mb-3" style="max-width: 200px;">
                    <!--<label for="fechaFin" class="form-label">Promoción Hasta</label>-->
                    <!--<input type="date" class="form-control" name="fecha_fin" required>-->
                    <label class="form-label">Fecha Hasta:</label><br>
                    <input type="date" name="fecha_hasta" class="form-control" value="<?php echo $fecha_hasta; ?>"><br>
                </div>
                
                <!-- Input Categoria Cliente -->
                <div class="mb-3" style="max-width: 200px;">
                    <label for="selectOpciones" class="form-label">Categoria de cliente</label>
                    <select class="form-select" id="selectOpciones" name="categoria_cliente">
                        <option value="Inicial">Inicial</option>
                        <option value="Medium">Medium</option>
                        <option value="Premium">Premium</option>
                    </select>
                </div>

                <!-- Input Local promo -->
                <div class="mb-3" style="max-width: 200px;">
                    <label for="selectLocales" class="form-label">Seleccionar Local</label>
                    <select class="form-select" id="selectLocales" name="cod_local" required>
                        <?php
                        // Obtener los locales del dueño
                        include("../../../config/db.php");
                        $query = "SELECT * FROM locales WHERE cod_usuario = '$codigo_usuario'";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $cod_local = $row['cod_local'];
                            $nombre_local = $row['nombre_local'];
                            echo "<option value='$cod_local'>$nombre_local</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Input Dias de la semana -->
                <div class="mb-3">
                    <label for="selectOpciones" class="form-label">Dias habilitados</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="dias[]" value="0" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Lunes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="dias[]" value="1" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Martes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="dias[]" value="2" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Miercoles
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="dias[]" value="3" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Jueves
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="dias[]" value="4" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Viernes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="dias[]" value="5">
                        <label class="form-check-label" for="flexCheckDefault">
                            Sabado
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="dias[]" value="6">
                        <label class="form-check-label" for="flexCheckDefault">
                            Domingo
                        </label>
                    </div>
                </div>

                
                

                <input type="submit" class="btn btn-primary" name="save_promo">    

            </form>

        </div>
    </div>

</div>




</body>
</html>
