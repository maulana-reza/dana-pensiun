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

		if ($key == count($array)-1){
			$result[] = sprintf($last_list,RemoveSpecialChar($item));
		}else{
			$result[] = sprintf($list,site_url($item),RemoveSpecialChar($item),$key+1);
		}
	}
	return implode('',$result);
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
function title($title = null){
	$data = uri_string();
	$array = explode('/', $data);
	if ($title == null){
		$title = $array[count($array)-1];
	}
	return RemoveSpecialChar($title);
}

