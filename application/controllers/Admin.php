<?php if(!defined('BASEPATH')) exit('No direct access is allowed');

class Admin extends CI_Controller {


	function __construct()
    {
        parent::__construct();
		
		if ($this->session->userdata('logged_in') != TRUE) 
		{
			$msg = '<div class="alert alert-danger">Identifiez-vous pour continuer</div>';
			$this->session->set_flashdata('message', $msg);
			redirect('login/index', 'refresh');
		} 

		$this->load->model('faq_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['page_title'] = 'Options';
		$data['include'] = 'admin/index';
		$this->load->view('template', $data);
	}
	

	public function saisir_ventes()
	{

		if ($this->input->post('submit'))
		{
			// Empty DB before inserting new values
			$this->db->where('vendu', 1)->delete('ventes');

			foreach ($_POST as $key => $value)
			{
				if ($key != 'submit')
				{
					if (substr($key,0,9) == "checkbox_")
	                {
	                    $num = str_replace("checkbox_","",$key);

	                    // Remove if exists
	                    $this->db->where('numero_velo', $num)->limit(1)->delete('ventes');
						
						// Insert value
						$data = array(
							'numero_velo' => $num,
							'vendu' => 1
							);
						$this->db->insert('ventes', $data);
					}

				}
			}

			$msg = '<div class="alert alert-success">Ventes enregistrées</div>';			
			$this->session->set_flashdata('message', $msg);
			redirect('admin/saisir_ventes', 'refresh');

		}

		$ventes = $this->db->select('numero_velo')->where('vendu', 1)->get('ventes')->result_array();
		$vdu = array();
		foreach ($ventes as $vendu)
		{
			$vdu[] = $vendu['numero_velo'];
		}

		$max = 1500;
		$output = array();
		for ($i = 1; $i <= $max; $i++)
		{
			if (in_array($i, $vdu))
			{
				$checked = 'checked="checked"';
			}
			else
			{
				$checked = NULL;
			}
			$output[] = '<div class="checkbox">
	  						<label>
	    						<input type="checkbox" '.$checked.' value="1" name="checkbox_'.$i.'">
	 	   						'.$i.'
	  						</label>
						</div>';
		}

		$this->load->library('table');
		$tmpl = array ('table_open' => '<table class="table table-striped">');
		$this->table->set_template($tmpl);
		$col_output = $this->table->make_columns($output, 10);

		$data['t_body'] = $this->table->generate($col_output);
		$data['page_title'] = 'Saisir Ventes';
		$data['include'] = 'admin/saisir_ventes';
		$this->load->view('template', $data);
	}


	
	function viewquestions() {
	

		
		$data['result1'] = $this->faq_model->awaitingReply();
		$data['result2'] = $this->faq_model->awaitingApproval();
		$data['result3'] = $this->faq_model->approvedQuestions();
		$data['page_title'] = 'F.A.Q. Management';
		$data['include'] = 'admin/listquestions';
		
		$this->load->view('template', $data);
	
	}
	
	
	function approvequestion($faq_id) {
	
		if ($faq_id > 0) {
			$this->faq_model->approveQuestion($faq_id);
			$this->session->set_flashdata('message', 'The question has been approved and displayed on the site');
			redirect('/admin/viewquestions', 'refresh');
		} else {
			$this->session->set_flashdata('message', 'An error occured, please contact the administrator');
			redirect('/admin/viewquestions', 'refresh');
		}
		
	}
	
	
	function unapprovequestion($faq_id) {
	
		if ($faq_id > 0) {
			$this->faq_model->unapproveQuestion($faq_id);
			$this->session->set_flashdata('message', 'The question has been unapproved');
			redirect('/admin/viewquestions', 'refresh');
		} else {
			$this->session->set_flashdata('message', 'An error occurred, please contact the administrator');
			redirect('/admin/viewquestions', 'refresh');
		}
		
	}
	
	
	
	function deletequestion($faq_id) {

		if ($faq_id > 0) {
			$this->faq_model->deleteQuestion($faq_id);
			$this->session->set_flashdata('message', 'The question was deleted successfully !');
			redirect('/admin/viewquestions', 'refresh');
		} else {
			$this->session->set_flashdata('message', 'An error has occurred, please contact the administrator');
			redirect('/admin/viewquestions', 'refresh');
		}
		
	}
	
	
	function replytoquestion($faq_id = NULL) {


		
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('question', 'Question', 'trim|required');
		$this->form_validation->set_rules('response', 'Response', 'trim|required');
		
		
			if ($this->form_validation->run() == FALSE) {
		
				$data['result'] = $this->faq_model->questionAwaitingReply($faq_id);
				$data['page_title'] = 'Reply to Question';
				$data['include'] = 'admin/replytoquestion';
				$this->load->view('template', $data);		
		
			} else {
			
				$this->faq_model->replyToQuestion();
				$this->session->set_flashdata('message', 'Your reply has been submitted');
				redirect('admin/viewquestions', 'refresh');

			}
	}
	
	
	function modifyArticle($rid = '')
	{
			$this->load->model('Mreglement');
			$this->load->library('form_validation');
		
			$this->form_validation->set_rules('artNo', 'Article Number', 'trim|required|numeric');
			$this->form_validation->set_rules('artName', 'Article Name', 'trim|required|max_length[150]');
			$this->form_validation->set_rules('artBody', 'Article Body', 'trim|required');

			if ($this->form_validation->run()) {
					$this->Mreglement->updateArticle();
					redirect('welcome/reglement', 'refresh');
			}
		
			if ($rid == NULL) 
			{ 
				$rid = $this->input->post('rid');
			}
			$data['article'] = $this->Mreglement->getSingleArticle($rid);
			$data['page_title'] = 'Modifier un Article';
			$data['include'] = '/admin/modifyarticle';
			$this->load->view('template', $data);
		
	}
	

}

