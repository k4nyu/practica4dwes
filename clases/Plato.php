<?php

class Plato{
    
    private $idplato, $nombre, $descripcion;
    
   function __construct($idplato=null, $nombre=null, $descripcion=null){
        $this->idplato=$idplato;
        $this->nombre=$nombre;
        $this->descripcion=$descripcion;
    }
    
    function set($datos, $inicio=0){
        $this->idplato= $datos[0+$inicio];
        $this->nombre= $datos[1+$inicio];
        $this->descripcion= $datos[2+$inicio];
    }
    
    function getIdplato() {
        return $this->idplato;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setIdplato($idplato) {
        $this->idplato = $idplato;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    
    public function getJSON(){
        $prop = get_object_vars($this);//todas las variables de instancia de esta clase
        $resp = '{';
        foreach ($prop as $key => $value){
            $resp.='"' . $key . '":'.json_encode(htmlspecialchars_decode($value)).',';
        }
        $resp = substr($resp, 0, -1)."}";
        return $resp;
    }
}

