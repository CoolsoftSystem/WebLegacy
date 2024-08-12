<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Equipos
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
                        <form action="<?php echo base_url();?>mantenimiento/cequipos/cupdateItems" method="POST">
                            <input type="hidden" value="<?php echo $itemsedit->id_equipo ?>" name="txtid" id="txtid">

							<div class="col-sm-6 form-group">
                                    <label for="marca">Marca</label>
                                    <input type="text" id="txtmarca" name="txtmarca"maxlength="1000" class="form-control" value="<?php echo !empty(form_error('txtmarca'))? set_value('txtmarca') : $itemsedit->marca ?>">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="modelo">Modelo</label>
                                    <input type="text" id="txtmodelo" name="txtmodelo" maxlength="950"class="form-control" value="<?php echo !empty(form_error('txtmodelo'))? set_value('txtmodelo') : $itemsedit->modelo ?>">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="serie">Número serie</label>
                                    <input type="text" id="txtserie" name="txtserie" maxlength="950"class="form-control" value="<?php echo !empty(form_error('txtserie'))? set_value('txtserie') : $itemsedit->num_serie ?>">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="sector">Sector</label>
                                    <input type="text" id="txtsector" name="txtsector" maxlength="950"class="form-control" value="<?php echo !empty(form_error('txtsector'))? set_value('txtsector') : $itemsedit->sector ?>"  >
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label for="accesorios">Accesorios</label>
                                    <input type="text" id="txtaccesorios" name="txtaccesorios" maxlength="950"class="form-control" value="<?php echo !empty(form_error('txtaccesorios'))? set_value('txtaccesorios') : $itemsedit->accesorios ?>"  >
                                </div>

                            <div class="col-sm-12 form-group">
                            <a class="btn btn-success" href="<?php echo base_url();?>mantenimiento/cequipos/cedit/<?php echo $itemsedit->id_encabezado; ?>">Volver</a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>
               </div>
            </div>
        </div>
    </section>
</div>
