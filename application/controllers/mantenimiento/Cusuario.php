<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cusuario extends CI_Controller {
    function __construct(){
    parent:: __construct();
    if(!$this->session->userdata('login')){
        redirect(base_url());
    }
    $this->load->model('musuario');
    $this->load->model('mroles');
    $this->load->model('mcombo');
    }


public function index(){
    $idrol = $this->session->userdata("idRol");
    $data = array (
        'usuarioindex' => $this->musuario->mselectusuario(),
        'roles'=> $this->mroles->obtener($idrol)
        
    );
    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/usuario/vlist', $data);
    $this->load->view('layouts/footer');
}


public function cadd(){
    $idrol = $this->session->userdata("idRol");
    //$data['usuario_select']  = $this->musuario->usuario_listar_select2();
    $datos = array(
        'roles'=> $this->mroles->obtener($idrol),
        'usuario_select' => $this->mroles->mselectrolessolo()
    );

    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$datos);
    $this->load->view('admin/usuario/vadd',$datos);
    $this->load->view('layouts/footer');
}


public function cinsert(){

    $nombre = $this->input->post('txtnombre');
     $email = $this->input->post('txtemail');
     $idRol = $this->input->post('usuario_select');
     $contraseña = $this->input->post('txtContraseña');

     $usu = $this->musuario->obtenerusuario($nombre);

    if($usu==null){

        $data = array(

            'nombre' => $nombre,
            'email' => $email,
            'pass' => $contraseña,
            'idRol'=> $idRol,
            'Anulado' => '0'
        );
        $res=$this->musuario->minsertusuario($data);
        if($res){
            $this->session->set_flashdata('correcto', 'Se guardo Correctamente');
            redirect(base_url().'mantenimiento/cusuario');
        }else{
            $this->session->set_flashdata('error', 'No se Guardo registro');
            redirect(base_url().'mantenimiento/cusuario/cadd');
        }

    }else{
        //REGLA DE VALIDACION
        $this->session->set_flashdata('error', "El Usuario '$nombre' ya esta registrado ");
        redirect(base_url().'mantenimiento/cusuario/cadd');
    }

    

}


public function cedit($id){
    $idrol = $this->session->userdata("idRol");
    $data = array(
        'usuarioedit' => $this->musuario->midupdateusuario($id),
        'roles'=> $this->mroles->obtener($idrol)
    );
    $data['usuario_select'] = $this->musuario->usuario_listar_select();
    $data['model'] = $this->musuario->obtener($data['usuarioedit']->idRol);

    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/usuario/vedit', $data);
    $this->load->view('layouts/footer');
}

public function cupdate(){

    $idusuario = $this->input->post('txtidusuario');
    $nombre = $this->input->post('txtnombre');
    $email = $this->input->post('txtemail');
    $txtnombreviejo = $this->input->post('txtnombreviejo');
    $idRol = mb_strtoupper($this->input->post('usuario'));
    $contraseña = $this->input->post('txtContraseña');

     $usu = $this->musuario->obtenerusuario($usuario);

    if(($usu==null) or ($txtnombreviejo==$usu) ){

        $data = array(
            'nombre' => $nombre,
            'email' => $email,
            'pass' => $contraseña
        );

        $res = $this->musuario->mupdateusuario($idusuario, $data);
        if($res){
            $this->session->set_flashdata('correcto', 'Se Guardo Correctamente');
            redirect(base_url().'mantenimiento/cusuario');
        }else {
            $this->session->set_flashdata('error', 'No se pudo actualizar la usuario');
            redirect(base_url().'mantenimiento/cusuario/cedit/'.$idusuario);
        }

    }else{
        //REGLA DE VALIDACION
        $this->session->set_flashdata('error', "El Usuario '$usuario' ya esta registrado ");
        redirect(base_url().'mantenimiento/cusuario/cedit/'.$idusuario);
    }



        


}

public function cdelete($id){

    $data=array(
        'Anulado' => '1'
    );
    $this->musuario->mupdateusuario($id, $data);
    //redirect(base_url().'mantenimiento/cusuario');
    echo "mantenimiento/cusuario";
}


}
