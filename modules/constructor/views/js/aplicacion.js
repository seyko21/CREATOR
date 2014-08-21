/*
* ---------------------------------------
* --------- CREATED BY CREATOR ----------
* fecha: 18-08-2014 19:08:36 
* Descripcion : aplicacion.js
* ---------------------------------------
*/
var aplicacion_ = function(){
    
    /*metodos privados*/
    var _private = {};
    
    _private.idAplicacion = 0;
    
    _private.config = {
        modulo: "constructor/aplicacion/"
    };

    /*metodos publicos*/
    this.publico = {};
    
    /*crea tab : Aplicacion*/
    this.publico.main = function(element){
        simpleScript.addTab({
            id : diccionario.tabs.CRAP,
            label: $(element).attr("title"),
            fnCallback: function(){
                aplicacion.getContenido();
            }
        });
    };
    
    /*contenido de tab: Aplicacion*/
    this.publico.getContenido = function(){
        simpleAjax.send({
            dataType: "html",
            root: _private.config.modulo,
            fnCallback: function(data){
                $("#"+diccionario.tabs.CRAP+"_CONTAINER").html(data);
                aplicacion.getGridAplicacion();
            }
        });
    };
    
    this.publico.getGridAplicacion = function (){
        /*------------------LOGICA PARA DATAGRID------------------------*/
    };
    
    this.publico.getFormNewAplicacion = function(btn){
        simpleAjax.send({
            element: btn,
            dataType: "html",
            root: _private.config.modulo + "getFormNewAplicacion",
            fnCallback: function(data){
                $("#cont-modal").append(data);  /*los formularios con append*/
                $("#"+diccionario.tabs.CRAP+"formNewAplicacion").modal("show");
            }
        });
    };
    
    this.publico.postNewAplicacion = function(){
        /*-----LOGICA PARA ENVIO DE FORMULARIO-----*/
    };
    
    this.publico.postDeleteAplicacionAll = function(btn){
        simpleScript.validaCheckBox({
            id: "#"+diccionario.tabs.CRAP+"gridAplicacion",
            msn: mensajes.MSG_9,
            fnCallback: function(){
                simpleScript.notify.confirm({
                    content: mensajes.MSG_7,
                    callbackSI: function(){
                        simpleAjax.send({
                            flag: 3, //si se usa SP usar flag, sino se puede eliminar esta linea
                            element: btn,
                            form: "#"+diccionario.tabs.CRAP+"formGridAplicacion",
                            root: _private.config.modulo + "postDeleteAplicacionAll",
                            fnCallback: function(data) {
                                if(!isNaN(data.result) && parseInt(data.result) === 1){
                                    simpleScript.notify.ok({
                                        content: mensajes.MSG_8,
                                        callback: function(){
                                            aplicacion.getGridAplicacion();
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
var aplicacion = new aplicacion_();