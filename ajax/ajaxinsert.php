<?php
header('Content-Type: application/json');
require '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloPlato($bd);
$nombre = Leer::get("nombre");
$descripcion =Leer::get("descripcion");
$plato = new Plato(null, $nombre, $descripcion);
$r = $modelo->add($plato);
echo '{"respuesta":'.$r.', "id":'.$bd->getAutonumerico().'}';
$bd->closeConexion();