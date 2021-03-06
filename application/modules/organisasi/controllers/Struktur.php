<?php
class Struktur extends HOME_Controller
{
	public $data = [];

	public function __construct()
	{
		parent::__construct();
		$this->addData('title','Struktur Organisasi');

		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}

	/**
	 * Redirect if needed, otherwise display the user list
	 */
	public function index()
	{

		$this->db->select('jabatan.name as jabatan_name,organization_structure.*');
		$this->db->join('jabatan','jabatan.id = organization_structure.jabatan_id');
		$this->addData('image_jabatan',$this->db->get('organization_structure')->result_array());
		$this->addData('jabatan',$this->db->get('jabatan')->result_array());
		$this->render('index');
	}
}
