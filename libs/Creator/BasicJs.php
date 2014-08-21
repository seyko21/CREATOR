<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BasicJs
 *
 * @author RDCC
 */
class BasicJs {
    
    /*crear archivo js BASICO*/
    public static function create($ruta,$opcion,$pre){
        $capitaleOpcion = Functions::capitalize($opcion);
        
        $contenido = '/*
* ---------------------------------------
* --------- CREATED BY CREATOR ----------
* fecha: '.date('d-m-Y H:m:s').' 
* Descripcion : '.$opcion.'.js
* ---------------------------------------
*/
var '.$opcion.'_ = function(){
    
    /*metodos privados*/
    var _private = {};
    
    _private.id'.$capitaleOpcion.' = 0;
    
    _private.config = {
        modulo: "'.$ruta['modulo'].'/'.$opcion.'/"
    };

    /*metodos publicos*/
    this.publico = {};
    
    /*crea tab : '.$capitaleOpcion.'*/
    this.publico.main = function(element){
        simpleScript.addTab({
            id : diccionario.tabs.'.$pre.',
            label: $(element).attr("title"),
            fnCallback: function(){
                '.$opcion.'.getContenido();
            }
        });
    };
    
    /*contenido de tab: '.$capitaleOpcion.'*/
    this.publico.getContenido = function(){
        simpleAjax.send({
            dataType: "html",
            root: _private.config.modulo,
            fnCallback: function(data){
                $("#"+diccionario.tabs.'.$pre.'+"_CONTAINER").html(data);
                '.$opcion.'.getGrid'.$capitaleOpcion.'();
            }
        });
    };
    
    this.publico.getGrid'.$capitaleOpcion.' = function (){
        /*------------------LOGICA PARA DATAGRID------------------------*/
    };
    
    this.publico.getFormNew'.$capitaleOpcion.' = function(btn){
        simpleAjax.send({
            element: btn,
            dataType: "html",
            root: _private.config.modulo + "getFormNew'.$capitaleOpcion.'",
            fnCallback: function(data){
                $("#cont-modal").append(data);  /*los formularios con append*/
                $("#"+diccionario.tabs.'.$pre.'+"formNew'.$capitaleOpcion.'").modal("show");
            }
        });
    };
    
    this.publico.postNew'.$capitaleOpcion.' = function(){
        /*-----LOGICA PARA ENVIO DE FORMULARIO-----*/
    };
    
    this.publico.postDelete'.$capitaleOpcion.'All = function(btn){
        simpleScript.validaCheckBox({
            id: "#"+diccionario.tabs.'.$pre.'+"grid'.$capitaleOpcion.'",
            msn: mensajes.MSG_9,
            fnCallback: function(){
                simpleScript.notify.confirm({
                    content: mensajes.MSG_7,
                    callbackSI: function(){
                        simpleAjax.send({
                            flag: 3, //si se usa SP usar flag, sino se puede eliminar esta linea
                            element: btn,
                            form: "#"+diccionario.tabs.'.$pre.'+"formGrid'.$capitaleOpcion.'",
                            root: _private.config.modulo + "postDelete'.$capitaleOpcion.'All",
                            fnCallback: function(data) {
                                if(!isNaN(data.result) && parseInt(data.result) === 1){
                                    simpleScript.notify.ok({
                                        content: mensajes.MSG_8,
                                        callback: function(){
                                            '.$opcion.'.getGrid'.$capitaleOpcion.'();
                                        }
                                    });
                                }
                            }
                        });
                    }
                });
            }
        });
    };
    
    return this.publico;
    
};
var '.$opcion.' = new '.$opcion.'_();';
        $r = $ruta['app'].'/modules/'.$ruta['modulo'].'/views/js/';
        
        $fp=fopen($r.$opcion.'.js',"x");
        fwrite($fp,$contenido);
        fclose($fp) ;
    }
    
}
