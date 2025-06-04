<?php
include('libreria/plantilla.php');
include('objetos.php');

plantilla::aplicar();

$personaje = new Personaje();
?>
<div class="text-and mb-3">
            <a href="addpersonaje.php" class="btn btn-primary">agregar</a>

        </div>   
        
        <div>
           <table class="table table-striped table-bordered table-hover">
             <thead>
                <tr>
                  <th>cedula</th>
                  <th>foto</th>
                  <th>tipo</th>
                  <th>nombre</th>
                  <th>apellido</th>
                  <th>fecha_nacimiento</th>
                  <th>comido_favorita</th>
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
                            $personaje = json_decode($contenido);

                            echo "<tr>";
                            echo "<td>{$personaje->cedula}</td>";
                            echo "<td><img src='{$personaje->foto}' alt='Foto' style='width: 100px; height: auto;'></td>";
                            echo "<td>{$personaje->nombre}</td>";
                            echo "<td>{$personaje->apellido}</td>";
                            echo "<td>{$personaje->fecha_nacimiento}</td>";
                            echo "<td>{$personaje->comido_favorita}</td>";                           
                            echo "<td>                              
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