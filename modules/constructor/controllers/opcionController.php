<?php
/*
* --------------------------------------
* fecha: 09-08-2014 16:08:37 
* Descripcion : opcionController.php
* --------------------------------------
*/    

class opcionController extends Controller{    
    
    public function __construct() {
        parent::__construct();
        $this->loadModel('opcion');
    }
    
    public function index(){ 
        Obj::run()->View->render('indexOpcion');
    }
    
    public function getUnique(){ 
        //$t=$mm->find(array('id_opcion'=>27,'id_modulo'=>24),array('id_opcion','opcion'));
//        Obj::$call->opcionModel->find(27);
//        echo Obj::$call->opcionModel->usuario_creacion;
        
//        $all = Obj::$call->opcionModel->all(array('id_opcion','opcion'));
//        print_r($all);
        
//        $allwhere = Obj::$call->opcionModel->where('id_modulo','=','38')
//                ->where('tipo_opcion','<>','A')
//                ->limit('10');
//        print_r($allwhere);
//        exit;
        
        
        $data = Obj::run()->opcionModel->getUniqueOpcion();   /*valida si opcion existe en la db*/
        $datap= Obj::run()->opcionModel->getUniquePrefijo();  /*valida si prefijo existe en la db*/
        $ruta = Obj::run()->opcionModel->getRuta();   /*ruta*/
        
        $r = $ruta['ruta'].Obj::run()->opcionModel->_opcion.'Controller.php';
       
        /*validar si existe modulo*/
        $existModulo = Obj::run()->Creator->validateModulo($ruta);
        
        /*valida si opcion existe en modulo de aplicacion*/
        if(!Obj::run()->Creator->validateOpcion($r)){
            $datax = array('result1'=>$data['result'],'result2'=>1,'prefijo'=>$datap['resultpre'],'existModulo'=>$existModulo,'modulo'=>$ruta['modulo'],'db'=>$ruta['db']);
        }else{
            $datax = array('result1'=>$data['result'],'result2'=>3,'prefijo'=>$datap['resultpre'],'existModulo'=>$existModulo,'modulo'=>$ruta['modulo']);
        }
        
        echo json_encode($datax);
    }
    
    public function getFormTablesDB(){
        Obj::run()->View->render('tables');
    }

    public static function getTablesDB(){
        $data = Obj::run()->opcionModel->getTablesDB(); 
        
        return $data;
    }
    
    public function getHtmlColumnas(){
        Obj::run()->View->render('columnas');
    }
    
    public static function getColumnsDB(){
        $data = Obj::run()->opcionModel->getColumnsDB(); 
        
        return $data;
    }
    
    public function getFormData(){
        $tipo = $this->post('_tipoData');
        $element = $this->post('_element');
        
        if($element == 'select'){
            if($tipo == 'F'){//data fija
                Obj::run()->View->render('formSelectF');
            }elseif($tipo == 'D'){//data dinamica
                Obj::run()->View->render('formSelectD');
            }
        }
        
    }
    
    public function postCrear(){ 
        $data = Obj::run()->opcionModel->postCrear();
        
        if($data == 1){
            $ruta = Obj::run()->opcionModel->getRuta();   /*ruta,modulo*/
            
            Obj::run()->Creator->createOpcion($ruta,Obj::run()->opcionModel->_opcion,Obj::run()->opcionModel->_tipo,Obj::run()->opcionModel->_prefijo);
        }
        
        $datax = array('result'=>$data);
        echo json_encode($datax);
    }
    
}

?>