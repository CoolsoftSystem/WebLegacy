<div class="content-wrapper">
    <section class="content-header">
        <div class="col-md-6">
                           <h2>Orden Recepción de Equipos</h2>    
        </div>
    </section>
    <section class="content" >
        <div class="box box-solid" style="margin-top: 1px;">
            <div class="box-body">
                <div class="col-sm-3 form-group" id="botones" style="margin-left: -85px;">
                           <a class="btn btn-info" style="margin-bottom: 10px; margin-rigth: 10px;" href="<?php echo base_url();?>mantenimiento/cequipos">Volver</a>
                           <button id="printButton" style="margin-bottom: 10px; margin-rigth: 10px;" class="btn btn-success">Imprimir</button>
                         
                </div>
                <div class="row">
                    <div class="col-md-12 " id='cuerpo' >
                            <link rel="stylesheet" href="<?php echo base_url();?>assets/template/dist/css/Remito.css" media="print">
                            <div class="row">
                                <div class="col-md-12" id="celdas1">
                                    <div class="row" >
                                        <div class="col-md-5 logo">
                                            <img src="<?php echo base_url()?>assets/template/dist/img/logo presus.png" width="100">
                                        </div>
                                        <div class="col-md-2 datos">
                                            
                                        </div>
                                        <div class="col-md-5 datos2">
                                            <h4>ORDEN RECEPCIÓN EQUIPOS N°<?php echo $equiposindex->num_orden; ?></h4>
                                            <h3>Fecha: <?php echo date("d/m/Y", strtotime("$equiposindex->fecha")); ?></h3>
                                        </div>
                                        <div class="col-md-6 datos3">
                                          <p>Monteagudo 788 Este Villa Mallea(Capital), San Juan - Teléfono: 4212673</p>
                                          <p>www.electronicabios.com.ar - electronicabios@gmail.com</p>
                                        </div>
                                    
                                    </div>
                                </div>
                                <div class="col-md-12" id="celdas3">
                                    <div class="row" >
                                        <div class="col-md-4 cliente1">
                                            <p>Sr./es: <?php echo $cliente->Nombre; ?></p>
                                            <p>Domicilio: <?php echo $model->Domicilio." ".$model->Localidad." ".$model->Provincia;  ?></p>   
																						<p>Teléfonos: Mantenimiento: <?php if($model->tel_mantenimiento) {echo $model->tel_mantenimiento; }else{ echo "-";}; ?> &nbsp 
																							 Ventas: <?php if($model->tel_venta) { echo $model->tel_venta;}else{ echo "-";} ;?> &nbsp 
																							 Comercial: <?php if($model->tel_comercial) {echo $model->tel_comercial;} else{ echo "-";} ; ?></p>                                     
                                        </div>
                                        <div class="col-md-8 cliente2">
																						 
                                            <p>E-mails: <?php if($model->mail_mant) {echo $model->mail_mant; }else{ echo "";}; ?> &nbsp 
																							 <?php if($model->mail_vta) { echo $model->mail_vta;}else{ echo "";} ;?> &nbsp 
																							 <?php if($model->mail_comercial) {echo $model->mail_comercial;} else{ echo "";} ; ?></p>
																						<p>Nombres: <?php if($model->nya_mant) {echo $model->nya_mant; }else{ echo "";}; ?> &nbsp 
																							 <?php if($model->nya_vta) { echo $model->nya_vta;}else{ echo "";} ;?> &nbsp 
																							 <?php if($model->nya_cial) {echo $model->nya_cial;} else{ echo "";} ; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" id="celdas4">
                                    <div>
                                        <table class="table table-primary">
                                                <thead>
                                                    <tr>
                                                    <th width="15%" scope="col">Marca</th>
                                                    <th width="30%"scope="col">Modelo</th>
                                                    <th width="25%"scope="col">Numero de Serie</th>
																										<th width="10%"scope="col">Sector</th>
																										<th width="20%"scope="col">Accesorios</th>
                                                    </tr>
                                                </thead>

                                                <tbody id='tbody1'>
                                                <?php if (!empty($items)) : ?>
                                                    <?php foreach ($items as $atributos) : ?>
                                                        <tr>
                                                            <td id='tbody2'><?php echo $atributos->marca; ?></td>
                                                            <td id='tbody3'><?php echo $atributos->modelo; ?></td>
                                                            <td id='tbody2'><?php echo $atributos->num_serie; ?></td>
																														<td id='tbody2'><?php echo $atributos->sector; ?></td>
																														<td id='tbody2'><?php echo $atributos->accesorios; ?></td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12" id="celdas5">
                                    <div class="row" >
                                        <div class="col-md-12 registrovacio0">    
                                          <p><?php echo $equiposindex->observaciones; ?></p>                                  
                                        </div>
                                        <div class="col-md-12 registro01">
                                            <strong><p>Observaciones</p></strong>                                     
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" id="celdas6">
                                    <div class="row" >
                                        <div class="col-md-6 registrovacio1">                                      
                                        </div>
                                        <div class="col-md-6 registrovacio3">   
                                        </div>
                                        <div class="col-md-6 registro1">
                                           <strong>FIRMA CLIENTE</strong>                                       
                                        </div>
                                        <div class="col-md-6 registro3">
                                            <strong>FIRMA TÉCNICO</strong>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    </div>
                </div>
            </div>
        </div>  
    </section>  
</div>

<script>

    function printDiv(nombreDiv) {
     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     document.body.innerHTML = contenidoOriginal;
    }
    
    
    // Función para imprimir la factura
    function printInvoice() {
      const printButton = document.getElementById('printButton');
      printButton.style.display = 'none'; // Ocultar el botón antes de imprimir

      window.print();

      printButton.style.display = 'block'; // Mostrar el botón después de imprimir
    }

    // Asociar la función de impresión al botón
    const printButton = document.getElementById('printButton');
    printButton.addEventListener('click', printInvoice);
  </script>
<style>

  #cuerpo {
    width: 210mm; /* Ancho A4 */
    height: 297mm; /* Alto A4 */
  }
  .cuerpo {
    width: 210mm; /* Ancho A4 */
    height: 297mm; /* Alto A4 */
    margin: auto;
    margin-top: 10px !important;
    padding: 25px;
    border: 1px solid #ccc;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  }

  #celdas1{
    border: 1px solid #ccc;
    border-radius: 15px;
    margin: 5px;
    margin-left: 130px !important;
    margin-right: 140px !important;
    height: 30mm !important;
  }
  #celdas3{
    border: 1px solid #ccc;
    border-radius: 15px;
    margin: 5px;
    height: 25mm !important;
    margin-left: 130px !important;
    margin-right: 40px !important;
  }
  #celdas4{
    border: 1px solid #ccc;
    border-radius: 15px;
    margin: 5px;
    height: 170mm !important;
    margin-left: 130px !important;
    margin-right: 40px !important;
  }
  #celdas5{
    border: 1px solid #ccc;
    margin: 5px;
    height: 20mm !important;
    margin-left: 130px !important;
    margin-right: 40px !important;
    
  }

  #celdas6{
    border: 1px solid #ccc;
    margin: 5px;
    height: 30mm !important;
    text-align: center;
    margin-left: 130px !important;
    margin-right: 40px !important;
  }

  .logo {
    margin-right: 2px;
    
  }
  .logo img{
    margin-top: 3%;
    margin-left: 30%;
    height: 35%;
    width: 55%;
  }
  .datos {
    background-color: black;
    font-size: 25px;
    padding: 0px !important;
    margin-top: 0% !important;
    margin-left: 5% !important;
    height: 65px !important;
    width: 5%;
    position: center top ;
    font-weight: bold !important;
   
  }
  .datos p {
    color: white;
    margin: 0 0 0px;
    position:absolute;
    top:5px;
    right:10px;

}
  .datos2 {
    font-size: 10px;
    padding: 0px !important;
    margin-top: 0% !important;
    text-align: left;
    margin-left: 6% !important;
  
  }

  .datos2 h5 p {
    margin: 0;
    padding: 0;
  
  }

  .datos3 {
    font-size: 10px;
    text-align: center;
    margin-top: -3% !important; 
  }
  .datos3 p {
    margin: 0% !important; 
  }
  .datos4 {
    font-size: 10px;
    text-align: center;
    margin-top: 1% !important; 
  }

  .cliente1 {
    font-size: 12px;
    padding: 0px !important;
    margin-top: 1%;
  }
  .cliente1 p {
    margin-top: 2%;
    margin-left: 5%;
  }
  .cliente2 {
    font-size: 12px;
    padding: 0px !important;
    margin-top: 1%;
  }
  .cliente2 p {
    margin-top: 2%;
    margin-left: 5%;
  }

  #celdas4 h1{
    position:absolute;
    bottom:5px;
    right:10px;
  }

  #ceeldas5 p {
    font-size: 2mm !important;
  }
  .registrovacio0  {
    border: 1px solid #ccc;
    height: 15mm !important;
  }
  .registro01 {
    border: 1px solid #ccc;
    height: 5mm !important;
    text-align: center !important;
  }
  .registrovacio0 p {
    margin-top: 5px !important;
    text-align: center !important;
  }
  .registro02 {
    border: 1px solid #ccc;
    height: 5mm !important;
    text-align: center !important;
  }
  .registrovacio1  {
    border: 1px solid #ccc;
    height: 25mm !important;
  }
  .registrovacio2  {
    border: 1px solid #ccc;
    height: 25mm !important;
  }
  .registrovacio3  {
    border: 1px solid #ccc;
    height: 25mm !important;
  }
  
  .registro1 {
    border: 1px solid #ccc;
    height: 5mm !important;
  }
  .registro2 {
    border: 1px solid #ccc;
    height: 5mm !important;
  }
  .registro3 {
    border: 1px solid #ccc;
    height: 5mm !important;
  }
  .table-primary th{
    text-align: center !important;
  }
  #tbody2 {
    text-align: center !important;
    font-weight: bold !important;
  }
  #tbody3 {
    text-align: left !important;
    font-weight: bold !important;
    border: 0 1px 0 solid black !important;
  }

  @media print {
  
    #cuerpo {
      width: 184mm; /* Ancho A4 */
    height: 250mm;
  }
    .cuerpo {
    width: 178mm; /* Ancho A4 */
    height: 250mm; /* Alto A4 */
    margin: auto;
    margin-top: 10px !important;
    padding: auto;
    border: 1px solid #ccc;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  }

  #celdas1{
    border: 1px solid #ccc;
    border-radius: 15px;
    margin: 5px !important;
    height: 30mm !important;
    margin-bottom: 10px !important;
  }
  #celdas3{
    border: 1px solid #ccc;
    border-radius: 15px;
    margin: 5px !important;
    height: 25mm !important;
  }
  #celdas4{
    border: 1px solid #ccc;
    border-radius: 15px;
    margin: 5px !important;
    height: 135mm !important;
    margin-top: 10px !important;
    padding-top: 2.5mm !important;
  }

  #celdas5{
    border: 1px solid #ccc;
    margin: 5px !important;
    height: 20mm !important;
    text-align: center;
    margin-top: 10px !important;
  }
  #celdas6{
    border: 1px solid #ccc;
    margin: 5px !important;
    height: 30mm !important;
    text-align: center;
  }

  .logo {
    margin-right: 2px;
    
  }
  .logo img{
    margin-top: 1.5%;
    margin-left: 15%;
    height: 7%;
    width: 17%;
  }
  .datos {
    background-color: black !important;
    font-size: 30px;
    padding: 0px !important;
    margin-top: -8.5% !important;
    margin-left: 47.5% !important;
    height: 65px !important;
    width: 5%;
    position: center top ;
    font-weight: bold !important;
   
  }
  .datos p {
    color: white !important;
    margin: 0 0 0px;
    position:absolute !important;
    top:5px !important;
    right:7px !important;

  }
.datos2 {
    font-size: 10px;
    padding: 0px !important;
    margin-top: -8% !important;
    text-align: left;
    margin-left: 58% !important;
}

  .datos2 h5 p {
    margin: 0;
    padding: 0;
  
}

  .datos3 {
    font-size: 10px;
    text-align: center;
    margin-top: -6% !important; 
    width: 49% !important;

  }
  .datos3 p {
    margin: 0% !important; 
    margin-top: -1.5% !important;
  }
  .datos4 {
    font-size: 10px;
    text-align: center;
    margin-top: -2% !important; 
    width: 49% !important;
    margin-left: 49% !important;


  }

  .cliente1 {
    font-size: 12px;
    padding: 0px !important;
    margin-top: 1%;
    width: 49% !important;
  }
  .cliente1 p {
    margin-top: 3% !important;
    margin-left: 7%;
  }
  .cliente2 {
    font-size: 12px;
    padding: 0px !important;
    margin-top: -11.5%;
    width: 49% !important;
    margin-left: 49% !important;
  }
  .cliente2 p {
    margin-top: 3% !important;
    margin-left: 5%;
  }

  #celdas4 h1{
    position:absolute;
    bottom:5px;
    right:10px;
  }

  #ceeldas5 p {
    font-size: 2mm !important;
  }
  .registrovacio0  {
    border: 1px solid #ccc;
    height: 15mm !important;
  }
  .registrovacio0 p {
    margin-top: 5px !important;
    font-size: 3mm !important;
    text-align: center !important;
  }
  .registro01 {
    border: 1px solid #ccc;
    height: 5mm !important;
    text-align: center !important;
    width: 126mm !important;
  }
  .registro02 {
    border: 1px solid #ccc;
    height: 5mm !important;
    text-align: center !important;
    width: 55mm !important;
    margin-left: 126mm !important;
    margin-top: -5mm !important;
    
  }

  .registrovacio1 {
    border: 1px solid #ccc;
    height: 25mm !important;
    width: 60mm !important; 
  }
  .registrovacio2 {
    border: 1px solid #ccc;
    height: 25mm !important;
    width: 60mm !important;
    margin-left: 60mm !important; 
    margin-top: -25mm !important;
    
  }
  .registrovacio3 {
    border: 1px solid #ccc;
    height: 25mm !important;
    width: 61mm !important;
    margin-left: 120mm !important; 
    margin-top: -25mm !important;
     
  }
  .registro1 {
    border: 1px solid #ccc;
    height: 5mm !important;
    width: 60mm !important;  
  }
  .registro2 {
    border: 1px solid #ccc;
    height: 5mm !important;
    width: 60mm !important; 
    margin-left: 60mm !important; 
    margin-top: -5mm !important;
  }
  .registro3 {
    border: 1px solid #ccc;
    height: 5mm !important;
    width: 61mm !important; 
    margin-left: 120mm !important; 
    margin-top: -5mm !important;
  
  }

  .table-primary th{
    text-align: center !important;
  }
  #tbody2 {
    text-align: center !important;
    font-weight: bold !important;
  }
  #tbody3 {
    text-align: left !important;
    font-weight: bold !important;
  }



  .box box-solid{
    display: none;
  }

  #botones{
    display: none;
  }

  /* ... otros estilos para la impresión ... */
}
</style>
