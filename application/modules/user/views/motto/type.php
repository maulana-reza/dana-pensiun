<section class="content">
	<div class="container-fluid">
		<div class="row">
			<!-- left column -->
			<div class="col-md-6">
				<!-- general form elements -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Form <?= title(@$title); ?></h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					<?= form_open(); ?>
					<div class="card-body">
						<?= alert_dashboard(validation_errors(),'warning');?>
						<div class="form-group">
							<label for="exampleInputEmail1">Nama Tipe Motto</label>
							<input type="text" class="form-control" id="exampleInputEmail1" name="name"
								   value="<?= @$name; ?>">
						</div>
					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						<button type="submit" class="btn btn-primary float-right" name="add" value="add">Simpan</button>
					</div>
					<?= form_close(); ?>
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

