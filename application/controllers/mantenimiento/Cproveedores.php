<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cproveedores extends CI_Controller {
    function __construct(){
    parent:: __construct();
    if(!$this->session->userdata('login')){
        redirect(base_url());
    }
    $idrol = $this->session->userdata("idRol");
    $this->load->model('mproveedores');
    $this->load->model('mroles');
    $this->load->model('mcombo');
    //var_dump($nombre);
    }


public function index(){
    $idrol = $this->session->userdata("idRol");
    $data = array (
        'proveedoresindex' => $this->mproveedores->mselectproveedores(),
        'roles'=> $this->mroles->obtener($idrol)
    );
    //$roles=$this->mroles->obtener($idRol);
    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/proveedores/vlist', $data);
    $this->load->view('layouts/footer');
}



public function cadd(){
    $idrol = $this->session->userdata("idRol");
    $data = array (
        'roles'=>$this->mroles->obtener($idrol)
    );
    
    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/proveedores/vadd');
    $this->load->view('layouts/footer');
}


public function cinsert(){

    
     $nombre = $this->input->post('txtnombre');
     $domicilio = $this->input->post('txtdomicilio');
     $producto = $this->input->post('txtproducto');
     $telefono = $this->input->post('txttelefono');
     $email = $this->input->post('txtemail');
     $contacto = $this->input->post('txtcontacto');
     $descripcion = $this->input->post('txtdescripcion');
     
    
               $data = array(

                   'Nombre' => $nombre,
                   'Domicilio' => $domicilio,
                   'Producto' => $producto,
                   'Telefono' => $telefono,
                   'Email' => $email,
                   'Contacto' => $contacto,
                   'Descripcion' => $descripcion
                   
               );
               $res=$this->mproveedores->minsertproveedores($data);

               if($res){
                   $this->session->set_flashdata('correcto', 'Se guardo Correctamente');
                   redirect(base_url().'mantenimiento/cproveedores');
               }else{
                   $this->session->set_flashdata('error', 'No se Guardo registro');
                   redirect(base_url().'mantenimiento/cproveedores/cadd');
               }
    



}


public function cedit($id){
    $idrol = $this->session->userdata("idRol");
    $data = array(
        'proveedoresedit' => $this->mproveedores->midupdateproveedores($id),
        'roles'=>$this->mroles->obtener($idrol)
    );
    
    //$roles=$this->mroles->obtener($idRol);
    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/proveedores/vedit', $data);
    $this->load->view('layouts/footer');
}

public function cupdate(){

     $IdProveedores = $this->input->post('txtIdProveedores');
     $nombre = $this->input->post('txtnombre');
     $domicilio = $this->input->post('txtdomicilio');
     $producto = $this->input->post('txtproducto');
     $telefono = $this->input->post('txttelefono');
     $email = $this->input->post('txtemail');
     $contacto = $this->input->post('txtcontacto');
     $descripcion = $this->input->post('txtdescripcion');



               $data = array(

                'Nombre' => $nombre,
                'Domicilio' => $domicilio,
                'Producto' => $producto,
                'Telefono' => $telefono,
                'Email' => $email,
                'Contacto' => $contacto,
                'Descripcion' => $descripcion
               );

                  $res = $this->mproveedores->mupdateproveedores($IdProveedores, $data);
                  if($res){
                      $this->session->set_flashdata('correcto', 'Se Guardo Correctamente');
                      redirect(base_url().'mantenimiento/cproveedores');
                  }else {
                      $this->session->set_flashdata('error', 'No se pudo actualizar la proveedores');
                      redirect(base_url().'mantenimiento/cproveedores/cedit/'.$IdProveedores);
                  }
    


}

public function cdelete($id){

    $data=array(
        'Anulado' => '1'
    );
    $this->mproveedores->mupdateproveedores($id, $data);
    //redirect(base_url().'mantenimiento/cproveedores');
    echo "mantenimiento/cproveedores";
}


}
?>
