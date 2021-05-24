<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_auth extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Model_crud');
        
        date_default_timezone_set('GMT');
	    date_default_timezone_set('Asia/Jakarta');
    }

	function index(){
		$this->load->view('admin/v_login');
	}

	function loginproses(){

			$user=$this->input->post('username');
			$pwd = md5($this->input->post('password'));		

			$cek = $this->Model_crud->ambilData("tb_admin","*"," username='".$user."'");
			
	        if(count($cek) == 0) {
				$this->session->set_flashdata("peringatan","<div class='alert bg-danger' role='alert'>
					<svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'/></svg> Username tidak terdaftar<a href='#' class='pull-right' class='close' data-dismiss='alert' aria-label='Close'><span class='glyphicon glyphicon-remove'></span></a>
				</div>");
				redirect("admin/c_auth");
	        } else {
	        	foreach ($cek as $row) {
	        		$pass 		= $row->password;
	        		$user 		= $row->username;
	        		$idadmin 	= $row->id_admin;
	        		$nama 		= $row->nama_admin;
	        	}


	            if($pwd !=$pass) {
	            	$this->session->set_flashdata("peringatan","<div class='alert bg-danger' role='alert'>
					<svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'/></svg> Password yang anda masukan salah<a href='#' class='pull-right' class='close' data-dismiss='alert' aria-label='Close'><span class='glyphicon glyphicon-remove'></span></a>
				</div>");
	            	redirect("admin/c_auth");
	            } else {
	                #buat sesi nrp
					$arsesi = array(
						'idadmin' => $idadmin,
						'username' => $user,
						'namaadmin' => $nama
						
					);
					$this->session->set_userdata($arsesi);
					redirect("admin/c_home");
	            }
	        }
		}

	function logout(){
		$arsesi = array(
						'idadmin',
						'namaadmin',
						'username'
					);
		$this->session->unset_userdata($arsesi);
		redirect('admin/c_auth', 'refresh');
	}

	function setting(){
		$data['judul']="";
		$id = $this->session->userdata('idadmin');
		$data['tampilkan'] = $this->Model_crud->ambilData("tb_admin","*"," id_admin='".$id."'");
		$data['konten']="admin/v_setting";
		$this->load->view('admin/v_main',$data);
	}

	function sua_proses(){
		$id = $this->session->userdata('idadmin');
		$simpan['nama_admin']= $this->input->post('nama');
		$simpan['username']= $this->input->post('username');
		$cek=$this->Model_crud->update("tb_admin",$simpan,"id_admin",$id);
		if ($cek) {
			$this->session->set_flashdata('pesan',"<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg>Proses Ubah akun Sukses<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='row'>");
			redirect('admin/c_auth/setting');
		}else{
			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Proses Ubah akun gagal<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        redirect('admin/c_auth/setting');
		}
		$this->load->view('admin/v_main',$data);
		
	}

	function sup_proses(){
		$id = $this->session->userdata('idadmin');
		$pwd = $this->input->post('pwdlama');
        $pwd1 = $this->input->post('pwdbaru');
        $pwd2 = $this->input->post('pwdulangi');

        if ($pwd1 != $pwd2) {
        	$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Password tidak sama<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        redirect('admin/c_auth/setting');
        } else {
        	$query=$this->Model_crud->cekData('tb_admin',"where id_admin='$id' and password=md5('$pwd')" );
        	if ($query>0) {
        		$update = $this->Model_crud->updateData("tb_admin","password=md5('".$pwd2."')","id_admin='".$id."'");
        		if ($update) {

        			$this->session->set_flashdata('pesan',"<div class='alert bg-success' role='alert'><svg class='glyph stroked checkmark'><use xlink:href='#stroked-checkmark'></use></svg>Proses Ubah password sukses Sukses<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='row'>");
					redirect('admin/c_auth/setting');
        		} else {
        			$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Password gagal diubah<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        		redirect('admin/c_auth/sua_proses');
        		}
        		
        	} else {
        		$this->session->set_flashdata('pesan',"<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg> Password salah<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	        	redirect('admin/c_auth/setting');
        	}
        	
        }
        
	}
}
?>