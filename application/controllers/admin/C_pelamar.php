<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pelamar extends CI_Controller {
	
	public function __Construct(){
	   parent ::__construct();	   
	   $this->load->model('Model_crud');  	   
	}

	public function index(){
		$data['judul']="Pelamar";
		$data['konten']="admin/pelamar/v_pelamar";
		$data['tampil']	= $this->Model_crud->ambilData("tb_alternatif ORDER BY nama_alternatif DESC");
		$data['relasi'] = $this->Model_crud->ambilData("tb_alternatif a join tb_rekrutmen b on a.id_rekrutmen = b.id_rekrutmen ORDER BY b.nama_rekrutmen ASC");
		$this->load->view('admin/v_main',$data);
	}

	public function tambah(){
		$data['judul']	= "Tambah pelamar";
		$data['konten']	= "admin/pelamar/v_pelamar_tambah";
		$data['tampil']	= $this->Model_crud->ambilData("tb_rekrutmen order by id_rekrutmen ASC");
		$this->load->view('admin/v_main',$data);
	}

	public function tambah_proses(){

		$simpan['nama_alternatif'] 	= $this->input->post("nama_alternatif");
		$simpan['posjab'] 			= $this->input->post("posjab");
		$simpan['universitas'] 		= $this->input->post("universitas");
		$simpan['telp'] 			= $this->input->post("telp");
		$simpan['tempat_lahir'] 	= $this->input->post("tempat_lahir");
		$simpan['tgl_lahir'] 		= $this->input->post("tgl_lahir");
		$simpan['id_rekrutmen']	 	= $this->input->post("id_rekrutmen");
		$simpan['alamat']	 		= $this->input->post("alamat");
		$simpan['level']	 		= "0";

		$cek2 = $this->Model_crud->simpan("tb_alternatif",$simpan);

		if ($cek2 > 0) {
			$this->session->set_flashdata('pesan',"<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg>Proses Tambah Pelamar Sukses<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='row'>");
			redirect('admin/c_pelamar');
		} else {
			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Proses Tambah Pelamar gagal<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        redirect('admin/c_pelamar/tambah');
		}	
	}

	public function Ubah($id){
		$data['judul']	= "Ubah Pelamar";
		$data['konten']	= "admin/pelamar/v_pelamar_ubah";		
		$data['tampil'] = $this->Model_crud->ambilData("tb_alternatif","*","id_alternatif='$id'");
		$data['rrekrutmen'] = $this->Model_crud->ambilData("tb_rekrutmen order by id_rekrutmen ASC");
		$this->load->view('admin/v_main',$data);
	}

	public function Ubah_proses(){
		$id_alternatif 				= $this->input->post("id_alternatif");
		$simpan['nama_alternatif'] 	= trim($this->input->post("nama_alternatif"));
		$simpan['posjab'] 			= $this->input->post("posjab");
		$simpan['tempat_lahir'] 	= $this->input->post("tempat_lahir");
		$simpan['tgl_lahir'] 		= $this->input->post("tgl_lahir");
		$simpan['universitas'] 		= $this->input->post("universitas");
		$simpan['telp'] 			= $this->input->post("telp");
		$simpan['alamat']	 		= $this->input->post("alamat");
		$simpan['id_rekrutmen'] 	= $this->input->post("id_rekrutmen");

		$cek=$this->Model_crud->update("tb_alternatif",$simpan,"id_alternatif",$id_alternatif);

		if ($cek) {
			$this->session->set_flashdata('pesan',"<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg>Proses Ubah pelamar Sukses<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='row'>");
			redirect('admin/c_pelamar');
		}else{
			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Proses Ubah pelamar gagal<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        redirect('admin/c_pelamar/ubah');
		}
		$this->load->view('v_main',$data);
	}

	public function Hapus($id){
		$cek = $this->Model_crud->delete('tb_alternatif','id_alternatif',$id);
		if ($cek == 0) {
			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Proses Hapus gagal<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        redirect('admin/c_pelamar');
		} else{
			$this->session->set_flashdata('pesan',"<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg>Proses hapus Sukses<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='row'>");
			redirect('admin/c_pelamar');
		}
	}

	
}
