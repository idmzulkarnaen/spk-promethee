<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_rekrutmen extends CI_Controller {

	public function __Construct(){
	   parent ::__construct();	   
	   $this->load->model('Model_crud');  	   
	}

	public function index(){
		$data['judul']	= "Perekrutan";
		$data['konten']	= "admin/rekrutmen/v_rekrutmen";
		$data['tampil']	= $this->Model_crud->ambilData("tb_rekrutmen ORDER BY tanggal DESC");
		$this->load->view('admin/v_main',$data);
	}

	public function tambah(){
		$data['judul']	= "Tambah perekrutan Posisi Jabatan";
		$data['konten']	= "admin/rekrutmen/v_rekrutmen_tambah";
		$this->load->view('admin/v_main',$data);
	}

	public function tambah_proses(){
		$data['kode'] 			= trim($this->input->post("kode"));
		$data['nama_rekrutmen'] = trim($this->input->post("nama_rekrutmen"));
		$data['tanggal'] 		= $this->input->post("tanggal");
		$data['kuota'] 			= $this->input->post("kuota");
		$data['keterangan'] 	= $this->input->post("keterangan");

		$cek = $this->Model_crud->cekData("tb_rekrutmen","WHERE kode='".$data['kode']."'");


		if (empty($data['kode'] && $data['nama_rekrutmen'] )) {
			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> kode atau nama belum diisi<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        redirect('admin/c_rekrutmen/tambah');
		}else if ($cek > 0) {
			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg>Kode data sudah ada<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        redirect('admin/c_rekrutmen/tambah');
		}


		$cek2 = $this->Model_crud->simpan("tb_rekrutmen",$data);

		if ($cek2 > 0) {
			$this->session->set_flashdata('pesan',"<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg>Proses Tambah Jabatan Sukses<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='row'>");
			redirect('admin/c_rekrutmen');
		} else {
			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Proses Tambah Jabatan gagal<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        redirect('admin/c_rekrutmen/tambah');
		}	
	}

	public function Ubah($id){
		$data['judul']	= "Ubah perekrutan Posisi Jabatan";
		$data['konten']	= "admin/rekrutmen/v_rekrutmen_ubah";
		if (!isset($id)) {
			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Proses masuk ke ubah gagal<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        redirect('admin/c_rekrutmen');
		}
		else{
			//$this->session->set_flashdata('pesan',"<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg> Selamat datang di proses ubah posisi jabatan <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
			$data['tampil'] = $this->Model_crud->ambilData("tb_rekrutmen","*","id_rekrutmen='$id'");
		}
		
		$this->load->view('admin/v_main',$data);
	}

	public function Ubah_proses(){
		$id_rekrutmen 				= trim($this->input->post("id_rekrutmen"));
		$data['nama_rekrutmen'] 	= trim($this->input->post("nama_rekrutmen"));
		$data['tanggal'] 			= $this->input->post("tanggal");
		$data['kuota'] 				= $this->input->post("kuota");
		$data['keterangan'] 		= $this->input->post("keterangan");
		$data['kode'] 				= $this->input->post("kode");

		$cek=$this->Model_crud->update("tb_rekrutmen",$data,"id_rekrutmen",$id_rekrutmen);

		if ($cek) {
			$this->session->set_flashdata('pesan',"<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg>Proses Ubah Jabatan Sukses<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='row'>");
			redirect('admin/c_rekrutmen');
		}else{
			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Proses Ubah Jabatan gagal<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        redirect('c_rekrutmen/ubah');
		}
		$this->load->view('admin/v_main',$data);
	}

	public function Hapus($id){
		$cek = $this->Model_crud->delete('tb_rekrutmen','id_rekrutmen',$id);
		if ($cek == 0) {
			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Proses Hapus gagal<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        redirect('admin/c_rekrutmen');
		} else{
			$this->session->set_flashdata('pesan',"<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg>Proses hapus Sukses<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='row'>");
			redirect('admin/c_rekrutmen');
		}
	}

	//--------------------  seleksi -----------------------------------------------------------------------------------------------

	public function seleksi($id){
		$data['id_rekrutmen']	= $id;
		$data['judul']	= "Perekrutan";
		$data['konten']	= "admin/rekrutmen/v_seleksi";
		$data['tampil']	= $this->Model_crud->ambilData("tb_rekrutmen a join tb_seleksi b on a.id_rekrutmen = b.id_rekrutmen","*","b.id_rekrutmen='$id' ORDER BY b.id_seleksi ASC");
		$this->load->view('admin/v_main',$data);
	}

	public function tambahseleksi($id){
		$data['id_rekrutmen']	= $id;
		$data['judul']	= "Tambah Seleksi";
		$data['rkriteria']	= $this->Model_crud->ambilData("tb_kriteria ORDER BY nama_kriteria ASC");
		$data['konten']	= "admin/rekrutmen/v_seleksi_tambah";
		$this->load->view('admin/v_main',$data);
	}

	public function tambah_prosesseleksi(){
		$data['id_seleksi'] 	= $this->Model_crud->newId('tb_seleksi','id_seleksi');
		$data['id_rekrutmen'] 	= $this->input->post("id_rekrutmen");
		$data['nama_seleksi']	= trim($this->input->post("nama_seleksi"));
		$data['kuota'] 			= $this->input->post("kuota");
		$kriteria 				= $this->input->post("kriteria");
		$bobot	 				= $this->input->post("bobot");


		$simpan = $this->Model_crud->simpan("tb_seleksi",$data);

		if ($simpan > 0) {
			$i = 0;
			foreach ($kriteria as $r) {
				if($r!=""){
					$data2['id_seleksi'] = $data['id_seleksi'];
					$data2['id_kriteria'] = $r;
					$data2['bobot'] = $bobot[$i];
					$this->Model_crud->simpan("tb_seleksi_kriteria",$data2);
					$i++;
				}
			}

			$this->session->set_flashdata('pesan',"<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg>Seleksi ditambahkan<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='row'>");
			redirect('admin/c_rekrutmen/seleksi/'.$data['id_rekrutmen']);
		} else {
			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Gagal menambhkan seleksi<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        redirect('admin/c_rekrutmen/tambahseleksi/'.$data['id_rekrutmen']);
		}	
	}

	public function Ubahseleksi($id){
		$data['id_seleksi']			= $id;
		$data['judul']				= "Ubah Seleksi";
		$data['rkriteria']			= $this->Model_crud->ambilData("tb_kriteria ORDER BY nama_kriteria ASC");
		$data['rkriteriadipilih'] 	= $this->Model_crud->ambilData("tb_seleksi_kriteria","*","id_seleksi = '".$id."'");
		$data['konten']	= "admin/rekrutmen/v_seleksi_ubah";
		if (!isset($id)) {
			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Proses masuk ke ubah gagal<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        redirect('admin/c_rekrutmen');
		}else{
			//$this->session->set_flashdata('pesan',"<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg> Selamat datang di proses ubah posisi jabatan <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
			$data['tampil'] = $this->Model_crud->ambilData("tb_rekrutmen a join tb_seleksi b on a.id_rekrutmen = b.id_rekrutmen","*","id_seleksi='$id'");
		}
		
		$this->load->view('admin/v_main',$data);
	}

	public function Ubah_prosesseleksi(){
		$id_seleksi 				= $this->input->post("id_seleksi");
		$id_rekrutmen 				= $this->input->post("id_rekrutmen");
		$data['nama_seleksi'] 		= trim($this->input->post("nama_seleksi"));
		$data['kuota'] 				= $this->input->post("kuota");
		$kriteria 					= $this->input->post("kriteria");
		$bobot	 					= $this->input->post("bobot");

		$cek=$this->Model_crud->update("tb_seleksi",$data,"id_seleksi",$id_seleksi);

		if ($cek) {
			$idk = "";
			$i = 0;
			$this->Model_crud->deleteData("tb_seleksi_kriteria","id_seleksi = '$id_seleksi'");
			foreach ($kriteria as $r) {
				if($r!=""){
					$data2['id_kriteria'] = $r;
					$data2['bobot'] = $bobot[$i];
					$cek2 = $this->Model_crud->cekData("tb_seleksi_kriteria","where id_seleksi = '".$id_seleksi."' and id_kriteria='".$data2['id_kriteria']."'");
					if($cek2>0){
						$this->Model_crud->update("tb_seleksi_kriteria",$data2,"id_seleksi",$id_seleksi);
					}else{
						$data2['id_seleksi'] = $id_seleksi;
						$this->Model_crud->simpan("tb_seleksi_kriteria",$data2);
					}
					if($idk=="")$idk = "'".$r."'";
					else $idk = $idk.",'".$r."'";
					$i++;	
				}		
			}

			$this->session->set_flashdata('pesan',"<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg>Seleksi diubah<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='row'>");
			redirect('admin/c_rekrutmen/seleksi/'.$id_rekrutmen);
		}else{
			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Seleksi gagal diubah<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        redirect('admin/c_rekrutmen/Ubahseleksi/'.$id_seleksi);
		}
	}


	public function Hapusseleksi(){
		$id = $this->input->get('ids');
		$idr = $this->input->get('idr');
		$cek = $this->Model_crud->delete('tb_seleksi','id_seleksi',$id);
		if ($cek ) {
			$this->session->set_flashdata('pesan',"<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg>Seleksi dihapus<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
			redirect('admin/c_rekrutmen/seleksi/'.$idr);
		} else{
			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Seleksi gaga dihapus<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='row'>");
			redirect('admin/c_rekrutmen/seleksi/'.$idr);
		}
	}


}