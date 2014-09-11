<?php
class BasicController{
 
    public static function create($ruta,$opcion,$pre){
        /*crear archivo controller BASICO*/
        $capitaleOpcion = Functions::capitalize($opcion);
        
        $contenido='<?php
/*
* ---------------------------------------
* --------- CREATED BY CREATOR ----------
* fecha: '.date('d-m-Y H:m:s').' 
* Descripcion : '.$opcion.'Controller.php
* ---------------------------------------
*/    

class '.$opcion.'Controller extends Controller{

    public function __construct() {
        $this->loadModel("'.$opcion.'");
    }
    
    public function index(){ 
        Obj::run()->View->render("index'.$capitaleOpcion.'");
    }
    
    public function getGrid'.$capitaleOpcion.'(){
        $editar   = Session::getPermiso(\''.$pre.'ED\');
        $eliminar = Session::getPermiso(\''.$pre.'DE\');
        
        $sEcho          =   $this->post(\'sEcho\');
        
        $rResult = Obj::run()->'.$opcion.'Model->get'.$capitaleOpcion.'();
        
        $num = Obj::run()->'.$opcion.'Model->_iDisplayStart;
        if($num >= 10){
            $num++;
        }else{
            $num = 1;
        }
        
        if(!isset($rResult[\'error\'])){  
            $iTotal         = isset($rResult[0][\'total\'])?$rResult[0][\'total\']:0;
            
            $sOutput = \'{\';
            $sOutput .= \'"sEcho": \'.intval($sEcho).\', \';
            $sOutput .= \'"iTotalRecords": \'.$iTotal.\', \';
            $sOutput .= \'"iTotalDisplayRecords": \'.$iTotal.\', \';
            $sOutput .= \'"aaData": [ \';     
            
            foreach ( $rResult as $aRow ){
                
                /*campo que maneja los estados, para el ejemplo aqui es ACTIVO, coloca tu campo*/
                if($aRow[\'activo\'] == 1){
                    $estado = \'<span class=\"label label-success\">\'.LABEL_ACT.\'</span>\';
                }else{
                    $estado = \'<span class=\"label label-danger\">\'.LABEL_DES.\'</span>\';
                }
                
                /*antes de enviar id se encrypta*/
                $encryptReg = Aes::en($aRow[\'ID_REGISTRO\']);
                
                /*
                 * configurando botones (add/edit/delete etc)
                 * se verifica si tiene permisos para editar
                 */
                $axion = \'"<div class=\"btn-group\">\';
                 
                if($editar[\'permiso\']){
                    $axion .= \'<button type=\"button\" class=\"\'.$editar[\'theme\'].\'\" title=\"\'.$editar[\'accion\'].\'\" onclick=\"'.$opcion.'.getFormEdit'.$capitaleOpcion.'(this,\\\'\'.$encryptReg.\'\\\')\">\';
                    $axion .= \'    <i class=\"\'.$editar[\'icono\'].\'\"></i>\';
                    $axion .= \'</button>\';
                }
                if($eliminar[\'permiso\']){
                    $axion .= \'<button type=\"button\" class=\"\'.$eliminar[\'theme\'].\'\" title=\"\'.$eliminar[\'accion\'].\'\" onclick=\"'.$opcion.'.postDelete'.$capitaleOpcion.'(this,\\\'\'.$encryptReg.\'\\\')\">\';
                    $axion .= \'    <i class=\"\'.$eliminar[\'icono\'].\'\"></i>\';
                    $axion .= \'</button>\';
                }
                
                $axion .= \' </div>" \';
                
                /*registros a mostrar*/
                $sOutput .= \'["\'.($num++).\'",\'.$axion.\',"\'.$aRow[\'CAMPO 1\'].\'","\'.$aRow[\'CAMPO 2\'].\'","\'.$estado.\'" \';

                $sOutput .= \'],\';

            }
            $sOutput = substr_replace( $sOutput, "", -1 );
            $sOutput .= \'] }\';
        }else{
            $sOutput = $rResult[\'error\'];
        }
        
        echo $sOutput;

    }
    
    /*carga formulario (new'.$capitaleOpcion.'.phtml) para nuevo registro: '.$capitaleOpcion.'*/
    public function getFormNew'.$capitaleOpcion.'(){
        Obj::run()->View->render("formNew'.$capitaleOpcion.'");
    }
    
    /*carga formulario (edit'.$capitaleOpcion.'.phtml) para editar registro: '.$capitaleOpcion.'*/
    public function getFormEdit'.$capitaleOpcion.'(){
        Obj::run()->View->render("formEdit'.$capitaleOpcion.'");
    }
    
    /*busca data para editar registro: '.$capitaleOpcion.'*/
    public static function find'.$capitaleOpcion.'(){
        $data = Obj::run()->'.$opcion.'Model->find'.$capitaleOpcion.'();
            
        return $data;
    }
    
    /*envia datos para grabar registro: '.$capitaleOpcion.'*/
    public function postNew'.$capitaleOpcion.'(){
        $data = Obj::run()->'.$opcion.'Model->new'.$capitaleOpcion.'();
        
        echo json_encode($data);
    }
    
    /*envia datos para editar registro: '.$capitaleOpcion.'*/
    public function postEdit'.$capitaleOpcion.'(){
        $data = Obj::run()->'.$opcion.'Model->edit'.$capitaleOpcion.'();
        
        echo json_encode($data);
    }
    
    /*envia datos para eliminar registro: '.$capitaleOpcion.'*/
    public function postDelete'.$capitaleOpcion.'(){
        $data = Obj::run()->'.$opcion.'Model->delete'.$capitaleOpcion.'();
        
        echo json_encode($data);
    }
    
    /*envia datos para eliminar registros: '.$capitaleOpcion.'*/
    public function postDelete'.$capitaleOpcion.'All(){
        $data = Obj::run()->'.$opcion.'Model->delete'.$capitaleOpcion.'All();
        
        echo json_encode($data);
    }
    
}

?>';
        $fp=fopen($ruta['ruta'].$opcion.'Controller.php',"x");
        fwrite($fp,$contenido);
        fclose($fp) ;
    }
    
}
?>