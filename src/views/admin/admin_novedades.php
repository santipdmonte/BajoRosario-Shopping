<?php 
include '../header.php';
include __DIR__ . "/../../../config/db.php";
include "../../controllers/novedades/get_novedades.php";

$novedades = get_novedades_active(); 

?>

<div class="container pt-4 section" style="display: flex; justify-content: center; align-items: center; flex-direction: column">

    <?php include('../error_messages.php')?>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary justify-content-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Nueva Novedad
    </button>

    <!-- List Novedades -->

    <div 
    class="container p-4" 
    style="
        display: flex; 
        flex-direction: column; 
        justify-content: center; 
        align-items: center;
        overflow-x: auto;"
    >

        <table class="table table-striped table-hover shadow text-center" style="min-width: 750px;">

            <thead>
                <tr>
                    <th scope="col">Novedad</th>
                    <th scope="col">Desde - Hasta</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>

            <?php while($novedad = mysqli_fetch_array($novedades)){ ?>

                <!-- Itero por cada fila de promociones en la DB -->
                <tbody>
                    <tr>
                    <td><?php echo $novedad['texto_novedad']?></td>
                    <td><?php echo ($novedad['fecha_desde_novedad'] . ' | ' . $novedad['fecha_hasta_novedad'])?></td>
                    <td><?php echo $novedad['categoria_cliente']?></td>
                    <td>
                        <form action="/bajorosario-shopping/src/controllers/novedades/novedades_edit_delete.php" method="POST">
                            <button class="btn btn-outline-warning" type="submit" name="action" value="edit">Edit</button>
                            <button class="btn btn-outline-danger" type="submit" name="action" value="delete">Borrar</button>
                            <input type="hidden" name="cod_novedad" value="<?php echo $novedad['cod_novedad']?>">
                        </form>
                    </td>
                    </tr>
                </tbody>

            <?php }?>

        </table>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Novedad</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">

                                <form action="/bajorosario-shopping/src/controllers/novedades/novedad_new.php" method="POST">

                                    <!-- TODO: Validacion de inputs -->

                                    <!-- Input Texto -->
                                    <div class="mb-3">
                                        <label for="" class="form-label">Texto Novedad</label>
                                        <input type="text" name="texto_novedad" class="form-control" autofocus required>
                                    </div>

                                    <!-- Input Fecha Ini -->
                                    <div class="mb-3">
                                        <label for="fechaInicio" class="form-label">Novedad Desde</label>
                                        <input type="date" class="form-control" name="fecha_desde" required>
                                    </div>

                                    <!-- Input fecha Hasta -->
                                    <div class="mb-3">
                                        <label for="fechaFin" class="form-label">Novedad Hasta</label>
                                        <input type="date" class="form-control" name="fecha_hasta" required>
                                    </div>
                                    
                                    <!-- Input Categoria Cliente -->
                                    <div class="mb-3">
                                        <label for="selectOpciones" class="form-label">Categoria</label>
                                        <select class="form-select" id="selectOpciones" name="categoria_cliente" required>
                                            <option value="inicial">Inicial</option>
                                            <option value="medium">Medium</option>
                                            <option value="premium">Premium</option>
                                        </select>
                                    </div>

                                    <input type="submit" class="btn btn-primary" name="save_novedad">    

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include ("../footer.php")?>

