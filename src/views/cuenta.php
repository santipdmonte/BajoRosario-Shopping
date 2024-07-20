<?php
include ("header.php");
include ("../../config/db.php");

if (isset($_SESSION['cod_usuario'])){
    $cod_usuario = $_SESSION['cod_usuario'];
    $query = "SELECT * FROM usuarios WHERE cod_usuario = '$cod_usuario'";
    $usuario = mysqli_query($conn, $query);
    $conn->close();
    $usuario = mysqli_fetch_assoc($usuario);
}

if (isset($_POST['guardar_cambios'])){
    // modidficar nombre usuario
    $nombre = $_POST['nombre'];
    $query = "UPDATE usuarios SET nombre_usuario = '$nombre' WHERE cod_usuario = '$cod_usuario'";
    $result = mysqli_query($conn, $query);
    $conn->close();
    $_SESSION['saved'] = true;
    $_SESSION['nombre_usuario'] = $nombre;
    header("Location: /bajorosario-shopping/src/views/cuenta.php");
    exit();
}

if (!$usuario){
    echo "No se ha encontrado el usuario";
}

?>

<div class="container py-4 section" style="display: flex; justify-content: center; align-items: center; flex-direction: column">
    
    <?php
    
    if (isset($_SESSION['saved'])) {
        echo '<div class="alert alert-success" role="alert"> Se guardaron los cambios con éxito</div>';
        unset($_SESSION['saved']);
    }
    
    ?>

    <h2>Cuenta</h2>    

    <div class="card w-100" style="max-width: 500px;">
        <div class="card-body">
            <form action="/bajorosario-shopping/src/views/cuenta.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" value=<?php echo ucfirst($usuario['nombre_usuario']);?> required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email: <?php echo $usuario['email'];?></label>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo Usuario: <?php echo ucfirst($usuario['tipo_usuario']);?></label>
                </div>

                <?php if ($usuario['tipo_usuario'] == 'cliente') {
                    echo '<div class="mb-3"> <label class="form-label mb-3">Categoria: ' . ucfirst($usuario['categoria_cliente']) . '</label></div>';
                } ?>

                <input type="submit" class="btn btn-primary" name="guardar_cambios" value="Guardar Cambios"> 
            </form>
        </div>
    </div>
</div>


<?php


include ("footer.php")

?>