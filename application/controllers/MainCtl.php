<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
  
use Aws\S3\S3Client;

class MainCtl extends CI_Controller {

	private $s3Client;
	private $bucket;

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
		$this->bucket = 'dida-bucket';
		$this->s3Client = new S3Client([
			'version' => 'latest',
			'region'  => 'us-east-1',
			'credentials' => [
				'key'    => 'ASIATRLZHDPVAQFUSEON',
				'secret' => 'HOCdN5FriZCqs9C7dhnU2M91uf+Ivudw4LK96g27',
				'token'  => 'FwoGZXIvYXdzEGgaDIwU6pR0G1LP1efccCLFAYHGy4YX9f0ej8avk3vTnqF7ThUURAUsovb5QBrvHu2+YR2mKeI3GckqDmhdo7JcNpQ8DMz20lWkM8E0P4ssGLbC3vB5LoX39JEcqXjZR6fO2v9makkicOw5PiqaLVrU9oXWf7uhgCa3NSLqXVAU2oIYKBfNgYQhnHvflVVryA1ZV/jhfJdPXK2OnHMjyq1newNNQpgRGidIAMDhkTn/fs9b3rjev+OggIhuw6SprDL618sH7+drbIm4ajlVkSI07+NO/mAaKMz0l5UGMi0/x+4htpVjHDPtpkzNXXZpCNCSjEPnq6WOj1zm0Xi+rfjNk/e7UBu02F8VUGo='
			]
		]);
	}
	
	public function index()
	{
		$data['img'] = $this->MainModel->getAllImage();
		$this->load->view('template/header');
		$this->load->view('index', $data);
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

			redirect(base_url());

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

	public function userUpdate()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$email    = $this->input->post('email');
		$fullname = $this->input->post('fullname');
		
		$data = array(
			'username' => $username,
			'fullname' => $fullname,
			'email' => $email,
		);
		$data_pwd = array(
			'userpwd' => md5($password),
		);

		if ($password != '') {
			$data = array_merge($data,$data_pwd);
		}

		$this->MainModel->updateData('users', $data, array('id_user' => $this->session->userdata('id_user')));
		
		redirect('ingfo');
	}

	public function logout()
	{
		session_destroy();
		redirect(base_url());
	}

	public function uploadImage($msg='', $flag='')
	{
		if(!$this->session->userdata('status') == "login"){
			return $this->login('Silahkan Login Terlebih Dahulu');
		}
		$data['msg'] = $msg;
		$data['flag'] = $flag;
		$this->load->view('template/header');
		$this->load->view('uploadImage', $data);
		$this->load->view('template/footer');
	}

	public function uploadingImage()
	{
		if(!$this->session->userdata('status') == "login"){
			return $this->login('Silahkan Login Terlebih Dahulu');
		}

		$title = $this->input->post('title');
		$desc = $this->input->post('desc');
		
		if(isset($_FILES["uploadFile"]) && $_FILES["uploadFile"]["error"] == 0){
			$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
			$filename = $_FILES["uploadFile"]["name"];
			$filetype = $_FILES["uploadFile"]["type"];
			$filesize = $_FILES["uploadFile"]["size"];

        	// Validate file extension
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

        	// Validate file size - 10MB maximum
			$maxsize = 2 * 1024 * 1024;
			if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");


        	// Validate type of the file
			if(in_array($filetype, $allowed)){
            	// Check whether file exists before uploading it
				$id = $this->MainModel->getLatest('img_info', 'id_img');
				($id == NULL) ? $id = 1 : $id++;
				$newFileName = $this->session->userdata('username') . ' - ' . $id . '.' . $ext;
				if(move_uploaded_file($_FILES["uploadFile"]["tmp_name"], "upload/" . $newFileName)){
					$file_Path = './upload/'. $newFileName;
					$key = basename($file_Path);

					try {
						$result = $this->s3Client->putObject([
							'Bucket' => $this->bucket,
							'Key'    => $key,
							'Body'   => fopen($file_Path, 'r'),
                            'ACL'    => 'public-read', // make file 'public'
                        ]);
						// echo "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
					} catch (Aws\S3\Exception\S3Exception $e) {
						return $this->uploadImage('There was an error uploading the file.\n'.$e->getMessage());
					}
					unlink($file_Path);
					$data = array(
						'title' => $title,
						'description' => $desc,
						'filename' => $newFileName,
						'id_user' => $this->session->userdata('id_user'),
					);

					$this->MainModel->inputData('img_info', $data);

					return $this->uploadImage('Upload File Berhasil', 1);
				}else{
					return $this->uploadImage('File is not uploaded');
				}
			} else{
				return $this->uploadImage('Error: There was a problem uploading your file. Please try again.'); 
			}
		} else{
			return $this->uploadImage('Error: ' . $_FILES["uploadFile"]["error"]);
		}
	}

	public function userInfo($msg='', $flag='')
	{
		if(!$this->session->userdata('status') == "login"){
			return $this->login('Silahkan Login Terlebih Dahulu');
		}
		$data['msg'] = $msg;
		$data['flag'] = $flag;
		$data['userInfo'] = $this->MainModel->getWhere('users', array('id_user' => $this->session->userdata('id_user')))->result();
		$this->load->view('template/header');
		$this->load->view('userInfo', $data);
		$this->load->view('template/footer');
	}

	public function userImage()
	{
		if(!$this->session->userdata('status') == "login"){
			return $this->login('Silahkan Login Terlebih Dahulu');
		}
		$data['img'] = $this->MainModel->getUserImage($this->session->userdata('id_user'));
		$this->load->view('template/header');
		$this->load->view('index', $data);
		$this->load->view('template/footer');
	}

	public function deleteImage($id)
	{
		if(!$this->session->userdata('status') == "login"){
			return $this->login('Silahkan Login Terlebih Dahulu');
		}

		$data = $this->MainModel->getWhere('img_info', array('id_img' => $id))->row();

		// $result = $this->s3Client->deleteObject(array(
		// 	'Bucket' => $this->bucket,
		// 	'Key'    => $data->filename
		// ));

		$this->MainModel->deleteData('img_info', array('id_img' => $id));

		redirect('userImage');
	}
}
