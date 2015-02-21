<?php
header('Content-Type: application/json');
require '../require/comun.php';
$pagina = 0;
if (Leer::get("pagina") != null) {
    $pagina = Leer::get("pagina");
}
$bd = new BaseDatos();
$modelo = new ModeloPlato($bd);
$enlaces = Paginacion::getEnlacesPaginacionJSON($pagina,$modelo->count(),Configuracion::RPP);
echo '{"paginas":'.json_encode($enlaces).',"plato":'.$modelo->getListJSON($pagina, Configuracion::RPP).'}';
$bd->closeConexion();