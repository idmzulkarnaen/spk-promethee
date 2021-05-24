<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_penilaian extends CI_Controller {

	public function __Construct(){
	   parent ::__construct();	   
	   $this->load->model('Model_crud');  	   
	}

	public function index(){
		$data['judul']="Data penilaian";
		$data['konten']="admin/penilaian/v_index";		
		$data['tampil']	= $this->Model_crud->ambilData("tb_rekrutmen ORDER BY tanggal DESC");
		$this->load->view('admin/v_main',$data);
	}
	
	public function tampilkan()
	{
		$id = $this->input->post("id_rekrutmen");
		if($id=="") $id = $this->input->get("id");
		$data['judul']="Data penilaian";
		$data['id']=$id;
		$data['konten']="admin/penilaian/v_penilaian";
		$data['tampil']	= $this->Model_crud->ambilData("tb_rekrutmen ORDER BY tanggal DESC");
		$data['rpenilaian']=$this->Model_crud->ambilData("tb_penilaian");
		$data['rrekrutmen']= $this->Model_crud->ambilData("tb_seleksi WHERE id_rekrutmen='$id' ORDER BY id_seleksi asc");
		$data['rpelamar']= $this->Model_crud->ambilData("tb_alternatif","*","id_rekrutmen='$id' ORDER BY nama_alternatif ASC");
		//$data['rkriteria']= $this->Model_crud->ambilData("tb_seleksi_kriteria a join tb_kriteria b on a.id_kriteria = b.id_kriteria WHERE a.id_rekrutmen='$id' ORDER BY b.nama_kriteria");
				
		$this->load->view('admin/v_main',$data);
	}

	public function simpannilai()
	{
		
		$nilai	= $this->input->post("nilai");
		$alternatif	= $this->input->post("alternatif");
		$kriteria	= $this->input->post("kriteria");
		$id	= $this->input->post("id");

		$rkriteria= $this->Model_crud->ambilData("tb_seleksi_kriteria a join tb_kriteria b on a.id_kriteria = b.id_kriteria ORDER BY b.nama_kriteria");
		$rpelamar= $this->Model_crud->ambilData("tb_alternatif ","*"," id_rekrutmen = '$id' ORDER BY nama_alternatif DESC");

		$i = 0;
		foreach ($nilai as $n) {
			$data['nilai']=$n;
			$data['id_alternatif']=$alternatif[$i];
			$data['id_seleksi_kriteria']=$kriteria[$i];
			$cek = $this->Model_crud->ambilData("tb_penilaian","*","id_alternatif = '
				".$alternatif[$i]."' and id_seleksi_kriteria='".$kriteria[$i]."'");
			if(count($cek)>0){
				foreach ($cek as $key) {
				}
				$simpen = $this->Model_crud->update("tb_penilaian",$data,"id_penilaian",$key->id_penilaian);
			}else{
				$simpen = $this->Model_crud->simpan("tb_penilaian",$data);
			}

			$i++;
		}

		if ($simpen) {
			//$this->session->set_flashdata('pesan',"<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg>Proses Menilai sukses<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='row'>");
			//redirect('admin/c_penilaian/');
			echo "<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg>Nilai disimpan<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
		} else {
			//$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Proses simpan nilai gagal gagal<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        //redirect('admin/c_penilaian/');
	        echo "<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Nilai gagal disimpan<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
		}
	}


	public function reset()
	{
		
		$idr	= $this->input->post("idr");
		$ids	= $this->input->post("ids");
		$level	= $this->input->post("level");

		$rrekrutmen= $this->Model_crud->ambilData("tb_seleksi a join tb_seleksi_kriteria b on a.id_seleksi = b.id_seleksi join tb_penilaian c on b.id_seleksi_kriteria = c.id_seleksi_kriteria","*"," a.id_rekrutmen = '$idr' and a.id_seleksi >= '$ids'");
		foreach ($rrekrutmen as $r) {
			$hapus = $this->Model_crud->delete("tb_penilaian","id_penilaian='$r->id_penilaian'");
		}
		
		$simpen = $this->Model_crud->updateData("tb_alternatif","level='$level'","id_rekrutmen='$idr' and level > '$level'");
		

		if ($simpen) {
			echo "<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg>Berhasil direset<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
		} else {
	        echo "<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Gagal direset<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
		}

		redirect('admin/c_penilaian/tampilkan?id='.$idr);
	}

		

			
}
