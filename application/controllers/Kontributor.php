<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("Asia/Jakarta");

class Kontributor extends CI_Controller {

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
		$this->db->where('id_staf', $this->session->userdata('id'));
		$kontributor['profil'] = $this->db->get()->result_array();

		$this->db->select('artikel.id');
		$this->db->from('artikel');
		$this->db->where('artikel.id_penulis', $this->session->userdata('id'));
		$kontributor['jumlah_artikel'] = $this->db->count_all_results();

		$notif['notifikasi'] = $this->M_Home->join_notifikasi_kontributor($this->session->userdata('id'), NULL, NULL);

		$this->db->select('artikel.id');
		$this->db->from('artikel');
		$this->db->where('artikel.kategori', 'Blog');
		$this->db->where('artikel.id_penulis', $this->session->userdata('id'));
		$dashboard['jumlah_blog'] = $this->db->count_all_results();

		$dashboard['jumlah_komentar'] = $this->M_Home->join_komentar_penulis_artikel($this->session->userdata('id'));

		$this->load->view('kontributor/include/nav', $notif);
		$this->load->view('kontributor/include/menu', $kontributor);
		$this->load->view('kontributor/index', $dashboard);
	}

	public function data_blog()
	{
		$this->db->select('staf.*');
		$this->db->from('staf');
		$this->db->where('id_staf', $this->session->userdata('id'));
		$kontributor['profil'] = $this->db->get()->result_array();

		$this->db->select('artikel.id');
		$this->db->from('artikel');
		$this->db->where('artikel.id_penulis', $this->session->userdata('id'));
		$kontributor['jumlah_artikel'] = $this->db->count_all_results();

		$this->db->select('artikel.*');
		$this->db->from('artikel');
		$this->db->where('artikel.id_penulis', $this->session->userdata('id'));

		$data['blog'] = $this->db->get();

		$notif['notifikasi'] = $this->M_Home->join_notifikasi_kontributor($this->session->userdata('id'), NULL, NULL);

		$this->load->view('kontributor/include/nav', $notif);
		$this->load->view('kontributor/include/menu', $kontributor);
		$this->load->view('kontributor/data_blog', $data);
	}

	public function new_blog()
	{
		$this->db->select('tags.*');
		$this->db->from('tags');
		$data['tags'] = $this->db->get()->result_array();
		// $path = base_url().'js/ckfinder';
	    $path = '../js/ckfinder';
	    $width = '860px';
	    $this->editor($path, $width);
		$this->load->view('kontributor/new_blog', $data);
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
	          redirect('kontributor/new_blog','refresh');
	        	} else {
		        	$data = array(
			          "judul" => $this->input->post('judul', TRUE),
			          "isi" => $this->input->post('description', TRUE),
			          "kategori" => "Blog",
			          "status" => "Pending",
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

	                $notif = array(
	                	"dari_id" => $this->session->userdata('id'),
	                	"id_artikel" => $idArtikel,
	                	"isi_notifikasi" => "Sebuah artikel blog berjudul {$this->input->post('judul')} telah dibuat. Cek bagian pesan atau halaman Data Artikel Blog untuk melihat lebih lanjut. <br><small><em>Klik (x) untuk menutup notifikasi ini.</em></small>",
	                	"tanggal_notifikasi" => date("Y-m-d H:i:s"),
	                	"status_notifikasi" => "Sent",
	                	);

	                $this->db->insert('notifikasi', $notif);

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
		        	$this->session->set_flashdata('insert_success_no_upload', 'Sukses Menyimpan Artikel Baru, Silakan Tunggu Persetujuan Admin untuk Artikel Anda! <br/>' . $this->upload->display_errors());
		        	$this->editor($path, $width);
		        	redirect('kontributor/new_blog','refresh');
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

				        $this->session->set_flashdata('success_insert_with_upload', 'Sukses Membuat Artikel dan Gambar Baru, Silakan Tunggu Persetujuan Admin untuk Artikel Anda!');
				        $this->editor($path, $width);
				        redirect('kontributor/new_blog','refresh');
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
    	$this->load->view('kontributor/edit_blog', $data);
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
	          	redirect('kontributor/new_blog','refresh');
	        	} else {
		        $data = array(
			          "judul" => $this->input->post('judul', TRUE),
			          "isi" => $this->input->post('description', TRUE),
			          "tanggal" => date("Y-m-d H:i:s"),
			          "id_penulis" => $this->session->userdata('id'),
			        );

			        $this->db->update('artikel', $data, array('id' => $id));

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
		        	redirect('kontributor/edit_post/'.$id,'refresh');
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
				        redirect('kontributor/edit_post/'.$id,'refresh');
	        	}  
	        }
	    } 
	}

	public function cek_notifikasi()
	{
		$session_id = $this->input->post('session_id', TRUE);
		$id_notifikasi = $this->input->post('id_notifikasi', TRUE);

		if ($this->input->post('ajax') != 1) {
			redirect('kontributor','refresh');
		} else {
			if ($this->input->post('session_id') && !$this->input->post('id_notifikasi')) {

				$query = $this->M_Home->join_notifikasi_kontributor($this->session->userdata('id'), 1, 0);
				$encode_data = json_encode($query);

				echo $encode_data;
			} else if ($this->input->post('session_id') && $this->input->post('id_notifikasi')) {
				$notif = array(
					"status_notifikasi" => "Read",
				);

				$this->db->update('notifikasi', $notif, array("id_notifikasi" => $id_notifikasi));

				$query = $this->M_Home->join_notifikasi_kontributor($this->session->userdata('id'), 1, 0);
				$encode_data = json_encode($query);

				echo $encode_data;
			} else {
				echo "false";
			}
		}
	}

	public function profil($id)
	{
		$this->db->select('artikel.id');
		$this->db->from('artikel');
		$this->db->where('artikel.id_penulis', $this->session->userdata('id'));
		$data['jumlah_artikel'] = $this->db->count_all_results();

		$this->db->select('staf.*');
		$this->db->from('staf');
		$this->db->where('staf.id_staf', $id);

		$data['profil'] = $this->db->get()->result_array();

		$notif['notifikasi'] = $this->M_Home->join_notifikasi_kontributor($this->session->userdata('id'), NULL, NULL);

		$this->load->view('kontributor/include/nav', $notif);
		$this->load->view('kontributor/profil', $data);
	}

	public function edit_profil($id)
	{
		if ($this->input->post('simpan', TRUE)) {
			$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');

            if ($this->form_validation->run() == FALSE) {
				redirect('kontributor/profil/'.$id,'refresh');
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
			        	$this->session->set_flashdata('update_no_upload_kontributor', 'Sukses Memperbarui Profil! <br/>' . $this->upload->display_errors());
			        	redirect('kontributor/profil/'.$id,'refresh');
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
							redirect('kontributor/profil/'.$id,'refresh');
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
							redirect('kontributor/profil/'.$id,'refresh');
							}

						/* resize and crop avatar */
			        	$config_avatar['image_library'] = 'gd2';
						$config_avatar['source_image'] = $uploaddata['full_path'];
						$config_avatar['new_image'] = './images/profil/avatar/' . $uploaddata['file_name'];
						$config_avatar['maintain_ratio'] = TRUE;
						$config_avatar['width'] = '32';
						$config_avatar['height'] = '32';
						$dim = (intval($uploaddata["image_width"]) / intval($uploaddata["image_height"])) - ($config_avatar['width'] / $config_avatar['height']);
						$config_avatar['master_dim'] = ($dim > 0)? "height" : "width";

						$this->image_lib->initialize($config_avatar); 
						if (! $this->image_lib->resize()) {
							$this->session->set_flashdata('error_resize_avatar', 'Error resize avatar:' . $this->image_lib->display_errors());
							redirect('kontributor/profil/'.$id,'refresh');
							}

						$config_avatar['image_library'] = 'gd2';
						$config_avatar['source_image'] = './images/profil/avatar/' . $uploaddata['file_name'];
						$config_avatar['new_image'] = './images/profil/avatar/' . $uploaddata['file_name'];
						$config_avatar['maintain_ratio'] = FALSE;
						$config_avatar['width'] = '32';
						$config_avatar['height'] = '32';
						$config_avatar['x_axis'] = '0';
						$config_avatar['y_axis'] = '0';

						$this->image_lib->initialize($config_avatar); 
						if (! $this->image_lib->crop()) {
							$this->session->set_flashdata('error_crop_avatar', 'Error crop avatar:' . $this->image_lib->display_errors());
							redirect('kontributor/profil/'.$id,'refresh');
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
							redirect('kontributor/profil/'.$id,'refresh');
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
							redirect('kontributor/profil/'.$id,'refresh');
							}

						$gambar = array(
							"gambar" => $this->session->userdata('type') . "_" . $this->session->userdata('username') . '.jpg',
						);

						$this->db->update('staf', $gambar, array("id_staf" => $id));

						$this->session->set_flashdata('update_with_upload', 'Sukses Memperbarui Profil dan Foto!');
						redirect('kontributor/profil/'.$id,'refresh');
			        }
			        
				}
		} 
	}

}

/* End of file Kontributor.php */
/* Location: ./application/controllers/Kontributor.php */