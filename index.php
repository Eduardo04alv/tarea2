<?php
include('libreria/plantilla.php');
plantilla::aplicar();
?>
<div class="text-and mb-3">
            <a href="add.php" class="btn btn-primary">agregar</a>

        </div>   
        
        <div>
           <table class="table table-striped table-bordered table-hover">
             <thead>
                <tr>
                  <th>Código</th>
                  <th>foto_url</th>
                  <th>tipo</th>
                  <th>nombre</th>
                  <th>descripción</th>
                  <th>país</th>
                  <th>autor</th>
                  <th>acciones</th>
                </tr>
             </thead>
             <tbody>
               <?php
                  $ruta = 'datos/';
                  if (is_dir($ruta)) {
                     $archivos = scandir($ruta);
                     foreach ($archivos as $archivo) {
                      if (pathinfo($archivo, PATHINFO_EXTENSION) === 'json') {
                          $contenido = file_get_contents($ruta . $archivo);
                            $obra = json_decode($contenido);

                            echo "<tr>";
                            echo "<td>{$obra->codigo}</td>";
                            echo "<td><img src='{$obra->foto}' alt='Foto' style='width: 100px; height: auto;'></td>";
                            echo "<td>{$obra->tipo}</td>";
                            echo "<td>{$obra->nombre}</td>";
                            echo "<td>{$obra->descripcion}</td>";
                            echo "<td>{$obra->pais}</td>";
                            echo "<td>{$obra->autor}</td>";
                            echo "<td>
                               <a href='personajes.php?id=<?= $obra->codigo ?>' class='btn btn-info'>Ver personajes</a>
                               <a href='editar.php?id={$obra->codigo}' class='btn btn-warning'>Editar</a>
                               <a href='eliminar.php?id={$obra->codigo}' class='btn btn-danger'>Eliminar</a>
                            </td>";
                            echo "</tr>";
                          }
                        }
                         } else {
                          echo "<tr><td colspan='8'>No hay obras registradas.</td></tr>";
                        }
                        ?>
                </tbody>
           </table>  
        </div>
    </div>
</body>
</html>