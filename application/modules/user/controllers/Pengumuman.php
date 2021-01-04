<?php

class Pengumuman extends DASHBOARD_Controller
{
	public $data = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->addData('title','Pengumuman');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}

	/**
	 * Redirect if needed, otherwise display the user list
	 */
	public function index($param = null)
	{
//		halaman tambah
		if ($param == "tambah") {
			if (request(['add'])) {
				$this->tambah();
			}
			$this->render('berita/tambah');
//		halaman edit
		} else if ($param == "edit") {
			if (request(['add'])) {
				$this->update();
			}
			$this->addData('title','Edit Pengumuman');
			$this->db->where('id',$this->uri->segment(5));
			$this->addMultipleData( $this->db->get('article')->row_array());
			$this->render('berita/tambah');
//		halaman hapus
		}else if($param =="remove"){
			$this->db->delete('article',['id' => $this->uri->segment(5)]);
			add_alert([['message' => "Berhasil dihapus"]]);
			$this->home();
		} else {

			$this->db->where('type_id',$this->type_id());
			$this->db->order_by('id','asc');
			$this->addData('berita', $this->db->get('article')->result_array());
			$this->render('berita/index');
		}
	}

	private function tambah()
	{
		$data = upload_file('file');

		$name = request([
			'judul',
			'deskripsi'
		]);

		if (!$data && !$name) {
			return false;
		}
		$insert = [
			'type_id' => $this->type_id(),
			'name' => $name['judul'],
			'description' => $name['deskripsi'],
			'user_id' => $this->ion_auth->user()->row()->id,
			'img' => $data['file_name'],
		];
		$this->db->insert('article', $insert);
		add_alert([['message' => "Berhasil ditambahkan"]]);
		$this->home();
	}
	private function update()
	{

		$name = request([
			'judul',
			'deskripsi'
		]);

		$insert = [
			'name' => $name['judul'],
			'description' => $name['deskripsi'],
		];
		if ($_FILES['file']['name']){
			$data = upload_file('file');
			$insert['img'] = $data['file_name'];
		}
		$this->db->where('id',$this->uri->segment(5));
		$this->db->update('article',$insert);
		add_alert([['message' => "Berhasil diubah"]]);
		$this->home();

	}
	private function type_id(){
		$data = $this->db->get_where('article_type',['name' => 'pengumuman'])->row_array();
		return $data['id'];
	}
	function home(){
		redirect('user/pengumuman/index');
	}
}
