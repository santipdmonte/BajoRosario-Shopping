<?php 
include '../header.php';
include __DIR__ . "/../../../config/db.php";
ob_start();
?>

<div class="section">

    <h2 class="title"> Cateogorias Cliente </h2>
    
    <div class="container p-4 text-center" style="max-width: 600px;">
    
        <?php
        if (isset($_SESSION['save_changes']) && $_SESSION['save_changes']) {
                echo '<div class="alert alert-success" role="success"> Cambios guardados con exito </div>';
                unset($_SESSION['save_changes']);
            }
        if (isset($_SESSION['error']) && $_SESSION['error']) {
            echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>';
            unset($_SESSION['error']);
        }
        ?>
    
        <form action="/bajorosario-shopping/src/controllers/clientes/cliente_categorias.php" method="POST">
            <table class="table table-striped table-hover shadow">
    
                <thead>
                    <tr>
                        <th scope="col">Categoria</th>
                        <th scope="col">Promociones Minimas</th>
                    </tr>
                </thead>
        
                
                <?php 
                $query = "SELECT * FROM categorias_cliente";
                $result_tasks = mysqli_query($conn, $query);
        
                while($row = mysqli_fetch_array($result_tasks)){ ?>
        
                    <!-- Itero por cada fila de promociones en la DB -->
                    <tbody>
                        <tr>
                        <td><?php echo ucfirst($row['categoria'])?></td>
                        <td>
                            <input type="hidden" name="cod_categorias[]" value="<?php echo $row['cod_categoria']?>" required>
                            <input class="w-25 rounded ps-2" style="background-color: transparent; border: 1px solid black; color: black" type="text" name="promociones_minimas_<?php echo $row['cod_categoria']?>" value="<?php echo $row['promociones_minimas_adquiridas']?>" required>
                        </td>
                        </tr>
                    </tbody>
        
                <?php }?>            
                
            </table>
    
            <div>
                <button class="btn btn-outline-success" type="submit" name="save_changes" value="save_changes">Guardar Cambios</button>
            </div>

        </form>
        
    </div>
</div>

    
<?php 
ob_end_flush();
include ("../footer.php")

?>

