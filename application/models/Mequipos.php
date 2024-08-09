<?php

class Mequipos extends CI_Model{

    //MOSTRAR orden equipos
    public function mselectequipos(){
        $resultado =	$query = $this->db->query("SELECT r.num_orden , r.fecha ,r1.marca, r1.modelo,
        r1.num_serie, r1.sector, r1.descripcion, r1.accesorios, r.id_cliente, r.anulado, c.Nombre FROM recepcionEquiposEncabezado r
        JOIN cliente c ON r.id_cliente = c.IdCliente  
		JOIN recepcionEquiposDetalle r1 ON r.num_orden = r1.id_encabezado
        where r.anulado = 0 and r1.anulado = 0
        ORDER BY r.num_orden DESC;");
     return $resultado->result();
    }
    //INSERTAR orden equipos encabezado
    public function minsertequipos($data){
        return  $this->db->insert('recepcionEquiposEncabezado',$data);
    }

	 //INSERTAR orden equipos items
	 public function minsertequipositems($data){
        return  $this->db->insert('recepcionEquiposDetalle',$data);
    }

    //OBTENER DATOS encabezado
    public function midupdateequipos($id){
       $this->db->where('num_orden', $id);
       $resultado = $this->db->get('recepcionEquiposEncabezado');
       return $resultado->row();
    }

	//OBTENER DATOS items
    public function midupdateequipositems($id){
		$this->db->where('id_equipo', $id);
		$resultado = $this->db->get('recepcionEquiposDetalle');
		return $resultado->row();
	 }
    
    //MODIFICAR orden equipos encabezado
    public function mupdateequipos($id, $data){
        $this->db->where('num_orden', $id);
        return $this->db->update('recepcionEquiposEncabezado', $data);
     }

	  //MODIFICAR orden equipos detalle
	  public function mupdateequipositems($id, $data){
        $this->db->where('id_equipo', $id);
        return $this->db->update('recepcionEquiposDetalle', $data);
     }

	 //Trear Detalle Orden equipos
	 public function obtenerEquiposDetalle($idEquipo, $idEncabezado){
        $this->db->where('id_equipo =',"$idEquipo");
        $this->db->where('id_encabezado =',"$idEncabezado");
        $resultado =$this->db->get('recepcionEquiposDetalle');
        return $resultado->result();
    }

	 //Trear Detalle Orden equipos
	 public function obtenerEquiposDetalle($idEncabezado){
        $this->db->where('id_encabezado =',"$idEncabezado");
        $resultado =$this->db->get('recepcionEquiposDetalle');
        return $resultado->result();
    }

	public function cargarItems($data){

		$idEncabezado=$data['IdEncabezado'];
		$marca=$data['marca'];
		$modelo=$data['modelo'];
		$numSerie=$data['numSerie'];
		$sector=$data['sector'];
		$accesorios=$data['accesorios'];
	   
		$this->db->where('IdEncabezado =',"$IdEncabezado");
		$this->db->insert('recepcionEquiposDetalle',$data);
		$resultado=$this->db->insert_id();
	
		return $linka= $data;
	}

     //Traer Cliente
    public function mselectinfocliente($id){
        $this->db->where('IdCliente =',"$id");
        $resultado =$this->db->get('cliente');
        return $resultado->row();
    }

    public function cliente_listar_select(){//
        $query=$this->db->query("SELECT DISTINCT cliente.IdCliente  ID ,cliente.Nombre as NOMBRE
                                FROM cliente WHERE cliente.Anulado = 0
                                ORDER BY cliente.Nombre ASC " );
      return $query->result();
      }

      public function cliente_listar_select2(){//
        $query=$this->db->query("SELECT DISTINCT cliente.IdCliente  IdCliente ,cliente.Nombre as NOMBRE
                                FROM cliente WHERE cliente.Anulado = 0
                                ORDER BY cliente.Nombre ASC " );
      return $query->result();
      }

      function obtener($id){//
        $this->db->where("IdCliente",$id);
        $query = $this->db->get('cliente');
        return $query->row();
        $error = $this->db->error();
    }

	 //Eliminar items detalle
	 public function mdeleteequiposdetalle($idEquipo){

        $this->db->where('id_equipo =',"$idEquipo");
        $resultado =$this->db->delete('recepcionEquiposDetalle');

    }
}
?>
