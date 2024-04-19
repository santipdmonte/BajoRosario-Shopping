<?php include("b_db.php"); ?>

<?php include("views/header.php")?>

<div class="container p-4" style="display: flex; justify-content: center; align-items: center; flex-direction: column">

    <?php
    // Verificar si la variable de sesión está establecida para mostrar el toast
    if (isset($_SESSION['promo_saved']) && $_SESSION['promo_saved']) {
        // Si la promoción se ha guardado correctamente, muestra el mensaje
        echo '<div class="alert alert-success" role="alert"> La promoción se guardo con éxito </div>';
        unset($_SESSION['promo_saved']);
    }
    if (isset($_SESSION['promo_failed']) && $_SESSION['promo_failed']) {
        // Si la promoción no se pudo guardar, muestra el mensaje
        echo '<div class="alert alert-danger" role="alert"> Error al guardar la promoción</div>';
        unset($_SESSION['promo_saved']);
    }
    ?>

    <div class="card" style="width: 40rem;">
        <div class="card-body">

            <form action="b_promo_new.php" method="POST">

                <!-- TODO: Validacion de inputs -->

                <!-- Input Texto -->
                <div class="mb-3">
                    <label for="" class="form-label">Texto Promoción</label>
                    <input type="text" name="texto_promo" class="form-control" autofocus required>
                </div>

                <!-- Input Fecha Ini -->
                <div class="mb-3">
                    <label for="fechaInicio" class="form-label">Promoción Desde</label>
                    <input type="date" class="form-control" name="fecha_inicio" required>
                </div>

                <!-- Input fecha Hasta -->
                <div class="mb-3">
                    <label for="fechaFin" class="form-label">Promoción Hasta</label>
                    <input type="date" class="form-control" name="fecha_fin" required>
                </div>
                
                <!-- Input Categoria Cliente -->
                <div class="mb-3">
                    <label for="selectOpciones" class="form-label">Categoria de cliente</label>
                    <select class="form-select" id="selectOpciones" name="categoria_cliente">
                        <option value="Inicial">Inicial</option>
                        <option value="Medium">Medium</option>
                        <option value="Premium">Premium</option>
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

                <!-- Codigo del local - Automatico segun que cliente agrega la promo -->
                <input type="text" name="cod_local" value="1" hidden>

                <input type="submit" class="btn btn-primary" name="save_promo">    

            </form>

        </div>
    </div>

</div>

<?php include("views/footer.html") ?>
