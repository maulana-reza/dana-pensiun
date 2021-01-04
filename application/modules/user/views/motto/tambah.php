<section class="content">
	<div class="container-fluid">
		<div class="row">
			<!-- left column -->
			<div class="col-md-6">
				<!-- general form elements -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Form <?= title(@$title);?></h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					<?= form_open_multipart();?>
					<div class="card-body">
						<?= alert_dashboard(validation_errors(),'warning');?>
						<div class="form-group">
							<label for="">Motto Type</label>
							<a href="<?= site_url('user/motto/type')?>" class="btn btn-primary m-2 btn-sm"><i class="fa fa-plus"></i></a>
							<?= select('motto_type_id',$this->db->get('motto_type')->result_array(),['id','name'],@$mottot_type_id)?>
						</div>
						<div class="form-group">
							<label for="">Konteks</label>
							<?= konteks_motto('konteks_type',@$konteks_type)?>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Keterangan</label>
							<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Keterangan" name="description" value="<?= @$description;?>">
						</div>

					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						<button type="submit" class="btn btn-primary float-right" name="add" value="add">Simpan</button>
					</div>
					<?= form_close();?>
				</div>
				<!-- /.card -->
			</div>
			<!--/.col (left) -->
			<!-- right column -->
			<!--/.col (right) -->
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
