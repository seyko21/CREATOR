/*
* ---------------------------------------
* --------- CREATED BY CREATOR ----------
* fecha: 21-08-2014 01:08:14 
* Descripcion : regla.js
* ---------------------------------------
*/
var regla_ = function(){
    
    /*metodos privados*/
    var _private = {};
    
    _private.idRegla = 0;
    
    _private.config = {
        modulo: "constructor/regla/"
    };

    /*metodos publicos*/
    this.publico = {};
    
    /*crea tab : Regla*/
    this.publico.main = function(element){
        simpleScript.addTab({
            id : diccionario.tabs.REG,
            label: $(element).attr("title"),
            fnCallback: function(){
                regla.getContenido();
            }
        });
    };
    
    /*contenido de tab: Regla*/
    this.publico.getContenido = function(){
        simpleAjax.send({
            dataType: "html",
            root: _private.config.modulo,
            fnCallback: function(data){
                $("#"+diccionario.tabs.REG+"_CONTAINER").html(data);
                regla.getGridRegla();
            }
        });
    };
    
    this.publico.getGridRegla = function (){
        /*------------------LOGICA PARA DATAGRID------------------------*/
    };
    
    this.publico.getFormNewRegla = function(btn){
        simpleAjax.send({
            element: btn,
            dataType: "html",
            root: _private.config.modulo + "getFormNewRegla",
            fnCallback: function(data){
                $("#cont-modal").append(data);  /*los formularios con append*/
                $("#"+diccionario.tabs.REG+"formNewRegla").modal("show");
            }
        });
    };
    
    this.publico.postNewRegla = function(){
        /*-----LOGICA PARA ENVIO DE FORMULARIO-----*/
    };
    
    this.publico.postDeleteReglaAll = function(btn){
        simpleScript.validaCheckBox({
            id: "#"+diccionario.tabs.REG+"gridRegla",
            msn: mensajes.MSG_9,
            fnCallback: function(){
                simpleScript.notify.confirm({
                    content: mensajes.MSG_7,
                    callbackSI: function(){
                        simpleAjax.send({
                            flag: 3, //si se usa SP usar flag, sino se puede eliminar esta linea
                            element: btn,
                            form: "#"+diccionario.tabs.REG+"formGridRegla",
                            root: _private.config.modulo + "postDeleteReglaAll",
                            fnCallback: function(data) {
                                if(!isNaN(data.result) && parseInt(data.result) === 1){
                                    simpleScript.notify.ok({
                                        content: mensajes.MSG_8,
                                        callback: function(){
                                            regla.getGridRegla();
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
var regla = new regla_();