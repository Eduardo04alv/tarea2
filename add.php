<?php
include('libreria/plantilla.php');
include('objeto.php');
plantilla::aplicar();

$obra = new obra();

$id = $_GET['id'] ?? null;
$ruta = "datos/$id.json";

if($_POST){
    $obra->codigo = $_POST['codigo'];
    $obra->foto = $_POST['foto'];
    $obra->tipo = $_POST['tipo'];
    $obra->nombre = $_POST['nombre'];
    $obra->descripcion = $_POST['descripcion'];
    $obra->pais = $_POST['pais'];
    $obra->autor = $_POST['autor'];

    if(!is_dir(filename: 'datos')){
        mkdir(directory: 'datos');
    }

    if(!is_dir(filename: 'datos')){ 
        plantilla::aplicar();
        echo "<div class='alert alert-danger'>Error al crear la carpeta de datos</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
        exit();
    }

    $ruta = 'datos/' . $obra->codigo . '.json';
    $json = json_encode(value: $obra);

    file_put_contents(filename: $ruta, data: $json);

    plantilla::aplicar();
    echo "<div class='alert alert-success'>Obra guardada correctamente</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
    exit();
}
?>

<form method="post" action="editar.php">
    <input type="hidden" name="id" value="<?= $obra->codigo ?>">

    <div class="mb-3">
        <label for="codigo" class="form-label">Código</label>
        <input type="text" class="form-control" id="codigo" name="codigo" value="<?= $obra->codigo ?>" required>
    </div>

    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo</label>
        <select class="form-select" id="tipo" name="tipo">
            <option value="">Selecciona</option>
            <?php
            foreach (Datos::tipos_de_obras() as $key => $value) {
                $selected = ($obra->tipo == $key) ? 'selected' : '';
                echo "<option value='$key' $selected>$value</option>";
            }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $obra->nombre ?>" required>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?= $obra->descripcion ?></textarea>
    </div>

    <div class="mb-3">
        <label for="pais" class="form-label">País</label>
        <input type="text" class="form-control" id="pais" name="pais" value="<?= $obra->pais ?>">
    </div>

    <div class="mb-3">
        <label for="autor" class="form-label">Autor</label>
        <input type="text" class="form-control" id="autor" name="autor" value="<?= $obra->autor ?>">
    </div>

    <div class="mb-3">
        <label for="foto" class="form-label">Foto URL</label>
        <input type="text" class="form-control" id="foto" name="foto" value="<?= $obra->foto ?>">
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form>