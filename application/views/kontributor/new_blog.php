<!DOCTYPE html>
<html>
    <head>
        <title>Kontributor | Artikel Baru</title>
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
        <h3>Artikel Baru</h3>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <?php echo form_open_multipart('kontributor/post');?>
            <div class="form-group">
                <h4 for="text1" class="control-label">Judul Artikel</h4>
                <input type="text" id="judul" placeholder="Judul" class="form-control" name="judul" />
            </div>
            <h4>Isi Artikel</h4>
            <?php echo $this->ckeditor->editor('description',@$default_value);?><?php echo form_error('description','<p class="error">'); ?>
            <br><input type="submit" name="submit" value="Save" id="save" class="save btn btn-primary" /> <a class="btn btn-default" href="<?php echo base_url('kontributor/data_blog') ?>">Back To Blog Data</a> <a class="btn btn-info" href="<?php echo base_url('kontributor') ?>">Back To Contributor Page</a>
            <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <h4>Tags Artikel</h4>
            <div class="form-group">
                <select data-placeholder="Tags Artikel" id="tag-artikel" name="tags[]" multiple class="form-control chzn-select" tabindex="8">
                    <option></option>
                    <?php foreach ($tags as $tag) { ?>
                        <option value="<?php echo $tag['id'] ?>"><?php echo $tag['tags'] ?></option>
                    <?php } ?>
                </select>
                <button type="button" class="btn btn-default btn-xs" style="margin-top:5px;" id="tambah-tag" data-target="#tagModal" data-toggle="modal">Tambah Tag</button>
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
        </div>
    </div>
    <?php echo form_close();?>
    <div class="modal fade" id="tagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Tambah Tags Artikel</h4>
              </div>
              <div class="modal-body violet">
                <?php echo form_open('admin/tambah_tag'); ?>
                    <fieldset class="form_cart">
                        <?php echo form_input(array('name' => 'tags', 'type' => 'text', 'class' => 'form-control')); ?>
                        <br><?php echo form_submit('tambah', 'Tambah', "class='btn btn-primary btn-md tambah'"); ?>
                    </fieldset>
                <?php echo form_close(); ?>
              </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
        var link = "<?php echo base_url() ?>";

        $(".violet form").submit(function() {
            /* Get the product ID and the quantity */
            var tag = $(this).find('input[name=tags]').val();

            $.post(link + 'admin/tambah_tag', {tag: tag, ajax: 1}, function(data) {
                /*optional stuff to do after success*/
                if (data == 'false') {
                    alert("Product does not exist");
                } else{
                    $.get(link + 'admin/new_post', function(cart) {
                        /*optional stuff to do after success*/
                        var newOption = $('<option value=' + data + '>' + tag + '</option>');
                        $('#tag-artikel').append(newOption);
                        $('#tag-artikel').trigger('chosen:updated');
                        $('#tagModal').modal('hide');
                    });
                };
            });
            return false;
        });
    });
    </script> 
        <?php if ($this->session->flashdata('success_insert_with_upload')) { ?>
            <div class="modal fade" id="sesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Dialog</h4>
                        </div>
                        <div class="modal-body">
                        <?php echo $this->session->flashdata('success_insert_with_upload'); ?>
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
        <?php if ($this->session->flashdata('insert_success_no_upload')) { ?>
            <div class="modal fade" id="sucModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Dialog</h4>
                        </div>
                        <div class="modal-body">
                        <?php echo $this->session->flashdata('insert_success_no_upload'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#sucModal').modal({
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
        <?php echo $this->session->flashdata('error_resize'); ?>
        <?php echo $this->session->flashdata('error_resize_thumbnail'); ?>
        <?php echo $this->session->flashdata('error_crop'); ?>
        <?php echo $this->session->flashdata('error_crop_thumbnail'); ?>
        <script src="<?php echo base_url() ?>assets/plugins/jasny/js/bootstrap-fileupload.js"></script>
        <script src="<?php echo base_url() ?>assets/plugins/chosen/chosen.jquery.min.js"></script>
        <script type="text/javascript">
            $(".chzn-select").chosen()
        </script>
    </body>
</html>