<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		/*$this->load->library('session');
		$this->load->model('User');*/
	}
	public function index()
	{
		/*$kirim["error"] = "";
		$this->load->view('login',$kirim);*/
		$this->load->view('dashboard');
	}
	public function signin()
	{
		//echo var_dump($_POST);
		$flag = 0;
		$hasil = $this->User->getLogin();
		if(empty($_POST['username']) || empty($_POST['password']))
		{
			$kirim["error"] = "Masukkan Username dan Password Anda..";
			$this->load->view('login',$kirim);	
		}
		else
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			foreach ($hasil as $key) 
			{
				if($username == $key->username)
				{
					if($password == $key->password)
					{
						$this->session->set_userdata('id_login',$key->id_login);
						$this->session->set_userdata('id_role',$key->id_role);
						$this->session->set_userdata('lastvisit_at',$key->lastvisit_at);
						$flag=$key->id_role;
						break;
					}
				}
			}
			if($flag == 1)
			{
				$data = array('lastvisit_at' => date('Y-m-d H:i:s'));
				$this->User->LastVisit($data,$this->session->userdata('id_login'));
				$this->load->view('admin/header');
				$this->load->view('admin/master_jamaah');
				$this->load->view('admin/footer');
			}
			else if ($flag == 2) 
			{
				$kirim['keg'] = $this->Master_M->get_keg_byAkses($this->session->userdata('id_login'));
				$this->load->view('sekretaris/header');
				$this->load->view('sekretaris/buat_keg',$kirim);
				$this->load->view('sekretaris/footer');
			}
			else
			{
				$kirim["error"] = "Maaf, Username atau Password yang anda masukkan salah..";
				$this->load->view('login',$kirim);	
			}
		}
		
	}
	public function signout()
	{
		$data = array('lastvisit_at' => date('Y-m-d H:i:s'));
		$this->User->LastVisit($data, $this->session->userdata('id_login'));
		$kirim["error"] = "";
		$this->session->sess_destroy();
		$this->load->view("login", $kirim);
	}
}
