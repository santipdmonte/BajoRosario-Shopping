<?php 
include '../header.php';
include __DIR__ . "/../../../config/db.php";

$cod_local = $_GET['cod_local'];

// Consulta para obtener la cantidad de usos de cada promoción
$sql = "SELECT p.texto_promo, COUNT(up.cod_promo) AS usos 
        FROM promociones p 
        LEFT JOIN uso_promociones up ON p.cod_promo = up.cod_promo 
        WHERE p.cod_local = $cod_local
        GROUP BY p.cod_promo
        ORDER BY usos DESC";
$result = $conn->query($sql);

$query_local = "SELECT * FROM locales WHERE cod_local = '$cod_local'";
$result_local = mysqli_fetch_array (mysqli_query($conn, $query_local));
$conn->close();

?>

<section class="section">

    <a class="p-4" href="javascript:history.back()">< Volver</a>

    <h2 class="title">Reportes Promociones <?php echo $result_local['nombre_local']?></h2>

    <div class="container pt-4 section" style="display: flex; justify-content: center; align-items: center; flex-direction: column">
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
                    if ($result->num_rows > 0) {
                        // Mostrar los datos de cada fila
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["texto_promo"] . "</td><td>" . $row["usos"] . "</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No hay datos disponibles</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include '../footer.php' ?>

