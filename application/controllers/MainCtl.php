<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainCtl extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->model('MainModel');
		date_default_timezone_set("Asia/Jakarta");
	}
	
	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('index');
		$this->load->view('template/footer');
	}

	public function login($msg='')
	{
		$data['msg'] = $msg;
		$this->load->view('template/header');
		$this->load->view('login', $data);
		$this->load->view('template/footer');
	}

	public function loginAct()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if ($username == '' || $password == '') {
			return $this->login('Username dan atau Password tidak boleh kosong');
		}


		$where = array(
			'username' => $username,
			'userpwd' => md5($password)
		);
		$cek = $this->MainModel->getWhere("users", $where);
		$num_row = $cek->num_rows();
		if ($num_row > 0) {
			$result = $cek->row_array();

			$data_session = array(
				'id_user'		=>	$result['id_user'],
				'username'		=>	$result['username'],
				'fullname'		=>	$result['fullname'],
				'email'			=>	$result['email'],
				'status'		=>	'login'
			);

			$this->session->set_userdata($data_session);

			redirect('MainCtl');

		} else {
			return $this->login('Username atau Password anda salah');
		}
	}

	public function signupAct()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$email    = $this->input->post('email');
		$fullname = $this->input->post('fullname');
		if ($username == '' || $password == '' || $email == '' || $fullname == '') {
			return $this->login('Username dan atau Password tidak boleh kosong');
		}

		$data = array(
			'username' => $username,
			'userpwd' => md5($password),
			'fullname' => $fullname,
			'email' => $email
		);

		$this->MainModel->inputData('users', $data);
		
		redirect('login');
	}

	public function logout()
	{
		session_destroy();
		redirect(base_url());
	}
}
