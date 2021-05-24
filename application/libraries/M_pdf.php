<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class M_pdf {

	function __construct(){
		include_once APPPATH.'third_party\mpdf\vendor\autoload.php';
	}

	function pdf(){
		$CI = & get_instance(); log_message('Debug', 'mPDF class is loaded.');
	}

	function load($param=[]){
		return new \Mpdf\Mpdf($param);
	}
} 