<?php
include('libreria/plantilla.php');
plantilla::aplicar();

$id = $_GET['codigo_obra'] ?? null;

if ($id) {
    $ruta = "datos/$id.json";

    if (file_exists($ruta)) {
        unlink($ruta);
        echo "<div class='alert alert-success'>Obra eliminada correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger'>La obra no existe.</div>";
    }
} else {
    echo "<div class='alert alert-warning'>ID no especificado.</div>";
}
?>

<a href="index.php" class="btn btn-primary mt-3">Volver al inicio</a>
