<?php
header('Content-Type: application/json');
require '../require/comun.php';
$bd = new BaseDatos();
$id=Leer::get("idfoto");
$modelofoto = new ModeloFoto($bd);
$foto = $modelofoto->get($id);
$ruta = "../fotos/".$foto->getUrl();
file_put_contents("log.txt", $bd->getError(), true);
unlink($ruta);
$r = $modelofoto->deletePorIdFoto($id);
echo '{"respuesta":'.$r.'}';
$bd->closeConexion();