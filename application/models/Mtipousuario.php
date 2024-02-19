<?php

class Mtipousuario extends CI_Model{

   
    //MOSTRAR usuario
    public function mselecttipo(){
        $resultado =$this->db->get('tipousuario');
        return $resultado->result();
    }
    //INSERTAR usuario
   /* public function minserttipo($data){
        return  $this->db->insert('tipousuario',$data);
    }*/

    //OBTENER DATOS
    public function midupdatetipo($id){
       $this->db->where('idRol', $id);
       $resultado = $this->db->get('tipousuario');
       return $resultado->row();
    }

    //MODIFICAR usuario
   /* public function mupdateusuario($id, $data){
        $this->db->where('idusuario', $id);
        return $this->db->update('usuarios', $data);
     }*/
     //Traer usuario
    public function mselectinfotipo($id){
        $this->db->where('idRol =',"$id");
        $resultado =$this->db->get('tipousuario');
        return $resultado->row();
    }
/*
    // Listar tipo de usuario
    public function usuario_listar_select(){//
        $query=$this->db->query("SELECT DISTINCT tipousuario.nombre_tipo as NOMBRE
                                FROM tipousuario JOIN usuarios WHERE usuarios.anulado = 0
                                ORDER BY tipousuario.Nombre ASC " );
      return $query->result();
      }

    public function usuario_listar_select2(){//
        $query=$this->db->query("SELECT DISTINCT tipousuario.idRol IdTecnico ,.Nombre as NOMBRE
                                FROM tecnico WHERE tecnico.Activo = 1
                                ORDER BY tecnico.Nombre ASC " );
      return $query->result();
      }

      // Listar uno de tipo de usuario
    public function usuario_listar_select_uno($id){//
        $query=$this->db->query("SELECT DISTINCT tipousuario.nombre_tipo as NOMBRE
                                FROM tipousuario JOIN usuarios WHERE idusuario = $id");
      return $query->result();
      }


      //Verifico si exite usuario
    public function obtenerusuario($usuario){
        $this->db->where('usuarios', $usuario);
        $resultado = $this->db->get('usuarios');
        return $resultado->row();
     }
 
 */
}
?>
