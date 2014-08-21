var modulo_ = function(){
    
    var _private = {};
    
    _private.id = 0;
    
    _private.config = {
        modulo: 'constructor/modulo/'
    };

    this.publico = {};
    
    this.publico.main = function(element){
        simpleScript.addTab({
            id : diccionario.tabs.T5,
            label: $(element).attr('title'),
            fnCallback: function(){
                modulo.getCont();
            }
        });
    };
    
    this.publico.getCont = function(){
        simpleAjax.send({
            dataType: 'html',
            root: _private.config.modulo,
            fnCallback: function(data){
                $('#'+diccionario.tabs.T5+'_CONTAINER').html(data);
                modulo.getGridModulo();
            }
        });
    };
    
    this.publico.getGridModulo = function (){
        $('#'+diccionario.tabs.T5+'gridModulo').dataTable({
            bProcessing: true,
            bServerSide: true,
            bDestroy: true,
            sPaginationType: "bootstrap_full", //two_button
            sServerMethod: "POST",
            bPaginate: true,
            iDisplayLength: 10,            
            aoColumns: [
                {sTitle: "<input type='checkbox' id='"+diccionario.tabs.T5+"chk_all' onclick='simpleScript.checkAll(this,\"#"+diccionario.tabs.T5+"gridModulo\");'>", sWidth: "1%", sClass: "center", bSortable: false},
                {sTitle: "Módulo", sWidth: "25%"},
                {sTitle: "Aplicación", sWidth: "20%", bSortable: false},
                {sTitle: "Usuario que creo", sWidth: "20%", bSortable: false},
                {sTitle: "Fecha Creación", sWidth: "15%",  sClass: "center", bSortable: false},
                {sTitle: "Acciones", sWidth: "15%", sClass: "center", bSortable: false}
            ],
            aaSorting: [[1, 'asc']],
            sScrollY: "300px",
            sAjaxSource: _private.config.modulo+'getGridModulo',
            fnDrawCallback: function() {
                $('#'+diccionario.tabs.T5+'gridModulo_filter').find('input').attr('placeholder','Buscar po módulo');
                /*para hacer evento invisible*/
                simpleScript.removeAttr.click({
                    container: '#widget_'+diccionario.tabs.T5, //widget del datagrid
                    typeElement: 'button, #'+diccionario.tabs.T5+'chk_all'
                });
            }
        });
        setup_widgets_desktop();
    };
    
    this.publico.getNuevoModulo = function(btn){
        simpleAjax.send({
            element: btn,
            dataType: 'html',
            root: _private.config.modulo + 'getNuevoModulo',
            fnCallback: function(data){
                $('#cont-modal').append(data);  /*los formularios con append*/
                $('#'+diccionario.tabs.T5+'formModuloo').modal('show');
            }
        });
    };
    
    this.publico.postNuevoModulo = function(){
        simpleScript.notify.confirm({
            content: 'Se creará directorios para estructura base de Módulo ¿Está seguro de grabar?',
            callbackSI: function(){
                simpleAjax.send({
                    flag: 1,
                    element: '#'+diccionario.tabs.T5+'btnGmodulo',
                    root: _private.config.modulo + 'postNuevoModulo',
                    form: '#'+diccionario.tabs.T5+'formModuloo',
                    clear: true,
                    fnCallback: function(data) {
                        if(!isNaN(data.result) && parseInt(data.result) === 1){
                            simpleScript.notify.ok({
                                content: mensajes.MSG_3,
                                callback: function(){
                                    modulo.getGridModulo();
                                }
                            });
                        }else if(!isNaN(data.result) && parseInt(data.result) === 2){
                            simpleScript.notify.error({
                                content: mensajes.MSG_4
                            });
                        }else if(!isNaN(data.result) && parseInt(data.result) === 3){
                            simpleScript.notify.error({
                                content: 'Módulo ya existe en la raíz de la aplicación.'
                            });
                        }
                    }
                });
            }
        });
    };
    
    return this.publico;
    
};
var modulo = new modulo_();