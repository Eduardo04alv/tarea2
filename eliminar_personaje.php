<?php
ob_start(); 
include('libreria/plantilla.php');
plantilla::aplicar();
$codigo_obra = $_GET['codigo_obra'] ?? null;
$cedula_personaje = $_GET['cedula'] ?? null;
$ruta_obra = "datos/{$codigo_obra}.json";
$mensaje = "";
if (empty($codigo_obra) || empty($cedula_personaje)) {
    $mensaje = "<div class='alert alert-warning'>Código de obra o cédula de personaje no especificados.</div>";
    echo $mensaje;
    ob_end_flush();
    exit();
}
if (file_exists($ruta_obra)) {
    $contenido_obra = file_get_contents($ruta_obra);
    $obra = json_decode($contenido_obra);
    if ($obra && isset($obra->personaje) && is_array($obra->personaje)) {
        $personajes_actualizados = [];
        $eliminado = false;
        foreach ($obra->personaje as $personaje) {
            if (isset($personaje->cedula) && $personaje->cedula === $cedula_personaje) {
                $eliminado = true;
            } else {
                $personajes_actualizados[] = $personaje; 
            }
        }
        if ($eliminado) {
            $obra->personaje = $personajes_actualizados;
            if (file_put_contents($ruta_obra, json_encode($obra, JSON_PRETTY_PRINT))) {
                $mensaje = "<div class='alert alert-success'>Personaje eliminado correctamente.</div>";
            } else {
                $mensaje = "<div class='alert alert-danger'>Error al eliminar el personaje de la obra.</div>";
            }
        } else {
            $mensaje = "<div class='alert alert-warning'>Personaje no encontrado en la obra.</div>";
        }
    } else {
        $mensaje = "<div class='alert alert-warning'>La obra no contiene personajes o el formato es incorrecto.</div>";
    }
} else {
    $mensaje = "<div class='alert alert-danger'>Obra no encontrada para eliminar el personaje.</div>";
}
echo "<div class='container mt-4'>" . $mensaje . "</div>";
echo "<div class='container'><a href='personajes.php?codigo_obra=" . htmlspecialchars($codigo_obra) . "' class='btn btn-primary mt-3'>Volver a los personajes de la obra</a></div>";
ob_end_flush();
?>