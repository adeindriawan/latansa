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
										<th>Judul Galeri</th>
										<th>Pengunggah</th>
										<th>Tanggal</th>
										<th>Detail</th>
										<th>Edit</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($galeri->num_rows() == 0) { ?>
										<tr>
											<td colspan="3">Belum ada galeri foto</td>
										</tr>
									<?php } else { ?>
										<?php foreach ($galeri->result_array() as $value) { ?>
											<tr>
												<td style="color:#000;"><?php echo $value['judul_galeri'] ?>
												</td>
												<td style="color:#000;"><?php echo $value['nama'] ?></td>
												<td style="color:#000;"><?php echo $value['tanggal_galeri'] ?>
												</td>
												<td>
												<a href="#" class="btn btn-success">
													<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 
												</a>
												</td>
												<td>
												<a href="#" class="btn btn-primary">
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
				<a class="btn btn-primary" data-toggle="modal" href='#jmlFoto'>Galeri Baru</a>
				<a href="<?php echo site_url("staf") ?>" name="kembali" class="btn btn-danger tombol-kembali">Kembali</a>
				</div>
			</div>
			<div class="modal fade" id="jmlFoto">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Dialog</h4>
						</div>
						<div class="modal-body">
							<form action="<?php echo site_url('staf/new_album') ?>" method="POST" role="form">
								<legend>Tentukan Jumlah Foto</legend>
								<div class="form-group">
									<label for="">Jumlah Foto</label>
									<select name="jumlah">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
									</select>
								</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
							<button type="submit" name="submit" class="btn btn-primary">Buat Galeri Baru</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			
		    <?php if ($this->session->flashdata('sukses_buat_galeri_baru')) { ?>
		        <div class="modal fade" id="errModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		            <div class="modal-dialog" role="document">
		                <div class="modal-content">
		                    <div class="modal-header">
		                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                        <h4 class="modal-title" id="exampleModalLabel">Dialog</h4>
		                    </div>
		                    <div class="modal-body">
		                    <?php echo $this->session->flashdata('sukses_buat_galeri_baru'); ?>
		                    </div>
		                </div>
		            </div>
		        </div>
		        <script type="text/javascript">
		            $(document).ready(function() {
		                $('#errModal').modal({
		                    'show':true,
		                    'keyboard': false
		                });
		            });
		        </script>
		    <?php } ?>
	</body>
</html>
