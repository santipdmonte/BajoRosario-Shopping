<?php
function email_template($hash){
    return '
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Email de Bienvenida</title>
    </head>
    <body>
        <div style="max-width: 600px; margin: 0 auto; background-color: #f9f9f9; padding: 20px; text-align: center;">
            <div>
                <img src="https://pub-6d29dc65ed78442db1957c22eac48272.r2.dev/logo.png" alt="Logo de la Empresa" width="150" style="display: block; margin: 0 auto;">
            </div>
            <h1 style="color: #333; font-size: 24px;">¡Bienvenido a Bajo Rosario!</h1>
            <p style="color: #555; font-size: 16px;">Gracias por unirte a nuestra comunidad. Haga clic en el enlace de abajo para confirmar su cuenta:</p>
            <a href="http://localhost/bajorosario-shopping/src/controllers/validar.php?token='. $hash . '" style="color: white; background-color: blue; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Confirmar Cuenta</a>
            
        </div>
    </body>
    </html>
    ';
}
?>


<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Email de Bienvenida</title>
    </head>
    <body>
        <div style="max-width: 600px; margin: 0 auto; background-color: #f9f9f9; padding: 20px; text-align: center;">
            <div>
                <img src="https://pub-6d29dc65ed78442db1957c22eac48272.r2.dev/logo.png" alt="Logo de la Empresa" width="150" style="display: block; margin: 0 auto;">
            </div>
            <h1 style="color: #333; font-size: 24px;">¡Bienvenido a Bajo Rosario!</h1>
            <p style="color: #555; font-size: 16px;">Gracias por unirte a nuestra comunidad. Haga clic en el enlace de abajo para confirmar su cuenta:</p>
            <a href="http://localhost/bajorosario-shopping/src/controllers/validar.php?token='. $hash . '" style="color: white; background-color: blue; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Confirmar Cuenta</a>
            
        </div>
    </body>
    </html>
