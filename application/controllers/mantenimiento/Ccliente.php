<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ccliente extends CI_Controller {
    function __construct(){
    parent:: __construct();
    if(!$this->session->userdata('login')){
        redirect(base_url());
    }
    $idrol = $this->session->userdata("idRol");
    $this->load->model('mcliente');
    $this->load->model('mroles');
    $this->load->model('mcombo');
    //var_dump($nombre);
    }


public function index(){
    $idrol = $this->session->userdata("idRol");
    $data = array (
        'clienteindex' => $this->mcliente->mselectcliente(),
        'roles'=> $this->mroles->obtener($idrol)
    );
    //$roles=$this->mroles->obtener($idRol);
    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/cliente/vlist', $data);
    $this->load->view('layouts/footer');
}



public function cadd(){
    $idrol = $this->session->userdata("idRol");
    $data = array (
        'roles'=>$this->mroles->obtener($idrol)
    );
    
    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/cliente/vadd');
    $this->load->view('layouts/footer');
}


public function cinsert(){

    
     $nombre = $this->input->post('txtnombre');
     $cuit = $this->input->post('txtcuit');
     $prov = $this->input->post('txtprovincia');
     $domicilio = $this->input->post('txtdomicilio');
     $iva = $this->input->post('txtiva');
     $localidad = $this->input->post('txtlocalidad');
     $mant = $this->input->post('txtmant');
     $venta = $this->input->post('txtventas');
     $comer = $this->input->post('txtcomercial');
     $mmant = $this->input->post('txtmmant');
     $mvta = $this->input->post('txtmvta');
     $mcial = $this->input->post('txtmcial');
     $nmant = $this->input->post('txtnmant');
     $nvta = $this->input->post('txtnvta');
     $ncial = $this->input->post('txtncial');
     $cli = $this->mcliente->obtenerclientedni($cuit);

     if($cli==null){
               $data = array(

                   'Nombre' => $nombre,
                   'DniCuit' => $cuit,
                   'Provincia' => $prov,
                   'Domicilio' => $domicilio,
                   'IVA' => $iva,
                   'Localidad' => $localidad,
                   'tel_mantenimiento' => $mant,
                   'tel_venta' => $venta,
                   'tel_comercial' => $comer,
                   'mail_mant' => $mmant,
                   'mail_vta' => $mvta,
                   'mail_comercial' => $mcial,
                   'nya_mant' => $nmant,
                   'nya_vta' => $nvta,
                   'nya_cial' => $ncial,
                   'Anulado' => '0'
               );
               $res=$this->mcliente->minsertcliente($data);

               if($res){
                   $this->session->set_flashdata('correcto', 'Se guardo Correctamente');
                   redirect(base_url().'mantenimiento/ccliente');
               }else{
                   $this->session->set_flashdata('error', 'No se Guardo registro');
                   redirect(base_url().'mantenimiento/ccliente/cadd');
               }
     }else{
       //REGLA DE VALIDACION
       $this->session->set_flashdata('error', 'Este Dni/Cuit ya esta registrado ');
       redirect(base_url().'mantenimiento/ccliente/cadd');
     }



}


public function cedit($id){
    $idrol = $this->session->userdata("idRol");
    $data = array(
        'clienteedit' => $this->mcliente->midupdatecliente($id),
        'roles'=>$this->mroles->obtener($idrol)
    );
    
    //$roles=$this->mroles->obtener($idRol);
    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/cliente/vedit', $data);
    $this->load->view('layouts/footer');
}

public function cupdate(){

     $idcliente = $this->input->post('txtidcliente');
     $nombre = $this->input->post('txtnombre');
     $cuitold = $this->input->post('txtcuitold'); 
     $cuit = $this->input->post('txtcuitnew');
     $prov = $this->input->post('txtprovincia');
     $domicilio = $this->input->post('txtdomicilio');
     $iva = $this->input->post('txtiva');
     $localidad = $this->input->post('txtlocalidad');
     $mant = $this->input->post('txtmant');
     $venta = $this->input->post('txtventas');
     $comer = $this->input->post('txtcomercial');
     $mmant = $this->input->post('txtmmant');
     $mvta = $this->input->post('txtmvta');
     $mcial = $this->input->post('txtmcial');
     $nmant = $this->input->post('txtnmant');
     $nvta = $this->input->post('txtnvta');
     $ncial = $this->input->post('txtncial');
     $correo = $this->input->post('txtcorreo');

     $cli = $this->mcliente->obtenerclientedni($cuit);

     if(($cli==null) or ($cuitold==$cuit)){

               $data = array(

                   'Nombre' => $nombre,
                   'DniCuit' => $cuit,
                   'Provincia' => $prov,
                   'IVA' => $iva,
                   'Localidad' => $localidad,
                   'tel_mantenimiento' => $mant,
                   'tel_venta' => $venta,
                   'tel_comercial' => $comer,
                   'mail_mant' => $mmant,
                   'mail_vta' => $mvta,
                   'mail_comercial' => $mcial,
                   'nya_mant' => $nmant,
                   'nya_vta' => $nvta,
                   'nya_cial' => $ncial,
                   'Domicilio' => $domicilio
               );

                  $res = $this->mcliente->mupdatecliente($idcliente, $data);
                  if($res){
                      $this->session->set_flashdata('correcto', 'Se Guardo Correctamente');
                      redirect(base_url().'mantenimiento/ccliente');
                  }else {
                      $this->session->set_flashdata('error', 'No se pudo actualizar la cliente');
                      redirect(base_url().'mantenimiento/ccliente/cedit/'.$idcliente);
                  }
     }else{
       //REGLA DE VALIDACION
       $this->session->set_flashdata('error', 'Este Dni/Cuit ya esta registrado ');
       redirect(base_url().'mantenimiento/ccliente/cadd');
     }


}

public function cdelete($id){

    $data=array(
        'Anulado' => '1'
    );
    $this->mcliente->mupdatecliente($id, $data);
    //redirect(base_url().'mantenimiento/ccliente');
    echo "mantenimiento/ccliente";
}


}
?>
