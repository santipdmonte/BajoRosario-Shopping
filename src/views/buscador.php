<?php

$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'bajito_rosario_promociones';

$conn = mysqli_connect($server, $username, $password, $dbname);
// include ("../../config/db.php");
// Se trabaja de esta forma con la conexion ya que al estar en el headear 
//      la ruta relativa del archivo se modificaba y no se podia acceder a la conexion

if (isset($_POST['local'])) {
    include_once __DIR__ . '/../../config/db.php';
    $local = ucfirst($_POST['local']);
    $sql = "SELECT * FROM locales WHERE nombre_local LIKE '$local'";
    $result = $conn->query($sql);
    
    if ($result->num_rows < 1) {
        header("Location: /bajorosario-shopping/404.php");
        exit();
    };

    $row = $result->fetch_assoc();
    $cod_local = $row['cod_local'];
    header("Location: /bajorosario-shopping/src/controllers/locales/local_search.php?local=$cod_local");
}

$localQuery = "SELECT * FROM locales";
$localResult = $conn->query($localQuery);
$conn->close();

?>

<form class="d-flex me-3" role="search" action="/bajorosario-shopping/src/views/buscador.php" method="POST"> 
    <input class="form-control me-2" list="search-local" name="local" placeholder="Buscar locales..."/>
    <datalist id="search-local">
        <?php while ($row = $localResult->fetch_assoc()): ?>
                 <option value="<?php echo htmlspecialchars($row['nombre_local']); ?>"></option>
        <?php endwhile; ?>
    </datalist>
    <!-- <button class="btn btn-outline-success" type="submit">Buscar</button> -->
</form>

