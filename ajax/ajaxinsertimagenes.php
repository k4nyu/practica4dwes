<?php
require '../require/comun.php';
$subir = new Subir("archivo");
$subir->subir();
$nombres = $subir->getNombre();
$id = Leer::get("id");
$bd = new BaseDatos();
foreach ($nombres as $key => $urlfoto) {
    $modeloFoto = new ModeloFoto($bd);
    $foto = new Foto(null, $id, substr($nombres[$key], 9));
    $modeloFoto->add($foto);
}


$bd->closeConexion();