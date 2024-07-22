<!-- Boostrap JS -->
<footer class="py-5 text-center text-body-secondary bg-body-tertiary">
    <div class="container" bis_skin_checked="1">
        <div class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div style="text-align: left;">
                <p style="margin-bottom: 0;">© 2024 Bajo Rosario</p>
                <p style="margin-bottom: 0;">Zeballos 1341, Rosario / S2000</p>
                <p style="margin-bottom: 0;">Email: admin@bajorosarioshopping.com</p>
                <p style="margin-bottom: 0;">HORARIOS:</p>
                <p style="margin-bottom: 0;">Locales comerciales: 10 a 21 hs.</p>
                <p style="margin-bottom: 0;">Patio de Comidas: 10:00 a 00:00 hs.</p>
            </div>

            <a href="/bajorosario-shopping/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img src="https://pub-6d29dc65ed78442db1957c22eac48272.r2.dev/logo.png" class="mx-2" alt="Bajo Rosario Logo" style="width: 50px;">
            </a>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="/bajorosario-shopping" class="nav-link px-2 text-body-secondary">Inicio</a></li>
                <li class="nav-item"><a href="/bajorosario-shopping/promociones" class="nav-link px-2 text-body-secondary">Promociones</a></li>
                <li class="nav-item"><a href="/bajorosario-shopping/contacto" class="nav-link px-2 text-body-secondary">Contacto</a></li>
                <li class="nav-item"><a href="/bajorosario-shopping/mapa_sitio" class="nav-link px-2 text-body-secondary">Mapa de sitio</a></li>
                <?php if (isset($_SESSION['user'])) { ?>
                    <li class="nav-item"><a href="/bajorosario-shopping/cuenta" class="nav-link px-2 text-body-secondary">Cuenta</a></li>
                    <li class="nav-item"><a href="/bajorosario-shopping/src/controllers/cerrar_sesion.php" class="nav-link px-2 text-danger">Cerrar sesión</a></li>
                <?php } else { ?>
                    <li class="nav-item"><a href="/bajorosario-shopping/login" class="nav-link px-2 text-body-secondary">Iniciar sesión</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
