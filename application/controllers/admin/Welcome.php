<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __Construct(){
	   parent ::__construct();	   
	   $this->load->model('model_crud');  
	   
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}
}
