<?php

class Motto extends DASHBOARD_Controller
{
	public $data = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}

	/**
	 * Redirect if needed, otherwise display the user list
	 */
	public function index($param = null)
	{
		if (request(['add'])) {
			$this->update_about();
		}
		$this->addMultipleData($this->db->get('about')->row_array());
		$this->db->select('motto_type.name as motto_type_name,motto.*');
		$this->db->join('motto_type',' motto.motto_type_id = motto_type.id');
		$this->addData('motto', $this->db->get('motto')->result_array());
		$this->render('motto/index');

	}

	private function add()
	{
		$data = request(['description', 'motto_type_id','konteks_type']);
		if (!$data) {
			return false;
		}
		$this->db->insert('motto', $data);
		add_alert([['message' => "Berhasil ditambahkan"]]);
		$this->home();
	}

	private function update()
	{
		$data = request(['description', 'motto_type_id','konteks_type']);
		if (!$data) {
			return false;
		}
		$this->db->where('id', $this->uri->segment(4));
		$this->db->update('motto', $data);
		add_alert([['message' => "Berhasil diubah"]]);
		$this->home();
	}

	public function remove()
	{

		$this->db->delete('motto', ['id' => $this->uri->segment(4)]);
		add_alert([['message' => "Berhasil dihapus"]]);
		$this->home();

	}

	private function home()
	{
		redirect('user/motto');
	}

	public function type()
	{
		if (request(['add'])) {
			$insert = request(['name']);
			$this->db->insert('motto_type', $insert);
			add_alert([['message' => 'berhasil ditambahkan']]);
		}
		$this->render("motto/type");
	}

	public function tambah()
	{
		if (request(['add'])) {
			$this->add();
		}
		$this->render('motto/tambah');
	}

	public function edit()
	{
		$this->addData('title', 'Edit Motto');
		if (request(['add'])) {
			$this->update();
		}
		$this->db->where('id', $this->uri->segment(4));
		$this->addMultipleData($this->db->get('motto')->row_array());
		$this->render('motto/tambah');
	}

	private function update_about()
	{
		$insert = request(['main_motto']);
		$exist = $this->db->get("about")->num_rows();
		if ($exist) {
			$this->db->update('about', $insert);
		} else {
			$this->db->insert('about', $insert);
		}
		add_alert([['message' => "Berhasil diubah"]]);
		$this->home();
	}
}
