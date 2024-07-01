<?php include __DIR__ . "/header.php";

$exists = isset($_SESSION['exists']) && $_SESSION['exists'];
$failed = isset($_SESSION['failed']) && $_SESSION['failed'];
$success = isset($_SESSION['success']) && $_SESSION['success'];
$email = isset($_GET['email'])? $_GET['email'] : '';
$error_email = isset($_GET['error_email'])? $_GET['error_email'] : '';
$nombre_usuario = isset($_GET['error'])? $_GET['error'] : '';

?>

<div class="container p-4" style="display: flex; justify-content: center; align-items: center; flex-direction: column"> 

    <div class="card w-100" style="max-width: 500px;">
        <?php

        if ($exists) {
            // Si la promoción se ha guardado correctamente, muestra el mensaje
            echo "
                <div class='alert alert-warning m-2' role='warning'>
                    Usuario ya registrado. 
                    <a href='inicio_sesion?email=$email' class='text-black'>
                        Iniciar Sesion
                    </a>
                </div>
            ";
            unset($_SESSION['exists']);
        }

        if ($failed) {
            // Si la promoción se ha guardado correctamente, muestra el mensaje
            echo '<div class="alert alert-danger m-2" role="alert"> Error al registrar el usuario</div>';
            unset($_SESSION['failed']);
        }

        if ($success) {
            // Si la promoción se ha guardado correctamente, muestra el mensaje
            echo '<div class="alert alert-success m-2" role="alert">Usuario Registrado correctamente. Pendiente de verificacion</div>';
            unset($_SESSION['success']);
        }

        //Tendria que mostrar el cartel de error
        if ($nombre_usuario) {
            // Si la promoción se ha guardado correctamente, muestra el mensaje
            echo '<div class="alert alert-danger m-2" role="alert"> Tipo de nombre de usuario incorrecto. El nombre de usuario no debe contener numeros ni caracteres especiales</div>';
            unset($_SESSION['error']);
        }

        //Tendria que mostrar el cartel de error
        if ($error_email) {
            // Si la promoción se ha guardado correctamente, muestra el mensaje
            echo '<div class="alert alert-danger m-2" role="alert"> Formato de mail incorrecto</div>';
            unset($_SESSION['error_email']);
        }

        ?> 
          
        <div class="card-body">
            <h2 class="pb-2" style="font-weight: bold;"> Registrarte </h2>

            <form action="/bajorosario-shopping/src/controllers/registrar_usuario.php" method="POST">

                <!-- TODO: Validacion de inputs -->

                <!-- Input Nombre -->
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre_usuario" required>
                </div>
                
                <!-- Input Email -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        name="email"
                        value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>" required
                    >
                    <div id="emailHelp" class="form-text">No vamosa  compartir el email con nadie.</div>
                </div>

                <!-- Input Password -->
                <div class="mb-3">
                    <label class="form-label">Constraseña</label>
                    <input type="password" class="form-control" name="clave_usuario" required>
                </div>
                
                <!-- Input Categoria Usuario -->
                <div class="mb-3">
                    <label class="form-label">Tipo de Usuario</label>
                    <select class="form-select" name="tipo_usuario" required>
                        <option value="cliente">Cliente</option>
                        <option value="dueno de local">Dueño de local</option> 
                    </select>
                </div>

                <input type="submit" class="btn btn-primary" name="create_user">    

            </form>

        </div>
    </div>

</div>

<?php include __DIR__ . "/footer.html" ?>
