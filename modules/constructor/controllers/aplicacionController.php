<?php
/*
* ---------------------------------------
* --------- CREATED BY CREATOR ----------
* fecha: 18-08-2014 19:08:36 
* Descripcion : aplicacionController.php
* ---------------------------------------
*/    

class aplicacionController extends Controller{

    public function __construct() {
        $this->loadModel("aplicacion");
    }
    
    public function index(){ 
        Obj::run()->View->render("indexAplicacion");
    }
    
    public function getGridAplicacion(){
        /*-----------CONFIGURAR DATA PARA GRID---------*/
    }
    
    /*carga formulario (newAplicacion.phtml) para nuevo registro: Aplicacion*/
    public function getFormNewAplicacion(){
        Obj::run()->View->render("formNewAplicacion");
    }
    
    /*carga formulario (editAplicacion.phtml) para editar registro: Aplicacion*/
    public function getFormEditAplicacion(){
        Obj::run()->View->render("formEditAplicacion");
    }
    
    /*envia datos para grabar registro: Aplicacion*/
    public function postNewAplicacion(){
        $data = Obj::run()->aplicacionModel->newAplicacion();
        
        echo json_encode($data);
    }
    
    /*envia datos para editar registro: Aplicacion*/
    public function postEditAplicacion(){
        $data = Obj::run()->aplicacionModel->editAplicacion();
        
        echo json_encode($data);
    }
    
    /*envia datos para eliminar registro: Aplicacion*/
    public function postDeleteAplicacionAll(){
        $data = Obj::run()->aplicacionModel->deleteAplicacionAll();
        
        echo json_encode($data);
    }
    
}

?>