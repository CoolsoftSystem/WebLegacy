<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Corden extends CI_Controller {
    function __construct(){
    parent:: __construct();
    if(!$this->session->userdata('login')){
        redirect(base_url());
    }
    $this->load->model('morden');
    $this->load->model('mroles');
    $this->load->model('mcombo');
    $this->load->model('mfactura');
    }



public function index(){
    $idrol = $this->session->userdata("idRol");
    $ordenes= $this->morden->mselectorden(); 
    
    foreach ($ordenes as $orden ) {
        $id=$orden->IdOrden;
        $porden=$this->morden->consultarEstado($id);

       
        if($porden != null){
            $completa=$porden->Completa;
            $estado=$porden->Estado;

            $orden->Completa=$completa;
            $orden->Estado=$estado;

            }else{
               
                $orden->Completa='0';
                $orden->Estado='4';
            }


   }
    $data = array (
        'ordenindex' => $ordenes,
        'ordencompletas' => $this->morden->mselectordencompletas(),
        'roles'=> $this->mroles->obtener($idrol)
    );


    $ordenes=  $data['ordenindex'];
  

    foreach ($ordenes as $orden ) {
         $id=$orden->IdOrden;
         $orden->Gastos=$this->morden->consultaGatosOrden($id);
    }


    $ordenesCompletas=  $data['ordencompletas'];



    foreach ($ordenesCompletas as $orden ) {
         $id=$orden->IdOrden;
         $orden->Gastos=$this->morden->consultaGatosOrden($id);
    }


    //die;

    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/orden/vlist', $data);
    $this->load->view('layouts/footer');
}


public function cadd(){
    $idrol = $this->session->userdata("idRol");
    $data['tipo_cliente_select'] = $this->morden->cliente_listar_select();
    $datos = array(
        'roles'=> $this->mroles->obtener($idrol)
    );

    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$datos);
    $this->load->view('admin/orden/vadd', $data);
    $this->load->view('layouts/footer');
}


public function cinsert(){

     $tarea = $this->input->post('txttarea');
     $obs = $this->input->post('txtobser');
     $fecha = $this->input->post('txtfecha');
     $id_cliente=$this->input->post("tipo_cliente");

    //REGLA DE VALIDACION
        $data = array(
            'FechaRecepcion' => $fecha,
            'TareaDesarrollar' => $tarea,
            'IdCliente' => $id_cliente,
            'Completada' => '0',
            'Eliminada' => '0',
            'observaciones' => $obs
        );
        $res=$this->morden->minsertorden($data);
        if($res){
            $this->session->set_flashdata('correcto', 'Se guardo Correctamente');
            redirect(base_url().'mantenimiento/corden');
        }else{
            $this->session->set_flashdata('error', 'No se Guardo registro');
            redirect(base_url().'mantenimiento/corden/cadd');
        }


}


public function cedit($id){
    $idrol = $this->session->userdata("idRol");
    

    $data = array(
        'ordenedit' => $this->morden->midupdateordenyfacturas($id),
        'roles'=> $this->mroles->obtener($idrol)
    );


    $data['cliente_select'] = $this->morden->cliente_listar_select2();
    $data['model'] = $this->morden->obtener($data['ordenedit']->IdCliente);


    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/orden/vedit', $data);
    $this->load->view('layouts/footer');
}

public function cupdate(){
      $tarea = $this->input->post('txttarea');
      $obs = $this->input->post('txtobser');
      $precio = $this->input->post('txtprecio');
      $cliente = mb_strtoupper($this->input->post("cliente"));
      $id = $this->input->post('txtidorden');
      $check = $this->input->post('habilitado');

      if($check=='on'){
        $completa=1;
      }else{
        $completa=0;
      }

     $data = array(

       'Precio' => $precio,
       'TareaDesarrollar' => $tarea,
       'IdCliente' => $cliente,
       'Completada' => $completa,
       'observaciones' => $obs

     );

        $res = $this->morden->mupdateorden($id, $data);
        if($res){
            $this->session->set_flashdata('correcto', 'Se Guardo Correctamente');
            redirect(base_url().'mantenimiento/corden');
        }else {
            $this->session->set_flashdata('error', 'No se pudo actualizar la orden');
            redirect(base_url().'mantenimiento/corden/cedit'.$id);
        }


}

public function cupdatefact(){

    $fpago = $this->input->post('txtfechaPago');
    $ffact = $this->input->post('txtfechaFactura');
    $nfact = $this->input->post('txtnumFactura');
    $id = $this->input->post('txtid');
    $estado = $this->input->post('txtpago');
    $idorden= $this->input->post('txtidorden');

    if($fpago==null){
        $fpago=null;
    }
    else{
        $fpago =date("Y/m/d", strtotime($this->input->post('txtfechaPago')));
    }

    if($ffact==null){
        $ffact=null;
    }
    else{
        $ffact =date("Y/m/d", strtotime($this->input->post('txtfechaFactura')));
    }
    
  
    $res=$this->mfactura->midupdatefact($nfact);
    $fac=$this->mfactura->mbuscaordenfactura($idorden);
    
      
          $data = array(
              'N_factura' => $nfact,
              'fecha_factura' => $ffact,
              'fecha_pago' => $fpago,
              'estado_pago' => $estado,
              'id_orden' =>$idorden
          );
          if($res==null && ($fac==null)){
                $res = $this->mfactura->minsertfactura($data);
          }else{
                $res = $this->mfactura->mupdatefact($id, $data);
          }
                if($res){
                    $this->session->set_flashdata('correcto', 'Se Guardo Correctamente');
                    redirect(base_url().'mantenimiento/corden');
                }else {
                    $this->session->set_flashdata('error', 'No se pudo actualizar la factura');
                    redirect(base_url().'mantenimiento/corden/cedit/'.$idorden);
                }
  
}
  

public function cdelete($id){

    $data=array(
        'Eliminada' => '1'
    );
    $this->morden->mupdateorden($id, $data);
    //redirect(base_url().'mantenimiento/corden');
    echo "mantenimiento/corden";
}

public function ccompleta($id){

    $data=array(
        'Completada' => '1'
    );
    $this->morden->mupdateorden($id, $data);
    //redirect(base_url().'mantenimiento/corden');
    echo "mantenimiento/corden";
}

public function cdescompleta($id){

    $data=array(
        'Completada' => '0'
    );
    $this->morden->mupdateorden($id, $data);
    //redirect(base_url().'mantenimiento/corden');
    echo "mantenimiento/corden";
}





}
?>
