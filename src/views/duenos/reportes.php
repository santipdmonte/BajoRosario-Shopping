<?php 
include '../header.php';
include __DIR__ . "/../../../config/db.php";

// Obtener todos los locales del dueño en sesión
$duenoId = $_SESSION['cod_usuario'];

$sql = "SELECT * FROM locales WHERE cod_usuario = $duenoId";
$resultLocales = mysqli_query($conn, $sql);

// Obtener la cantidad de usos de cada promoción de cada local
$locales = [];
$promociones = [];

while ($row = mysqli_fetch_assoc($resultLocales)) {
    $locales[] = $row;
    $codLocal = $row['cod_local'];
    $sql = "SELECT promociones.cod_promo, COUNT(uso_promociones.cod_uso) AS usos 
            FROM promociones 
            LEFT JOIN uso_promociones ON promociones.cod_promo = uso_promociones.cod_promo 
            WHERE promociones.cod_local = $codLocal 
            GROUP BY promociones.cod_promo";
    $resultPromociones = mysqli_query($conn, $sql);

    if ($resultPromociones->num_rows > 0) {
        while ($row = $resultPromociones->fetch_assoc()) {
            $promociones[$codLocal][] = $row;
        }
    }
}

?>

<section class="section">
    <h2 class="title">Reportes Promociones</h2>
    <div class="container pt-4 section" style="display: flex; justify-content: center; align-items: center; flex-direction: column">
        
        <?php if (count($locales) > 0) { ?>
            <?php foreach ($locales as $local) { ?>
                <h3 class="title"><?php echo $local['nombre_local'] ?></h3>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Promoción</th>
                                <th>Usos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (array_key_exists($local['cod_local'], $promociones)) {
                                foreach ($promociones[$local['cod_local']] as $promocion) {
                                    $codPromo = $promocion["cod_promo"];
                                    $sql = "SELECT * FROM promociones WHERE cod_promo = $codPromo";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    if ($row) {
                                        $textPromo = $row['texto_promo'];
                                        echo "<tr><td>" . $textPromo . "</td><td>" . $promocion["usos"] . "</td></tr>";
                                    }
                                }
                            } else {
                                echo "<tr><td colspan='2'>No hay datos disponibles</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>No hay locales disponibles</p>
        <?php } ?>
    </div>
</section>

<?php include '../footer.php' ?>
