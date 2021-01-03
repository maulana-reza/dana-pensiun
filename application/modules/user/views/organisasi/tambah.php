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
							<div class="form-group">
								<label for="">Jabatan</label>
								<a href="<?= site_url('user/jabatan/tambah')?>" class="btn btn-primary m-2 btn-sm"><i class="fa fa-plus"></i></a>
								<?= select('jabatan',$this->db->get('jabatan')->result_array(),['id','name'],@$jabatan_id)?>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Keterangan</label>
								<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Keterangan" name="ket" value="<?= @$description;?>">
							</div>
							<div class="form-group">
								<label for="exampleInputFile">Gambar</label>
								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="exampleInputFile" name="file">
										<label class="custom-file-label" for="exampleInputFile">Choose file</label>
									</div>
								</div>
							</div>
							<?php if (@$img):?>
							<div class="form-group">
								<img src="<?= show_image($img);?>" class="img-thumbnail">

							</div>
							<?php endif;?>

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
