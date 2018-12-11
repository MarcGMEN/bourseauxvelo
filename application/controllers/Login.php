<?php if(!defined('BASEPATH')) exit('No direct access is allowed');

class Login extends CI_Controller {


	function __construct()
	{
        parent::__construct();
	}
	

	function index() {

		$siteadminun = 'admin';
		$siteadminpw = '7b3ubfg';

		if ($this->input->post('submit')) {

			$un = $this->input->post('username');
			$pw = $this->input->post('password');
			
			if ($un == $siteadminun && $pw == $siteadminpw) 
			{
				$this->session->set_userdata('logged_in', TRUE);
				$msg = '<div class="alert alert-success">Vous êtes connecté</div>';
				$this->session->set_flashdata('message', $msg);
				redirect('admin/index', 'refresh');
			} 
			else 
			{
				$msg = '<div class="alert alert-danger">Identifiez-vous pour continuer</div>';
				$this->session->set_flashdata('message', $msg);
				redirect('login/index', 'refresh');
			}
		} 
		$data['include'] = 'login';
		$data['page_title'] = 'Connexion';
		$this->load->view('template', $data);
	
		
		
	// redirect('/admin/viewquestions', 'refresh');
	}
	

	function logout() 
	{
		$this->session->unset_userdata('logged_in');
		redirect('welcome/index', 'refresh');
	}
	
	
}
