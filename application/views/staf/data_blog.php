<!DOCTYPE html>
<html>
	<body class="padTop53 ">
		<?php defined('BASEPATH') OR exit('No direct access script allowed') ?>
		<?php $this->load->view('staf/include/head'); ?>
			<div id="wrap">
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
					<div class="panel panel-default">
						<div class="panel-heading"><h3>Data Artikel Blog</h3></div>
						<div class="panel-body">
							<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
							    <thead>
									<tr>
										<th>Judul Artikel</th>
										<th>Tanggal</th>
										<th>Detail</th>
										<th>Edit/Publish</th>
										<th>Hapus</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($blog->num_rows() == 0) { ?>
										<tr>
											<td colspan="3">Belum ada artikel blog yang pending.</td>
										</tr>
									<?php } else { ?>
										<?php foreach ($blog->result_array() as $value) { ?>
											<tr>
												<td style="color:#000;"><?php echo $value['judul'] ?></td>
												<td style="color:#000;"><?php echo $value['tanggal'] ?></td>
												<td>
												<a href="<?php echo site_url("home/artikel/".$value['id']) ?>" class="btn btn-success">
													<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 
												</a>
												</td>
												<td>
												<a href="<?php echo site_url("staf/publish_blog/".$value['id']) ?>" class="btn btn-primary">
													<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
												</a>
												</td>
												<td>
												<a class="btn btn-danger" value="" data-target="" data-toggle="modal">
													<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
												</a>
												</td>
											</tr>
										<?php } ?>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				<a href="<?php echo site_url("kontributor") ?>" name="kembali" class="btn btn-danger tombol-kembali">Kembali</a>
				</div>
			</div>
	</body>
</html>
