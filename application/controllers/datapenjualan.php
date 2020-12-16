<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


use chriskacerguis\RestServer\RestController;
class Datapenjualan extends RestController {

    public function __construct(){
		parent::__construct();
		$this->load->model('datapenjualanmodel' , 'dpm');
    }
	public function index_get()
	{
		$id=$this->get('id_penjualan');
		if($id===null){
			$totaldata=$this->dpm->count();
			$list=$this->dpm->get(null);
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
			$data=$this->dpm->get($id);
			if($data){
				$this->response(['status'=>true,'data'=>$data],RestController::HTTP_OK);
			}else{
				$this->response(['status'=>false,'msg'=>$id.'Tidak Ditemukan'],RestController::HTTP_NOT_FOUND);
			}
		}
	
	}
	public function index_post(){
		$data = [
		'id_penjualan' => $this->post('id_penjualan'),
		'kodeitem' => $this->post('kodeitem'),
		'namaitem' => $this->post('namaitem'),
        'size' => $this->post('size'),
        'jenis' => $this->post('jenis'),
        'merk' => $this->post('merk'),
        'jumlahbarang' => $this->post('jumlahbarang'),
        'satuan' => $this->post('satuan'),
        'totalpendapatan' => $this->post('totalpendapatan'),
		];
		$simpan = $this->dpm->add($data);
		if($simpan['status']){
			$this->response(['status'=> true, ' msg'=> $simpan['data']. 'Data telah Ditambahkan'], RestController::HTTP_CREATED);
		}else{
			$this->response(['status'=> false, 'msg'=> $simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
		}
	}
	public function index_put(){
		$data = [
            'id_penjualan' => $this->put('id_penjualan'),
            'kodeitem' => $this->put('kodeitem'),
            'namaitem' => $this->put('namaitem'),
            'size' => $this->put('size'),
            'jenis' => $this->put('jenis'),
            'merk' => $this->put('merk'),
            'jumlahbarang' => $this->put('jumlahbarang'),
            'satuan' => $this->put('satuan'),
            'totalpendapatan' => $this->put('totalpendapatan'),
		];
		$id=$this->put('id_penjualan');
		$simpan = $this->dpm->update($id,$data);
		if($simpan['status']){
			$this->response(['status'=> true, ' msg'=> $simpan['data']. 'Data telah Dirubah'], RestController::HTTP_OK);
		}else{
			$this->response(['status'=> false, 'msg'=> $simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
		}
	}
	public function index_delete(){
		
		$id=$this->delete('id_penjualan');
		$delete = $this->dpm->delete($id);
		if($delete['status']){
			$this->response(['status'=> true, ' msg'=> $id. 'Data telah Dihapus'], RestController::HTTP_OK);
		}else{
			$this->response(['status'=> false, 'msg'=> $delete['msg']], RestController::HTTP_INTERNAL_ERROR);
		}
	}
	
	
	
	}

