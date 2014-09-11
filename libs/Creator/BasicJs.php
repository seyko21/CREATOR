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
        var oTable = $("#"+diccionario.tabs.'.$pre.'+"grid'.$capitaleOpcion.'").dataTable({
            bProcessing: true,
            bServerSide: true,
            bDestroy: true,
            sPaginationType: "bootstrap_full", //two_button
            sServerMethod: "POST",
            bPaginate: true,
            iDisplayLength: 10,            
            aoColumns: [
                {sTitle: "N°", sWidth: "1%",bSortable: false},
                {sTitle: "Acciones", sWidth: "8%", sClass: "center", bSortable: false},
                {sTitle: "CAMPO 1", sWidth: "25%"},
                {sTitle: "CAMPO 2", sWidth: "25%", bSortable: false},
                {sTitle: "Estado", sWidth: "10%", sClass: "center", bSortable: false}                
            ],
            aaSorting: [[2, "asc"]],
            sScrollY: "300px",
            sAjaxSource: _private.config.modulo+"getGrid'.$capitaleOpcion.'",
            fnDrawCallback: function() {
                $("#"+diccionario.tabs.'.$pre.'+"grid'.$capitaleOpcion.'_filter").find("input").attr("placeholder","Buscar por '.$capitaleOpcion.'").css("width","250px");
                simpleScript.enterSearch("#"+diccionario.tabs.'.$pre.'+"grid'.$capitaleOpcion.'",oTable);
                /*para hacer evento invisible*/
                simpleScript.removeAttr.click({
                    container: "#widget_"+diccionario.tabs.'.$pre.',
                    typeElement: "button"
                });
            }
        });
        setup_widgets_desktop();
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
    
    this.publico.getFormEdit'.$capitaleOpcion.' = function(btn,id){
        _private.id'.$capitaleOpcion.' = id;
            
        simpleAjax.send({
            element: btn,
            dataType: "html",
            root: _private.config.modulo + "getFormEdit'.$capitaleOpcion.'",
            data: "&_id'.$capitaleOpcion.'="+_private.id'.$capitaleOpcion.',
            fnCallback: function(data){
                $("#cont-modal").append(data);  /*los formularios con append*/
                $("#"+diccionario.tabs.'.$pre.'+"formEdit'.$capitaleOpcion.'").modal("show");
            }
        });
    };
    
    this.publico.postNew'.$capitaleOpcion.' = function(){
        simpleAjax.send({
            flag: AQUI FLAG,
            element: "#"+diccionario.tabs.'.$pre.'+"btnGr'.$capitaleOpcion.'",
            root: _private.config.modulo + "postNew'.$capitaleOpcion.'",
            form: "#"+diccionario.tabs.'.$pre.'+"formNew'.$capitaleOpcion.'",
            clear: true,
            fnCallback: function(data) {
                if(!isNaN(data.result) && parseInt(data.result) === 1){
                    simpleScript.notify.ok({
                        content: mensajes.MSG_3,
                        callback: function(){
                            simpleScript.reloadGrid("#"+diccionario.tabs.'.$pre.'+"grid'.$capitaleOpcion.'");
                        }
                    });
                }else if(!isNaN(data.result) && parseInt(data.result) === 2){
                    simpleScript.notify.error({
                        content: "'.$capitaleOpcion.' ya existe."
                    });
                }
            }
        });
    };
    
    this.publico.postEdit'.$capitaleOpcion.' = function(){
        simpleAjax.send({
            flag: AQUI FLAG,
            element: "#"+diccionario.tabs.'.$pre.'+"btnEd'.$capitaleOpcion.'",
            root: _private.config.modulo + "postEdit'.$capitaleOpcion.'",
            form: "#"+diccionario.tabs.'.$pre.'+"formEdit'.$capitaleOpcion.'",
            data: "&_id'.$capitaleOpcion.'="+_private.id'.$capitaleOpcion.',
            clear: true,
            fnCallback: function(data) {
                if(!isNaN(data.result) && parseInt(data.result) === 1){
                    simpleScript.notify.ok({
                        content: mensajes.MSG_10,
                        callback: function(){
                            _private.id'.$capitaleOpcion.' = 0;
                            simpleScript.closeModal("#"+diccionario.tabs.'.$pre.'+"formEdit'.$capitaleOpcion.'");
                            simpleScript.reloadGrid("#"+diccionario.tabs.'.$pre.'+"grid'.$capitaleOpcion.'");
                        }
                    });
                }else if(!isNaN(data.result) && parseInt(data.result) === 2){
                    simpleScript.notify.error({
                        content: "'.$capitaleOpcion.' ya existe."
                    });
                }
            }
        });
    };
    
    this.publico.postDelete'.$capitaleOpcion.' = function(btn,id){
        simpleScript.notify.confirm({
            content: mensajes.MSG_5,
            callbackSI: function(){
                simpleAjax.send({
                    flag: AQUI FLAG,
                    element: btn,
                    gifProcess: true,
                    data: "&_id'.$capitaleOpcion.'="+id,
                    root: _private.config.modulo + "postDelete'.$capitaleOpcion.'",
                    fnCallback: function(data) {
                        if(!isNaN(data.result) && parseInt(data.result) === 1){
                            simpleScript.notify.ok({
                                content: mensajes.MSG_6,
                                callback: function(){
                                    simpleScript.reloadGrid("#"+diccionario.tabs.'.$pre.'+"grid'.$capitaleOpcion.'");
                                }
                            });
                        }
                    }
                });
            }
        });
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
