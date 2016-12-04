 <!-- BEGIN BODY -->
 <body class="padTop53 " >
<?php $this->load->view('kontributor/include/head'); ?>
<?php $this->load->view('kontributor/include/menu'); ?>
<!-- MAIN WRAPPER -->
    <div id="wrap" >
          <!--PAGE CONTENT -->
        <div id="content">  
            <div class="inner" style="min-height: 700px;">
	            <div class="row">
	                <div class="col-lg-12">
	                  <h1>Profil Kontributor</h1>
	                </div>
	            </div>
              <hr />
				<?php echo form_open_multipart("kontributor/edit_profil/".$profil[0]['id_staf'], array('class' => 'form-horizontal')); ?>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><?php if ($profil[0]['nama'] == NULL) { ?>
								(Belum ada nama)
							<?php } else { ?>
								<?php echo $profil[0]['nama'] ?>
							<?php } ?></h3>
						</div>
						<div class="panel-body">
							<?php if ($profil[0]['gambar'] == NULL) { ?>
								<p>Belum ada foto</p>
							<?php } else { ?>
								<img src="<?php echo base_url() ?>images/profil/halaman/<?php echo $profil[0]['gambar'] ?>">
							<?php } ?>
						</div>
					</div>
					<h4>Upload Foto</h4>
		            <div class="form-group">
		                <div class="fileupload fileupload-new" data-provides="fileupload">
		                    <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
		                    <div>
		                        <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="gambar" disabled="disabled" class="inputDisabled" /></span>
		                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
		                    </div>
		                </div>
		            </div>
		            <p><small><em>* foto harus portrait dengan ukuran lebar minimal: 225px, dan tinggi: 320px</em></small></p>
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<div class="form-group">
					    <label for="text1" class="control-label col-lg-4">Nama Lengkap</label>
					    <div class="col-lg-8">
					        <input type="text" placeholder="Nama Lengkap" name="nama" value="<?php echo $profil[0]['nama'] ?>" disabled="disabled" class="form-control inputDisabled" />
					    </div>
					</div>
					<div class="form-group">
					    <label for="text1" class="control-label col-lg-4">Username</label>
					    <div class="col-lg-8">
					        <input type="text" placeholder="Username" name="username" value="<?php echo $profil[0]['username'] ?>" disabled="disabled" class="form-control inputDisabled" />
					        <?php form_error("username", '<code>', '</code>') ?>
					    </div>
					</div>
					<div class="form-group">
					    <label for="text1" class="control-label col-lg-4">Password</label>
					    <div class="col-lg-8">
					        <input type="text" placeholder="Password" name="password" value="<?php echo $profil[0]['password'] ?>" disabled="disabled" class="form-control inputDisabled" />
					        <?php echo form_error("password", "<code>", "</code>") ?>
					    </div>
					</div>
					<div class="form-group">
					    <label for="text1" class="control-label col-lg-4">Motto Hidup</label>
					    <div class="col-lg-8">
					        <input type="text" placeholder="Motto Hidup" name="motto" value="<?php echo $profil[0]['motto'] ?>" disabled="disabled" class="form-control inputDisabled" />
					        <?php echo form_error("motto", "<code>", "</code>") ?>
					    </div>
					</div>
					<div class="form-group">
					    <label for="text1" class="control-label col-lg-4">Tanggal Lahir</label>
					    <div class="col-lg-8">
	                        <div class="input-group input-append  date" id="dpYears" data-date="12-02-2012"
	                             data-date-format="dd-mm-yyyy" data-date-viewmode="years">
	                            <input class="form-control inputDisabled" type="text" value="<?php echo $profil[0]['tanggal_lahir'] ?>" name="tanggal" disabled="disabled" />
	                            <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
	                        </div>
	                    </div>
					</div>
					<div class="form-group">
					    <label for="text1" class="control-label col-lg-4">Deskripsi Diri</label>
					    <div class="col-lg-8">
					        <textarea placeholder="Deskripsi Diri" name="deskripsi" disabled="disabled" class="form-control inputDisabled"><?php echo $profil[0]['deskripsi']; ?></textarea>
					        <?php echo form_error("deskripsi", "<code>", "</code>") ?>
					    </div>
					</div>
					<div class="form-group">
					    <label for="text1" class="control-label col-lg-4"></label>
					    <div class="col-lg-8">
					        <a id="tombol-edit" name="edit-mitra" class="btn btn-info">Edit Data</a>
						<?php echo form_submit("simpan", "Simpan Data", array("class" => "btn btn-primary", "id" => "tombol-submit")); ?>
	        			<a href="<?php echo site_url("kontributor") ?>" name="kembali" class="btn btn-danger">Batal</a>
	        			<button class="btn btn-primary" id="test">Test</button>
					    </div>
					</div>
				</div>
    		</div>
    	</div>
    </div>
    <?php if ($this->session->flashdata('update_no_upload_kontributor')) { ?>
        <div class="modal fade" id="upnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Dialog</h4>
                    </div>
                    <div class="modal-body">
                    <?php echo $this->session->flashdata('update_no_upload_kontributor'); ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#upnModal').modal({
                    'show':true,
                    'keyboard': false
                });
            });
        </script>
    <?php } ?>
    <?php if ($this->session->flashdata('update_with_upload')) { ?>
        <div class="modal fade" id="upwModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Dialog</h4>
                    </div>
                    <div class="modal-body">
                    <?php echo $this->session->flashdata('update_with_upload'); ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#upwModal').modal({
                    'show':true,
                    'keyboard': false
                });
            });
        </script>
    <?php } ?>
    <?php echo $this->session->flashdata('error_resize_gambar'); ?>
    <?php echo $this->session->flashdata('error_resize_thumbnail'); ?>
    <?php echo $this->session->flashdata('error_resize_avatar'); ?>
    <?php echo $this->session->flashdata('error_crop_gambar'); ?>
    <?php echo $this->session->flashdata('error_crop_thumbnail'); ?>
    <?php echo $this->session->flashdata('error_crop_avatar'); ?>
    <!--END MAIN WRAPPER -->
<!-- FOOTER -->
      <div id="footer">
        <p>&copy;  Copyrights - &nbsp;<?php echo date('Y') ?> &nbsp;Developed by <a href="http://chronica.id">Ade Indriawan</a></p>
      </div>
      <!--END FOOTER -->
      <script type="text/javascript">
			$("#tombol-edit").click(function(event){
			   event.preventDefault();
			   $('.inputDisabled').prop("disabled", false); // Element(s) are now enabled.
			});
		</script>
  </body>
  <!-- END BODY -->