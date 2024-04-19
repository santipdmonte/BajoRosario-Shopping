<?php include("b_db.php"); ?>

<?php include("views/header.php")?>

<div class="container p-4" style="display: flex; justify-content: center; align-items: center; flex-direction: column">

    <div class="card" style="width: 40rem;">
        <div class="card-body">

            <h2 class="pb-2" style="font-weight: bold;"> Iniciar Sesión </h2>

            <form action="b_inicio_sesion.php" method="POST">

                <!-- TODO: Validacion de inputs -->
                
                <!-- Input Email -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                    <?php if (isset($_SESSION['not_aprove']) && $_SESSION['not_aprove']){?>
                        <div id="emailHelp" class="form-text text-danger-emphasis">Usuario pendiente de aprobación.</div>
                    <?php 
                    unset($_SESSION['not_aprove']);
                    } ?>

                </div>

                <!-- Input Password -->
                <div class="mb-3">
                    <label class="form-label">Constraseña</label>
                    <input type="password" class="form-control" name="clave_usuario">
                    <?php if (isset($_SESSION['not_valid_password']) && $_SESSION['not_valid_password']){?>
                        <div id="emailHelp" class="form-text text-danger">Contraseña incorrecta</div>
                    <?php 
                    unset($_SESSION['not_valid_password']);
                    } ?>
                </div>

                <input type="submit" class="btn btn-primary" name="valid_user">    

            </form>

        </div>
    </div>

</div>

<?php include("views/footer.html") ?>
