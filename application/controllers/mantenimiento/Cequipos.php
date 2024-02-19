<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cequipos extends CI_Controller {
    function __construct(){
    parent:: __construct();
    if(!$this->session->userdata('login')){
        redirect(base_url());
    }
    $idrol = $this->session->userdata("idRol");
    $this->load->model('mcliente');
    $this->load->model('mequipos');
    $this->load->model('mroles');
    $this->load->model('mcombo');
    //var_dump($nombre);
    }


public function index(){
    $idrol = $this->session->userdata("idRol");
    $data = array (
        'equipoindex' => $this->mequipos->mselectequipos(),
        'roles'=> $this->mroles->obtener($idrol)
    );
    //$roles=$this->mroles->obtener($idRol);
    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/recepcion_equipos/vlist', $data);
    $this->load->view('layouts/footer');
}



public function cadd(){
    $idrol = $this->session->userdata("idRol");
    $data['tipo_cliente_select'] = $this->mequipos->cliente_listar_select();
    $datos = array (
        'roles'=>$this->mroles->obtener($idrol)
    );
    
    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$datos);
    $this->load->view('admin/recepcion_equipos/vadd',$data);
    $this->load->view('layouts/footer');
}


public function cinsert(){


     $fecha = $this->input->post('txtfecha');
     $id_cliente=$this->input->post("tipo_cliente");
     $marca = $this->input->post('txtmarca');
     $modelo = $this->input->post('txtmodelo');
     $num_serie = $this->input->post('txtserie');
     $sector = $this->input->post('txtsector');
     $acc = $this->input->post('txtaccesorios');
     $descripcion = $this->input->post('txtdescripcion');

               $data = array(

                   'fecha' => $fecha,
                   'marca' => $marca,
                   'modelo' => $modelo,
                   'num_serie' => $num_serie,
                   'sector' => $sector,
                   'descripcion' => $descripcion,
                   'accesorios' => $acc,
                   'id_cliente' => $id_cliente,
                   'anulado' => '0'
               );
               $res=$this->mequipos->minsertequipos($data);

               if($res){
                   $this->session->set_flashdata('correcto', 'Se guardo Correctamente');
                   redirect(base_url().'mantenimiento/cequipos');
               }else{
                   $this->session->set_flashdata('error', 'No se Guardo registro');
                   redirect(base_url().'mantenimiento/cequipos/cadd');
               }


}


public function cedit($id){
    $idrol = $this->session->userdata("idRol");
    $data = array(
        'equiposedit' => $this->mequipos->midupdateequipos($id),
        'roles'=>$this->mroles->obtener($idrol)
    );
    $data['cliente_select'] = $this->mequipos->cliente_listar_select2();
    $data['model'] = $this->mequipos->obtener($data['equiposedit']->id_cliente);
    //$roles=$this->mroles->obtener($idRol);
    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/recepcion_equipos/vedit', $data);
    $this->load->view('layouts/footer');
}

public function cupdate(){

    $id = $this->input->post('txtnumorden');
    $fecha = date("Y/m/d", strtotime($this->input->post('txtfecha')));
    $cliente = mb_strtoupper($this->input->post("cliente"));
    $marca = $this->input->post('txtmarca');
    $modelo = $this->input->post('txtmodelo');
    $num_serie = $this->input->post('txtserie');
    $sector = $this->input->post('txtsector');
    $acc = $this->input->post('txtaccesorios');
    $descripcion = $this->input->post('txtdescripcion');

    

    

               $data = array(

                'fecha' => $fecha,
                'marca' => $marca,
                'modelo' => $modelo,
                'num_serie' => $num_serie,
                'sector' => $sector,
                'descripcion' => $descripcion,
                'accesorios' => $acc,
                'id_cliente' => $cliente,
                'anulado' => '0'
               );

                  $res = $this->mequipos->mupdateequipos($id, $data);
                  if($res){
                      $this->session->set_flashdata('correcto', 'Se Guardo Correctamente');
                      redirect(base_url().'mantenimiento/cequipos');
                  }else {
                      $this->session->set_flashdata('error', 'No se pudo actualizar la orden');
                      redirect(base_url().'mantenimiento/cequipos/cedit/');
                  }

}

public function print($id){
    $idrol = $this->session->userdata("idRol");
    $data = array (
        'equiposindex' => $this->mequipos->midupdateequipos($id),
        'roles'=> $this->mroles->obtener($idrol)
    );
    $data['model'] = $this->mequipos->obtener($data['equiposindex']->id_cliente);
    //$roles=$this->mroles->obtener($idRol);
    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/recepcion_equipos/vprint', $data);
    $this->load->view('layouts/footer');
}

public function cdelete($id){

    $data=array(
        'anulado' => '1'
    );
    $this->mequipos->mupdateequipos($id, $data);
    //redirect(base_url().'mantenimiento/cequipos');
    echo "mantenimiento/cequipos";
}


}
?>