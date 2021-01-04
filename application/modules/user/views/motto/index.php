<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<!-- /.card -->

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Motto</h3>
						<a href="<?= site_url('user/motto/tambah');?>" class="float-right btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<?= alert_dashboard('','info');?>
						<?= form_open();?>
						<div class="form-group">
							<label for="">Motto Utama</label>
							<div class="input-group mb-3">

								<?= form_input([
									'class' => 'form-control',
									'value' => @$main_motto,
									'name' => 'main_motto',
								]);?>
								<div class="input-group-append">
									<button class="btn btn-outline-secondary" type="submit" name="add" value="add">Ubah</button>
								</div>
							</div>
						</div>
						<?= form_close();?>
						<table id="example1" class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>Keterangan</th>
								<th>Motto Tipe</th>
								<th>Konteks Tipe</th>
								<th>Aksi</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($motto as $item):?>
								<tr>
									<td><?= $item['description'] ;?></td>
									<td><?= $item['motto_type_name'];?></td>
									<td><?= $item['konteks_type'];?></td>
									<td><?=show_aksi($item['id']);?></td>
								</tr>
							<?php endforeach;?>
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</section>

<?php ob_start('buffers');?>
<script>
	$(function () {
		$("#example1").DataTable({
			"responsive": true, "lengthChange": false, "autoWidth": false,
			"lengthChange": true,
			"searching": true,
		}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
	});
</script>
<?php ob_end_clean();?>
