<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_proses_hitung extends CI_Controller {

	public function __Construct(){
	   parent ::__construct();	   
	   $this->load->model('Model_crud');  
	   
	}

	public function index()
	{
		$data['judul']="Data hitung";
		$data['konten']="admin/phitung/v_index";
		$data['tampil']	= $this->Model_crud->ambilData("tb_rekrutmen ORDER BY tanggal DESC");
		$this->load->view('admin/v_main',$data);
	}

	public function tampilkan()
	{
		$id = $this->input->post("id_rekrutmen");
		$data['id']=$id;
		$data['judul']="Data hitung";
		$data['konten']="admin/phitung/v_proses_hitung";
		//$tampilkan=$this->Model_crud->ambilData("tb_penilaian a join tb_alternatif b on a.id_alternatif = b.id_alternatif join tb_kriteria c on a.id_kriteria = c.id_kriteria WHERE b.id_rekrutmen='$id' ORDER BY b.nama_alternatif");
		$data['tampil']	= $this->Model_crud->ambilData("tb_rekrutmen ORDER BY tanggal DESC");
		$data['rpenilaian']=$this->Model_crud->ambilData("tb_penilaian");
		$data['rrekrutmen']= $this->Model_crud->ambilData("tb_seleksi WHERE id_rekrutmen='$id' ORDER BY id_seleksi asc");
	
		


		$this->load->view('admin/v_main',$data);
	}


	public function exportexcel(){


		$idr = $this->input->post('idr');
		$tahap = $this->input->post('tahap');
		$seleksi = $this->input->post('seleksi');
	    $heading=array('No','Pelamar','Alamat','Tempat, tanggal lahir','Telp','Posisi Jabatan','Sekolah Asal','Keterangan');
	    $this->load->library('PHPExcel');
	    //Create a new Object
	    $objPHPExcel = new PHPExcel();
	    $objPHPExcel->getActiveSheet()->setTitle($seleksi);

	    $objPHPExcel->getProperties()->setCreator("Idham")
							 ->setLastModifiedBy("Idham")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

	    $objPHPExcel->getActiveSheet()->setCellValue("A1","Hasil seleksi ".$seleksi);

	    //Loop Heading
	    $rowNumberH = 3;
	    $colH = 'A';
	    foreach($heading as $h){
	        $objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
	        $colH++;    
	    }



	    $row = 4;
	    $no = 1;
	    //$maxrow=count($pelamar)+1;

		$rpelamar = $this->Model_crud->ambilData("tb_alternatif","*","id_rekrutmen='$idr' and level >= '$tahap' ORDER BY level DESC, nama_alternatif ASC");
	    foreach($rpelamar as $n){
	    	if($n->level>$tahap)$ket = "Lolos";
	    	else $ket = "Tidak lolos";
		    $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$no);
		    $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$n->nama_alternatif);
		    $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$n->alamat);
		    $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$n->tempat_lahir.', '.tanggal($n->tgl_lahir));
		    $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$n->telp);
	        $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$n->posjab);
	        $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$n->universitas);
	        $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$ket);
	        $row++;
	        $no++;
	    }
	    $objPHPExcel->getActiveSheet()->freezePane('A2');
	    //Cell Style
	    $styleArray = array(
	        'borders' => array(
	            'allborders' => array(
	                'style' => PHPExcel_Style_Border::BORDER_THIN
	            )
	        )
	    );
	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
	    ob_end_clean();
	    


	    header('Content-Type: pplication/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="HasilSeleksi_'.date('YmdHi').'.xls"');
	    header('Cache-Control: max-age=0');

	    $objWriter->save('php://output');
		exit();
	}


	public function cetak(){
		$this->load->library('M_pdf');

		$mpdf = $this->m_pdf->load([
		  'mode' => 'utf-8',
		  'format' => 'A4'
		]);


		$idr = $this->input->get('idr');
		$tahap = $this->input->get('tahap');
		$seleksi = $this->input->get('seleksi');

		$rpelamar = $this->Model_crud->ambilData("tb_alternatif","*","id_rekrutmen='$idr' and level >= '$tahap' ORDER BY nama_alternatif ASC");
	    

		$html = "
		<style>td{
			border: 1px solid #5f6468;
			}</style>
		<img src='".base_url('assets/img/kop amikom.png')."' Style='width:47%'>
		<br><br>
    	<h4 align='center'>PENGUMUMAN HASIL SELEKSI TAHAP ".($tahap+1)."<br>CALON KARYAWAN<BR>STMIK AMIKOM PURWOKERTO<BR>".tanggal(date('Y-m-d'))."</h4>
    	<br>
    	<p>Berikut daftar nama yang mengkuti seleksi $seleksi :</p>
    	<table class='table table-border' style='border-spacing:0;border-collapse:collapse;width:100%'>
    	<tr style='background:yellow'><td>No</td><td>Nama</td><td>Alamat</td><td>Lolos</td></tr>";

    	$no=1;
    	foreach($rpelamar as $n){
	    	if($n->level>$tahap){
	    		$sts = "Lolos";	    		
	    	}else{
	    		$sts = "Tidak lolos";
	    	}
	    	$html.= "<tr><td>$no</td><td>$n->nama_alternatif</td><td>$n->alamat</td><td>$sts</td></tr>";
	    		$no++;
	    }

    	$html.= "
    	</table>
    	<p>Selamat atas Pelamar yang lolos dalam seleksi</p>
    	<br><br>
    	<p>Purwokerto, ".tanggal(date('Y-m-d'))."</p>
    	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kabag KPH<br>STMIK AMIKOM Purwokerto</p>
    	<img src='".base_url('assets/img/ttd yusmedi.jpg')."' Style='margin-left:20px;width:24%'>
    	<p>Yusmedi Nurfaizal, S.Sos, S.E, M.M.</p>";

		//echo $html;
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}
}
