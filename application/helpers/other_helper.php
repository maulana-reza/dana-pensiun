<?php
function request($param)
{
	$ci = get_instance();
//	validation

	foreach ($param as $key => $item) {
		$ci->form_validation->set_rules($item, $item, 'required');
		$result[$item] = @$ci->input->post($item);
	}
	if ($ci->form_validation->run() == false) {
		return false;
	}
	return @$result ? $result : [];
}

function upload_file($name)
{
	$ci = get_instance();
	$config['upload_path'] = './upload/';
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size'] = 2000;
	$config['remove_spaces'] = TRUE;
	$config['encrypt_name'] = TRUE;

	$ci->load->library('upload', $config);
	if (!$ci->upload->do_upload($name)) {
		add_alert([['message' => $ci->upload->display_errors()]]);
		return false;
	} else {
		return $ci->upload->data();
	}
}

function alert_dashboard($message, $type = "info")
{
	$alert = '<div class="alert alert-%s alert-dismissible fade show" role="alert">%s<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
	$ci = get_instance();
	try {

		$exist = $ci->session->message;
		if (!$message && is_array($exist)) {

			foreach ($exist as $item) {
				$all[] = @$item['message'];
			}
			$message = implode('<br>', $all);
		}
	} catch (Exception $e) {

	}
	if (!$message) {
		return '';
	}
	return sprintf($alert, $type, $message);
}

function add_alert($param)
{
	$ci = get_instance();
	if (is_array($ci->session->message)) {
		$ci->session->set_flashdata('message', array_merge($ci->session->message, $param));
	} else {
		$ci->session->set_flashdata('message', $param);

	}
}

function show_image($name)
{
	return base_url('upload/') . $name;
}

function show_aksi($id)
{
	$edit = '<a href="%s" type="button" class="btn btn-warning" ><i class="fa fa-edit"></i></a>';
	$rem = '<a href="%s" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></a>';
	return sprintf($edit, site_url(uri_string() . '/edit/' . $id)) . sprintf($rem, site_url(uri_string() . '/remove/' . $id));
}

function berita_terbaru()
{
	$ci = get_instance();
	$ci->db->where('type_id', type_id());
	$ci->db->limit(4);
	$ci->db->order_by('created_at', 'asc');
	$berita = $ci->db->get('article')->result_array();
	$list = '				<div class="post-item-small">
					<div class="post-image img-thumbnail">
						<a href="%s">
							<img width="85" height="85"
								 src="%s"
								 alt=""/>
						</a>
					</div>
					<a href="%s">%s</a>
					<span class="post-date">%s</span></div>
';
	foreach ($berita as $item) {
		$result[] = sprintf($list, article_link($item['id']), show_image($item['img']), article_link($item['id']), $item['name'], $item['created_at']);
	}
	return @$result ? implode('', $result) : '';
}

function berita_terbaru_home()
{

	$ci = get_instance();
	$ci->db->where('article.type_id', type_id());
	$ci->db->limit(4);
	$ci->db->select('article.*,users.first_name,users.last_name');
	$ci->db->join('users', 'users.id = article.user_id');
	$ci->db->order_by('article.created_at', 'asc');
	$berita = $ci->db->get('article')->result_array();
	$list = '
<article
		class="post post-grid  col-md-6 col-lg-4 col-xl-3 post-22333 post type-post status-publish format-standard has-post-thumbnail hentry category-berita">
	<div class="grid-box">
		<div class="post-image single">
			<div class="post-slideshow porto-carousel owl-carousel">
				<a href="%s">
					<div class="img-thumbnail">
						<img class="owl-lazy img-responsive"
							 width="404" height="347"
							 src="%s"
							 data-src="%s"
							 alt=""/>
						<span class="zoom"
							  data-src="%s"
							  data-title=""><i
									class="fa fa-search"></i></span>
					</div>
				</a>
			</div>

		</div>

		<!-- Post meta before content -->
		<div class="post-content">

			<h4 class="entry-title"><a
						href="%s">%s</a></h4>
			<p class="post-excerpt">%s[...]</p>
		</div>
		<!-- Post meta after content -->
		<div class="post-meta"><span class="meta-date"><i
						class="fa fa-calendar"></i>%s</span>
		</div>
		<div class="post-meta"><span class="meta-author"><i
						class="fa fa-user"></i>By %s</span><span
					class="meta-cats"><i
						class="fa fa-folder-open"></i>Berita</span>
		</div>
		<div class="clearfix">
			<a class="btn btn-xs btn-primary pt-right"
			   href="%s">Read
				more...</a>
		</div>
	</div>
</article>
';

	foreach ($berita as $item) {
		$result[] = sprintf($list,
			article_link($item['id']),
			show_image($item['img']),
			show_image($item['img']),
			show_image($item['img']),
			article_link($item['id']),
			$item['name'],
			substr($item['description'], 0, 20),
			$item['created_at'],
			$item['first_name'] . ' ' . $item['last_name'],
			article_link($item['id']));
	}
	return @$result ? implode('', $result) : '';


}

function pengumuman_terbaru()
{
	$list = '<div class="post-slide">
	<div class="post-item">
		<div class="post-date">
			<span class="day">%s</span>
			<span class="month">%s</span>
		</div>
		<h4>
			<a href="%s">%s</a></h4>
		<p class="post-excerpt">%s[...] <a class="read-more" href="%s">read
				more <i class="fa fa-angle-right"></i></a>
		</p>
	</div>
</div>';

	$ci = get_instance();
	$ci->db->where('article.type_id', type_id());
	$ci->db->limit(4);
	$ci->db->select('article.*,users.first_name,users.last_name');
	$ci->db->join('users', 'users.id = article.user_id');
	$ci->db->order_by('article.created_at', 'asc');
	$pengumuman = $ci->db->get('article')->result_array();
	foreach ($pengumuman as $item) {
		$result[] = sprintf($list,
			custom_date('d', $item['created_at']),
			custom_date('M', $item['created_at']),
			pengumuman_link($item['id']),
			$item['name'],
			substr($item['description'], 0, 20),
			pengumuman_link($item['id'])
		);
	}
	return @$result ? implode('', $result) : '';

}

function type_id()
{
	$ci = get_instance();
	$data = $ci->db->get_where('article_type', ['name' => 'berita'])->row_array();
	return $data['id'];
}

function show_motto()
{
	$ci = get_instance();
	$card = '											<div class="card card-default">
												<div class="card-header"><h4 class="card-title m-0"><a
																class="accordion-toggle" data-toggle="collapse"
																href="#collapse%s"><i class="fa fa-rocket"></i>%s</a>
													</h4></div>
												<div id="collapse%s" class="collapse">
													<div class="card-body">
														<div class="porto-toggles wpb_content_element ">
															%s
														</div>
													</div>
												</div>
											</div>
';
	$collapse = '
	<section class="toggle  "><label>%s</label>
	<div class="toggle-content">
		<ul style="text-align: justify;">
		%s
		</ul>
	</div>
</section>
';
	$data = $ci->db->get('motto_type')->result_array();
	foreach ($data as $item1) {
		$external = $ci->db->get_where("motto", ['motto_type_id' => $item1['id'], 'konteks_type' => 'Konteks Eksternal'])->result_array();
		$internal = $ci->db->get_where("motto", ['motto_type_id' => $item1['id'], 'konteks_type' => 'Konteks Internal'])->result_array();
		$konteks = sprintf($collapse, 'Konteks Eksternal', '<li>'.implode('</li><li>', array_column($external, 'description')).'</li>')
			. sprintf($collapse, 'Konteks Internal','<li>'. implode('</li><li>', array_column($internal, 'description')).'</li>');
		$cards[] = sprintf($card, $item1['id'], $item1['name'], $item1['id'], $konteks);
	}
	return @$cards ? implode('', $cards) : '';

}

function konteks_motto($name, $select)
{
	$array = [
		[
			'name' => 'Konteks Internal',
			'value' => 'Konteks Internal',
		],
		[
			'name' => 'Konteks Eksternal',
			'value' => 'Konteks Eksternal'
		]
	];
	return select($name, $array, ['value', 'name'], $select);
}
