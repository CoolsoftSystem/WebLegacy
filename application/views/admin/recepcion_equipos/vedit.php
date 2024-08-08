<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Orden de Recepción de Equipos 
            <small>Editar</small>
        </h1>
    </section>
    <section class="content">
        <div class="box box-solid">
            <div class="box-body">
               <hr>
               <div class="row">
                   <div class="col-md-12">
                       <?php if($this->session->flashdata('error')):?>
                        <div class="alert alert-danger">
                            <p><?php echo $this->session->flashdata('error') ?> </p>
                        </div>
                        <?php endif ; ?>
                        <form action="<?php echo base_url();?>mantenimiento/cequipos/cupdate" method="POST">
                             <input type="hidden" value="<?php echo $equiposedit->num_orden ?>" name="txtnumorden" id="txtnumorden"> 
                                 <div class="col-sm-2 form-group">
                                    <label for="fecha">Fecha</label>
                                     <input type="string" id="txtfecha" name="txtfecha" class="form-control" min="2020-01-01" max="2100-12-31" value="<?php echo !empty(form_error('txtfecha'))? set_value('txtfecha') :  date("d/m/Y", strtotime("$equiposedit->fecha"));?>" >
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="cliente">Cliente&nbsp;&nbsp; (*)</label>
                							<? $this->select_items->sin_buscador5($cliente_select,(!empty($model->IdCliente))
                                        ? $model->IdCliente : '',	'cliente','1',(!empty($consultar)) ? "disabled ":'required');?>
                			        <input id="cliente_hidden" name="cliente_hidden" type="hidden" >
                			    </div>
                                <div class="col-sm-6 form-group">
                                     <a class="btn btn-info" href="<?php echo base_url();?>mantenimiento/cequipos">Volver</a>
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                 </div> 
                    </form>
               </div>
               <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-11">
                                <form action="<?php echo base_url();?>mantenimiento/cequipos/cupdateItems" method="POST">
                                    <div class="col-sm-12 form-group">
                                    <h3>Detalle Equipos</h3>
                                    </div>
                                    <input type="hidden" value="<?php echo $equiposedit->IdEncabezado ?>" name="txtIdEquipos" id="txtIdEquipos">
                                
                                    <div class="col-sm-5 form-group">
                                        <label for="marca">Marca</label>
                                        <input type="text" id="txtmarca" name="txtmarca" class="form-control"  value="<?php echo set_value('txtmarca') ?>" required>
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label for="modelo">Modelo</label>
                                        <input type="number" id="txtmodelo" name="txtmodelo" class="form-control" value="<?php echo set_value('txtmodelo') ?>" >
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label for="numSerie">Numero de Serie</label>
                                        <input type="text" id="txtnumSerie" name="txtnumSerie" class="form-control" value="<?php echo set_value('txtnumSerie') ?>" >
                                    </div>
                                    <div class="col-sm-6 form-group">
                                    <label for="sector">Sector</label>
                                    <input type="text" id="txtsector" name="txtsector" class="form-control" value="<?php echo set_value('txtsector') ?>" >
                                    </div>
                                    <div class="col-sm-12 form-group">
                                    <label for="accesorios">Accesorios</label>
                                    <input type="text" id="txtaccesorios" name="txtaccesorios" class="form-control" value="<?php echo set_value('txtaccesorios') ?>" >
                                    </div>
                                    <div class="col-sm-12 form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" id="txtdescripcion" name="txtdescripcion" class="form-control" value="<?php echo set_value('txtdescripcion') ?>" >
                                    </div>
                                    <div class="col-sm-1">
                                        <br>
                                        <button class="btn btn-primary" type="button" id="agregarItem"><span class="fa fa-plus" aria-hidden="true" ></span> Agregar </button>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                            <table id="example1" class="table table-bordered table-hover order-table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Marca</th>
                                                        <th>Modelo</th>
                                                        <th>Numero de Serie</th>
                                                        <th>Sector</th>
                                                        <th>Accesorios</th>
                                                        <th>Descripción</th>
                                                    </tr>
                                                </thead>
                                                <tbody id='tbody1'>
                                                    <?php if (!empty($item)) : ?>
                                                        <?php foreach ($item as $atributos) : ?>
                                                            <tr>
                                                                <td><?php echo $atributos->id_equipo; ?></td>
                                                                <td style="text-align: justify; display: inline-block;"><?php echo $atributos->item; ?></td>
                                                                <td><?php echo $atributos->marca; ?></td>
                                                                <td><?php echo $atributos->modelo; ?></td>
                                                                <td><?php echo $atributos->numSerie; ?></td>
                                                                <td><?php echo $atributos->sector; ?></td>
                                                                <td><?php echo $atributos->accesorios; ?></td>
                                                                <td><?php echo $atributos->descripcion; ?></td>
                                                                <?php $data = $atributos->id_equipo; ?>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a title="Modificar" href="<?php echo base_url(); ?>mantenimiento/cequipos/ceditItem/<?php echo $atributos->id_equipo; ?>" class="btn btn-info ">
                                                                            <span class="fa fa-pencil"></span>
                                                                        </a>
                                                                        <a title="Eliminar" href="<?php echo base_url(); ?>mantenimiento/cequipos/cdeleteItem/<?php echo $atributos->id_equipo; ?>" class="btn btn-danger btn-remove deleteItemEquipos">
                                                                            <span class="fa fa-remove"></span>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">

$(document).ready(function(){

    var base_url= "<?php echo base_url();?>";
  $('#agregarProducto').on('click',function(){
        var idRemito =$('#txtIdRemito').val();
        var producto =$('#txtproducto').val();
        var cant =$('#txtcantidad').val();
        var numSerie =$('#txtnumSerie').val();
    
      
        if((producto=='') || (cant=='') || (numSerie=='')  ){
            
            window.location.href=base_url+'/mantenimiento/cremitos/cError/'+idRemito;
        }else{

        $('#txtproducto').val('');
        $('#txtcantidad').val('');
        $('#txtnumSerie').val('');
        
       
                $.ajax( {
                                    method:'POST',
                                    url:'<?php echo base_url(); ?>' + 'mantenimiento/cremitos/addProducto',
                                    dataType:'html',
                                    data:{producto:producto,idRemito:idRemito,cant:cant, numSerie:numSerie}})
                                   
                                    .done(function(r) {
                                        //alert(r);
                                    if(r==0){
                                        //alert("entra al if");
                                        window.location.href=base_url+'/mantenimiento/cremitos/cErrorCantidad/'+idRemito;
                                    }else if(r==1) {
                                        //alert("no entra al if");
                                        window.location.href=base_url+'/mantenimiento/cremitos/cedit/'+idRemito;
                                            //$("#tbody1").append(r['linksa']);
                                    }
                                        
                                    });

        }

        });
    })
</script>
