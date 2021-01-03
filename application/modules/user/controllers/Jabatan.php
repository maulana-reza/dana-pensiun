<?php


class Jabatan extends DASHBOARD_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library(['ion_auth', 'form_validation']);

	}

	public function tambah(){
		if (request(['add'])){
			$this->add();
		}
		$this->render('jabatan/index');
	}
	private function add(){
		$data = request(['name']);
		if (!$data){
			return false;
		}
		$this->db->insert('jabatan',$data);
		add_alert([['message' => 'Jabatan berhasil ditambahkan']]);
		$this->home();
	}
	private function home()
	{
//		redirect('user/organisasi/struktur/tambah');
	}
}
