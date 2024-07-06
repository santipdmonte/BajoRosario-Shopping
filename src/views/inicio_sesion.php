<?php include __DIR__ . "/header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['use_promo_no_sesion'])) {
        $_SESSION['alert'] = 'Para utilizar las promociones debes iniciar sesion';
    }
}

$usuario_no_encontrado = isset($_SESSION['usuario_no_encontrado']) && $_SESSION['usuario_no_encontrado'];
$alert = (isset($_SESSION['alert']) && $_SESSION['alert'])? $_SESSION['alert'] : '';
$email = isset($_GET['email'])? $_GET['email'] : '';

?>

<div class="container p-4" style="display: flex; justify-content: center; align-items: center; flex-direction: column">

    
    <div class="card w-100" style="max-width: 500px;">
        
        <?php
        if ($usuario_no_encontrado) {
            // Si la promoción se ha guardado correctamente, muestra el mensaje
                echo "
                    <div class='alert alert-warning m-2' role='warning'>
                        Usuario no encontrado. 
                        <a href='registrar_usuario?email=$email' class='text-black'>
                            Registrar Usuario
                        </a>
                    </div>
                ";
            unset($_SESSION['usuario_no_encontrado']);
        }

        if ($alert){
            echo "
                <div class='alert alert-warning m-2' role='warning'>
                    $alert
                </div>
            ";
            unset($_SESSION['alert']);
        }
        ?>

        <div class="card-body">

            <h2 class="pb-2" style="font-weight: bold;"> Iniciar Sesión </h2>

            <form action="/bajorosario-shopping/src/controllers/inicio_sesion.php" method="POST">

                <!-- TODO: Validacion de inputs -->
                
                <!-- Input Email -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        name="email" 
                        value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>" required
                    >
                    <?php if (isset($_SESSION['not_aprove']) && $_SESSION['not_aprove']){?>
                        <div id="emailHelp" class="form-text text-danger-emphasis">Usuario pendiente de aprobación.</div>
                    <?php 
                    unset($_SESSION['not_aprove']);
                    } ?>

                </div>

                <!-- Input Password ¿Hace falta validar password? -->
                <div class="mb-3">
                    <label class="form-label">Constraseña</label>
                    <input type="password" class="form-control" name="clave_usuario" required>
                    <?php if (isset($_SESSION['not_valid_password']) && $_SESSION['not_valid_password']){?>
                        <div id="emailHelp" class="form-text text-danger">Contraseña incorrecta</div>
                    <?php 
                    unset($_SESSION['not_valid_password']);
                    } ?>
                </div>

                <input type="submit" class="btn btn-primary" name="valid_user">    

            </form>

            <div class="pt-3 d-flex gap-4 justify-content-center text-secondary">
                <a href="/bajorosario-shopping/registrar_usuario" class="text-secondary">Registrarte</a>
                <!-- <a href="" class="text-secondary">Recuperar Contraseña</a> -->
            </div>

        </div>
    </div>

</div>

<?php include __DIR__ . "/footer.html" ?>
