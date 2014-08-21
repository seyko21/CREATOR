<?php
/*
* --------------------------------------
* fecha: 09-08-2014 16:08:37 
* Descripcion : opcionModel.php
* --------------------------------------
*/ 

class opcionModel extends ModelORM{

    protected static $_table = 'c_opcion';
    
    protected static $_primaryKey  = 'id_opcion';
    
    private $_flag;
    private $_idModulo;
    public  $_opcion;
    public  $_prefijo;
    public  $_tipo;
    private $_database;
    private $_column;
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
        $this->_flag        = $this->post('_flag');
        $this->_idModulo    = Aes::de($this->post('_idModulo'));    /*se decifra*/
        $this->_opcion      = $this->post(T6.'txt_opcion'); 
        $this->_prefijo     = $this->post(T6.'txt_prefijo');
        $this->_tipo        = $this->post(T6.'rd_tipo');  
        $this->_database          = $this->post('_db'); 
        $this->_column          = $this->post('_column'); 
        $this->_usuario     = Session::get('sys_idUsuario');
        
        $this->_iDisplayStart  =   $this->post('iDisplayStart'); 
        $this->_iDisplayLength =   $this->post('iDisplayLength'); 
        $this->_iSortingCols   =   $this->post('iSortingCols');
        $this->_sSearch        =   $this->post('sSearch');
    }
    
    public function getRuta(){
        $query2 = "
        SELECT  
                a.`ruta`,
                m.`modulo`,
                a.base_datos
        FROM `c_modulo` m
        INNER JOIN c_aplicacion a ON a.`id_aplicacion`=m.`id_aplicacion`
        WHERE m.`id_modulo` = :idModulo AND m.`estado` <> :estado ";
        
        $parms2 = array(
            ':idModulo'=>  $this->_idModulo,
            ':estado'=>'0'
        );
        $data2 = $this->queryOne($query2,$parms2);
        
        $ruta = $data2['ruta'].'modules/'.$data2['modulo'].'/controllers/';
        
        return array('ruta'=>$ruta,'modulo'=>$data2['modulo'],'app'=>$data2['ruta'],'db'=>$data2['base_datos']);
    }

    public function getUniqueOpcion(){
        $query = "SELECT COUNT(*) AS result FROM `c_opcion` WHERE `opcion`= :opcion AND `id_modulo` = :idModulo AND `estado` <> :estado; ";
        
        $parms = array(
            ':idModulo'=>  $this->_idModulo,
            ':opcion'=>  $this->_opcion,
            ':estado'=>'0'
        );
        $data = $this->queryOne($query,$parms);
        
        return $data;
    }
    
    public function getUniquePrefijo(){
        $query = "SELECT COUNT(*) AS resultpre FROM `c_opcion` WHERE `prefijo`= :prefijo AND `id_modulo` = :idModulo AND `estado` <> :estado; ";
        
        $parms = array(
            ':idModulo'=>  $this->_idModulo,
            ':prefijo'=>  $this->_prefijo,
            ':estado'=>'0'
        );
        $data = $this->queryOne($query,$parms);
        
        return $data;
    }
    
    public function getTablesDB(){
        $query = "call sp_confUsuarioConsultas(:flag,:db,:pr);";
        
        $parms = array(
            ':flag'=>  5,
            ':db'=>  $this->_database,
            ':pr'=>  ''
        );
        $data = $this->queryAll($query,$parms);
        return $data;
    }
    
    public function getColumnsDB(){
        $query = "call sp_confUsuarioConsultas(:flag,:db,:column);";
        
        $parms = array(
            ':flag'=>  6,
            ':db'=>  $this->_database,
            ':column'=>  $this->_column
        );
        $data = $this->queryAll($query,$parms);
        return $data;
    }

    public function postCrear(){
        $query = "INSERT INTO c_opcion(
                    id_modulo,
                    opcion,
                    tipo_opcion,
                    prefijo,
                    usuario_creacion                    
                )VALUES(
                    :idModulo,
                    :opcion,
                    :tipo,
                    :prefijo,
                    :usuario
                ); ";
        
        $parms = array(
            ':idModulo'=>  $this->_idModulo,
            ':opcion'=>  $this->_opcion,
            ':tipo'=>$this->_tipo,
            ':prefijo'=> $this->_prefijo,
            ':usuario'=> $this->_usuario
        );
        $this->execute($query,$parms);
        
        return 1;
    }
    
}

?>