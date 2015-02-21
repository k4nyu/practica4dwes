<?php
header('Content-Type: application/json');
require '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloPlato($bd);
$id = Leer::get("id");
$nombre = Leer::get("nombre");
$descripcion =Leer::get("descripcion");
$plato = new Plato($id, $nombre, $descripcion);
$r = $modelo->edit($plato);
echo '{"respuesta":'.$r.'}';
$bd->closeConexion();