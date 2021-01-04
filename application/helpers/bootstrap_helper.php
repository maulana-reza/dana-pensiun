<?php
function menus($menus)
{
	$menu = '<li class="menu-item menu-item-type-custom menu-item-object-custom">
						<a href=" %s " class="">
						<i class="%s"></i>
									%s
						</a>
				</li>';
	$sub_menu = '<li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children active has-sub">
						<a href="#" class=" current "> %s </a>
						<span class="arrow"></span>
						<ul class="sub-menu">
						%s
						</ul>
					</li>';
	foreach ($menus as $item) {
		if (@$item['sub']) {
			$sub_menus_temp = sub_menus(@$item['sub']);
			$result[] = sprintf($sub_menu, @$item['label'], $sub_menus_temp);
		} else {
			$result[] = sprintf($menu, site_url(@$item['url']), @$item['icon'], @$item['label']);
		}
	}
	$ul = '<ul id="menu-main-menu-1" class="mobile-menu accordion-menu"> %s </ul>';
	return sprintf($ul, implode('', $result));
}

function sub_menus($menus)
{
	$sub_menu = '<li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children active has-sub">
						<a href="#" class=" current "> %s </a>
						<span class="arrow"></span>
						<ul class="sub-menu">
						%s
						</ul>
					</li>';
	$menu = '<li class="menu-item menu-item-type-post_type menu-item-object-page">
				<a href=" %s " class="">%s</a>
				</li>';
	foreach ($menus as $item) {
		if (@@$item['sub']) {
			$sub_menus_temp = sub_menus(@$item['sub']);
			$result[] = sprintf($sub_menu, @$item['label'], $sub_menus_temp);
		} else {
			$result[] = sprintf($menu, site_url(@$item['url']), @$item['label']);
		}
	}
	return implode('', $result);
}

function menus_web($menus)
{
	$menu = '<li class="menu-item menu-item-type-post_type menu-item-object-page  narrow ">
						<a href=" %s " class="">
						<i class="%s"></i>
									%s
						</a>
				</li>';
	$sub_menu = '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has-sub narrow ">
						<a href="#" class="  "> %s </a>
						<span class="arrow"></span>
						<div class="popup" style="display: block;"><div class="inner" style=""><ul class="sub-menu">
						%s
						</ul>
						</div>
						</div>
					</li>';
	foreach ($menus as $item) {
		if (@$item['sub']) {
			$sub_menus_temp = sub_menus_web(@$item['sub']);
			$result[] = sprintf($sub_menu, @$item['label'], $sub_menus_temp);
		} else {
			$result[] = sprintf($menu, site_url(@$item['url']), @$item['icon'], @$item['label']);
		}
	}
	$ul = '<ul id="menu-main-menu" class="main-menu mega-menu show-arrow"> %s </ul>';
	return sprintf($ul, implode('', $result));
}

function sub_menus_web($menus)
{
	$sub_menu = '<li class="menu-item menu-item-type-taxonomy menu-item-object-category current-menu-item menu-item-has-children  sub">
						<a href="#" > %s </a>
						<span class="arrow"></span>
						<ul class="sub-menu">
						%s
						</ul>
					</li>';
	$menu = '<li class="menu-item menu-item-type-taxonomy menu-item-object-category">
				<a href=" %s " class="">%s</a>
				</li>';
	foreach ($menus as $item) {
		if (@$item['sub']) {
			$sub_menus_temp = sub_menus_web(@$item['sub']);
			$result[] = sprintf($sub_menu, @$item['label'], $sub_menus_temp);
		} else {
			$result[] = sprintf($menu, site_url(@$item['url']), @$item['label']);
		}
	}
	return implode('', $result);
}

function uri_path()
{
	$data = uri_string();
	$array = explode('/', $data);
	$list = '<li class="home" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"> 
				<a itemtype="http://schema.org/Thing" itemprop="item" href="%s"
				title="Go to Home Page"><span itemprop="name">%s</span>
				<meta itemprop="position" content="%s"/>
				</a><i class="delimiter"></i></li>';
	$last_list = '<li>%s</li>';
	foreach ($array as $key => $item) {

		if ($key == count($array) - 1) {
			$result[] = sprintf($last_list, RemoveSpecialChar($item));
		} else {
			$result[] = sprintf($list, site_url($item), RemoveSpecialChar($item), $key + 1);
		}
	}
	return implode('', $result);
}

function uri_path_dashboard()
{
	$data = uri_string();
	$array = explode('/', $data);
	$list = '<li class="breadcrumb-item"><a href="%s">%s</a></li>';
	$last_list = '<li class="breadcrumb-item active">%s</li>';
	foreach ($array as $key => $item) {

		if ($key == count($array) - 1) {
			$result[] = sprintf($last_list, RemoveSpecialChar($item));
		} else {
			$result[] = sprintf($list, site_url($item), RemoveSpecialChar($item), $key + 1);
		}
	}
	$ul = '<ol class="breadcrumb float-sm-right">
							%s</ol>';
	return sprintf($ul, implode('', $result));
}

function RemoveSpecialChar($str)
{

	// Using str_replace() function
	// to replace the word
	$res = str_replace(array('\'', '"',
		',', ';', '<', '>'), ' ', $str);

	// Returning the result
	return ucfirst($res);
}

function title($title = null)
{
	$data = uri_string();
	$array = explode('/', $data);
	if ($title == null) {
		$title = $array[count($array) - 1];
	}
	return RemoveSpecialChar($title);
}

function alert($type, $message = null)
{
	$alert = '<div class="alert alert-%s" role="alert">
%s
</div>';
	if (!$message)
		return "";

	$message = str_replace(".", "<br>", $message);
	return sprintf($alert, $type, $message);
}

function menus_dashboard($menus)
{
	$menu = '<li class="nav-item">
						<a href="%s" class="nav-link">
							<i class="%s"></i>
							<p>
							%s
							</p>
						</a>
					</li>';
	$sub_menu = '<li class="nav-item menu-open">
						<a  href="#" class="nav-link">
							<i class="%s"></i>
							<p>
								%s
								<i class="right fas fa-angle-left"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
						%s
						</ul>
					</li>';
	$li = '<li class="nav-header">%s</li>';
	foreach ($menus as $item) {
		if (@$item['header']) {
			$result[] = sprintf($li, $item['header']);
		} else if (@$item['sub']) {
			$sub_menus_temp = sub_menus_dashboard(@$item['sub']);
			$result[] = sprintf($sub_menu, @$item['icon'], @$item['label'], $sub_menus_temp);
		} else {
			$result[] = sprintf($menu, site_url(@$item['url']), @$item['icon'], @$item['label']);
		}
	}
	$ul = '<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> %s </ul>';
	return sprintf($ul, implode('', $result));
}

function sub_menus_dashboard($menus)
{
	$sub_menu = '<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="nav-icon fas fa-circle"></i>
							<p>
								%s
								<i class="right fas fa-angle-left"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
						%s
						</ul>
					</li>';
	$menu = '<li class="nav-item">
								<a href="%s" class="nav-link">
									<i class="%s"></i>
									<p>%s</p>
								</a>
							</li>';
	foreach ($menus as $item) {
		if (@@$item['sub']) {
			$sub_menus_temp = sub_menus(@$item['sub']);
			$result[] = sprintf($sub_menu, @$item['label'], $sub_menus_temp);
		} else {
			$result[] = sprintf($menu, site_url(@$item['url']), @$item['icon'], @$item['label']);
		}
	}
	return implode('', $result);
}

function select($label, $list, $name, $selects)
{
	$select = '<select name="%s" class="form-control">%s</select>';
	$option = '<option value="%s" %s>%s</option>';

	foreach ($list as $item) {

		$selected = @$item[$name[0]] == $selects ? 'selected' : '';
		$data[] = sprintf($option, @$item[$name[0]], $selected, $item[$name[1]]);
	}
	if (!is_array(@$data)) {
		$data = [];
	}
	return sprintf($select, $label, implode("", $data));
}

function buffers($buffer)
{
	get_instance()->session->set_userdata(['buffer' => $buffer]);
}

function list_artikel($list)
{
	$article = '<article  class="post post-medium post type-post status-publish format-standard has-post-thumbnail hentry category-berita">
	<!-- Post meta before content -->
	<div class="row">
		<div class="col-lg-5">
			<div class="post-image single">
				<div class="post-slideshow porto-carousel owl-carousel owl-loaded">

					<div class="owl-stage-outer owl-height" style="height: 10px; margin-left: 0px; margin-right: 0px;">
						<div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 326px;">
							<div class="owl-item active" style="width: 326px;"><a href="%s">
									<div class="img-thumbnail">
										<img class="owl-lazy img-responsive" width="404" height="347" src="%s"
											 data-src="%s" alt="">
										<span class="zoom" data-src="%s" data-title=""><i class="fa fa-search"></i></span>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="col-lg-7">

			<div class="post-content">

				<h2 class="entry-title"><a href="%s">%s</a>
				</h2>

				<span class="vcard" style="display: none;"><span class="fn"></span></span><span
						class="updated" style="display:none">%s</span>
				<p class="post-except">%s[...]</p>
			</div>
		</div>
	</div>
	<!-- Post meta after content -->
	<div class="post-meta ">
		<span class="meta-date"><i class="fa fa-calendar"></i>%s</span>
		<span class="meta-author"><i class="fa fa-user"></i> By %s</span>
		<span class="meta-cats"><i class="fa fa-folder-open"></i> Berita</span>
	</div>
	<a class="btn btn-xs btn-primary pt-right" href="%s">Read more...</a>
</article>';
	foreach ($list as $item) {
		$result[] = sprintf($article, article_link($item['id']),show_image($item['img']),show_image($item['img']), show_image($item['img']), article_link($item['id']), $item['name'],$item['created_at'], substr($item['description'], 0, 50),$item['created_at'],$item['first_name'].' '.$item['last_name'], article_link($item['id']));
	}
	return @$result  ? implode('', $result) : '';
}

function article_link($id)
{
	return site_url('artikel/berita/view/' . $id);
}
function pengumuman_link($id)
{
	return site_url('pengumuman/view/' . $id);
}
function custom_date($f,$date)
{
	return date($f,strtotime($date));
}
function jabatan_tab($jabatan)
{
	$ul = '<ul class="member-filter nav nav-pills sort-source">%s</ul>';
	$list = '<li class="%s" data-filter="%s"><a href="#">%s</a></li>';
	foreach($jabatan as $key => $item)
	{
		if ($key == 0){
			$result[] = sprintf($list,'active','*','Show All');
		}
		$result[] = sprintf($list,'',str_replace(' ','-',$item['name']),$item['name']);
	}
	return sprintf($ul,implode('',$result));
}
function show_image_jabatan($image_jabatan)
{
	$img = '
<article
		class="member member-col-3 %s post-48 type-member status-publish has-post-thumbnail hentry member_cat-%s">
	<span class="entry-title" style="display: none;">%s</span>
	<span class="vcard" style="display: none;">
	</span>
	<div class="member-item ">
                <span class="thumb-info thumb-info-hide-wrapper-bg">

                    <span class="thumb-info-wrapper ">
                                                <span class="thumb-member-container ">
                            <img class="img-responsive" width="367" height="367"
								 src="%s" alt=""/>

                                                     </span>
                                                        <span class="thumb-info-title">
                                <span class="thumb-info-inner">%s</span>
                                                                    <span class="thumb-info-type">%s</span>
                                                            </span>
                    </span>
					<!--Thumb info wrapper end-->
					<!--Thumb info container -->
                </span>
	</div>
</article>';
	foreach ($image_jabatan as $item){
		$result[] = sprintf($img,str_replace(' ','-',$item['jabatan_name']),str_replace(' ','-',$item['jabatan_name']),$item['description'],show_image($item['img']),$item['description'],$item['jabatan_name']);
	}
	return implode('',$result);
}
function pagination($count,$uri,$uri_segment,$per_page){
	$ci = get_instance();
	//konfigurasi pagination
	$config['base_url'] = site_url($uri); //site url
	$config['total_rows'] = $count; //total row
	$config['per_page'] = $per_page;  //show record per halaman
	$config["uri_segment"] = $uri_segment;  // uri parameter
	$choice = $config["total_rows"] / $config["per_page"];
//	$config["num_links"] = $choice;

	// Membuat Style pagination untuk BootStrap v4
	$config['first_link']       = 'First';
	$config['last_link']        = 'Last';
	$config['next_link']        = 'Next';
	$config['prev_link']        = 'Prev';
	$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	$config['full_tag_close']   = '</ul></nav></div>';
	$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	$config['num_tag_close']    = '</span></li>';
	$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	$config['prev_tagl_close']  = '</span>Next</li>';
	$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	$config['first_tagl_close'] = '</span></li>';
	$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	$config['last_tagl_close']  = '</span></li>';

	$ci->pagination->initialize($config);
	$data['page'] = ($config["uri_segment"]) ? $ci->uri->segment($config["uri_segment"]) : 0;

	//panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model.

	$data['pagination'] = $ci->pagination->create_links();
	return [
		'pagination' => $ci->pagination->create_links(),
		'page' => $data['page'],
	];

}
function view($name)
{
	get_instance()->load->view($name);
}
