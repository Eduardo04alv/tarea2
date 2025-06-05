<?php
class obra{
    public $codigo;
    public $foto;
    public $tipo;
    public $nombre;
    public $descripcion;
    public $pais;
    public $autor;
   public $personaje = array();
}
class personaje {
   public $cedula;
   public $foto;
   public $nombre;
   public $apellido;
   public $fecha_nacimiento;
   public $comida_favorita; 
}
class Datos{
public static function tipos_de_obras(){
return array(
'pelicula' => 'pelicula',
'serie' => 'serie',
'libro' => 'libro'
);
}
}
?>