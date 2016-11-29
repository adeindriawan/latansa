<!DOCTYPE html>
<html>
	<body class="padTop53 ">
		<?php defined('BASEPATH') OR exit('No direct access script allowed') ?>
		<?php $this->load->view('staf/include/head'); ?>
			<div id="wrap">
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
					<div class="panel panel-default">
						<div class="panel-heading"><h3>Data Halaman</h3></div>
						<div class="panel-body">
							<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
							    <thead>
									<tr>
										<th>Nama Halaman</th>
										<th>Keterangan</th>
										<th>Detail</th>
										<th>Edit</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($halaman->num_rows() == 0) { ?>
										<tr>
											<td colspan="3">Belum ada artikel</td>
										</tr>
									<?php } else { ?>
										<?php foreach ($halaman->result_array() as $value) { ?>
											<tr>
												<td style="color:#000;"><?php echo $value['nama_halaman'] ?></td>
												<td style="color:#000;"><?php echo $value['keterangan'] ?></td>
												<td>
												<a href="<?php echo site_url("home/".$value['alamat']) ?>" class="btn btn-success">
													<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 
												</a>
												</td>
												<td>
												<a href="<?php echo site_url("staf/edit_halaman/".$value['id_halaman']) ?>" class="btn btn-primary">
													<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
												</a>
												</td>
											</tr>
										<?php } ?>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				<a href="<?php echo site_url("staf") ?>" name="kembali" class="btn btn-danger tombol-kembali">Kembali</a>
				</div>
			</div>
	</body>
</html>
