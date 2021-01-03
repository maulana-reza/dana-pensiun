<section class="content">
	<div class="container-fluid">
		<div class="row">
			<!-- /.col -->
			<div class="col-md-9">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">Compose New Message</h3>
					</div>
					<!-- /.card-header -->
					<?= form_open_multipart();?>

					<div class="card-body">
						<?= alert_dashboard(validation_errors(),'warning');?>
						<div class="form-group">
							<label for="judul">Judul</label>
							<input class="form-control" placeholder="Judul" name="judul" value="<?= @$name;?>">
						</div>
						<div class="form-group">
							<label >Deskripsi</label>

							<textarea id="compose-textarea" class="form-control" style="height: 300px" name="deskripsi" placeholder="Deskripsi">
<?= @$description;?>
                    </textarea>
						</div>
						<div class="form-group">

							<div class="btn btn-default btn-file">
								<i class="fas fa-paperclip"></i> Gambar
								<input type="file" name="file">
							</div>
							<p class="help-block">Max. 2MB</p>
							<?php if(@$img):?>
							<img src="<?= show_image($img);?>" class="img-thumbnail w-25">
							<?php endif;?>
						</div>
					</div>
					<!-- /.card-body -->
					<div class="card-footer">
						<div class="float-right">
							<button type="submit" name="add" value="add" class="btn btn-primary"><i class="fa fa-plus"></i> Simpan</button>
						</div>
						<button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
					</div>
					<?= form_close();?>

					<!-- /.card-footer -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
<?php ob_start('buffers');?>
<script>
$(function () {
//Add text editor
$('#compose-textarea').summernote()
})
</script>
<?php ob_end_clean();?>
