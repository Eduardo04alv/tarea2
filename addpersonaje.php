<?php
include('libreria/plantilla.php');
include('objeto.php');
plantilla::aplicar();

$obra_id = $_GET['codigo_obra'] ?? null;
$ruta_obra = "datos/$obra_id.json";
$mensaje = "";

if ($_POST) {
    if (file_exists($ruta_obra)) {
        $contenido = file_get_contents($ruta_obra);
        $obra = json_decode($contenido);

        $personaje = new Personaje();
        $personaje->cedula = $_POST['cedula'];
        $personaje->foto = $_POST['foto'];
        $personaje->nombre = $_POST['nombre'];
        $personaje->apellido = $_POST['apellido'];
        $personaje->fecha_nacimiento = $_POST['fecha_nacimiento'];
        $personaje->comida_favorita = $_POST['comida_favorita'];

        $obra->personaje[] = $personaje;
        file_put_contents($ruta_obra, json_encode($obra));

        $mensaje = "<div class='alert alert-success'>Personaje agregado correctamente</div>";
    } else {
        $mensaje = "<div class='alert alert-danger'>Obra no encontrada</div>";
    }
}
?>

<?= $mensaje ?>
<form method="post">
    <input type="hidden" name="obra" value="<?= $obra_id ?>">
    <div class="mb-3">
        <label>Cédula:</label>
        <input type="text" name="cedula" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Foto (URL):</label>
        <input type="text" name="foto" class="form-control">
    </div>
    <div class="mb-3">
        <label>Nombre:</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Apellido:</label>
        <input type="text" name="apellido" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Comida favorita:</label>
        <input type="text" name="comida_favorita" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Guardar personaje</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form>
