<?php
class Berita extends HOME_Controller
{
	public $data = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation','pagination']);
		$this->load->helper(['url', 'language']);
		$this->addData('title','Berita');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}

	/**
	 * Redirect if needed, otherwise display the user list
	 */
	public function index()
	{
		$this->data();
		$this->render('index');
	}
	private function data()
	{
		$this->db->where('article.type_id',$this->type_id());
		$this->db->select('article.*,users.first_name,users.last_name');
		$this->db->join('users','users.id = article.user_id');
		$this->db->group_by('article.id');
		$count = $this->db->get('article')->num_rows();
		$data = pagination($count,'artikel/berita/index',4,5);

		$this->db->where('article.type_id',$this->type_id());
		$this->db->select('article.*,users.first_name,users.last_name');
		$this->db->join('users','users.id = article.user_id');
		$this->db->group_by('article.id');
		$article = $this->db->get('article',5,$data['page'])->result_array();
		$this->addData('article',$article);
		$this->addData('pagination',$data['pagination']);
	}
	public function view($id)
	{

		$this->db->where('article.id',$id);
		$this->db->select('article.*,users.first_name,users.last_name');
		$this->db->join('users','users.id = article.user_id');
		$this->addMultipleData($this->db->get('article')->row_array());
		$this->addData('title','Berita');
		$this->render('view');
	}

	private function type_id(){
		$data = $this->db->get_where('article_type',['name' => 'berita'])->row_array();
		return (int)$data['id'];
	}
}
