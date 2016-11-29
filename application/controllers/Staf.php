<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("Asia/Jakarta");

class Staf extends CI_Controller {

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
		$this->db->select('staf.*');
		$this->db->from('staf');
		$this->db->where('staf.id_staf', $this->session->userdata('id'));
		$staf['profil'] = $this->db->get()->result_array();

		$this->db->select('halaman.id_halaman');
		$this->db->from('halaman');
		$staf['jumlah_halaman'] = $this->db->count_all_results();

		$this->db->select('artikel.id');
		$this->db->from('artikel');
		$this->db->where('artikel.kategori', 'Berita');
		$staf['jumlah_artikel'] = $this->db->count_all_results();

		$this->db->select('galeri.id_galeri');
		$this->db->from('galeri');
		$staf['jumlah_galeri'] = $this->db->count_all_results();

		$this->db->select('staf.*');
		$this->db->from('staf');
		$this->db->where('id_staf', $this->session->userdata('id'));

		$staf['profil'] = $this->db->get()->result_array();

		$this->load->view('staf/include/nav');
		$this->load->view('staf/include/menu', $staf);
		$this->load->view('staf/index');
	}

	public function data_artikel()
	{
		$this->db->select('staf.*');
		$this->db->from('staf');
		$this->db->where('staf.id_staf', $this->session->userdata('id'));
		$staf['profil'] = $this->db->get()->result_array();

		$this->db->select('halaman.id_halaman');
		$this->db->from('halaman');
		$staf['jumlah_halaman'] = $this->db->count_all_results();

		$this->db->select('artikel.id');
		$this->db->from('artikel');
		$this->db->where('artikel.kategori', 'Berita');
		$staf['jumlah_artikel'] = $this->db->count_all_results();

		$this->db->select('galeri.id_galeri');
		$this->db->from('galeri');
		$staf['jumlah_galeri'] = $this->db->count_all_results();

		$data['artikel'] = $this->M_Home->join_artikel_admin();

		$this->load->view('staf/include/nav');
		$this->load->view('staf/include/menu', $staf);
		$this->load->view('staf/data_artikel', $data);
	}

	public function data_halaman()
	{
		$this->db->select('staf.*');
		$this->db->from('staf');
		$this->db->where('staf.id_staf', $this->session->userdata('id'));
		$staf['profil'] = $this->db->get()->result_array();

		$this->db->select('halaman.id_halaman');
		$this->db->from('halaman');
		$staf['jumlah_halaman'] = $this->db->count_all_results();

		$this->db->select('artikel.id');
		$this->db->from('artikel');
		$this->db->where('artikel.kategori', 'Berita');
		$staf['jumlah_artikel'] = $this->db->count_all_results();

		$this->db->select('galeri.id_galeri');
		$this->db->from('galeri');
		$staf['jumlah_galeri'] = $this->db->count_all_results();

		$this->db->select('halaman.id_halaman, halaman.nama_halaman, halaman.keterangan, halaman.alamat');
		$this->db->from('halaman');
		$data['halaman'] = $this->db->get();

		$this->load->view('staf/include/nav');
		$this->load->view('staf/include/menu', $staf);
		$this->load->view('staf/data_halaman', $data);
	}

	public function edit_halaman($id)
	{
		$data['halaman'] = $this->db->get_where('halaman', array('id_halaman' => $id))->result_array();
		$path = '../js/ckfinder';
    	$width = '860px';
		$this->editor($path, $width);

		$this->load->view('staf/edit_halaman', $data);
	}

	public function edit_hal($id)
	{
		$path = '../js/ckfinder';
    	$width = '860px';
		if ($this->input->post('description', TRUE)) {
	      	$this->form_validation->set_rules('description', 'Isi Artikel', 'trim|required|xss_clean');
	        if ($this->form_validation->run() == FALSE) {
	          	$this->session->set_flashdata('error_form_validation', 'Error Form Validation!');
	          	$this->editor($path, $width);
	          	redirect('staf/new_halaman'.$id,'refresh');
	        	} else {
		        $data = array(
			          "isi_halaman" => $this->input->post('description', TRUE),
			          "keterangan" => "Terakhir diubah oleh " . $this->session->userdata('username') . " pada " . date("d-m-Y H:i:s"),
			        );

			        $this->db->update('halaman', $data, array('id_halaman' => $id));

		        $this->load->library('upload');

		        $config['upload_path'] = './images/halaman/original/';
		        $config['file_name'] = $id . '.jpg';
		        $config['overwrite'] = TRUE;
		        $config['allowed_types'] = 'gif|jpg|jpeg|png';
		        $config['max_size'] = '2000';
		        $config['max_width'] = '5000';
		        $config['max_height'] = '5000';

		        $this->upload->initialize($config);

		        if (! $this->upload->do_upload('gambar')) {
		        	$this->session->set_flashdata('success_no_upload', "Sukses Mengedit Artikel! <br/>" . $this->upload->display_errors());
		        	redirect('staf/edit_halaman/'.$id,'refresh');
			        } else {
			        	$uploaddata = $this->upload->data();
						$this->load->library('image_lib');

						/* resize and crop thumbnail */
			        	$config_thumbnail['image_library'] = 'gd2';
						$config_thumbnail['source_image'] = $uploaddata['full_path'];
						$config_thumbnail['new_image'] = './images/halaman/slider/' . $uploaddata['file_name'];
						$config_thumbnail['maintain_ratio'] = TRUE;
						$config_thumbnail['width'] = '960';
						$config_thumbnail['height'] = '350';
						$dim = (intval($uploaddata["image_width"]) / intval($uploaddata["image_height"])) - ($config_thumbnail['width'] / $config_thumbnail['height']);
						$config_thumbnail['master_dim'] = ($dim > 0)? "height" : "width";

						$this->image_lib->initialize($config_thumbnail); 
						if (! $this->image_lib->resize()) {
							$this->session->set_flashdata('error_resize_thumbnail', 'Error resize thumbnail:' . $this->image_lib->display_errors());
							}

						$config_thumbnail['image_library'] = 'gd2';
						$config_thumbnail['source_image'] = './images/halaman/slider/' . $uploaddata['file_name'];
						$config_thumbnail['new_image'] = './images/halaman/slider/' . $uploaddata['file_name'];
						$config_thumbnail['maintain_ratio'] = FALSE;
						$config_thumbnail['width'] = '960';
						$config_thumbnail['height'] = '350';
						$config_thumbnail['x_axis'] = '0';
						$config_thumbnail['y_axis'] = '0';

						$this->image_lib->initialize($config_thumbnail); 
						if (! $this->image_lib->crop()) {
							$this->session->set_flashdata('error_crop_thumbnail', 'Error crop thumbnail:' . $this->image_lib->display_errors());
							}

						/* resize and crop gambar */
						$config_gambar['image_library'] = 'gd2';
						$config_gambar['source_image'] = $uploaddata['full_path'];
						$config_gambar['new_image'] = './images/halaman/halaman/' . $uploaddata['file_name'];
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
						$config_gambar['source_image'] = './images/halaman/halaman/' . $uploaddata['file_name'];
						$config_gambar['new_image'] = './images/halaman/halaman/' . $uploaddata['file_name'];
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

						$gambar = array(
							"gambar_halaman" => $id . '.jpg',
						);

						$this->db->update('halaman', $gambar, array("id_halaman" => $id));

						$this->session->set_flashdata('success_with_upload', 'Sukses Mengedit Artikel dan Gambar!');
				        $this->editor($path, $width);
				        redirect('staf/edit_halaman/'.$id,'refresh');
	        	}  
	        }
	    } 
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
		$this->load->view('staf/new_post', $data);
	}

	public function editor($path, $width)
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
	          redirect('staf/new_post','refresh');
	        	} else {
		        	$data = array(
			          "judul" => $this->input->post('judul', TRUE),
			          "isi" => $this->input->post('description', TRUE),
			          "kategori" => "Berita",
			          "tanggal" => date("Y-m-d H:i:s"),
			          "id_penulis" => $this->session->userdata('id'),
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
		        	redirect('staf/new_post','refresh');
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
				        redirect('staf/new_post','refresh');
	        	}  
	        }
	    } 
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
    	$this->load->view('staf/edit_post', $data);
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
	          	redirect('staf/new_post','refresh');
	        	} else {
		        $data = array(
			          "judul" => $this->input->post('judul', TRUE),
			          "isi" => $this->input->post('description', TRUE),
			          "tanggal" => date("Y-m-d H:i:s"),
			          "id_penulis" => $this->session->userdata('id'),
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
		        	redirect('staf/edit_post/'.$id,'refresh');
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
				        redirect('staf/edit_post/'.$id,'refresh');
	        	}  
	        }
	    } 
	}

	public function data_galeri()
	{
		$this->db->select('staf.*');
		$this->db->from('staf');
		$this->db->where('staf.id_staf', $this->session->userdata('id'));
		$staf['profil'] = $this->db->get()->result_array();

		$this->db->select('halaman.id_halaman');
		$this->db->from('halaman');
		$staf['jumlah_halaman'] = $this->db->count_all_results();

		$this->db->select('artikel.id');
		$this->db->from('artikel');
		$this->db->where('artikel.kategori', 'Berita');
		$staf['jumlah_artikel'] = $this->db->count_all_results();

		$this->db->select('galeri.id_galeri');
		$this->db->from('galeri');
		$staf['jumlah_galeri'] = $this->db->count_all_results();

		$data['galeri'] = $this->M_Home->join_galeri_staf();

		$this->load->view('staf/include/nav');
		$this->load->view('staf/include/menu', $staf);
		$this->load->view('staf/data_galeri', $data);

	}

	public function new_album()
	{
		$data['data1'] = $this->input->post('jumlah', TRUE);
		$path = '../js/ckfinder';
	    $width = '860px';
	    $this->editor($path, $width);
		$this->load->view('staf/new_album', $data);
	}

	public function upload_galeri()
	{
		$path = '../js/ckfinder';
    	$width = '860px';
		if ($this->input->post('description', TRUE)) {
	      	$this->form_validation->set_rules('description', 'Deskripsi Galeri', 'trim|required|xss_clean');
	      	$this->form_validation->set_rules('judul', 'Judul Galeri', 'trim|required|xss_clean');
	        if ($this->form_validation->run() == FALSE) {
	          $this->session->set_flashdata('error_form_validation', 'Error Form Validation!');
	          $this->editor($path, $width);
	          redirect('staf/new_post','refresh');
	        	} else {
		        	$data = array(
			          "judul_galeri" => $this->input->post('judul', TRUE),
			          "deskripsi_galeri" => $this->input->post('description', TRUE),
			          "tanggal_galeri" => date("Y-m-d H:i:s"),
			          "id_pengunggah" => $this->session->userdata('id'),
			        );

			        $this->db->insert('galeri', $data);

			        $idGaleri = $this->db->insert_id("galeri");

			        $foto_galeri['id_galeri'] = $idGaleri;
	                if ($this->input->post('submit') && !empty($_FILES['foto']['name'])) {
	                	$files = $_FILES;
	                	foreach ($files as $key => $value) {
	                		$filesCount = count($files['foto']['name']);
		                	for($i = 0; $i < $filesCount; $i++){
				                $_FILES['userFile']['name'] = $value['name'][$i];
				                $_FILES['userFile']['type'] = $value['type'][$i];
				                $_FILES['userFile']['tmp_name'] = $value['tmp_name'][$i];
				                $_FILES['userFile']['error'] = $value['error'][$i];
				                $_FILES['userFile']['size'] = $value['size'][$i];

				                $foto_galeri['caption'] = $_POST['caption'][$i];

				                $uploadPath = './images/galeri/original/';
				                $config['upload_path'] = $uploadPath;
				                $config['allowed_types'] = 'gif|jpg|png';
				                $config['file_name'] = str_replace(" ", "_", $this->input->post('judul')) . "_" . $i . '.jpg';
				                
				                $this->load->library('upload', $config);
				                $this->upload->initialize($config);
				                if($this->upload->do_upload('userFile')){
				                    $uploaddata = $this->upload->data();
									$this->load->library('image_lib');

									/* resize and crop thumbnail */
						        	$config_thumbnail['image_library'] = 'gd2';
									$config_thumbnail['source_image'] = $uploaddata['full_path'];
									$config_thumbnail['new_image'] = './images/galeri/thumbnail/' . $uploaddata['file_name'];
									$config_thumbnail['maintain_ratio'] = TRUE;
									$config_thumbnail['width'] = '201';
									$config_thumbnail['height'] = '201';
									$dim = (intval($uploaddata["image_width"]) / intval($uploaddata["image_height"])) - ($config_thumbnail['width'] / $config_thumbnail['height']);
									$config_thumbnail['master_dim'] = ($dim > 0)? "height" : "width";

									$this->image_lib->initialize($config_thumbnail); 
									if (! $this->image_lib->resize()) {
										$this->session->set_flashdata('error_resize_thumbnail', 'Error resize thumbnail:' . $this->image_lib->display_errors());
										}

									$config_thumbnail['image_library'] = 'gd2';
									$config_thumbnail['source_image'] = './images/galeri/thumbnail/' . $uploaddata['file_name'];
									$config_thumbnail['new_image'] = './images/galeri/thumbnail/' . $uploaddata['file_name'];
									$config_thumbnail['maintain_ratio'] = FALSE;
									$config_thumbnail['width'] = '201';
									$config_thumbnail['height'] = '201';
									$config_thumbnail['x_axis'] = '0';
									$config_thumbnail['y_axis'] = '0';

									$this->image_lib->initialize($config_thumbnail); 
									if (! $this->image_lib->crop()) {
										$this->session->set_flashdata('error_crop_thumbnail', 'Error crop thumbnail:' . $this->image_lib->display_errors());
										}

									/* resize and crop view */
						        	$config_view['image_library'] = 'gd2';
									$config_view['source_image'] = $uploaddata['full_path'];
									$config_view['new_image'] = './images/galeri/view/' . $uploaddata['file_name'];
									$config_view['maintain_ratio'] = TRUE;
									$config_view['width'] = '960';
									$config_view['height'] = '480';
									$dim = (intval($uploaddata["image_width"]) / intval($uploaddata["image_height"])) - ($config_view['width'] / $config_view['height']);
									$config_view['master_dim'] = ($dim > 0)? "height" : "width";

									$this->image_lib->initialize($config_view); 
									if (! $this->image_lib->resize()) {
										$this->session->set_flashdata('error_resize_view', 'Error resize view:' . $this->image_lib->display_errors());
										}

									$config_view['image_library'] = 'gd2';
									$config_view['source_image'] = './images/galeri/view/' . $uploaddata['file_name'];
									$config_view['new_image'] = './images/galeri/view/' . $uploaddata['file_name'];
									$config_view['maintain_ratio'] = FALSE;
									$config_view['width'] = '960';
									$config_view['height'] = '480';
									$config_view['x_axis'] = '0';
									$config_view['y_axis'] = '0';

									$this->image_lib->initialize($config_view); 
									if (! $this->image_lib->crop()) {
										$this->session->set_flashdata('error_crop_view', 'Error crop view:' . $this->image_lib->display_errors());
										}

				                    $foto_galeri['path_view'] = $config['file_name'];
				                    $this->db->insert('foto_galeri', $foto_galeri);
				                } // end if this->upload
				            } // end for
	                	} // end foreach

			            if(!empty($uploadData)){
			                $statusMsg = 'Some problem occurred, please try again.';
			                $this->session->set_flashdata('statusMsg',$statusMsg);
			            }
	                } // end if this->input->post
	            $this->session->set_flashdata('sukses_buat_galeri_baru', 'Sukses membuat galeri baru!');
	            redirect('staf/data_galeri','refresh');
	        } // end ifelse validation run
	    } // end if this->input->post description
	}

	public function profil($id)
	{
		$this->db->select('staf.*');
		$this->db->from('staf');
		$this->db->where('staf.id_staf', $this->session->userdata('id'));
		$data['profil'] = $this->db->get()->result_array();

		$this->db->select('halaman.id_halaman');
		$this->db->from('halaman');
		$data['jumlah_halaman'] = $this->db->count_all_results();

		$this->db->select('artikel.id');
		$this->db->from('artikel');
		$this->db->where('artikel.kategori', 'Berita');
		$data['jumlah_artikel'] = $this->db->count_all_results();

		$this->db->select('galeri.id_galeri');
		$this->db->from('galeri');
		$data['jumlah_galeri'] = $this->db->count_all_results();

		$this->db->select('staf.*');
		$this->db->from('staf');
		$this->db->where('staf.id_staf', $id);

		$data['profil'] = $this->db->get()->result_array();

		$this->load->view('staf/include/nav');
		$this->load->view('staf/profil', $data);
	}

	public function edit_profil($id)
	{
		if ($this->input->post('simpan', TRUE)) {
			$this->form_validation->set_rules('username', 'Nama Peneliti', 'required|trim|xss_clean');
            $this->form_validation->set_rules('password', 'Jenis Kelamin', 'required|trim|min_length[6]');

            if ($this->form_validation->run() == FALSE) {
				redirect('staf/profil/'.$id,'refresh');
				} else {
					$data = array(
						"nama" => $this->input->post('nama', TRUE),
						"username" => $this->input->post('username', TRUE),
						"password" => $this->input->post('password', TRUE),
						"tanggal_lahir" => $this->input->post('tanggal', TRUE),
						"motto" => $this->input->post('motto', TRUE),
						"deskripsi" => $this->input->post('deskripsi', TRUE),
					);

					$this->db->update('staf', $data, array('id_staf' => $id));

					$this->load->library('upload');

			        $config['upload_path'] = './images/profil/original/';
			        $config['file_name'] = $this->session->userdata('type') . "_" . $this->session->userdata('username') . '.jpg';
			        $config['overwrite'] = TRUE;
			        $config['allowed_types'] = 'gif|jpg|jpeg|png';
			        $config['max_size'] = '2000';
			        $config['max_width'] = '5000';
			        $config['max_height'] = '5000';

			        $this->upload->initialize($config);

			        if (! $this->upload->do_upload('gambar')) {
			        	$this->session->set_flashdata('update_no_upload', 'Sukses Memperbarui Profil! <br/>' . $this->upload->display_errors());
			        	redirect('staf/profil/'.$id,'refresh');
			        } else {
			        	$uploaddata = $this->upload->data();
						$this->load->library('image_lib');

						/* resize and crop thumbnail */
			        	$config_thumbnail['image_library'] = 'gd2';
						$config_thumbnail['source_image'] = $uploaddata['full_path'];
						$config_thumbnail['new_image'] = './images/profil/thumbnail/' . $uploaddata['file_name'];
						$config_thumbnail['maintain_ratio'] = TRUE;
						$config_thumbnail['width'] = '64';
						$config_thumbnail['height'] = '64';
						$dim = (intval($uploaddata["image_width"]) / intval($uploaddata["image_height"])) - ($config_thumbnail['width'] / $config_thumbnail['height']);
						$config_thumbnail['master_dim'] = ($dim > 0)? "height" : "width";

						$this->image_lib->initialize($config_thumbnail); 
						if (! $this->image_lib->resize()) {
							$this->session->set_flashdata('error_resize_thumbnail', 'Error resize thumbnail:' . $this->image_lib->display_errors());
							}

						$config_thumbnail['image_library'] = 'gd2';
						$config_thumbnail['source_image'] = './images/profil/thumbnail/' . $uploaddata['file_name'];
						$config_thumbnail['new_image'] = './images/profil/thumbnail/' . $uploaddata['file_name'];
						$config_thumbnail['maintain_ratio'] = FALSE;
						$config_thumbnail['width'] = '64';
						$config_thumbnail['height'] = '64';
						$config_thumbnail['x_axis'] = '0';
						$config_thumbnail['y_axis'] = '0';

						$this->image_lib->initialize($config_thumbnail); 
						if (! $this->image_lib->crop()) {
							$this->session->set_flashdata('error_crop_thumbnail', 'Error crop thumbnail:' . $this->image_lib->display_errors());
							}

						/* resize and crop gambar */
						$config_gambar['image_library'] = 'gd2';
						$config_gambar['source_image'] = $uploaddata['full_path'];
						$config_gambar['new_image'] = './images/profil/halaman/' . $uploaddata['file_name'];
						$config_gambar['maintain_ratio'] = TRUE;
						$config_gambar['width'] = '225';
						$config_gambar['height'] = '320';
						$dim = (intval($uploaddata["image_width"]) / intval($uploaddata["image_height"])) - ($config_gambar['width'] / $config_gambar['height']);
						$config_gambar['master_dim'] = ($dim > 0)? "height" : "width";

						$this->image_lib->initialize($config_gambar); 
						if (! $this->image_lib->resize()) {
							$this->session->set_flashdata('error_resize_gambar', 'Error resize gambar:' . $this->image_lib->display_errors());
							}
						$config_gambar['image_library'] = 'gd2';
						$config_gambar['source_image'] = './images/profil/halaman/' . $uploaddata['file_name'];
						$config_gambar['new_image'] = './images/profil/halaman/' . $uploaddata['file_name'];
						$config_gambar['maintain_ratio'] = FALSE;
						$config_gambar['width'] = '225';
						$config_gambar['height'] = '320';
						$config_gambar['x_axis'] = '0';
						$config_gambar['y_axis'] = '0';

						$this->image_lib->clear();
						$this->image_lib->initialize($config_gambar); 
						if (! $this->image_lib->crop()) {
							$this->session->set_flashdata('error_crop_gambar', 'Error crop gambar:' . $this->image_lib->display_errors());
							}

						$gambar = array(
							"gambar" => $this->session->userdata('type') . "_" . $this->session->userdata('username') . '.jpg',
						);

						$this->db->update('staf', $gambar, array("id_staf" => $id));

						$this->session->set_flashdata('update_with_upload', 'Sukses Memperbarui Profil dan Foto!');
						redirect('staf/profil/'.$id,'refresh');
			        }
			        
				}
		} 
	}

}

/* End of file Staf.php */
/* Location: ./application/controllers/Staf.php */