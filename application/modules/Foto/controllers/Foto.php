<?php

class Foto extends Back_controller {

	function __construct() {

		parent::__construct();
		$this->load->model('Mfoto', 'mdl');
		$cek = $this->session->userdata('hak_akses');
		if(!($cek)) {
			redirect('Bengkeldata');
		}

	}

	function index() {

		$data_array = array();

		$data_array['data'] = $this->mdl->get_data();

		$title = "Foto";
		$subtitle = "foto";
		$content = $this->load->view('list.php', $data_array, true);

		$this->load_content($title, $subtitle, $content);

	}

	function add($id) {

		$data_array = array();
		$data_array['id_kategori_foto'] = $id;
		$data_array['ketegori_foto'] = $this->mdl->get_kategori_foto_($id);

		$title = "Tambah Foto";
		$subtitle = "foto";
		$content = $this->load->view('add.php', $data_array, true);

		$this->load_content($title, $subtitle, $content);

	}

	function edit($id, $id2) {

		$data_array = array();

		$data_array['data']	= $this->mdl->cek_data($id);
		$data_array['id_kategori_foto'] = $id2;
		$data_array['ketegori_foto'] = $this->mdl->get_kategori_foto_($id2);

		$title = "Edit Foto";
		$subtitle = "foto";
		$content = $this->load->view('edit.php', $data_array, true);

		$this->load_content($title, $subtitle, $content);

	}

	function insert() {

		$post = $this->input->post();

		$query = $this->mdl->insert_data($post);

		$query == true ? $this->alert_info('Berhasil Tambah Data') : $this->alert_error('Gagal Tambah Data');

		redirect('Foto/add/'.$post['id_kategori_foto']);

	}

	function update() {

		$post = $this->input->post();

		$query = $this->mdl->update_data($post, $post['id']);

		$query == true ? $this->alert_info('Berhasil Ubah Data') : $this->alert_error('Gagal Ubah Data');

		redirect('Foto/add/'.$post['id_kategori_foto']);

	}

	function hapus($id, $id2) {

		$query = $this->mdl->delete_data($id);

		$query == true ? $this->alert_info('Berhasil Hapus Data') : $this->alert_error('Gagal Hapus Data');

		redirect('Foto/add/'.$id2);

	}

}
