<?php
class Organisasi extends DASHBOARD_Controller
{
	public $data = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->addData('title','Struktur Organisasi');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}
	/**
	 * Redirect if needed, otherwise display the user list
	 */
	public function struktur($param = null)
	{
		if ($param == "tambah"){
			if (request(['add'])) {
				$this->add();
			}
			$this->render('organisasi/tambah');
		}else if ($param == "edit"){
			if (request(['add'])) {
				$this->update();
			}
			$this->db->where('id',$this->uri->segment(5));
			$this->addMultipleData($this->db->get('organization_structure')->row_array());
			$this->render('organisasi/tambah');
		}else if($param =="remove") {
			$this->db->delete('organization_structure',['id'=> $this->uri->segment(5)]);
			add_alert([['message' => "Berhasil dihapus"]]);
			$this->home();
		}else{
			$this->db->select('jabatan.name as jabatan_name,organization_structure.*');
			$this->db->join('jabatan','jabatan.id = organization_structure.jabatan_id');
			$this->addData('struktur',$this->db->get('organization_structure')->result_array());
			$this->render('organisasi/index');
		}
	}
	private function add()
	{
		$data = request(['ket','jabatan']);
		$file = upload_file('file');

		if (!$data || !$file) {
			return false;
		}
		$insert = [
			'description' => $data['ket'],
			'img' => $file['file_name'],
			'jabatan_id' => $data['jabatan']
		];
		$this->db->insert('organization_structure',$insert);
		add_alert([['message' => "Berhasil ditambahkan"]]);
		$this->home();
	}

	private function update()
	{
		$data = request(['ket','jabatan']);
		if (!$data) {
			return false;
		}
		$insert = [
			'description' => $data['ket'],
			'jabatan_id' => $data['jabatan']
		];
		if ($_FILES['file']['name']){
			$file = upload_file('file');
			$insert['img'] = $file['file_name'];
		}
		$this->db->where('id',$this->uri->segment(5));
		$this->db->update('organization_structure',$insert);
		add_alert([['message' => "Berhasil diubah"]]);
		$this->home();
	}

	private function home()
	{
		redirect('user/organisasi/struktur');
	}
}
