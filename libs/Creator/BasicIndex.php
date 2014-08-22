<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BasicIndex
 *
 * @author RDCC
 */
class BasicIndex {
    
    /*crear archivo index BASICO*/
    public static function create($ruta, $opcion, $pre){
        $capitaleOpcion = Functions::capitalize($opcion);
        
        $contenido = '<?php 
/*
* ---------------------------------------
* --------- CREATED BY CREATOR ----------
* fecha: '.date('d-m-Y H:m:s').' 
* Descripcion : index'.$capitaleOpcion.'.phtml
* ---------------------------------------
*/
$nuevo    = Session::getPermiso("'.$pre.'NEW");
$eliminar = Session::getPermiso("'.$pre.'DE");
echo Functions::widgetOpen(array(
        "id"=>'.$pre.',
        "title"=>"'.$capitaleOpcion.'"
    )); 
?>

    <div class="widget-body-toolbar"></div>
    <div class="dataTables_wrapper form-inline" role="grid">
        <div class="dt-top-row">
            <div class="DTTT btn-group">
                <!-- verificar permisos -->
                <?php if($nuevo["permiso"]): ?>
                <button id="<?php echo '.$pre.'; ?>btnNew'.$capitaleOpcion.'" type="button" onclick="'.$opcion.'.getFormNew'.$capitaleOpcion.'(this);" class="<?php echo $nuevo["theme"]; ?>">
                    <i class="<?php echo $nuevo["icono"]; ?>"></i> <?php echo $nuevo["accion"]; ?>
                </button>
                <?php endif; ?>
                <!-- verificar permisos -->
                <?php if($eliminar["permiso"]): ?>
                <button id="<?php echo '.$pre.'; ?>btnDelete'.$capitaleOpcion.'" type="button" onclick="'.$opcion.'.postDelete'.$capitaleOpcion.'All(this);" class="<?php echo $eliminar["theme"]; ?>">
                    <i class="<?php echo $eliminar["icono"]; ?>"></i> <?php echo $eliminar["accion"]; ?>
                </button>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <form id="<?php echo '.$pre.'; ?>formGrid'.$capitaleOpcion.'" name="<?php echo T5; ?>formGrid'.$capitaleOpcion.'">
        <table id="<?php echo '.$pre.'; ?>grid'.$capitaleOpcion.'" class="table table-striped table-bordered table-hover table-condensed" style="width:100%"></table>
    </form>
<?php echo Functions::widgetClose(); ?>';
        
        $r = $ruta['app'].'/modules/'.$ruta['modulo'].'/views/';
        
        $fp=fopen($r.'index'.$capitaleOpcion.'.phtml',"x");
        fwrite($fp,$contenido);
        fclose($fp) ;
    }
    
}
