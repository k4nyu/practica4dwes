<?php

header('Content-Type: application/json');
require '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloPlato($bd);
$plato = $modelo->get(Leer::get("id"));
echo '{"nombre":"'.$plato->getNombre().'","descripcion": "'.$plato->getDescripcion().'"}';