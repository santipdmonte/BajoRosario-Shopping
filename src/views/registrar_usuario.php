<?php include __DIR__ . "/header.php"?>

<div class="container p-4" style="display: flex; justify-content: center; align-items: center; flex-direction: column"> 

    <div class="card" style="width: 40rem;">
        <?php
        echo ("TODO: Validar todos los inputs en front y back");

        if (isset($_SESSION['exists']) && $_SESSION['exists']) {
            // Si la promoción se ha guardado correctamente, muestra el mensaje
            $email = $_GET['email'];
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
        if (isset($_SESSION['failed']) && $_SESSION['failed']) {
            // Si la promoción se ha guardado correctamente, muestra el mensaje
            echo '<div class="alert alert-danger m-2" role="alert"> Error al registrar el usuario</div>';
            unset($_SESSION['failed']);
        }
        if (isset($_SESSION['success']) && $_SESSION['success']) {
            // Si la promoción se ha guardado correctamente, muestra el mensaje
            echo '<div class="alert alert-success m-2" role="alert">Usuario Registrado correctamente. Pendiente de verificacion</div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['mail_status'])) {
            // Si la promoción se ha guardado correctamente, muestra el mensaje
            echo '<div class="alert alert-success m-2" role="alert">' . $_SESSION['mail_status']. '</div>';
            unset($_SESSION['mail_status']);
        }
        ?>   
        <div class="card-body">
            <h2 class="pb-2" style="font-weight: bold;"> Registrarte </h2>

            <form action="/bajorosario-shopping/src/controllers/registrar_usuario.php" method="POST">

                <!-- TODO: Validacion de inputs -->

                <!-- Input Nombre -->
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre_usuario">
                </div>
                
                <!-- Input Email -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        name="email"
                        value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>"
                    >
                    <div id="emailHelp" class="form-text">No vamosa  compartir el email con nadie.</div>
                </div>

                <!-- Input Password -->
                <div class="mb-3">
                    <label class="form-label">Constraseña</label>
                    <input type="password" class="form-control" name="clave_usuario">
                </div>
                
                <!-- Input Categoria Usuario -->
                <div class="mb-3">
                    <label class="form-label">Tipo de Usuario</label>
                    <select class="form-select" name="tipo_usuario">
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
