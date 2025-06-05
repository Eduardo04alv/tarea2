<?php
// Cargar la clase personaje y obra
require_once('objeto.php');

$codigo_obra = $_GET['codigo_obra'] ?? null;
$cedula = $_GET['cedula'] ?? null;
$mensaje = "";

if (!$codigo_obra || !$cedula) {
    die("Código de obra o cédula no especificado.");
}

$ruta_obra = "datos/$codigo_obra.json";

if (!file_exists($ruta_obra)) {
    die("La obra no existe.");
}

$contenido = file_get_contents($ruta_obra);
$obra = json_decode($contenido);

$personaje_encontrado = null;
foreach ($obra->personaje as $p) {
    if ($p->cedula == $cedula) {
        $personaje_encontrado = $p;
        break;
    }
}

if (!$personaje_encontrado) {
    die("Personaje no encontrado.");
}

// Si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $personaje_encontrado->nombre = $_POST['nombre'];
    $personaje_encontrado->apellido = $_POST['apellido'];
    $personaje_encontrado->fecha_nacimiento = $_POST['fecha_nacimiento'];
    $personaje_encontrado->comida_favorita = $_POST['comida_favorita'];

    // Guardar cambios en el JSON
    file_put_contents($ruta_obra, json_encode($obra, JSON_PRETTY_PRINT));
    $mensaje = "Personaje actualizado correctamente.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Personaje</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Editar Personaje</h2>
    
    <?php if ($mensaje): ?>
        <div class="alert alert-success"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label>Cédula:</label>
            <input type="text" class="form-control" value="<?php echo $personaje_encontrado->cedula; ?>" disabled>
        </div>
        <div class="mb-3">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo $personaje_encontrado->nombre; ?>" required>
        </div>
        <div class="mb-3">
            <label>Apellido:</label>
            <input type="text" name="apellido" class="form-control" value="<?php echo $personaje_encontrado->apellido; ?>" required>
        </div>
        <div class="mb-3">
            <label>Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" class="form-control" value="<?php echo $personaje_encontrado->fecha_nacimiento; ?>" required>
        </div>
        <div class="mb-3">
            <label>Comida Favorita:</label>
            <input type="text" name="comida_favorita" class="form-control" value="<?php echo $personaje_encontrado->comida_favorita; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="verpersonajes.php?codigo_obra=<?php echo $codigo_obra; ?>" class="btn btn-secondary">Volver</a>

    </form>
</body>
</html>
