<?php

class ModeloPlato{
    private $bd;
    private $tabla="plato";
    
    function __construct(BaseDatos $bd){
        $this->bd=$bd;
    }
    
    function add(Plato $objeto){
        $sql="insert into $this->tabla values(null, :nombre, :descripcion);";
        $parametros["nombre"]=$objeto->getNombre();
        $parametros["descripcion"]=$objeto->getDescripcion();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
    function delete (Plato $objeto){
        $sql="delete from $this->tabla where idplato=:idplato";
        $parametros["idplato"]=$objeto->getIdplato();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
    function deletePorIdplato($idplato){
        return $this->delete(new Plato($idplato));
    }
    
    function edit(Plato $objeto){
        $sql="update $this->tabla set nombre=:nombre, descripcion=:descripcion "
                . "where idplato=:idplato;";
        $parametros["nombre"]=$objeto->getNombre();
        $parametros["descripcion"]=$objeto->getDescripcion();
        $parametros["idplato"]=$objeto->getIdplato();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
    function editPK(Plato $objetoOriginal, Plato $objetoNuevo){
        $sql="update $this->tabla set nombre=:nombre, descripcion=:descripcion "
                . "where idplato=:idplatopk;";
        $parametros["nombre"]=$objeto->getNombre();
        $parametros["descripcion"]=$objeto->getDescripcion();
        $parametros["idplato"]=$objetoNuevo->getId();
        $parametros["idplatopk"]=$objetoOriginal->getId();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
    function get($idplato){
        $consultaSql = "select * from $this->tabla where idplato=:idplato";
        $arrayConsulta["idplato"]=$idplato;
        $resultado= $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if($resultado){
            $plato= new Plato();
            $plato->set($this->bd->getFila());
            return $plato;
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
    
    function getPlatos($pagina=0, $rpp=10, $condicion="1=1", $parametros=array(), $orderby=1){
        $list=array();
        $principio = $pagina*$rpp;
        $sql="select * from $this->tabla where $condicion order by $orderby limit $principio,$rpp";
        $r=$this->bd->setConsulta($sql, $parametros);
        if($r){
            while($fila=$this->bd->getFila()){
                $anuncio= new Plato();
                $anuncio->set($fila);
                $list[]=$anuncio;
            }
        } else{
            return null;
        }    
        return $list;
    }
    
    function getListJSON($pagina = 0, $rpp = 3, $condicion = "1=1", $parametros = array(), $orderby = "1"){
        $pos = $pagina * $rpp;
        $sql = "select * from $this->tabla where $condicion order by $orderby limit $pos, $rpp";
        $this->bd->setConsulta($sql, $parametros);
        $r = "[ ";
        while($datos = $this->bd->getFila()){
            $plato = new Plato();
            $plato->set($datos);
            $r .= $plato->getJSON() . ",";
        }
        $r = substr($r, 0, -1)."]";
        return $r;
    }
    
    function selectHtml($idanuncio, $name, $condicion, $parametros, $valorSeleccionado="", $blanco=true, $textoBlanco="&nbsp;"){
        $select="<select name='$name' id='$id'>";
        if($blanco){
            $select.="<option value=''>$textoBlanco</option>";
        }
        $select.="</select>";
        return $select;
    }
    
}
