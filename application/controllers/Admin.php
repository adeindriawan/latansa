<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("Asia/Jakarta");

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Home');

		if (! $this->session->userdata('username')) {
            $this->session->set_flashdata('sesi_habis', 'Sesi Anda sudah habis, silakan login kembali!');
            redirect('home','refresh');
        }
	}

	public function index()
	{
		$this->load->view('admin/index');
	}

	public function new_post()
	{
		$this->db->select('tags.*');
		$this->db->from('tags');
		$data['tags'] = $this->db->get()->result_array();
		// $path = base_url().'js/ckfinder';
	    $path = '../js/ckfinder';
	    $width = '860px';
	    $this->editor($path, $width);
	    $this->load->view('admin/new_post', $data);
	}

	public function editor($path,$width)
	{
		//Loading Library For Ckeditor
	    $this->load->library('ckeditor');
	    $this->load->library('ckFinder');
	    //configure base path of ckeditor folder 
	    $this->ckeditor->basePath = base_url().'js/ckeditor/';
	    $this->ckeditor->config['toolbar'] = 'Full';
	    $this->ckeditor->config['language'] = 'en';
	    $this->ckeditor->config['width'] = $width;
	    //configure ckfinder with ckeditor config 
	    $this->ckfinder->SetupCKEditor($this->ckeditor,$path);
	}

	public function tambah_tag()
	{
		$tag = $this->input->post('tag', TRUE);

        // Check if user has javascript enabled
        if($this->input->post('ajax') != '1'){
            //redirect('cart'); // If javascript is not enabled, reload the page with new data
            } else { 
                if ($this->input->post('tag', TRUE)) {
                    $data = array(
                        'tags' => $tag,
                    );

                    $this->db->insert('tags', $data);
                        
                    echo $this->db->insert_id('jenis');
                } else {
                    echo 'false';
                }   
            }
	}

	public function post()
	{
		$path = '../js/ckfinder';
    	$width = '860px';
		if ($this->input->post('description', TRUE)) {
	      	$this->form_validation->set_rules('description', 'Isi Artikel', 'trim|required|xss_clean');
	      	$this->form_validation->set_rules('judul', 'Judul Artikel', 'trim|required|xss_clean');
	      	$this->form_validation->set_rules('tags[]', 'Tags Artikel', 'required');
	        if ($this->form_validation->run() == FALSE) {
	          $this->session->set_flashdata('error_form_validation', 'Error Form Validation!');
	          $this->editor($path, $width);
	          redirect('admin/new_post','refresh');
	        	} else {
		        	$data = array(
			          "judul" => $this->input->post('judul', TRUE),
			          "isi" => $this->input->post('description', TRUE),
			          "kategori" => "Catatan Admin",
			          "tanggal" => date("Y-m-d H:i:s"),
			          "penulis" => $this->session->userdata('username'),
			        );

			        $this->db->insert('artikel', $data);

			        $idArtikel = $this->db->insert_id("artikel");

			        $tags_artikel['id_artikel'] = $idArtikel;
	                foreach ($_POST['tags'] as $selected) {
	                $tags_artikel['id_tags'] = $selected;
	                $this->db->insert("tags_artikel", $tags_artikel);
	                }

		        $this->load->library('upload');

		        $config['upload_path'] = './images/artikel/original/';
		        $config['file_name'] = str_replace(" ", "_", $this->input->post('judul')) . "_" . $this->session->userdata('username') . '.jpg';
		        $config['overwrite'] = TRUE;
		        $config['allowed_types'] = 'gif|jpg|jpeg|png';
		        $config['max_size'] = '2000';
		        $config['max_width'] = '2500';
		        $config['max_height'] = '2500';

		        $this->upload->initialize($config);

		        if (! $this->upload->do_upload('gambar')) {
		        	$this->session->set_flashdata('insert_success_no_upload', 'Sukses Menyimpan Artikel Baru! <br/>' . $this->upload->display_errors());
		        	$this->editor($path, $width);
		        	redirect('admin/new_post','refresh');
			        } else {
			        	$uploaddata = $this->upload->data();
						$this->load->library('image_lib');

						/* resize and crop thumbnail */
			        	$config_thumbnail['image_library'] = 'gd2';
						$config_thumbnail['source_image'] = $uploaddata['full_path'];
						$config_thumbnail['new_image'] = './images/artikel/thumbnail/' . $uploaddata['file_name'];
						$config_thumbnail['maintain_ratio'] = TRUE;
						$config_thumbnail['width'] = '120';
						$config_thumbnail['height'] = '120';
						$dim = (intval($uploaddata["image_width"]) / intval($uploaddata["image_height"])) - ($config_thumbnail['width'] / $config_thumbnail['height']);
						$config_thumbnail['master_dim'] = ($dim > 0)? "height" : "width";

						$this->image_lib->initialize($config_thumbnail); 
						if (! $this->image_lib->resize()) {
							$this->session->set_flashdata('error_resize_thumbnail', 'Error resize thumbnail:' . $this->image_lib->display_errors());
							}

						$config_thumbnail['image_library'] = 'gd2';
						$config_thumbnail['source_image'] = './images/artikel/thumbnail/' . $uploaddata['file_name'];
						$config_thumbnail['new_image'] = './images/artikel/thumbnail/' . $uploaddata['file_name'];
						$config_thumbnail['maintain_ratio'] = FALSE;
						$config_thumbnail['width'] = '120';
						$config_thumbnail['height'] = '120';
						$config_thumbnail['x_axis'] = '0';
						$config_thumbnail['y_axis'] = '0';

						$this->image_lib->initialize($config_thumbnail); 
						if (! $this->image_lib->crop()) {
							$this->session->set_flashdata('error_crop_thumbnail', 'Error crop thumbnail:' . $this->image_lib->display_errors());
							}

						/* resize and crop gambar */
						$config_gambar['image_library'] = 'gd2';
						$config_gambar['source_image'] = $uploaddata['full_path'];
						$config_gambar['new_image'] = './images/artikel/gambar/' . $uploaddata['file_name'];
						$config_gambar['maintain_ratio'] = TRUE;
						$config_gambar['width'] = '1000';
						$config_gambar['height'] = '415';
						$dim = (intval($uploaddata["image_width"]) / intval($uploaddata["image_height"])) - ($config_gambar['width'] / $config_gambar['height']);
						$config_gambar['master_dim'] = ($dim > 0)? "height" : "width";

						$this->image_lib->initialize($config_gambar); 
						if (! $this->image_lib->resize()) {
							$this->session->set_flashdata('error_resize_gambar', 'Error resize gambar:' . $this->image_lib->display_errors());
							}
						$config_gambar['image_library'] = 'gd2';
						$config_gambar['source_image'] = './images/artikel/gambar/' . $uploaddata['file_name'];
						$config_gambar['new_image'] = './images/artikel/gambar/' . $uploaddata['file_name'];
						$config_gambar['maintain_ratio'] = FALSE;
						$config_gambar['width'] = '1000';
						$config_gambar['height'] = '415';
						$config_gambar['x_axis'] = '0';
						$config_gambar['y_axis'] = '0';

						$this->image_lib->clear();
						$this->image_lib->initialize($config_gambar); 
						if (! $this->image_lib->crop()) {
							$this->session->set_flashdata('error_crop_gambar', 'Error crop gambar:' . $this->image_lib->display_errors());
							}

						/* resize and crop list */
						$config_list['image_library'] = 'gd2';
						$config_list['source_image'] = $uploaddata['full_path'];
						$config_list['new_image'] = './images/artikel/list/' . $uploaddata['file_name'];
						$config_list['maintain_ratio'] = TRUE;
						$config_list['width'] = '460';
						$config_list['height'] = '200';
						$dim = (intval($uploaddata["image_width"]) / intval($uploaddata["image_height"])) - ($config_list['width'] / $config_list['height']);
						$config_list['master_dim'] = ($dim > 0)? "height" : "width";

						$this->image_lib->initialize($config_list); 
						if (! $this->image_lib->resize()) {
							$this->session->set_flashdata('error_resize_list', 'Error resize list:' . $this->image_lib->display_errors());
							}
						$config_list['image_library'] = 'gd2';
						$config_list['source_image'] = './images/artikel/list/' . $uploaddata['file_name'];
						$config_list['new_image'] = './images/artikel/list/' . $uploaddata['file_name'];
						$config_list['maintain_ratio'] = FALSE;
						$config_list['width'] = '460';
						$config_list['height'] = '200';
						$config_list['x_axis'] = '0';
						$config_list['y_axis'] = '0';

						$this->image_lib->clear();
						$this->image_lib->initialize($config_list); 
						if (! $this->image_lib->crop()) {
							$this->session->set_flashdata('error_crop_list', 'Error crop list:' . $this->image_lib->display_errors());
							}

						$gambar = array(
							"gambar" => str_replace(" ", "_", $this->input->post('judul')) . "_" . $this->session->userdata('username') . '.jpg',
						);

						$this->db->update('artikel', $gambar, array('id' => $idArtikel));

				        $this->session->set_flashdata('success_insert_with_upload', 'Sukses Membuat Artikel dan Gambar Baru!');
				        $this->editor($path, $width);
				        redirect('admin/new_post','refresh');
	        	}  
	        }
	    } 
	}

	public function data_artikel()
	{
		$this->db->select('artikel.*');
		$this->db->from('artikel');

		$data['artikel'] = $this->db->get();


		$this->load->view('admin/data_artikel', $data);
	}

	public function edit_post($id)
	{
		$path = '../js/ckfinder';
    	$width = '860px';
    	$this->db->select('artikel.*');
    	$this->db->from('artikel');
    	$this->db->where('artikel.id', $id);

    	$data['artikel'] = $this->db->get()->result_array();

    	$query = $this->M_Home->join_artikel_tags($id)->result_array();
    	foreach ($query as $value) {
    		$query1[] = $value['tags'];
    	}
    	$data['tags_artikel'] = $query1;

    	$data['tags'] = $this->db->get('tags');
    	$this->editor($path, $width);
    	$this->load->view('admin/edit_post', $data);
	}

	public function edit($id)
	{
		$path = '../js/ckfinder';
    	$width = '860px';
		if ($this->input->post('description', TRUE)) {
	      	$this->form_validation->set_rules('description', 'Isi Artikel', 'trim|required|xss_clean');
	      	$this->form_validation->set_rules('judul', 'Judul Artikel', 'trim|required|xss_clean');
	      	$this->form_validation->set_rules('tags[]', 'Tags Artikel', 'required');
	        if ($this->form_validation->run() == FALSE) {
	          	$this->session->set_flashdata('error_form_validation', 'Error Form Validation!');
	          	$this->editor($path, $width);
	          	redirect('admin/new_post','refresh');
	        	} else {
		        $data = array(
			          "judul" => $this->input->post('judul', TRUE),
			          "isi" => $this->input->post('description', TRUE),
			          "tanggal" => date("Y-m-d H:i:s"),
			          "penulis" => $this->session->userdata('username'),
			        );

			        $this->db->update('artikel', $data, array('id' => $id));

			        $this->db->select('tags_artikel.*');
			        $this->db->delete('tags_artikel', array("id_artikel" => $id));

			        $tags_artikel['id_artikel'] = $id;
	                foreach ($_POST['tags'] as $selected) {
	                $tags_artikel['id_tags'] = $selected;
	                $this->db->insert("tags_artikel", $tags_artikel);
	                }

		        $this->load->library('upload');

		        $config['upload_path'] = './images/artikel/original/';
		        $config['file_name'] = str_replace(" ", "_", $this->input->post('judul')) . "_" . $this->session->userdata('username') . '.jpg';
		        $config['overwrite'] = TRUE;
		        $config['allowed_types'] = 'gif|jpg|jpeg|png';
		        $config['max_size'] = '2000';
		        $config['max_width'] = '2500';
		        $config['max_height'] = '2500';

		        $this->upload->initialize($config);

		        if (! $this->upload->do_upload('gambar')) {
		        	$this->session->set_flashdata('success_no_upload', "Sukses Mengedit Artikel! <br/>" . $this->upload->display_errors());
		        	redirect('admin/edit_post/'.$id,'refresh');
			        } else {
			        	$uploaddata = $this->upload->data();
						$this->load->library('image_lib');

						/* resize and crop thumbnail */
			        	$config_thumbnail['image_library'] = 'gd2';
						$config_thumbnail['source_image'] = $uploaddata['full_path'];
						$config_thumbnail['new_image'] = './images/artikel/thumbnail/' . $uploaddata['file_name'];
						$config_thumbnail['maintain_ratio'] = TRUE;
						$config_thumbnail['width'] = '120';
						$config_thumbnail['height'] = '120';
						$dim = (intval($uploaddata["image_width"]) / intval($uploaddata["image_height"])) - ($config_thumbnail['width'] / $config_thumbnail['height']);
						$config_thumbnail['master_dim'] = ($dim > 0)? "height" : "width";

						$this->image_lib->initialize($config_thumbnail); 
						if (! $this->image_lib->resize()) {
							$this->session->set_flashdata('error_resize_thumbnail', 'Error resize thumbnail:' . $this->image_lib->display_errors());
							}

						$config_thumbnail['image_library'] = 'gd2';
						$config_thumbnail['source_image'] = './images/artikel/thumbnail/' . $uploaddata['file_name'];
						$config_thumbnail['new_image'] = './images/artikel/thumbnail/' . $uploaddata['file_name'];
						$config_thumbnail['maintain_ratio'] = FALSE;
						$config_thumbnail['width'] = '120';
						$config_thumbnail['height'] = '120';
						$config_thumbnail['x_axis'] = '0';
						$config_thumbnail['y_axis'] = '0';

						$this->image_lib->initialize($config_thumbnail); 
						if (! $this->image_lib->crop()) {
							$this->session->set_flashdata('error_crop_thumbnail', 'Error crop thumbnail:' . $this->image_lib->display_errors());
							}

						/* resize and crop gambar */
						$config_gambar['image_library'] = 'gd2';
						$config_gambar['source_image'] = $uploaddata['full_path'];
						$config_gambar['new_image'] = './images/artikel/gambar/' . $uploaddata['file_name'];
						$config_gambar['maintain_ratio'] = TRUE;
						$config_gambar['width'] = '1000';
						$config_gambar['height'] = '415';
						$dim = (intval($uploaddata["image_width"]) / intval($uploaddata["image_height"])) - ($config_gambar['width'] / $config_gambar['height']);
						$config_gambar['master_dim'] = ($dim > 0)? "height" : "width";

						$this->image_lib->initialize($config_gambar); 
						if (! $this->image_lib->resize()) {
							$this->session->set_flashdata('error_resize_gambar', 'Error resize gambar:' . $this->image_lib->display_errors());
							}
						$config_gambar['image_library'] = 'gd2';
						$config_gambar['source_image'] = './images/artikel/gambar/' . $uploaddata['file_name'];
						$config_gambar['new_image'] = './images/artikel/gambar/' . $uploaddata['file_name'];
						$config_gambar['maintain_ratio'] = FALSE;
						$config_gambar['width'] = '1000';
						$config_gambar['height'] = '415';
						$config_gambar['x_axis'] = '0';
						$config_gambar['y_axis'] = '0';

						$this->image_lib->clear();
						$this->image_lib->initialize($config_gambar); 
						if (! $this->image_lib->crop()) {
							$this->session->set_flashdata('error_crop_gambar', 'Error crop gambar:' . $this->image_lib->display_errors());
							}

						/* resize and crop list */
						$config_list['image_library'] = 'gd2';
						$config_list['source_image'] = $uploaddata['full_path'];
						$config_list['new_image'] = './images/artikel/list/' . $uploaddata['file_name'];
						$config_list['maintain_ratio'] = TRUE;
						$config_list['width'] = '460';
						$config_list['height'] = '200';
						$dim = (intval($uploaddata["image_width"]) / intval($uploaddata["image_height"])) - ($config_list['width'] / $config_list['height']);
						$config_list['master_dim'] = ($dim > 0)? "height" : "width";

						$this->image_lib->initialize($config_list); 
						if (! $this->image_lib->resize()) {
							$this->session->set_flashdata('error_resize_list', 'Error resize list:' . $this->image_lib->display_errors());
							}
						$config_list['image_library'] = 'gd2';
						$config_list['source_image'] = './images/artikel/list/' . $uploaddata['file_name'];
						$config_list['new_image'] = './images/artikel/list/' . $uploaddata['file_name'];
						$config_list['maintain_ratio'] = FALSE;
						$config_list['width'] = '460';
						$config_list['height'] = '200';
						$config_list['x_axis'] = '0';
						$config_list['y_axis'] = '0';

						$this->image_lib->clear();
						$this->image_lib->initialize($config_list); 
						if (! $this->image_lib->crop()) {
							$this->session->set_flashdata('error_crop_list', 'Error crop list:' . $this->image_lib->display_errors());
							}

						$gambar = array(
							"gambar" => str_replace(" ", "_", $this->input->post('judul')) . "_" . $this->session->userdata('username') . '.jpg',
						);

						$this->db->update('artikel', $gambar, array("id" => $id));

						$this->session->set_flashdata('success_with_upload', 'Sukses Mengedit Artikel dan Gambar!');
				        $this->editor($path, $width);
				        redirect('admin/edit_post/'.$id,'refresh');
	        	}  
	        }
	    } 
	}

	public function blog()
	{
		$this->load->view('home/blog');
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */