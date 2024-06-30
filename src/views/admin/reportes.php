<!--Por último, el administrador podrá monitorear la utilización de los descuentos en los
locales del shopping mediante reportes gerenciales brindados por el sistema a desarrollar.-->

<!--Se crea un contador en la base de datos que se actualize cada vez que sea 
utilizada para que el admin pueda obsercvar la cantidad de veces que fue utilizada la promocion -->

 


<?php 
include '../header.php';
include __DIR__ . "/../../../config/db.php";

// Consulta para obtener la cantidad de usos de cada promoción
$sql = "SELECT p.texto_promo, COUNT(up.cod_promo) AS usos 
        FROM promociones p 
        LEFT JOIN uso_promociones up ON p.cod_promo = up.cod_promo 
        GROUP BY p.cod_promo";
$result = $conn->query($sql);

$sql = "SELECT l.nombre_local, l.cod_local, p.texto_promo, COUNT(up.cod_promo) AS usos 
        FROM promociones p 
        LEFT JOIN uso_promociones up ON p.cod_promo = up.cod_promo 
        INNER JOIN locales l ON p.cod_local = l.cod_local
        GROUP BY p.cod_promo
        ORDER BY usos DESC
        LIMIT 10
        ";
$result2 = $conn->query($sql);

$sql = "SELECT l.nombre_local, l.cod_local, COUNT(up.cod_promo) AS usos 
        FROM promociones p 
        INNER JOIN uso_promociones up ON p.cod_promo = up.cod_promo 
        INNER JOIN locales l ON p.cod_local = l.cod_local
        GROUP BY l.cod_local
        ORDER BY usos DESC";
$result3 = $conn->query($sql);
?>

<section class="section">
    <h2 class="title">Reportes Promociones</h2>
    <div class="container pt-4 section" style="display: flex; justify-content: center; align-items: center; flex-direction: column">
        
        <div>
            <h4 for="">Top 10 Promos</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Local</th>
                        <th>Promoción</th>
                        <th>Usos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result2->num_rows > 0) {
                        // Mostrar los datos de cada fila
                        while($row = $result2->fetch_assoc()) {
                            echo "<tr><td><a href='reportes/". $row["cod_local"] ."'>" . $row["nombre_local"] . "</a></td><td>" . $row["texto_promo"] . "</td><td>" . $row["usos"] . "</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No hay datos disponibles</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div>
            <h4 for="">Promociones por locales</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Local</th>
                        <th>Usos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result3->num_rows > 0) {
                        // Mostrar los datos de cada fila
                        while($row = $result3->fetch_assoc()) {
                            echo "<tr><td><a href='reportes/". $row["cod_local"] ."'>" . $row["nombre_local"] . "</a></td><td>" . $row["usos"] . "</td></tr>";
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

<?php include '../footer.html' ?>

<?php $conn->close(); ?>

