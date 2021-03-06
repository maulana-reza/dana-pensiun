<?php


class DASHBOARD_Controller extends MY_Controller
{
	protected $menus = array();
	public function __construct()
	{
		parent::__construct();
		$this->addMenus([
			[
				'label' => 'Profile',
				'url' => 'user/profile',
			],
			[
				'label' => 'Pengumuman',
				'url' => 'user/pengumuman/index',
			],
			[
				'label' => 'Dashboard',
				'url' => 'user/dashboard',
			],
			[
				'label' => 'Artikel',
				'sub' => [
					[
						'label' => 'Berita',
						'url' => 'user/artikel/berita',
					],
				]
			],
			[
				'label' => 'Tentang Kami',
				'sub' => [
					[
						'label' => 'Struktur Organisasi',
						'url' => 'user/organisasi/struktur',
					],
					[
						'label' => 'Visi Misi',
						'url' => 'user/visi',
					],
					[
						'label' => 'Motto',
						'url' => 'user/motto',
					],
//						[
//							'label' => 'Struktur Organisasi',
//							'sub' => [
//								[
//									'label' => 'Struktur Organisasi',
//									'url' => 'organisasi/struktur',
//								],
//							],
//						],
				],
			],
		]);
		$this->is_login();

	}

	public function render($view_name, $template = "adminlte", $return = FALSE)
	{
		$this->addData('menus', $this->menus);
		return parent::render($view_name, $template, $return); // TODO: Change the autogenerated stub
	}

	/**
	 * @param array $menus
	 */
	public function setMenus($menus)
	{
		$this->menus = $menus;
	}

	/**
	 * @param array $menus
	 */
	public function addMenus($menus)
	{
		$this->menus = array_merge($this->menus, $menus);
	}
	public function  is_login()
	{
		if (!parent::is_login()){
			redirect('home');
		}
	}


}
