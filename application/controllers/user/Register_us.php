<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Register_us extends CI_Controller {
 
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth_us');
		$this->load->library('form_validation');
	}
 
	public function index()
	{
		//$data["user"] = $this->auth->getAll();
		$this->load->view('user/register_us'); // Ini kearah View Registernya
	}

	public function proses()
	{
		$this->form_validation->set_rules('username_us', 'username','trim|required|min_length[1]|max_length[50]|is_unique[user.username]');
		$this->form_validation->set_rules('email_us', 'email','required|is_unique[user.email]');
		$this->form_validation->set_rules('password_us', 'password','trim|required|min_length[1]|max_length[255]');
		if ($this->form_validation->run()==true)
	   	{
			$username = $this->input->post('username_us');
			$email = $this->input->post('email_us');
			$password = $this->input->post('password_us');
			$this->auth_us->register($username,$email,$password);
			$this->session->set_flashdata('success_register','Proses Pendaftaran User Berhasil');
			redirect('user/login_us');
		}
		else
		{
			$this->session->set_flashdata('error', 'Username atau email yang Anda masukkan telah terdaftar');
			redirect('user/register_us');
		}
	}
}
