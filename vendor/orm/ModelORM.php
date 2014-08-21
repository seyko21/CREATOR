<?php
/*
 * Documento   : Model
 * Creado      : 03-ene-2014, 17:05:26
 * Autor       : RDCC
 * Descripcion :
 */
abstract class ModelORM extends Model{
    
    protected static $_class = '';
    
    protected static $_table = '';
    
    protected static $_primaryKey  = '';
    
    public function __construct() {
        parent::__construct();
    }
    
    /*
     * ->find(array('id_opcion'=>27,'id_modulo'=>24),array('id_opcion','opcion'));
     * ->find(27);
     */
    /*metodo para buscar */
    public function find($id, $columns = array('*')){        
        
        $params=' $params = array(';
        
        $sql = 'SELECT ';
        foreach ($columns as $col) {
            $sql.= $col.',';
        }
        $sql = substr_replace($sql, "", -1);
        $sql.=' FROM '.static::$_table;
        $sql.=' WHERE ';
        /*es array asociativo*/
        if(is_array($id)){
            foreach ($id as $key => $value) {
                /*los where*/
                $sql.= $key.'=:'.$key.' AND ';
                /*los parametros*/
                $params .= "':".$key."' => '".$value."',";
            }
            $sql = substr_replace($sql, "", -4);
        }else{
            /*los where*/
            $sql.= static::$_primaryKey.'=:'.static::$_primaryKey;
            /*los parametros*/
            $params .= "':".static::$_primaryKey."' => '".$id."',";
        } 
        $params = substr_replace($params, "", -1);
        $params .=');';
        
        eval($params);
        $roww = parent::queryOne($sql, $params);
       
        /*se agrega propiedades dinamicamente, segun el query*/
        foreach($roww as $key=>$campo){  
          $this->$key = $campo;  
          $this->array_campos[$key] = $campo;  
        }  
    }
    
    /*
     * ->all(array('campo1','campo2'));
     */
    /*select todos los registros*/
    public function all($columns = array('*')){
        $sql = 'SELECT ';
        foreach ($columns as $col) {
            $sql.= $col.',';
        }
        $sql = substr_replace($sql, "", -1);
        $sql.=' FROM '.static::$_table;
        
        return parent::queryAll($sql, array());
    }
    
    /*selecciona todos los registros segun where*/
    public function where($where, $columns = array('*')){
        $params=' $params = array(';
        
        $sql = 'SELECT ';
        foreach ($columns as $col) {
            $sql.= $col.',';
        }
        $sql = substr_replace($sql, "", -1);
        $sql.=' FROM '.static::$_table;
        $sql.=' WHERE ';
        /*es array asociativo*/
        if(is_array($where)){
            foreach ($where as $key => $value) {
                /*los where*/
                $sql.= $key.'=:'.$key.' AND ';
                /*los parametros*/
                $params .= "':".$key."' => '".$value."',";
            }
            $sql = substr_replace($sql, "", -4);
        }else{
            /*los where*/
            $sql.= static::$_primaryKey.'=:'.static::$_primaryKey;
            /*los parametros*/
            $params .= "':".static::$_primaryKey."' => '".$where."',";
        } 
        $params = substr_replace($params, "", -1);
        $params .=');';
        
        eval($params);
        return parent::queryAll($sql, $params);
    }


//    public function __call($nombre, $param){
//        echo "CON UNA INSTANCIA '$nombre'  con parametros ". implode(', ', $param)."\n";
//    }
//
//    public static function __callStatic($nombre, $param){
//      echo "CON METODO ESTATICO '$nombre'  con parametros ". implode(', ', $param)."\n";
//    }
    
}
?>
