<?php if(!defined('BASEPATH')) exit('No direct access is allowed');

class Faq_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }
	
	// GET RESULTS TO DISPLAY TO SITE VISITORS (QUESTIONS AND ANSWERS) APPROVED QUESTIONS ONLY
	function approvedQuestions() {
		$this->db->where('approved', '1');	
		$this->db->order_by('date', 'asc');
		$query = $this->db->get('faq');
		return $query->result();
	
	}	

	// LIST QUESTIONS FOR AWAITING REPLY - CHRONOLOGICAL ORDER 
	function awaitingReply() {
		$this->db->where('response', NULL);
		$this->db->where('approved', NULL);
		$this->db->order_by('date', 'desc');
		$query = $this->db->get('faq');
		return $query->result();
	}


	// LIST QUESTIONS FOR AWAITING REPLY - CHRONOLOGICAL ORDER 
	function awaitingApproval() {
	
//		$where = "response != 'NULL'";
		
		$this->db->where('approved', NULL);
		$this->db->where('response !=', 'NULL');
//		$this->db->where($where);
		$this->db->order_by('date', 'desc');
		$query = $this->db->get('faq');
		return $query->result();
	}


	function approveQuestion($faq_id) {
		
		$data = array(
			'approved' => '1'
			);
			
		$this->db->where('faq_id', $faq_id);
		$this->db->limit(1);
		$this->db->update('faq', $data);
	
	}

	
	function unapproveQuestion($faq_id) {
	
		$data = array(
			'approved' => NULL
			);
		$this->db->where('faq_id', $faq_id);
		$this->db->limit('1');
		$this->db->update('faq', $data);
	}


	function deleteQuestion($faq_id) {
		$this->db->where('faq_id', $faq_id);
		$this->db->limit(1);
		$this->db->delete('faq');
	}


	function addQuestion() {

		if ($this->input->post('user_comment') == '')
		{
			$data = array(
				'name'		=>	$this->input->post('name', TRUE),
				'email'		=>	$this->input->post('email', TRUE),
				'question'	=>	$this->input->post('question', TRUE)
				);			
			$this->db->insert('faq', $data);
		}

	}
	
	
	function questionAwaitingReply($faq_id) {		
		$this->db->where('faq_id', $faq_id);
		$query = $this->db->get('faq');
		return $query->result();	
	}


	function replyToQuestion() {
	
		$faq_id = $this->input->post('faq_id');
		
		$data = array(
			'name'		=>	$this->input->post('name'),
			'email'		=>	$this->input->post('email'),
			'question'	=>	$this->input->post('question'),
			'response'	=>	$this->input->post('response')
			);
		$this->db->where('faq_id', $faq_id);
		$this->db->limit('1');
		$this->db->update('faq', $data);
	
	}

	
	
}
