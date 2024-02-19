<?php

class Mroles extends CI_Model{

   /* public function logeo ($user,$pass){

        $this->db->where('nombre',$user);
        $this->db->where('pass',$pass);
        $resultado =$this->db->get('usuarios');
        if($resultado->num_rows()>0){
            return $resultado->row();
        }
        else{
            return false;
        }
    }*/

    //MOSTRAR usuario
    public function mselectrolessolo(){
        //$this->db->where('Anulado =','0');
        $resultado =$query=$this->db->query("SELECT t.idRol, t.nombre_tipo, t.cliente, t.tecnico, t.ordenes, t.usuarios, t.roles, t.estados_trabajo
        FROM tipousuario t 
        WHERE anulado = 0");
        return $resultado->result();
    }
    //no se usa
    public function mselectroles(){
        //$this->db->where('Anulado =','0');
        $resultado =$query=$this->db->query("SELECT t.nombre_tipo, t.idRol, u.idUsuario, u.nombre, u.email
        FROM tipousuario t INNER JOIN usuarios u on t.idRol=u.idRol WHERE u.anulado = 0");
        return $resultado->result();
    }

    public function mtroles(){
        
        $resultado =$query=$this->db->query("SELECT t.nombre_tipo FROM tipousuario t");
        return $resultado->result();
    }
    //INSERTAR usuario
    public function minsertroles($data){
        return  $this->db->insert('tipousuario',$data);
    }

    //OBTENER DATOS
    public function midupdateroles($id){
       $this->db->where('idRol', $id);
       $resultado = $this->db->get('tipousuario');
       return $resultado->row();
    }

    //MODIFICAR usuario
    public function mupdateroles($id, $data){
        $this->db->where('idRol', $id);
        return $this->db->update('tipousuario', $data);
     }
     //Traer usuario
    public function mselectinforoles($id){
        $this->db->where('idRol', $id);
        $resultado =$this->db->get('tipousuario');
        return $resultado->row();
    }

    // Listar tipo de usuario
    public function roles_listar_select(){//
        $query=$this->db->query("SELECT DISTINCT tipousuario.nombre_tipo as NOMBRE
                                FROM tipousuario JOIN usuarios WHERE usuarios.anulado = 0");
      return $query->result();
      }

    public function roles_listar_select2(){//
        $query=$this->db->query("SELECT DISTINCT u.idUsuario, t.nombre_tipo
                                FROM tipousuario t INNER JOIN usuarios u on t.idRol=u.idRol WHERE u.anulado = 0" );
      return $query->result();
      }

      // Listar uno de tipo de usuario
    public function roles_listar_select_uno($id){//
        $query=$this->db->query("SELECT DISTINCT tipousuario.nombre_tipo as NOMBRE
                                FROM tipousuario JOIN usuarios WHERE idusuario = $id");
      return $query->result();
      }


      //Verifico si exite usuario
    public function obtenerrol($rol){
        $this->db->where('nombre_tipo', $rol);
        $resultado = $this->db->get('tipousuario');
        return $resultado->row();
     }
 
     public function obtenerroles($roles){
        $this->db->where('tipousuario', $roles);
        $resultado = $this->db->get('tipousuario');
        return $resultado->row();
     }

    function obtener($id){
        $this->db->where("idRol",$id);
        $query = $this->db->get('tipousuario');
        return $query->row();
        $error = $this->db->error();
    }
 
}
?>