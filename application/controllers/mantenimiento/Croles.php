<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Croles extends CI_Controller {
    function __construct(){
    parent:: __construct();
    if(!$this->session->userdata('login')){
        redirect(base_url());
    }
    $this->load->model('mroles');
    $this->load->model('mtipousuario');
    $this->load->model('mcombo');
    }


public function index(){
    $idrol = $this->session->userdata("idRol");
    $data = array (
        'rolesindex' => $this->mroles->mselectrolessolo(),
        'roles'=> $this->mroles->obtener($idrol)
    );
    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/roles/vlist', $data);
    $this->load->view('layouts/footer');
}


public function cadd(){
    $idrol = $this->session->userdata("idRol");
    $data['roles_select'] = $this->mroles->roles_listar_select2();

    $datos = array(
        'roles'=> $this->mroles->obtener($idrol)
    );

    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$datos);
    $this->load->view('admin/roles/vadd',$data);
    $this->load->view('layouts/footer');
}


public function cinsert(){

    //$idrol = $this->input->post('txtidrol');
    $nombre_tipo = $this->input->post('txtnombre');
    $check_cliente = $this->input->post('cliente');
    $check_tecnico = $this->input->post('tecnico');
    $check_orden = $this->input->post('ordenes');
    $check_usu = $this->input->post('usu');
    $check_rol = $this->input->post('rol');
    $check_est = $this->input->post('estado');
    $check_eq = $this->input->post('equipos');
    $check_remitos = $this->input->post('remitos');
    $check_proveedores = $this->input->post('proveedores');



    $b_rol = $this->mroles->obtenerrol($nombre_tipo);

    if($check_cliente=='on'){
        $cliente=1;
      }else{
        $cliente=0;
      }
      if($check_tecnico=='on'){
        $tecnico=1;
      }else{
        $tecnico=0;
      }
      if($check_orden=='on'){
        $orden=1;
      }else{
        $orden=0;
      }
      if($check_usu=='on'){
        $usuario=1;
      }else{
        $usuario=0;
      }
      if($check_rol=='on'){
        $rol=1;
      }else{
        $rol=0;
      }
      if($check_est=='on'){
        $est=1;
      }else{
        $est=0;
      }
      if($check_eq=='on'){
        $eq=1;
      }else{
        $eq=0;
      }
      if($check_remitos=='on'){
        $remito=1;
      }else{
        $remito=0;
      }
      if($check_proveedores=='on'){
        $proveedores=1;
      }else{
        $proveedores=0;
      }
      

      if($b_rol==null){
        $data = array(

            //'idRol' => $idRol,
            'nombre_tipo' => $nombre_tipo,
            'cliente' => $cliente,
            'tecnico' => $tecnico,
            'ordenes' => $orden,
            'usuarios' => $usuario,
            'roles' => $rol,
            'estados_trabajo' => $est,
            'equipos' => $eq,
            'remitos' => $remito,
            'proveedores' => $proveedores,
            'anulado' => 0


        );
        //var_dump($data);
        //die;
        $res=$this->mroles->minsertroles($data);
        if($res){
            $this->session->set_flashdata('correcto', 'Se guardo Correctamente');
            redirect(base_url().'mantenimiento/croles');
        }else{
            $this->session->set_flashdata('error', 'No se Guardo registro');
            redirect(base_url().'mantenimiento/croles/cadd');
        }

    }else{
        //REGLA DE VALIDACION
        $this->session->set_flashdata('error', 'Este Rol ya esta registrado ');
        redirect(base_url().'mantenimiento/croles/cadd');
      }

}


public function cedit($id){
    $idrol = $this->session->userdata("idRol");
    $data = array(
        'rolesedit' => $this->mroles->midupdateroles($id),
        'roles'=> $this->mroles->obtener($idrol)
    );
    //$data['usuario_select'] = $this->musuario->usuario_listar_select2();
    $data['model'] = $this->mroles->obtener($data['rolesedit']->idRol);

    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/roles/vedit', $data);
    $this->load->view('layouts/footer');
}

public function cupdate(){

    $idRol = $this->input->post('txtidrol');
    $nombre_tipo = $this->input->post('txtnombre');
    $nombre = $this->input->post('txtnombreviejo');
    $check_cliente = $this->input->post('cliente');
    $check_tecnico = $this->input->post('tecnico');
    $check_orden = $this->input->post('ordenes');
    $check_usu = $this->input->post('usu');
    $check_rol = $this->input->post('rol');
    $check_est = $this->input->post('estado');
    $check_eq = $this->input->post('equipos');
    $check_remitos = $this->input->post('remitos');
    $check_proveedores = $this->input->post('proveedores');

     $nrol = $this->mroles->obtenerrol($nombre_tipo);

     if($check_cliente=='on'){
        $cliente=1;
      }else{
        $cliente=0;
      }
      if($check_tecnico=='on'){
        $tecnico=1;
      }else{
        $tecnico=0;
      }
      if($check_orden=='on'){
        $orden=1;
      }else{
        $orden=0;
      }
      if($check_usu=='on'){
        $usuario=1;
      }else{
        $usuario=0;
      }
      if($check_rol=='on'){
        $rol=1;
      }else{
        $rol=0;
      }
      if($check_est=='on'){
        $est=1;
      }else{
        $est=0;
      }
      if($check_eq=='on'){
        $eq=1;
      }else{
        $eq=0;
      }
      if($check_remitos=='on'){
        $remito=1;
      }else{
        $remito=0;
      }
      if($check_proveedores=='on'){
        $proveedores=1;
      }else{
        $proveedores=0;
      }


      if(($nrol==null) or ($nombre==$nombre_tipo) ){

        $data = array(
            //'idRol' => $idRol,
            'nombre_tipo' => $nombre_tipo,
            'cliente' => $cliente,
            'tecnico' => $tecnico,
            'ordenes' => $orden,
            'usuarios' => $usuario,
            'roles' => $rol,
            'estados_trabajo' => $est,
            'equipos' => $eq,
            'remitos' => $remito,
            'proveedores' => $proveedores,
            'anulado' => 0

        );

        $res = $this->mroles->mupdateroles($idRol, $data);
        if($res){
            $this->session->set_flashdata('correcto', 'Se Guardo Correctamente');
            redirect(base_url().'mantenimiento/croles');
        }else {
            $this->session->set_flashdata('error', 'No se pudo actualizar el rol');
            redirect(base_url().'mantenimiento/croles/cedit/'.$idRol);
        }

    }else{
        //REGLA DE VALIDACION
        $this->session->set_flashdata('error', "El Rol '$nombre_tipo' ya esta registrado ");
        redirect(base_url().'mantenimiento/croles/cedit/'.$idRol);
    }





}

public function cdelete($id){

    $data=array(
        'anulado' => '1'
    );
    $this->mroles->mupdateroles($id, $data);
    //redirect(base_url().'mantenimiento/ccliente');
    echo "mantenimiento/croles";
}


}
