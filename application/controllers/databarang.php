<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


use chriskacerguis\RestServer\RestController;
class Databarang extends RestController {

    public function __construct(){
		parent::__construct();
		$this->load->model('databarangmodel' , 'dbm');
    }
	public function index_get()
	{
		$id=$this->get('id_barang');
		if($id===null){
			$totaldata=$this->dbm->count();
			$list=$this->dbm->get(null);
			if($list){
				$data=[
					'status'=>true,
					'totaldata'=>$totaldata,
					'data'=>$list
				];
			}
			else{
				$data=[
					'status'=>false,
					'msg'=> 'Data Tidak Ditemukan'
				];
			}
			$this->response($data,RestController::HTTP_OK);
		}else{
			$data=$this->dbm->get($id);
			if($data){
				$this->response(['status'=>true,'data'=>$data],RestController::HTTP_OK);
			}else{
				$this->response(['status'=>false,'msg'=>$id.'Tidak Ditemukan'],RestController::HTTP_NOT_FOUND);
			}
		}
	
	}
	public function index_post(){
		$data = [
		'id_barang' => $this->post('id_barang'),
		'kodebarang' => $this->post('kodebarang'),
		'namabarang' => $this->post('namabarang'),
		'jumlahbarang' => $this->post('jumlahbarang'),
		];
		$simpan = $this->dbm->add($data);
		if($simpan['status']){
			$this->response(['status'=> true, ' msg'=> $simpan['data']. 'Data telah Ditambahkan'], RestController::HTTP_CREATED);
		}else{
			$this->response(['status'=> false, 'msg'=> $simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
		}
	}
	public function index_put(){
		$data = [
		'id_barang' => $this->put('id_barang'),
		'kodebarang' => $this->put('kodebarang'),
		'namabarang' => $this->put('namabarang'),
		'jumlahbarang' => $this->put('jumlahbarang'),
		];
		$id=$this->put('id_barang');
		$simpan = $this->dbm->update($id,$data);
		if($simpan['status']){
			$this->response(['status'=> true, ' msg'=> $simpan['data']. 'Data telah Dirubah'], RestController::HTTP_OK);
		}else{
			$this->response(['status'=> false, 'msg'=> $simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
		}
	}
	public function index_delete(){
		
		$id=$this->delete('id_barang');
		$delete = $this->dbm->delete($id);
		if($delete['status']){
			$this->response(['status'=> true, ' msg'=> $id. 'Data telah Dihapus'], RestController::HTTP_OK);
		}else{
			$this->response(['status'=> false, 'msg'=> $delete['msg']], RestController::HTTP_INTERNAL_ERROR);
		}
	}
	
	
	
	}

