<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrabajos extends CI_Controller {
    function __construct(){
    parent:: __construct();
    if(!$this->session->userdata('login')){
        redirect(base_url());
    }
    $this->load->model('morden');
    $this->load->model('mparteorden');
    $this->load->model('mroles');
    }



public function index(){
    $idrol = $this->session->userdata("idRol");
    
    $ordenes= $this->morden->mselectestadostrabajo(); 
    
   
    
    foreach ($ordenes as $orden ) {
        $id=$orden->IdOrden;
        //$band = false;
        $parteorden = $this->mparteorden->mselectparteorden($id);
        $orden->tecnicos="";
        if($parteorden != null){
            $tec="";
            //$HH=0;
            $horasAcum=0;
            $fecha_visita="";
           
            foreach($parteorden as $parte){
                
                $tecnicos = $this->mparteorden->mselectTecnicoId($parte->IdParte);
                
                    foreach($tecnicos as $tecnico){
                    
                    $nombre = $tecnico->Nombre;
                        if(strlen(strstr($tec, $nombre))>0){
                            
                        }
                        else{
                            
                            $tec=$tec."".$nombre." ";
                        }
                       
                        
                    }
                    
                   

                    $FechaInicio= $parte->FechaInicio;
                    $FechaFin= $parte->FechaFin;
                    if($FechaInicio == null || $FechaFin == null || $FechaInicio == '0000-00-00 00:00:00' || $FechaFin == '0000-00-00 00:00:00'){
                        if($FechaInicio == '0000-00-00 00:00:00' || $FechaInicio == null){
                            $orden->$FechaInicio="-";
                        }
                        if($FechaFin == '0000-00-00 00:00:00' || $FechaFin == null){
                            $orden->$FechaFin="-";
                        }
                        $orden->HH="-";
                        $horasAcum = $horasAcum + 0;
                    }
                    else{
                    $date1 = strtotime("$FechaInicio");
                    $date2 = strtotime("$FechaFin");

                    //var_dump($date1);
                    //$interval = date_diff($date1, $date2);
                    //$hora =$interval->format(' %H :%I : %S ');
                    
                    
                        //$band = true;
                        
                    $h1 = ((($date2 - $date1) /60) /60);

                    //$h1 = $this->mparteorden->suma_horas($date1,$date2);
                    $horasAcum = $horasAcum+$h1;
                        //$band=false;
                        //var_dump("Entra al else");
                    }
                    


                    
                   
                    //$h2 = $this->mparteorden->explode_tiempo($hora2);

                    //echo segundos_hhmm($total_tiempo_segundos);

                    


                            
            } //recorre parte orden
        }else{

            $tec="No tiene técnicos";
            $horasAcum=0;

            }
        
        $orden->TEC=$tec;
        
        //$horasAcum =$horasAcum->format(' %H :%I : %S ');
        $orden->HH=$horasAcum;



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
            $tarea=$this->morden->consultarPrimerTarea($id);
            if($tarea != null){
                $fecha_visita= $tarea->FechaInicio;
                if($fecha_visita != null){
                    //$fecha_visita=date("d/m/Y", strtotime("$fecha_visita"));
                    $orden->Fecha=$fecha_visita;}
                else{
                    $orden->Fecha="-";
                }
            }
            else{
                $orden->Fecha="-";
            }

    $orden->Gastos=$this->morden->consultaGatosOrden($id);
    $orden->tecnicos = $this->mparteorden->mselectTecnicoId($id);

    $orden->Precio = (int)$orden->Precio;
    $orden->Gastos = (int)$orden->Gastos;
    

    $orden->Ganancia = $orden->Precio - $orden->Gastos;

    if($orden->Ganancia != null){
        $orden->Ganancia = (float)$orden->Ganancia;
        $orden->rentabilidad = $orden->HH / $orden->Ganancia;
        $orden->rentabilidad = $orden->rentabilidad * 100;
        
    }
    else{
        $orden->rentabilidad = 0;
    }

    $FechaFact= $orden->fecha_factura;
    $FechaPago= $orden->fecha_pago;
        if($FechaFact == null || $FechaPago == null || $FechaFact == '0000-00-00 00:00:00' || $FechaPago == '0000-00-00 00:00:00'){
            if($FechaFact == '0000-00-00 00:00:00' || $FechaFact == null){
                $orden->fecha_factura="-";
            }
            if($FechaPago == '0000-00-00 00:00:00' || $FechaPago == null){
                $orden->fecha_pago="-";
            }
            $orden->demora="-";
        }
        else{
        $date1 = date_create("$FechaFact");
        $date2 = date_create("$FechaPago");
        $interval = date_diff($date1,$date2);
        $dias =$interval->format(' %a ')." días";
        
        $orden->demora=$dias;
            
        }
    }
    $data = array (
        'ordenindex' => $ordenes,
        'roles'=> $this->mroles->obtener($idrol)
    );


    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/estados_trabajo/vlist',$data);
    $this->load->view('layouts/footer');
}


public function indexFiltro(){
    
    $idrol = $this->session->userdata("idRol");
    $ini=$this->input->post('txtfechai');
    $fin=$this->input->post('txtfechaf');
    
    if($ini != null && $fin != null){
    $ordenes= $this->morden->mselectordenfecha($ini,$fin); 
    
    foreach ($ordenes as $orden ) {
        $id=$orden->IdOrden;
        //$band = false;
        $parteorden = $this->mparteorden->mselectparteorden($id);
        $orden->tecnicos="";
        if($parteorden != null){
            $tec="";
            //$HH=0;
            $horasAcum=0;
           
            foreach($parteorden as $parte){
                
                $tecnicos = $this->mparteorden->mselectTecnicoId($parte->IdParte);
                
                    foreach($tecnicos as $tecnico){
                    
                    $nombre = $tecnico->Nombre;
                        if(strlen(strstr($tec, $nombre))>0){
                            
                        }
                        else{
                            
                            $tec=$tec."".$nombre." ";
                        }
                       
                        
                    }
                    
                   

                    $FechaInicio= $parte->FechaInicio;
                    $FechaFin= $parte->FechaFin;
                    if($FechaInicio != null && $FechaFin != null){

                    $date1 = strtotime("$FechaInicio");
                    $date2 = strtotime("$FechaFin");

                    //var_dump($date1);
                    //$interval = date_diff($date1, $date2);
                    //$hora =$interval->format(' %H :%I : %S ');
                    
                    
                        //$band = true;
                        
                    $h1 = ((($date2 - $date1) /60) /60);

                    //$h1 = $this->mparteorden->suma_horas($date1,$date2);
                    $horasAcum = $horasAcum+$h1;
                    }
                    else{
                        //$band=false;
                        //var_dump("Entra al else");
                        $horasAcum = $horasAcum + 0;
                    }
                    


                    
                   
                    //$h2 = $this->mparteorden->explode_tiempo($hora2);

                    //echo segundos_hhmm($total_tiempo_segundos);

                    


                            
            } //recorre parte orden
        }else{

            $tec="No tiene técnicos";
            $horasAcum=0;

            }
        
        $orden->TEC=$tec;
        
        //$horasAcum =$horasAcum->format(' %H :%I : %S ');
        $orden->HH=$horasAcum;



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

    $orden->Gastos=$this->morden->consultaGatosOrden($id);
    $orden->tecnicos = $this->mparteorden->mselectTecnicoId($id);

    $orden->Precio = (int)$orden->Precio;
    $orden->Gastos = (int)$orden->Gastos;
    

    $orden->Ganancia = $orden->Precio - $orden->Gastos;

    if($orden->Ganancia != null){
        $orden->Ganancia = (float)$orden->Ganancia;
        $orden->rentabilidad = $orden->HH / $orden->Ganancia;
        $orden->rentabilidad = $orden->rentabilidad * 100;
        
    }
    else{
        $orden->rentabilidad = 0;
    }

    }
    $data = array (
        'ordenindex' => $ordenes,
        'roles'=> $this->mroles->obtener($idrol)
    );
    

    $this->load->view('layouts/header');
    $this->load->view('layouts/aside',$data);
    $this->load->view('admin/estados_trabajo/vlist',$data);
    $this->load->view('layouts/footer');
    }//fin if
    else{
       redirect(base_url().'mantenimiento/ctrabajos/index');
    }
}




}
?>