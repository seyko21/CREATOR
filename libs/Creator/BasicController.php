<?php
class BasicController{
 
    public static function create($ruta,$opcion){
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
        /*-----------CONFIGURAR DATA PARA GRID---------*/
    }
    
    /*carga formulario (new'.$capitaleOpcion.'.phtml) para nuevo registro: '.$capitaleOpcion.'*/
    public function getFormNew'.$capitaleOpcion.'(){
        Obj::run()->View->render("formNew'.$capitaleOpcion.'");
    }
    
    /*carga formulario (edit'.$capitaleOpcion.'.phtml) para editar registro: '.$capitaleOpcion.'*/
    public function getFormEdit'.$capitaleOpcion.'(){
        Obj::run()->View->render("formEdit'.$capitaleOpcion.'");
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