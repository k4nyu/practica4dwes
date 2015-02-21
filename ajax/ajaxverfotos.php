<?php
header('Content-Type: application/json');
require '../require/comun.php';
if (Leer::get("idplato") != null) {
    $idfoto = Leer::get("idplato");
}
$bd = new BaseDatos();
$modelo = new ModeloFoto($bd);
echo '{"fotos":'.$modelo->getListJSON($idfoto).'}';
$bd->closeConexion();