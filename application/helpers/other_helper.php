<?php
function request($param)
{
	$ci = get_instance();
//	validation

	foreach($param as $key => $item){
		$ci->form_validation->set_rules($item,$item,'required');
		$result[$item] = @$ci->input->post($item);
	}
	if($ci->form_validation->run() == false){
		return false;
	}
	return @$result ? $result : [];
}
function upload_file($name){
	$ci = get_instance();
	$config['upload_path'] = './upload/';
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size'] = 2000;
	$config['remove_spaces'] = TRUE;
	$config['encrypt_name'] = TRUE;

	$ci->load->library('upload', $config);
	if (!$ci->upload->do_upload($name))
	{
		add_alert( [['message'=>$ci->upload->display_errors()]]);
		return false;
	}else{
		return $ci->upload->data();
	}
}
function alert_dashboard($message,$type = "info")
{
	$alert = '<div class="alert alert-%s alert-dismissible fade show" role="alert">%s<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
	$ci = get_instance();
	try {

		$exist = $ci->session->message;
		if (!$message && is_array($exist)){

			foreach ($exist as $item){
				$all[] = @$item['message'];
			}
			$message = implode('<br>',$all);
		}
	}catch (Exception $e){

	}
	if (!$message){
		return '';
	}
	return sprintf($alert,$type,$message);
}
function add_alert($param){
	$ci = get_instance();
	if (is_array($ci->session->message)){
		$ci->session->set_flashdata('message',array_merge($ci->session->message,$param));
	}else{
		$ci->session->set_flashdata('message',$param);

	}
}
function show_image($name)
{
	return base_url('upload/').$name;
}
function show_aksi($id)
{
	$edit = '<a href="%s" type="button" class="btn btn-warning" ><i class="fa fa-edit"></i></a>';
	$rem = '<a href="%s" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></a>';
	return sprintf($edit,site_url(uri_string().'/edit/'.$id)).sprintf($rem,site_url(uri_string().'/remove/'.$id));
}
