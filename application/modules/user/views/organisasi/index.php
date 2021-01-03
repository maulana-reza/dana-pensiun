<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<!-- /.card -->

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Daftar Berita</h3>
						<a href="<?= site_url('user/organisasi/struktur/tambah');?>" class="float-right btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<?= alert_dashboard('','info');?>

						<table id="example1" class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>Gambar</th>
								<th>Keterangan</th>
								<th>Jabatan</th>
								<th>Aksi</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($struktur as $item):?>
								<tr>
									<td><?= $item['description'] ;?></td>
									<td><img class="w-25" src="<?= show_image($item['img']);?>" alt=""></td>
									<td><?= $item['jabatan_name'];?></td>
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
