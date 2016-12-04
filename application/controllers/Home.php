<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("Asia/Jakarta");

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Home');
	}

	public function index()
	{
		$data['halaman'] = $this->db->get('halaman', 5, 0);
		$data['posts'] = $this->M_Home->berita_index();

		$this->load->view('home/home', $data);
	}

	public function staff_login()
	{
		$this->load->view('staff_login');
	}

	public function staff_masuk()
	{
		$this->form_validation->set_rules("username", "Username", "required|trim|xss_clean");
        $this->form_validation->set_rules("password", "Password", "required|trim|xss_clean|min_length[6]");

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("staff_login");
        } else {
			$sqlAdmin = $this->db->get_where('admin',
				array(
					"username" => $this->input->post('username', TRUE),
					"password" => $this->input->post('password', TRUE)
					)
				);

			$sqlKontributor = $this->db->get_where('staf', 
				array(
					"username" => $this->input->post('username', TRUE),
					"password" => $this->input->post('password', TRUE),
					"kategori" => 'kontributor',
					)
				);
			$sqlStaf = $this->db->get_where('staf', 
				array(
					"username" => $this->input->post('username', TRUE),
					"password" => $this->input->post('password', TRUE),
					"kategori" => 'admin',
					)
				);

    		if ($sqlAdmin->num_rows() > 0) {
    			$row = $sqlAdmin->result_array();

    			$session = array(
    				'id' => $row[0]["id"],
    				'username' => $row[0]["username"],
                    'type' => 'administrator',
    			);

    			$this->session->set_userdata($session);
    			redirect('admin','refresh');
    		} elseif ($sqlKontributor->num_rows() > 0) {
    			$row = $sqlKontributor->result_array();

    			$session = array(
    				'id' => $row[0]["id_staf"],
    				'username' => $row[0]["username"],
    				'type' => 'kontributor',
    			);

    			$this->session->set_userdata($session);
    			redirect('kontributor','refresh');
    		} elseif ($sqlStaf->num_rows() > 0) {
    			$row = $sqlStaf->result_array();

    			$session = array(
    				'id' => $row[0]["id_staf"],
    				'username' => $row[0]["username"],
    				'type' => 'admin',
    			);

    			$this->session->set_userdata($session);
    			redirect('staf','refresh');
    		} else {
    			$this->session->set_flashdata('eror_login', 'Error. Username dan password salah!');
    			redirect('home','refresh');
    		}
        }
	}

	public function logout()
	{
		$session = array(
            'id' => "",
            'username' => "",
            'email' => "",
        );
        
        $this->session->set_userdata($session);
        $this->session->unset_userdata($session);
        $this->session->sess_destroy();

        redirect("home", "refresh");
	}

	public function artikel($id)
	{
		$data['artikel'] = $this->M_Home->join_artikel_penulis($id)->result_array();

		$data['tags'] = $this->M_Home->join_artikel_tags($id)->result_array();

		$this->db->select('komentar.*');
		$this->db->from('komentar');
		$this->db->where('id_artikel', $id);
		$this->db->order_by('tanggal_komentar', 'desc');
		$data['komentar'] = $this->db->get();

		$this->load->view('home/artikel', $data);
	}

	public function tambah_komentar()
	{
		$artikel = $this->input->post('artikel', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$website = $this->input->post('website', TRUE);
		$email = $this->input->post('email', TRUE);
		$komentar = $this->input->post('komentar', TRUE);
		$avatar = $this->input->post('avatar', TRUE);
		$judul = $this->input->post('judul', TRUE);

		// untuk tabel komentar
		$query = $this->db->get_where('artikel', array("id" => $artikel))->result_array();
		if ($query[0]['kategori'] == "Berita") {
			$penulis = NULL;
		} else {
			$penulis = $query[0]['id_penulis'];
		}

        // Check if user has javascript enabled
        if($this->input->post('ajax') != '1'){
            //redirect('cart'); // If javascript is not enabled, reload the page with new data
            } else { 
                if ($this->input->post('komentar', TRUE)) {
                    $data = array(
                    	'id_artikel' => $artikel,
                        'nama_komentator' => $nama,
                        'website_komentator' => $website,
                        'email_komentator' => $email,
                        'isi_komentar' => $komentar,
                        'avatar_komentator' => $avatar,
                        'tanggal_komentar' => date("Y-m-d H:i:s"),
                    );

                    $this->db->insert('komentar', $data);

                    $notif = array(
                    	"id_artikel" => $artikel,
                    	"dari_id" => $this->session->userdata('id'),
                    	"untuk_id" => $penulis,
                    	"isi_notifikasi" => "Ada komentar baru di artikel yang berjudul {$judul}. Cek artikel tersebut untuk melilhat lebih lanjut. <br><small><em>Klik (x) untuk menutup notifikasi ini.</em></small>",
                    	"tanggal_notifikasi" => date("Y-m-d H:i:s"),
                    	"status_notifikasi" => "Sent",
                    );

                    $this->db->insert('notifikasi', $notif);
                    	    
                    echo "true";
                } else {
                    echo 'false';
                }   
            }
	}

	public function search_tag($id)
	{
		$this->db->select('tags_artikel.id');
		$this->db->from('tags_artikel');
		$this->db->where('id_tags', $id);
		$num = $this->db->count_all_results();

		$this->load->library('pagination');
		$config['base_url'] = site_url('home/search_tag/'.$id);
		
		$config['total_rows'] = $num;
		$config['per_page'] = 4;
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;

		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = '</ul>';

		$config['num_tag_open']  = '<li>';
		$config['num_tag_close']  = '</li>';

		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['prev_link'] = 'Prev';
		$config['next_link'] = 'Next';

		$config['first_tag_open'] = "<li>";
		$config['first_tag_close'] = "</li>";
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';


		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = "<li class='current'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		
		$this->pagination->initialize($config);
		
		$data['links'] = $this->pagination->create_links();
		$data['value'] = $this->M_Home->search_tag($id, $config['per_page'], ($this->uri->segment(3)) ? $this->uri->segment(3) : 0);

		$this->load->view('home/search_tag', $data);
	}

	public function berita()
	{
		$this->db->select('artikel.id');
		$this->db->where('artikel.kategori', 'Berita');
		$this->db->from('artikel');
		$num = $this->db->count_all_results();

		$this->load->library('pagination');
		$config['base_url'] = site_url('home/berita');
		
		$config['total_rows'] = $num;
		$config['per_page'] = 4;
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;

		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = '</ul>';

		$config['num_tag_open']  = '<li>';
		$config['num_tag_close']  = '</li>';

		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['prev_link'] = 'Prev';
		$config['next_link'] = 'Next';

		$config['first_tag_open'] = "<li>";
		$config['first_tag_close'] = "</li>";
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';


		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = "<li class='current'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		
		$this->pagination->initialize($config);
		
		$data['links'] = $this->pagination->create_links();
		$data['value'] = $this->M_Home->join_berita_staf($config['per_page'], ($this->uri->segment(3)) ? $this->uri->segment(3) : 0);

		$this->load->view('home/berita', $data);
	}

	public function blog()
	{
		$this->db->select('artikel.id');
		$this->db->where('artikel.kategori', 'Blog');
		$this->db->where('artikel.status', 'Published');
		$this->db->from('artikel');
		$num = $this->db->count_all_results();

		$this->load->library('pagination');
		$config['base_url'] = site_url('home/blog');
		
		$config['total_rows'] = $num;
		$config['per_page'] = 4;
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;

		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = '</ul>';

		$config['num_tag_open']  = '<li>';
		$config['num_tag_close']  = '</li>';

		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['prev_link'] = 'Prev';
		$config['next_link'] = 'Next';

		$config['first_tag_open'] = "<li>";
		$config['first_tag_close'] = "</li>";
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';


		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = "<li class='current'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		
		$this->pagination->initialize($config);
		
		$data['links'] = $this->pagination->create_links();
		$data['value'] = $this->M_Home->join_blog_kontributor($config['per_page'], ($this->uri->segment(3)) ? $this->uri->segment(3) : 0);

		$this->load->view('home/blog', $data);
	}

	public function galeri()
	{
		$this->db->select('galeri.id_galeri');
		$this->db->from('galeri');
		$num = $this->db->count_all_results();

		$this->load->library('pagination');
		$config['base_url'] = site_url('home/galeri');
		
		$config['total_rows'] = $num;
		$config['per_page'] = 1;
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;

		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = '</ul>';

		$config['num_tag_open']  = '<li>';
		$config['num_tag_close']  = '</li>';

		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['prev_link'] = 'Prev';
		$config['next_link'] = 'Next';

		$config['first_tag_open'] = "<li>";
		$config['first_tag_close'] = "</li>";
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';


		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = "<li class='current'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		
		$this->pagination->initialize($config);
		
		$data['data2'] = $this->pagination->create_links();
		$data['data1'] = $this->M_Home->join_galeri_foto($config['per_page'], ($this->uri->segment(3)) ? $this->uri->segment(3) : 0);

		$this->load->view('home/galeri', $data);
	}

	public function profil($id)
	{
		$this->db->select('staf.*');
		$this->db->from('staf');
		$this->db->where('id_staf', $id);

		$data['profil'] = $this->db->get()->result_array();
		$this->load->view('home/profil', $data);
	}

	public function mengapa()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'mengapa');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function pendaftaran()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'pendaftaran');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function pendidikan()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'pendaftaran');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function kiprah()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'pendaftaran');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function sejarah()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'sejarah');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function visi()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'visi');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function filosofis()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'filosofis');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function kepengurusan()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'kepengurusan');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function kurikulum()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'kurikulum');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function smp()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'smp');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function sma()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'sma');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function smk()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'smk');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function pengajar()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'pengajar');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function rutinitas()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'rutinitas');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function pengasuhan()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'pengasuhan');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function pengajaran()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'pengajaran');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function bahasa()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'bahasa');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function ubudiyyah()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'ubudiyyah');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function scoring()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'scoring');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function aspa()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'aspa');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function aspi()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'aspi');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function sekolah()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'sekolah');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function fasilitas()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'fasilitas');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

	public function ekskul()
	{
		$this->db->select('halaman.*');
		$this->db->from('halaman');
		$this->db->where('halaman.alamat', 'ekskul');
		$data['halaman'] = $this->db->get()->result_array();

		$this->load->view('home/halaman', $data);
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */