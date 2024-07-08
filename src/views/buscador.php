<?php

if (isset($_POST['local'])) {
    include_once __DIR__ . '/../../config/db.php';
    $local = ucfirst($_POST['local']);
    $sql = "SELECT * FROM locales WHERE nombre_local LIKE '$local'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $cod_local = $row['cod_local'];
    header("Location: /bajorosario-shopping/src/controllers/locales/local_search.php?local=$cod_local");
}

?>

<form class="d-flex me-3" role="search" action="/bajorosario-shopping/src/views/buscador.php" method="POST">
    <input class="form-control me-2" id='search-local' type="search" placeholder="Buscar locales..." aria-label="Search" name='local'>
</form>

