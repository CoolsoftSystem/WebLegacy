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

public function addItems(){
    $marca = $this->input->post("marca");
    $idEncabezado = $this->input->post("idEncabezado");
    $modelo = $this->input->post("modelo");
    $numSerie = $this->input->post("numSerie");
	$sector = $this->input->post("sector");
	$accesorios = $this->input->post("accesorios");
	$descripcion = $this->input->post("descripcion");


    
    $items=$this->mequipos->obtenerEquiposDetalle($idEncabezado);
    $cant2=0;
    foreach ($items as $items ) {
        
        $cant2++;
    }
   if($cant2 < 12){
    
    $data = array(
        'marca' => $marca,
        'modelo' =>  $modelo,
        'numSerie' => $numSerie,
		'sector' => $sector,
		'accesorios' => $accesorios,
		'descripcion' => $descripcion,
        'IdEncabezado' => $idEncabezado
    );
   

    $res=$this->mequipos->cargarItems($data);

   $ban=1;

    echo json_encode($ban);
   }else{
    $ban=0;
    echo json_encode($ban);
    
   }


public function cinsert(){


     $fecha = $this->input->post('txtfecha');
     $id_cliente=$this->input->post("tipo_cliente");
     /*$marca = $this->input->post('txtmarca');
     $modelo = $this->input->post('txtmodelo');
     $num_serie = $this->input->post('txtserie');
     $sector = $this->input->post('txtsector');
     $acc = $this->input->post('txtaccesorios');
     $descripcion = $this->input->post('txtdescripcion');*/

               $data = array(

                   'fecha' => $fecha,
                   /*'marca' => $marca,
                   'modelo' => $modelo,
                   'num_serie' => $num_serie,
                   'sector' => $sector,
                   'descripcion' => $descripcion,
                   'accesorios' => $acc,*/
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

	$data['items'] = $this->mequipos->obtenerEquiposDetalle($idEncabezado);
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
    /*$marca = $this->input->post('txtmarca');
    $modelo = $this->input->post('txtmodelo');
    $num_serie = $this->input->post('txtserie');
    $sector = $this->input->post('txtsector');
    $acc = $this->input->post('txtaccesorios');
    $descripcion = $this->input->post('txtdescripcion');*/

	if($fecha==null){
        $fecha=null;
    }
    else{
        $fecha =date("Y/m/d", strtotime($this->input->post('txtfecha')));
    }
    

    

               $data = array(

                'fecha' => $fecha,
               /* 'marca' => $marca,
                'modelo' => $modelo,
                'num_serie' => $num_serie,
                'sector' => $sector,
                'descripcion' => $descripcion,
                'accesorios' => $acc,*/
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

	$data['items'] = $this->mequipos->obtenerEquiposDetalle($idEncabezado);
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

public function ceditItems($id){
    $idrol = $this->session->userdata("idRol");
    $data = array(
        'itemsedit' => $this->mequipos->midupdateequipositems($id),
        'roles'=> $this->mroles->obtener($idrol)
    );

    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/items/vedit', $data);
    $this->load->view('layouts/footer');
}

public function cdeleteItems($id){

    $item = $this->mequipos->midupdateequipositems($id);
    $idEncabezado= $item->idEncabezado;
    $this->mequipos->mdeleteequiposdetalle($id);
    //redirect(base_url().'mantenimiento/cparteorden/cedit/'.$IdParte);
    echo "mantenimiento/cequipos/cedit/$idEncabezado";
}

public function cupdateItems(){

	$marca = $this->input->post('txtmarca');
    $modelo = $this->input->post('txtmodelo');
    $num_serie = $this->input->post('txtserie');
    $sector = $this->input->post('txtsector');
    $acc = $this->input->post('txtaccesorios');
    $descripcion = $this->input->post('txtdescripcion');
	$id = $this->input->post('txtid');
	$item = $this->mequipos->midupdateequipositems($id);
  
  
	$IdEncabezado= $item->IdEncabezado;
  
		$data = array(
				'marca' => $marca,
                'modelo' => $modelo,
                'num_serie' => $num_serie,
                'sector' => $sector,
                'descripcion' => $descripcion,
                'accesorios' => $acc,
		);
  
  
		$res = $this->mequipos->mupdateequipositems($id, $data);
		if($res){
			$this->session->set_flashdata('correcto', 'Se Guardo Correctamente');
			redirect(base_url().'mantenimiento/cequipos/cedit/'.$IdEncabezado);
		}else {
			$this->session->set_flashdata('error', 'No se pudo actualizar la Orden de equipos');
			redirect(base_url().'mantenimiento/cequipos/cedit'.$IdParte);
		}
  }

  public function cError($idEncabezado){

  
	$this->session->set_flashdata('error', 'Faltan Datos del Item');
	redirect(base_url().'mantenimiento/cequipos/cedit/'.$idEncabezado);

}

public function cErrorCantidad($idEncabezado){


$this->session->set_flashdata('error', 'No se pueden agregar mas de 12 ITEMS');
redirect(base_url().'mantenimiento/cequipos/cedit/'.$idEncabezado);

}


}
?>
