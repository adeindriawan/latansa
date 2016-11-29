<!DOCTYPE html>
<html>
    <head>
        <title>Staf | Edit Halaman</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="Demo project with jQuery">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url() ?>layout/styles/bootstrap.css" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/font-awesome.css" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-fileupload.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/chosen/chosen.min.css" />
        <style type="text/css"></style>
    </head>
    <body> 
    <script src="<?php echo base_url() ?>js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3>Edit Halaman</h3>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <?php echo form_open_multipart('staf/edit_hal/'.$halaman[0]['id_halaman']);?>
            <div class="form-group">
                <h4 for="text1" class="control-label">Nama Halaman</h4>
                <p><?php echo $halaman[0]['nama_halaman'] ?></p>
            </div>
            <h4>Isi Artikel</h4>
            <?php echo $this->ckeditor->editor('description', $halaman[0]['isi_halaman']);?><?php echo form_error('description','<p class="error">'); ?>
            <br><input type="submit" name="submit" value="Save & Publish" id="save" class="save btn btn-primary" />
            <a class="btn btn-default" href="<?php echo base_url('staf/data_halaman') ?>">Back to Data Halaman</a>
            <a class="btn btn-info" href="<?php echo base_url('staf') ?>">Back to Staff Page</a>
            <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <h4>Gambar Artikel</h4>
                <div class="panel">
                    <div class="panel-body">
                        <?php if ($halaman[0]['gambar_halaman'] == NULL) { ?>
                            <p>(Belum ada gambar)</p>
                        <?php } else { ?>
                            <img width="250px" height="103,75px" src="<?php echo base_url() ?>images/halaman/halaman/<?php echo $halaman[0]['gambar_halaman'] ?>">
                        <?php } ?>
                    </div>
                </div>
            <h4>Upload Gambar</h4>
            <div class="form-group">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
                    <div>
                        <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="gambar" /></span>
                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                    </div>
                </div>
            </div>
            <p><small><em>* foto harus landscape dengan ukuran lebar minimal: 1000px, dan tinggi: 415px</em></small></p>
        </div>
    </div>
    <?php echo form_close();?>
        <?php if ($this->session->flashdata('success_no_upload')) { ?>
            <div class="modal fade" id="sesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Dialog</h4>
                        </div>
                        <div class="modal-body">
                        <?php echo $this->session->flashdata('success_no_upload'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#sesModal').modal({
                        'show':true,
                        'keyboard': false
                    });
                });
            </script>
        <?php } ?>
        <?php if ($this->session->flashdata('success_with_upload')) { ?>
            <div class="modal fade" id="errModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Dialog</h4>
                        </div>
                        <div class="modal-body">
                        <?php echo $this->session->flashdata('success_with_upload'); ?>
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
        <?php if ($this->session->flashdata('error_form_validation')) { ?>
            <div class="modal fade" id="errModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Dialog</h4>
                        </div>
                        <div class="modal-body">
                        <?php echo $this->session->flashdata('error_form_validation'); ?>
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
        <?php echo $this->session->flashdata('error_resize_gambar'); ?>
        <?php echo $this->session->flashdata('error_resize_thumbnail'); ?>
        <?php echo $this->session->flashdata('error_resize_list'); ?>
        <?php echo $this->session->flashdata('error_crop_gambar'); ?>
        <?php echo $this->session->flashdata('error_crop_thumbnail'); ?>
        <?php echo $this->session->flashdata('error_crop_list'); ?>
        <script src="<?php echo base_url() ?>assets/plugins/jasny/js/bootstrap-fileupload.js"></script>
        <script src="<?php echo base_url() ?>assets/plugins/chosen/chosen.jquery.min.js"></script>
        <script type="text/javascript">
            $(".chzn-select").chosen()
        </script>
    </body>
</html>