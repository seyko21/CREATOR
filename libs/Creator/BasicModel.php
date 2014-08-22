<?php
/**
 * Description of BasicModel
 *
 * @author RDCC
 */
class BasicModel {
    
    public static function create($ruta,$opcion){
        /*crear archivo model BASICO*/
        $capitaleOpcion = Functions::capitalize($opcion);
        $contenido = '<?php
/*
* ---------------------------------------
* --------- CREATED BY CREATOR ----------
* fecha: '.date('d-m-Y H:m:s').' 
* Descripcion : '.$opcion.'Model.php
* ---------------------------------------
*/ 

class '.$opcion.'Model extends Model{

    private $_id'.$capitaleOpcion.';
    private $_usuario;
    
    /*para el grid*/
    private $_iDisplayStart;
    private $_iDisplayLength;
    private $_iSortingCols;
    private $_sSearch;
    
    public function __construct() {
        parent::__construct();
        $this->_set();
    }
    
    private function _set(){
        $this->_id'.$capitaleOpcion.'   = Aes::de(Formulario::getParam("_id'.$capitaleOpcion.'"));    /*se decifra*/
        $this->_usuario                 = Session::get("sys_idUsuario");
        
        $this->_iDisplayStart  =   Formulario::getParam("iDisplayStart"); 
        $this->_iDisplayLength =   Formulario::getParam("iDisplayLength"); 
        $this->_iSortingCols   =   Formulario::getParam("iSortingCols");
        $this->_sSearch        =   Formulario::getParam("sSearch");
    }
    
    /*grabar nuevo registro: '.$capitaleOpcion.'*/
    public function new'.$capitaleOpcion.'(){
        /*-------------------------LOGICA PARA EL INSERT------------------------*/
    }
    
    /*seleccionar registro a editar: '.$capitaleOpcion.'*/
    public function find'.$capitaleOpcion.'(){
        /*-----------------LOGICA PARA SELECT REGISTRO A EDITAR-----------------*/
    }
    
    /*editar registro: '.$capitaleOpcion.'*/
    public function edit'.$capitaleOpcion.'(){
        /*-------------------------LOGICA PARA EL UPDATE------------------------*/
    }
    
    /*eliminar varios registros: '.$capitaleOpcion.'*/
    public function delete'.$capitaleOpcion.'All(){
        /*--------------------------LOGICA PARA DELETE--------------------------*/
    }
    
}

?>';    
        $r = $ruta['app'].'/modules/'.$ruta['modulo'].'/models/';
        
        $fp=fopen($r.$opcion.'Model.php',"x");
        fwrite($fp,$contenido);
        fclose($fp) ;
    }
    
}
