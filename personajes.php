<?php
include('libreria/plantilla.php');
plantilla::aplicar();

$codigo_obra = isset($_GET['codigo_obra']) ? htmlspecialchars($_GET['codigo_obra']) : '';
$ruta_obra = "datos/{$codigo_obra}.json"; 

if (empty($codigo_obra)) {
    echo "<div class='container mt-4'>
            <div class='alert alert-warning' role='alert'>
                Por favor, selecciona una obra para ver sus personajes.
                <a href='index.php' class='alert-link'>Volver a la lista de obras</a>.
            </div>
          </div>";
    exit();
}

$obra_data = null;
$personajes_de_obra = [];
if (file_exists($ruta_obra)) {
    $contenido_obra = file_get_contents($ruta_obra);
    $obra_data = json_decode($contenido_obra);
    if ($obra_data && isset($obra_data->personaje) && is_array($obra_data->personaje)) {
        $personajes_de_obra = $obra_data->personaje;
    }
}

?>
<div class="container mt-4">
    <h2 class="mb-4">Personajes de la Obra: <?php echo htmlspecialchars($codigo_obra); ?></h2>

    <div class="text-end mb-3">
        <a href="addpersonaje.php?codigo_obra=<?php echo htmlspecialchars($codigo_obra); ?>" class="btn btn-primary">Agregar Personaje a esta Obra</a>
    </div>
    <div>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Comida Favorita</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($obra_data && !empty($personajes_de_obra)) {
                    foreach ($personajes_de_obra as $personaje) {
                        echo "<tr>";
                        echo "<td> {$personaje->cedula} </td>";
                        echo "<td><img src= {$personaje->foto} alt='Foto' style='width: 100px; height: auto;'></td>";
                        echo "<td> {$personaje->nombre}</td>";
                        echo "<td> {$personaje->apellido}</td>";
                        echo "<td> {$personaje->fecha_nacimiento}</td>";
                        echo "<td> {$personaje->comida_favorita} </td>";
                        echo "<td>
                            <a href='editarpesonaje.php?codigo_obra={$codigo_obra }&cedula={$personaje->cedula }' class='btn btn-warning btn-sm'>Editar</a>
                            <a href='eliminar_personaje.php?codigo_obra= {$codigo_obra}&cedula= {$personaje->cedula}' class='btn btn-danger btn-sm'>Eliminar</a>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No hay personajes registrados para esta obra o la obra no fue encontrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>