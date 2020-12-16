<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Datapenjualanmodel extends CI_Model {

    public function __construct(){
        parent::__construct();
    }
	public function get($id=null,$offset=0)
	{
        if($id===null){
            return $this->db->get('tb_penjualan1',  $offset)->result();
        }else{
            return $this->db->get_where('tb_penjualan1', ['id_penjualan'=> $id])->result_array();
        }
    }
    public function count(){
        return $this->db->get('tb_penjualan1')->num_rows();
    }
    public function add($data){
      try{
          $this->db->insert('tb_penjualan1', $data);
          $error = $this->db->error();
          if(!empty($error['code'])){
              throw new Exception ('Terjadi Kesalahan : ' . $error['message']);
              return false;
          }
          return ['status'=> true, 'data'=>$this->db->affected_rows()];

      }catch(Exception $ex){
        return ['status' => false, 'msg'=> $ex->getMessage()];
    }  
    }
    public function update($id,$data){
        try{
            $this->db->update('tb_penjualan1', $data, ['id_penjualan' => $id]);
            $error = $this->db->error();
            if(!empty($error['code'])){
                throw new Exception ('Terjadi Kesalahan : ' . $error['message']);
                return false;
            }
            return ['status'=> true, 'data'=>$this->db->affected_rows()];
  
        }catch(Exception $ex){
          return ['status' => false, 'msg'=> $ex->getMessage()];
      }  
      }
      public function delete($id){
        try{
            $this->db->delete('tb_penjualan1', ['id_penjualan' => $id]);
            $error = $this->db->error();
            if(!empty($error['code'])){
                throw new Exception ('Terjadi Kesalahan : ' . $error['message']);
                return false;
            }
            return ['status'=> true, 'data'=>$this->db->affected_rows()];
  
        }catch(Exception $ex){
          return ['status' => false, 'msg'=> $ex->getMessage()];
      }  
      }
}

