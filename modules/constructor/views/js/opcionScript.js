var opcionScript_ = function(){
    
    this.publico = {};
    
    this.publico.validaOpcion = function(data,navigation,baseItemSelector,index,tipo){
        if(parseInt(data.result1) > 0 || parseInt(data.result2) === 3){/*si existe*/
            simpleScript.notify.error({
                content: 'Opción ya existe en base de datos o raíz de la aplicación'
            });
            navigation.find(baseItemSelector + ':eq(0) a').tab('show');
            return false;
        }
        if(parseInt(data.prefijo) > 0 ){/*si existe*/
            simpleScript.notify.error({
                content: 'Prefijo ya existe'
            });
            navigation.find(baseItemSelector + ':eq(0) a').tab('show');
            return false;
        }
        if(parseInt(data.existModulo) === 0){
            simpleScript.notify.error({
                content: 'Módulo: '+data.modulo+' no existe'
            });
            navigation.find(baseItemSelector + ':eq(0) a').tab('show');
            return false;
        }
        /*opcion no existe*/
        if(parseInt(data.result1) === 0 && parseInt(data.result2) === 1 && parseInt(data.prefijo) === 0){
            switch (tipo.toString()){
                case 'B': //basico
                        /*si es Basica pasa hasta el paso final*/
                        navigation.find(baseItemSelector + ':eq(3) a').tab('show');
                        /*marca el paso como completado*/
                        $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).addClass(
                                'complete');
                        $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).find('.step')
                                .html('<i class="fa fa-check"></i>');                    
                        return false;
                    break;
                case 'M': //mantenedor
                    navigation.find(baseItemSelector + ':eq(1) a').tab('show');
                    /*marca el paso como completado*/
                    $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).addClass(
                            'complete');
                    $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).find('.step')
                            .html('<i class="fa fa-check"></i>');
                    opcion.getTablesDB(data.db);
                    return false;
                    break;
            }
        }
    };
    
    this.publico.marcaTable = function(el){
        $('#'+diccionario.tabs.T6+'cont-tables').find('.h').removeClass('verdeT');
        $(el).addClass('verdeT');
    };
    
    this.publico.enableCols = function(el,fila){
        if($(el).is(':checked')){//activar elementos
            $('#'+diccionario.tabs.T6+fila+'chk_key').attr('disabled',false).parent().removeClass('state-disabled');
            $('#'+diccionario.tabs.T6+fila+'txt_id').attr('disabled',false);
            $('#'+diccionario.tabs.T6+fila+'txt_name').attr('disabled',false);
            $('#'+diccionario.tabs.T6+fila+'txt_etiqueta').attr('disabled',false);
            $('#'+diccionario.tabs.T6+fila+'lst_tipo').attr('disabled',false);
            $('#'+diccionario.tabs.T6+fila+'chk_ayuda').attr('disabled',false).parent().removeClass('state-disabled');
            $('#'+diccionario.tabs.T6+fila+'chk_validar').attr('disabled',false).parent().removeClass('state-disabled');
        }else{
            $('#'+diccionario.tabs.T6+fila+'chk_key').attr('disabled',true).parent().addClass('state-disabled');
            $('#'+diccionario.tabs.T6+fila+'txt_id').attr('disabled',true);
            $('#'+diccionario.tabs.T6+fila+'txt_name').attr('disabled',true);
            $('#'+diccionario.tabs.T6+fila+'txt_etiqueta').attr('disabled',true);
            $('#'+diccionario.tabs.T6+fila+'lst_tipo').attr('disabled',true);
            $('#'+diccionario.tabs.T6+fila+'chk_ayuda').attr('disabled',true).parent().addClass('state-disabled');
            $('#'+diccionario.tabs.T6+fila+'chk_validar').attr('disabled',true).parent().addClass('state-disabled');
        }
    };
    
    this.publico.enableAyuda = function(el,fila){
        if($(el).is(':checked')){//activar elementos
            $('#'+diccionario.tabs.T6+fila+'txt_ayuda').attr('disabled',false);
        }else{
            $('#'+diccionario.tabs.T6+fila+'txt_ayuda').attr('disabled',true);
        }
    };
    
    this.publico.enableCols2 = function(el,fila){
        $('#'+diccionario.tabs.T6+fila+'lst_tipodata').attr('disabled',true).val('');
        
        if(el.value === 'select' || el.value === 'radio' || el.value === 'checkbox'){
            $('#'+diccionario.tabs.T6+fila+'lst_tipodata').attr('disabled',false);
        }
    };
    
    return this.publico;
    
};
var opcionScript = new opcionScript_();