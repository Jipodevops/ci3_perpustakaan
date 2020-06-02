<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //memanggil model
        $this->load->model(array('login_model'));
    }

	public function index() {
		//mengarahkan ke function read
        $this->login_user();
	}

	public function login_user() {
		
		//memanggil fungsi login submit	(agar di view tidak dilihat fungsi login submit)
		$this->login_submit();

		//mengirim data ke view
		$output = array(
						'judul' => 'Masuk - SISPER 1.0(beta)'
					);
		//memanggil file view
		$this->load->view('login', $output);
	}

	private function login_submit() {
		
		//proses jika tombol login di submit
		if($this->input->post('submit') == 'Masuk') {

			//aturan validasi input login
			$this->form_validation->set_rules('username', 'Username', 'required|alpha|callback_login_check');
			$this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric|min_length[5]');

			//jika validasi sukses 
			if ($this->form_validation->run() == TRUE) {

				//redirect ke mahasiswa (bisa dirubah ke controller & fungsi manapun)
				redirect('dashboard');
			} 

		}
	}

	public function login_check() {
		//menangkap data input dari view
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		//check username & password sesuai dengan di database
        $data_login = $this->login_model->read_single($username);
    
        $psw_check = $data_login['psw'];
        $psw_decrypt = $this->encryption->decrypt($psw_check);

        if ($password == $psw_decrypt) {
			$this->session->set_userdata('id_petugas', $data_login['id_petugas']);
			$this->session->set_userdata('nama', $data_login['nama']);


			return TRUE;

		//jika tidak cocok : dikembalikan ke fungsi login_submit (validasi gagal)
		} else {

			//membuat pesan error
			$this->form_validation->set_message('login_check', 'Username & password tidak tepat');

			
			return FALSE;

		}
	}

	public function reset_password() {
		
		//memanggil fungsi login submit	(agar di view tidak dilihat fungsi login submit)
		$this->reset_password_submit();

		//mengirim data ke view
		$output = array(
						'theme_page' => 'change_pass',
						'judul' => 'Reset Password'
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	private function reset_password_submit(){
		if($this->input->post('submit') == 'Simpan') {

			//aturan validasi input login
			$this->form_validation->set_rules('password', 'Password Lama', 'required|alpha_numeric|min_length[5]|callback_reset_password_check');
			$this->form_validation->set_rules('passwordbaru', 'Password Baru', 'required|alpha_numeric|min_length[5]|differs[password]');
			$this->form_validation->set_rules('passconf', 'Ulangi Password Baru', 'required|matches[passwordbaru]');
			


			//jika validasi sukses 
			if ($this->form_validation->run() == TRUE) {
				$id = $this->session->userdata('id_petugas');
				$passwordbaru = $this->input->post('passwordbaru');
				$password_encrypt = $this->encryption->encrypt($passwordbaru);
				$input =  array(
						'psw' => $password_encrypt, 
					);
				 $this->login_model->update($input, $id);

				 echo '<script>alert("Change Password Has Been Successfull!");</script>';
                 
				redirect('dashboard', 'refresh');
			} 
			

		}
	}

	public function reset_password_check() {
		//menangkap data input dari view
		$id = $this->session->userdata('id_petugas');
		$password = $this->input->post('password');

		//mengambil password sesuai username
		$data_login = $this->login_model->read_single_reset($id);


        //password dari database
        $psw = $data_login['psw'];
		$passdec = $this->encryption->decrypt($psw);

		if($password == $passdec) {


			return TRUE;

		//jika password tidak cocok : dikembalikan ke fungsi login_submit (validasi gagal)
		} else {

			//membuat pesan error
			$this->form_validation->set_message('reset_password_check', 'password tidak tepat');
			
			return FALSE;

		}
	}

	public function logout() {

		//hapus session user
		$this->session->unset_userdata('id');
        $this->session->unset_userdata('nama');
        $this->session->sess_destroy();

		//mengembalikan halaman ke function read
		redirect('login');
	}
}