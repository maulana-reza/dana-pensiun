<?php
class Pengumuman extends HOME_Controller
{
	public $data = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation','pagination']);
		$this->load->helper(['url', 'language']);
		$this->addData('title','Pengumuman');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}
	public function view($id)
	{

		$this->db->where('article.id',$id);
		$this->db->select('article.*,users.first_name,users.last_name');
		$this->db->join('users','users.id = article.user_id');
		$this->addMultipleData($this->db->get('article')->row_array());

		$this->render('artikel/view');
	}

	private function type_id(){
		$data = $this->db->get_where('article_type',['name' => 'berita'])->row_array();
		return (int)$data['id'];
	}
}

