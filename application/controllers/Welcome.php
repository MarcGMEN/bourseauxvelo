<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	var $weekend_dates;

	function __construct()
    {
        parent::__construct();

		$this->weekend_dates['dates'] = '10 et 11 novembre 2018';
		$this->weekend_dates['samedi'] = 'samedi 10 novembre 2018';
		$this->weekend_dates['dimanche'] = 'dimanche 11 novembre 2017';

		$this->load->model('faq_model');
		$this->load->library('form_validation');
	}


	function index() {
	
		$data['include'] = 'accueil';
		$data['page_title'] = 'Bourse Aux Velos';
		$data['weekend_dates'] = $this->weekend_dates['dates'];
		$data['samedi'] = $this->weekend_dates['samedi'];
		$data['dimanche'] = $this->weekend_dates['dimanche'];
		$this->load->view('template', $data);
	}


	public function bav()
	{
		$data['include'] = 'bav';
		$data['page_title'] = 'Bourse Aux Velos';
		$data['weekend_dates'] = $this->weekend_dates['dates'];
		$data['samedi'] = $this->weekend_dates['samedi'];
		$data['dimanche'] = $this->weekend_dates['dimanche'];
		$this->load->view('template', $data);
	}


	function venir() {
	
		$data['include'] = 'venir';
		$data['page_title'] = 'Comment Venir ?';
		$this->load->view('template', $data);	
		
	}


	function animations() {
	
		$data['include'] = 'animations';
		$data['page_title'] = 'Animations';
		$this->load->view('template', $data);	
		
	}

	function reglement() {

		$data['include'] = 'reglement';
		$data['page_title'] = 'Reglement';
		$this->load->view('template', $data);	
		
	}
	

	public function ventes()
	{

		$this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');

		$this->form_validation->set_rules('numero_velo', 'Numéro de vélo', 'trim|required|numeric');

		if ($this->form_validation->run())
		{
			$numero_velo = $this->input->post('numero_velo');

			$query = $this->db->where('numero_velo', $numero_velo)->where('vendu', 1)->get('ventes');
			$vendu = $query->num_rows();

			if ($vendu == 1)
			{
				$message = '<div class="alert alert-success"><b>Votre vélo numéro '.$numero_velo.' a été vendu !</b> Rendez-vous à la soucoupe dès à présent pour retirer votre chèque/argent.
				<br />Munissez-vous de : 
				<ul>
					<li>Votre reçu vendeur</li>
					<li>La pièce d\'identité utilisée lors de l\'inscription</li>
					<li>Le montant de la commission due (10% du prix de vente)</li>
				</ul></div>';
			}
			else
			{
				$message = '<div class="alert alert-danger"><b>Votre vélo numéro '.$numero_velo.' n\'a pas encore été vendu. Veuillez re-essayer ultérieurement.</b></div>';
			}


			$this->session->set_flashdata('message', $message);
			redirect('welcome/ventes', 'refresh');


		}

		// Get latest update (mise_a_jour)
		$result = $this->db->select_max('mise_a_jour')->get('ventes')->row_array();
		if ($result['mise_a_jour'] == '')
		{
			$maj = 'non rensigné';
		}
		else
		{
			$maj = date('d-m-Y H:i', strtotime($result['mise_a_jour']));
		}
		$data['mise_a_jour'] = $maj;

		$data['include'] = 'ventes';
		$data['page_title'] = 'Ventes en direct';
		$this->load->view('template', $data);		
	}

	
	function article_exists($value) {
		
			$this->db->where('artNo', $value);
			$query = $this->db->get('reglement');
			
			if ($query->num_rows() > 0)
			{
				$this->form_validation->set_message('article_exists', 'Cet article existe déjà');
				return FALSE;
			} 
			else
			{
				return TRUE;
			}
		
		
	}

	function faq() 
	{
		$this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
		$this->form_validation->set_rules('name', 'Nom', 'trim|required|strip_tags');
		$this->form_validation->set_rules('email', 'Mail', 'trim|required|valid_email');
		$this->form_validation->set_rules('question', 'Question', 'trim|required|strip_tags');

		if ($this->form_validation->run()) 
		{
			$this->faq_model->addQuestion();
			
			$this->load->library('email');
			$this->email
				->from('bourseauxvelos@avs44.com', 'Bourse Aux Velos')
				->to('avs.vtt@gmail.com', 'AVS44 Administrator')
				->subject('New FAQ Question')
				->message('A new question has been submitted, click the link to submit a reply : http://avs44.com/bourseauxvelos/login/index')
				->send();
				
			$this->session->set_flashdata('message', 'Merci, nous vous répondrons dans les plus brefs délais');
			redirect('welcome/faq', 'refresh');
		}

		$data['faq'] = $this->faq_model->approvedQuestions();
		$data['include'] = 'faq';
		$data['page_title'] = 'F.A.Q.';
		$this->load->view('template', $data);
	}


	function check_blank($data)
	{
		if (empty($data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	function statistiques() {
	
		$data['include'] = 'statistiques';
		$data['page_title'] = 'Statistiques';
		$this->load->view('template', $data);
		
	}

	
	function presse() {
		
		$data['include'] = 'presse';
		$data['page_title'] = 'Presse';
		$this->load->view('template', $data);
		
	}


	function telechargements() {
	
		$data['include'] = 'telechargements';
		$data['page_title'] = 'Téléchargements';
		$this->load->view('template', $data);	
		
	}


	function contact()
	{
			$data['page_title'] = 'Contact';
			$data['include'] = 'contact';
			$this->load->view('template', $data);
	}

}
