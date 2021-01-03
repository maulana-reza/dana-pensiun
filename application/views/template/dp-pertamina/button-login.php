<?php if (get_instance()->ion_auth->logged_in()) {
	$data = get_instance()->ion_auth->user()->row();
	?>
	<div class="header-contact">
		<ul class="nav nav-pills nav-top">
			<li class="">
				<a class="btn btn-xs btn-outline-primary btn-register" href="<?= site_url("user/dashboard");?>">
					<i class="fa fa-user"></i>
					<?= $data->first_name." ".$data->last_name;?>
				</a>
			</li>

			<li class="">
				<a class="btn btn-xs btn-primary btn-login" href="<?= site_url('auth/logout'); ?>"><i
							class="fa fa-sign-in"></i>Logout</a>
			</li>
		</ul>
	</div>

	<?php
} else {
	?>
	<div class="header-contact">
		<ul class="nav nav-pills nav-top">
			<li class="">
				<a class="btn btn-xs btn-outline-primary btn-register" href="<?= site_url('auth/register'); ?>" =
				=""><i class="fa fa-user"></i>Register <span
						class="d-none d-sm-inline">Peserta</span></a>
			</li>
			<li class="">
				<a class="btn btn-xs btn-primary btn-login" href="<?= site_url('auth/login'); ?>"><i
							class="fa fa-sign-in"></i>Login Peserta</a>
			</li>

		</ul>
	</div>

	<?php
}
