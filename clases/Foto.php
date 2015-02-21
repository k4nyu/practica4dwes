<?php

class Foto{
    private $idfoto, $idplato, $url; 
    
    function __construct($idfoto = null, $idplato = null, $url= null) {
        $this->idfoto = $idfoto;
        $this->idplato = $idplato;
        $this->url = $url;
    }
    
    function set($datos, $inicio = 0){
        $this->idfoto = $datos[0+ $inicio];
        $this->idaplato = $datos[1+ $inicio];
        $this->url = $datos[2+ $inicio];
    }
    
    function getIdfoto() {
        return $this->idfoto;
    }

    function getIdplato() {
        return $this->idplato;
    }

    function getUrl() {
        return $this->url;
    }

    function setIdfoto($idfoto) {
        $this->idfoto = $idfoto;
    }

    function setIdplato($idplato) {
        $this->idplato = $idplato;
    }

    function setUrl($url) {
        $this->url = $url;
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