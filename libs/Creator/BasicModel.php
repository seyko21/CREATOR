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

    private $_flag;
    private $_id'.$capitaleOpcion.';
    private $_activo;
    private $_usuario;
    
    /*para el grid*/
    public  $_iDisplayStart;
    private $_iDisplayLength;
    private $_iSortingCols;
    private $_sSearch;
    
    public function __construct() {
        parent::__construct();
        $this->_set();
    }
    
    private function _set(){
        $this->_flag        = Formulario::getParam("_flag");
        $this->_id'.$capitaleOpcion.'   = Aes::de(Formulario::getParam("_id'.$capitaleOpcion.'"));    /*se decifra*/
        $this->_usuario     = Session::get("sys_idUsuario");
        
        $this->_iDisplayStart  = Formulario::getParam("iDisplayStart"); 
        $this->_iDisplayLength = Formulario::getParam("iDisplayLength"); 
        $this->_iSortingCols   = Formulario::getParam("iSortingCols");
        $this->_sSearch        = Formulario::getParam("sSearch");
    }
    
    /*data para el grid: '.$capitaleOpcion.'*/
    public function get'.$capitaleOpcion.'(){
        $aColumns       =   array("","","REGISTRO_A_ORDENAR" ); //para la ordenacion y pintado en html
        /*
	 * Ordenando, se verifica por que columna se ordenara
	 */
        $sOrder = "";
        for ( $i=0 ; $i<intval( $this->_iSortingCols ) ; $i++ ){
                if ( $this->post( "bSortable_".intval($this->post("iSortCol_".$i)) ) == "true" ){
                        $sOrder .= " ".$aColumns[ intval( $this->post("iSortCol_".$i) ) ]." ".
                                ($this->post("sSortDir_".$i)==="asc" ? "asc" : "desc") ." ";
                }
        }
        
        $query = "call sp [NOMBRE_PROCEDIMIENTO_GRID] Grid(:iDisplayStart,:iDisplayLength,:sOrder,:sSearch);";
        
        $parms = array(
            ":iDisplayStart" => $this->_iDisplayStart,
            ":iDisplayLength" => $this->_iDisplayLength,
            ":sOrder" => $sOrder,
            ":sSearch" => $this->_sSearch,
        );
        $data = $this->queryAll($query,$parms);
        return $data;
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
