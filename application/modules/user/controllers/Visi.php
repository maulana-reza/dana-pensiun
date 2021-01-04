<?php


class Visi extends DASHBOARD_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->addData('title','Visi Misi');
	}

	public function index()
	{
		if (request(['add'])){
			$this->add();
		}
		$this->addMultipleData($this->db->get('about')->row_array());
		$this->render('visi/index');
	}
	private function add()
	{
		$insert = request(['visi','misi']);
		$exist = $this->db->get("about")->num_rows();
		if ($exist){
			$this->db->update('about',$insert);
		}else{
			$this->db->insert('about',$insert);
		}
		add_alert([['message' => "Berhasil diubah"]]);
		$this->home();
	}
	private function home()
	{
		redirect(uri_string(),'refresh');
	}
}
