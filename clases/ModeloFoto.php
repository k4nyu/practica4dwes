<?php

class ModeloFoto{
    
    private $bd;
    private $tabla="foto";
    
    function __construct(BaseDatos $bd){
        $this->bd=$bd;
    }
    
    function add(Foto $objeto){
        $sql="insert into $this->tabla values(null, :idplato, :url);";
        $parametros["idplato"]=$objeto->getIdplato();
        $parametros["url"]=$objeto->getUrl();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
    function delete (Foto $objeto){
        $sql="delete from $this->tabla where idplato=:idplato";
        $parametros["idplato"]=$objeto->getIdplato();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
    function deletePorIdFoto($idfoto){
        $sql="delete from $this->tabla where idfoto=:idfoto";
        $parametros["idfoto"]=$idfoto;
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
    function deletePorIdplato($idplato){
        return $this->delete(new Foto(null, $idplato));
    }
    
    function edit(Foto $objeto){
        $sql="update $this->tabla set url=:url, idplato=:idplato where idfoto=:idfoto;";
        $parametros["url"]=$objeto->getUrl();
        $parametros["idplato"]=$objeto->getIdplato();
        $parametros["idfoto"]=$objeto->getIdfoto();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    function editPK(Foto $objetoOriginal, Foto $objetoNuevo){
        $sql="update $this->tabla set idplato=:idplato, url=:url where idfoto=:idfotopk;";
        $parametros["idplato"]=$objetoNuevo->getIdplato();
        $parametros["url"]=$objetoNuevo->getUrl();
        $parametros["idfoto"]=$objetoNuevo->getIdfoto();
        $parametros["idfotopk"]=$objetoOriginal->getIdfoto();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
    function get($idfoto){
        $consultaSql = "select * from $this->tabla where idfoto=:idfoto";
        $arrayConsulta["idfoto"]=$idfoto;
        $resultado= $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if($resultado){
            $foto= new Foto();
            $foto->set($this->bd->getFila());
            return $foto;
        }
        return null;
    }
    
    function getFotoIdPlato($idplato) {
        $sql = "select * from $this->tabla where idplato= :idplato";
        $parametros["idplato"] = $idplato;
        $r = $this->bd->setConsulta($sql, $parametros);
        $arrayFotos = array();
        if ($r) 
        {
            while ($fila = $this->bd->getFila()) 
            {
                $foto = new Foto();
                $foto->set($fila);
                $arrayFotos[] = $foto;
            }            
            return $arrayFotos;
        }
        return null;
    }
    
    function count($condicion="1=1", $parametros=array()){
        $sql="select count(*) from $this->tabla where $condicion";
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            $variable = $this->bd->getFila();
            return $variable[0];
        }
        return -1;
    }
    
    function getFotos($idplato){
        $sql="select * from $this->tabla where idplato=:idplato";
        $parametros["idplato"]=$idplato;
        $r=$this->bd->setConsulta($sql, $parametros);
        if($r){
            while($fila=$this->bd->getFila()){
                $foto= new Foto();
                $foto->set($fila);
                $list[]=$foto;
            }
        } else{
            return null;
        }    
        return $list;
    }
    
    function getListJSON($idplato){
        $sql = "select * from $this->tabla where idplato=:idplato";
        $parametros["idplato"]=$idplato;
        $this->bd->setConsulta($sql, $parametros);
        $r = "[ ";
        while($datos = $this->bd->getFila()){
            $plato = new Foto();
            $plato->set($datos);
            $r .= $plato->getJSON() . ",";
        }
        $r = substr($r, 0, -1)."]";
        return $r;
    }
    
    function selectHtml($idfoto, $name, $condicion, $parametros, $valorSeleccionado="", $blanco=true, $textoBlanco="&nbsp;"){
        $select="<select name='$name' id='$id'>";
        if($blanco){
            $select.="<option value=''>$textoBlanco</option>";
        }
        $select.="</select>";
        return $select;
    }
    
}