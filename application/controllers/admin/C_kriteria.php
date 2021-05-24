<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kriteria extends CI_Controller {

	public function __Construct(){
	   parent ::__construct();	   
	   $this->load->model('Model_crud'); 	   
	}

	public function index()	{
		$data['judul']		="Kriteria";
		$data['konten']		="admin/kriteria/v_kriteria";
		$data['tampil']		= $this->Model_crud->ambilData("tb_kriteria ORDER BY nama_kriteria ASC");
		$data['relasi'] 	= $this->Model_crud->ambilData("tb_kriteria a join tb_tipe_preferensi b on a.id_tipe_preferensi = b.id_tipe_preferensi ORDER BY a.nama_kriteria ASC");
		$this->load->view('admin/v_main',$data);
	}

	public function tambah()
	{
		$data['judul']	= "Tambah Kriteria";
		$data['konten']	= "admin/kriteria/v_kriteria_tambah";
		$data['tampil']	= $this->Model_crud->ambilData("tb_tipe_preferensi order by id_tipe_preferensi ASC");
		$this->load->view('admin/v_main',$data);
	}

	public function tambah_proses()
	{

		$simpan['nama_kriteria'] 		= $this->input->post("nama_kriteria");
		$simpan['min_max']	 			= $this->input->post("min_max");
		$simpan['id_tipe_preferensi']	= $this->input->post("id_tipe_preferensi");
		$simpan['q']					= $this->input->post("q");
		$simpan['p']					= $this->input->post("p");
		$simpan['s']					= $this->input->post("s");

		if ($this->input->post("q")=="") $simpan['q'] = "0";
		else $simpan['q'] = $this->input->post("q");

		if ($this->input->post("p")=="") $simpan['p'] = "0";
		else $simpan['p'] = $this->input->post("p");

		if ($this->input->post("s")=="") $simpan['s'] = "0";
		else $simpan['s'] = $this->input->post("s");

		$cek2 = $this->Model_crud->simpan("tb_kriteria",$simpan);

		if ($cek2 > 0) {
			$this->session->set_flashdata('pesan',"<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg>Proses Tambah Kriteria Sukses<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='row'>");
			redirect('admin/c_kriteria');
		} else {
			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Proses Tambah Kriteria gagal<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        redirect('admin/c_kriteria/tambah');
		}	
	}

	public function Ubah($id)
	{
		$data['judul']	= "Ubah Kriteria";
		$data['konten']	= "admin/kriteria/v_kriteria_ubah";		
		$data['tampil'] = $this->Model_crud->ambilData("tb_kriteria","*","id_kriteria='$id'");
		$data['rtipe'] 	= $this->Model_crud->ambilData("tb_tipe_preferensi order by id_tipe_preferensi ASC");
		$this->load->view('admin/v_main',$data);
	}


	public function Ubah_proses()
	{
		$id_kriteria					= $this->input->post("id_kriteria");
		$simpan['nama_kriteria'] 		= trim($this->input->post("nama_kriteria"));
		$simpan['min_max'] 				= $this->input->post("min_max");
		$simpan['id_tipe_preferensi'] 	= $this->input->post("id_tipe_preferensi");
		$simpan['q'] 					= $this->input->post("q");
		$simpan['p'] 					= $this->input->post("p");
		$simpan['s'] 					= $this->input->post("s");

		$cek=$this->Model_crud->update("tb_kriteria",$simpan,"id_kriteria",$id_kriteria);

		if ($cek) {
			$this->session->set_flashdata('pesan',"<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg>Proses Ubah kriteria Sukses<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='row'>");
			redirect('admin/c_kriteria');
		}else{
			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Proses Ubah kriteria gagal<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        redirect('c_kriteria/ubah');
		}
		$this->load->view('admin/v_main',$data);
	}



	public function Hapus($id)
	{
		$cek = $this->Model_crud->delete('tb_kriteria','id_kriteria',$id);
		if ($cek == 0) {
			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Proses Hapus gagal<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        redirect('admin/c_kriteria');
		} else{
			$this->session->set_flashdata('pesan',"<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg>Proses hapus Sukses<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='row'>");
			redirect('admin/c_kriteria');
		}
	}
}
