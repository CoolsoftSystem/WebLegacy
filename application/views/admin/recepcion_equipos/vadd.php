<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Orden de Recepción de Equipos
            <small>Nuevo</small>
        </h1>
    </section>
    <section class="content">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <?php if ($this->session->flashdata('error')) : ?>
                                <div class="alert alert-danger">
                                    <p><?php echo $this->session->flashdata('error') ?></p>
                                </div>
                            <?php endif; ?>
                            <form action="<?php echo base_url(); ?>mantenimiento/cequipos/cinsert" method="POST">
                                <div class="col-sm-2 form-group">
                                  <label for="fecha">Fecha</label>
                                  <input type="date" id="txtfecha" name="txtfecha" min="1"  class="form-control" value="<?php echo set_value('txtfecha') ?>" required >
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label class="control-label" for="tipo_cliente">CLIENTE (*)</label>
                                    <?$this->select_items->sin_buscador($tipo_cliente_select, '','tipo_cliente','1', 'required');?>
                                </div>
								<div class="col-sm-12 form-group">
                                    <label for="observaciones">Observaciones</label>
                                    <input type="text" id="txtobservaciones" name="txtobservaciones" class="form-control" value="<?php echo set_value('txtobservaciones') ?>" >
                                    </div>
                                 <div class="col-sm-12 form-group">
                                    <a class="btn btn-info" href="<?php echo base_url(); ?>mantenimiento/cequipos">Volver</a>
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
