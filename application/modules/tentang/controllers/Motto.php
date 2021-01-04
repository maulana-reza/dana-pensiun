<?php


class Motto extends HOME_Controller
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
		$this->addData('title',"Motto");

	}
	/**
	 * Redirect if needed, otherwise display the user list
	 */
	public function index()
	{
		$this->addMultipleData($this->db->get("about")->row_array());
		$this->render('motto', 'dp-pertamina');
	}
}
