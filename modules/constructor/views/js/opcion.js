var opcion_ = function(){
    
    var _private = {};
    
    _private.idModulo = 0;
    
    _private.db = 0;
    
    _private.tabla = 0;
    
    _private.campo = '';
    
    _private.config = {
        modulo: 'constructor/opcion/'
    };

    this.publico = {};
    
    this.publico.main = function(element,mod){
        var d = mod.split('-');
        var modulo = d[1];
        _private.idModulo = d[0]; /*modulo al q se esta configurando una opcion*/
        
        simpleScript.addTab({
            id : diccionario.tabs.T6,
            label: $(element).attr('title'),
            fnCallback: function(){
                opcion.getCont(modulo);
            }
        });
    };
    
    this.publico.getCont = function(modulo){
        simpleAjax.send({
            dataType: 'html',
            root: _private.config.modulo,
            data: '&_modulo='+modulo+'&_idModulo='+_private.idModulo,
            fnCallback: function(data){
                $('#'+diccionario.tabs.T6+'_CONTAINER').html(data);
            }
        });
    };
  
    this.publico.getUnique = function(navigation,baseItemSelector,index,tipo){
        simpleAjax.send({
            gifProcess: true,
            root: _private.config.modulo+'getUnique',
            form: '#'+diccionario.tabs.T6+'formOpcion',
            data: '&_idModulo='+_private.idModulo,
            fnCallback: function(data){
                opcionScript.validaOpcion(data,navigation,baseItemSelector,index,tipo);
            }
        });
    };
    
    this.publico.getTablesDB = function(db){
        _private.db = db;
        simpleAjax.send({
            dataType: 'html',
            root: _private.config.modulo+'getFormTablesDB',
            data: '&_db='+_private.db,
            fnCallback: function(data){
                $('#'+diccionario.tabs.T6+'cont-tables').html(data);
            }
        });
    };
    
    this.publico.getHtmlColumnas = function(el,tab){
        /*si es otra tabla traera sus campos, si es el mismo no pasa*/
        if(_private.tabla === tab){
            return false;
        }
        opcionScript.marcaTable(el);
        
        _private.tabla = tab;
        
        simpleAjax.send({
            gifProcess:true,
            dataType: 'html',
            root: _private.config.modulo+'getHtmlColumnas',
            data: '&_db='+_private.db+'&_tabla='+_private.tabla,
            fnCallback: function(data){
                $('#'+diccionario.tabs.T6+'cont-columns').html(data);
            }
        });
    };
    
    /*formulario para congirurar data de DB*/
    this.publico.getFormData = function(el,f){
        _private.campo = $('#'+f+'chk_usar').val(); //campo q se esta configurando
        
        simpleAjax.send({
            gifProcess: true,
            dataType: 'html',
            root: _private.config.modulo+'getFormData',
            data: '&_tipoData='+el+'&_element='+$('#'+f+'lst_tipo').val(),
            fnCallback: function(data){
                $('#cont-modal').append(data);  /*los formularios con append*/
                $('#'+diccionario.tabs.T6+'formData').modal('show');
            }
        });
    };
    
    this.publico.postCrear = function(btn){
        simpleAjax.send({
            element: btn,
            root: _private.config.modulo+'postCrear',
            form: '#'+diccionario.tabs.T6+'formOpcion',
            data: '&_idModulo='+_private.idModulo,
            fnCallback: function(data){
                if(parseInt(data.result) === 1){
                    simpleScript.notify.ok({
                        content: 'Opción se creó correctamente'
                    });
                    /*cerrar tab*/
                    simpleScript.closeTab(diccionario.tabs.T6);
                }
            }
        });
    };
    
    return this.publico;
    
};
var opcion = new opcion_();