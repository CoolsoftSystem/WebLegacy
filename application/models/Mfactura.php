<?php

class Mfactura extends CI_Model{

    //MOSTRAR Factura
    public function mselectfactura(){
        
        $resultado =$this->db->get('factura');

        return $resultado->result();
    }
    //INSERTAR Factura
    public function minsertfactura($data){
        return  $this->db->insert('factura',$data);
    }

    //Modificar
    public function miupdatefactura($id){
       $this->db->where('id_orden', $id);
       $resultado = $this->db->get('factura');
       return $resultado->row();
    }
     //OBTENER DATOS
     public function midupdatefact($id){
        $this->db->where('N_factura', $id);
        $resultado = $this->db->get('factura');
        return $resultado->row();
     }
 
     //MODIFICAR factura
     public function mupdatefact($id, $data){
 
         $this->db->where('N_factura', $id);
         return $this->db->update('factura', $data);
      }

      //busca si para esa orden hay factura
  public function mbuscaordenfactura($id){

    $resultado = $query = $this->db->query("SELECT f.N_factura 
    FROM factura f 
    where f.id_orden=$id;");
    return $resultado->result();

}
//
}
?>