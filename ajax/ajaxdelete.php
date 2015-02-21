<?php
header('Content-Type: application/json');
require '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloPlato($bd);
$id=Leer::get("id");
$modelofoto = new ModeloFoto($bd);
$fotos = $modelofoto->getFotos($id);
foreach($fotos as $key => $value) {
    $ruta = "../fotos/".$value->getUrl();
    unlink($ruta);
}
$modelofoto->deletePorIdPlato($id);
$r = $modelo->deletePorIdplato($id);
echo '{"respuesta":'.$r.'}';
$bd->closeConexion();