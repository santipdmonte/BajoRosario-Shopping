<?php
include ("header.php");

// Handle the email form, send it to bajorosario2@gmail.com
if (isset($_POST['send_email'])){
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $consulta = $_POST['consulta'];

    $to = "bajorosario2@gmail.com";
    $subject = "Consulta de $nombre";
    $message = "Email: $email\nConsulta: $consulta";
    $headers = "From: $email";

    // mail($to, $subject, $message, $headers);
    $_SESSION['consulta_saved'] = true;
}

$consulta_saved = isset($_SESSION['consulta_saved']) && $_SESSION['consulta_saved'] == true;

?>
<div class="container py-4 section" style="display: flex; justify-content: center; align-items: center; flex-direction: column">
    
    <?php
    
    if ($consulta_saved) {
        echo '<div class="alert alert-success" role="alert"> El mensaje se envio con éxito </div>';
        unset($_SESSION['consulta_saved']);
    }
    
    ?>

    <h2>Contáctanos</h2>    

    <div class="card w-100" style="max-width: 500px;">
        <div class="card-body">
            <form action="/bajorosario-shopping/src/views/contacto.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" requireds>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Tu mensaje</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="consulta" required></textarea>
                </div>

                <input type="submit" class="btn btn-primary" name="send_email"> 
            </form>
        </div>
    </div>
</div>

<?php

include ("footer.html")

?>