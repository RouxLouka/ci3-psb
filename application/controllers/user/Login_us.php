<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_us extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('auth_us');
	}

	public function index()
	{	$this->load->library('form_validation');
		$this->load->view('user/login_us');
	}

	public function aksi_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if($this->auth_us->login_user($username,$password))
		{
			redirect('user/dashboard');
		}
		else
		{
			$this->session->set_flashdata('error','Username & Password salah');
			redirect('user/login_us');
		}
	}
 
	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('is_login');
		redirect('user/login_us');
	}
}
