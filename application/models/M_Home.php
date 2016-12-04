<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Home extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function berita_index()// homepage
	{
		$this->db->select('artikel.*, staf.username');
		$this->db->from('artikel');
		$this->db->where('artikel.kategori', 'Berita');

		$this->db->join('staf', 'artikel.id_penulis = staf.id_staf', 'left');

		$this->db->limit(3, 0);
		$this->db->order_by('tanggal', 'desc');

		return $this->db->get();
	}

	public function join_artikel_tags($id)// data tags pada halaman artikel yang spesifik
	{
		$this->db->select('tags_artikel.*, artikel.id, tags.*');
		$this->db->from('artikel');
		$this->db->where('artikel.id', $id);

		$this->db->join('tags_artikel', 'tags_artikel.id_artikel = artikel.id', 'left');
		$this->db->join('tags', 'tags_artikel.id_tags = tags.id', 'left');

		$query = $this->db->get();

		return $query;
	}

	public function join_tags_artikel()
	{
		$this->db->select('tags_artikel.*, artikel.id, tags.*');
		$this->db->from('artikel');

		$this->db->join('tags_artikel', 'tags_artikel.id_artikel = artikel.id', 'left');
		$this->db->join('tags', 'tags_artikel.id_tags = tags.id', 'left');

		$query = $this->db->get();

		return $query;
	}

	public function join_artikel_admin()// tabel daftar artikel untuk halaman admin
	{
		$this->db->select('artikel.id, artikel.judul, artikel.tanggal, staf.username', FALSE);
		$this->db->from('artikel');
		$this->db->where('artikel.kategori', 'Berita');

		$this->db->join('staf', 'staf.id_staf = artikel.id_penulis', 'left');

		return $this->db->get();
	}

	public function join_artikel_penulis($id)// halaman artikel
	{
		$this->db->select('artikel.*, staf.username', FALSE);
		$this->db->from('artikel');
		$this->db->where('artikel.id', $id);

		$this->db->join('staf', 'staf.id_staf = artikel.id_penulis', 'left');

		return $this->db->get();
	}

	public function join_berita_staf($limit, $offset)// halaman daftar berita
	{
		$this->db->select('artikel.*, staf.username');
		$this->db->from('artikel');
		$this->db->where('artikel.kategori', 'Berita');

		$this->db->join('staf', 'artikel.id_penulis = staf.id_staf', 'left');

		$this->db->order_by('tanggal', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get();
	}

	public function join_blog_kontributor($limit, $offset)// halaman daftar blog
	{
		$this->db->select('artikel.*, staf.username');
		$this->db->from('artikel');
		$this->db->where('artikel.kategori', 'Blog');
		$this->db->where('artikel.status', 'Published');

		$this->db->join('staf', 'artikel.id_penulis = staf.id_staf', 'left');

		$this->db->order_by('tanggal', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get();
	}

	public function search_tag($id)// untuk mencari artikel berdasarkan tag
	{
		$this->db->select('artikel.*, tags_artikel.*, tags.*, staf.username');
		$this->db->from('tags_artikel');
		$this->db->where('tags_artikel.id_tags', $id);

		$this->db->join('artikel', 'artikel.id = tags_artikel.id_artikel', 'left');
		$this->db->join('tags', 'tags.id = tags_artikel.id_tags', 'left');
		$this->db->join('staf', 'staf.id_staf = artikel.id_penulis', 'left');

		$this->db->order_by('tanggal', 'desc');
		return $this->db->get();
	}

	public function join_galeri_foto($limit, $offset)
	{
		$this->db->select('galeri.*');
		$this->db->from('galeri');
		$this->db->order_by('tanggal_galeri', 'desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();

		$sql = array();
		foreach ($query->result_array() as $value) {
			$this->db->select('galeri.*, foto_galeri.*');
			$this->db->from('galeri');
			$this->db->where('galeri.id_galeri', $value["id_galeri"]);

			$this->db->join('foto_galeri', 'galeri.id_galeri = foto_galeri.id_galeri', 'left');
			$sql[] = $this->db->get()->result_array();
		}
		return $sql;
	}

	public function join_galeri_staf()
	{
		$this->db->select('galeri.*, staf.nama');
		$this->db->from('galeri');

		$this->db->join('staf', 'staf.id_staf = galeri.id_pengunggah', 'left');

		return $this->db->get();
	}

	public function join_notifikasi_kontributor($id, $limit, $offset)
	{
		$this->db->select('notifikasi.*, staf.username');
		$this->db->from('notifikasi');
		$this->db->where('notifikasi.untuk_id', $id);
		$this->db->where('notifikasi.status_notifikasi', 'Sent');
		$this->db->limit($limit, $offset);

		$this->db->join('staf', 'notifikasi.dari_id = staf.id_staf', 'left');

		return $this->db->get()->result_array();
	}

	public function join_notifikasi_admin($limit, $offset)
	{
		$this->db->select('notifikasi.*, staf.username');
		$this->db->from('notifikasi');
		$this->db->where('notifikasi.untuk_id', NULL);
		$this->db->where('notifikasi.status_notifikasi', 'Sent');
		$this->db->limit($limit, $offset);

		$this->db->join('staf', 'notifikasi.dari_id = staf.id_staf', 'left');

		return $this->db->get()->result_array();
	}

	public function join_komentar_penulis_artikel($id)// menampilkan jumlah komentar pada artikel-artikel yang ditulis oleh kontributor di halaman dashboard
	{
		$this->db->select('komentar.id_artikel, artikel.id_penulis');
		$this->db->from('komentar');

		$this->db->join('artikel', 'artikel.id = komentar.id_artikel', 'left');

		$this->db->where('artikel.id_penulis', $id);
		return $this->db->get();
	}

}

/* End of file M_Home.php */
/* Location: ./application/models/M_Home.php */