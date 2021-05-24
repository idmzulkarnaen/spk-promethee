<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_home extends CI_Controller {

	public function __Construct(){
	   parent ::__construct();	   
	   $this->load->model('Model_crud');  
	   
	}

	public function index()
	{
		$data['judul']="Dashboard";
		$data['konten']="admin/v_dasboard";
		$data['rkriteria']= $this->Model_crud->ambilData("tb_kriteria ORDER BY nama_kriteria ASC");
		$data['rpelamar']= $this->Model_crud->ambilData("tb_alternatif ORDER BY nama_alternatif DESC");
		$this->load->view('admin/v_main',$data);
	}
}
