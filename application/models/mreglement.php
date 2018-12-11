<?php if(!defined('BASEPATH')) exit('No direct access is allowed');

class Mreglement extends Model {


	function Mreglement() {
	
		parent::Model();
	
	}
	

	function getReglement() {
	
			$this->db->order_by('artNo', 'asc');
			$query = $this->db->get('reglement');
			return $query->result();
		
	}
	
	
	function addArticle() {
	
			$data = array(
				'artNo' => $this->input->post('artNo'),
				'artName' => $this->input->post('artName'),
				'artBody' => $this->input->post('artBody')
				);
				
			$this->db->insert('reglement', $data);
		
	}



	function getSingleArticle($rid)
	{
			$this->db->where('rid', $rid);
			$this->db->limit(1);
			$query = $this->db->get('reglement');
			return $query->result();
	}


	function updateArticle()
	{
			$data = array(
				'artNo' => $this->input->post('artNo'),
				'artName' => $this->input->post('artName'),
				'artBody' => $this->input->post('artBody')
				);
			$this->db->where('rid', $this->input->post('rid'));	
			$this->db->update('reglement', $data);		
	}	


}
