<?php

class Fiche extends CI_Controller {
	private $champsFiche=["Nom","Portrait","Couverture","SousTitre","Description","Citation"];
	public function creation(){
		$this->load->helper('url', 'form');
		 $this->load->library('form_validation');
			if(!isset($this->session->user)){
				redirect("login/view");
			};
		
		
        $this->form_validation->set_rules('Nom', 'Nom', 'required');
        $this->form_validation->set_rules('Genre', 'Genre', 'required');
        $this->form_validation->set_rules('Description', 'Description', 'required');
		$this->load->model('fiche_model','ficheManager');
		
		if($this->form_validation->run()){
			$fiche=array();
			foreach($this->champsFiche as $key){
				$fiche[$key]=$this->input->post($key);
			}
			$fiche["Video"]=$this->getFile("Video", "video");
			$fiche["Portrait"]=$this->getFile("Portrait", 'img');
			$fiche["Couverture"]=$this->getFile("Couverture", 'img');

			$ficheGenre=$this->input->post('Genre');
	
			$historique=array();
			$dates=$this->input->post('dateHisto');
			$descriptions=$this->input->post('descriptionHisto');
			for($i=0; $i<count($dates);$i++){
				$newHisto=array(
					'DateHistorique'=>$dates[$i],
					'Description'=>$descriptions[$i]
				);
				array_push($historique,$newHisto);
			}
			
			
			$this->ficheManager->creation_fiche($fiche, $ficheGenre,$historique);
			$this->load->view('templates/header');
			$this->load->view('pages/fiche_cree');
			$this->load->view('templates/footer');
		}else{
			$data["genres"]=$this->ficheManager->get_genres();
			$this->load->view('templates/header');
			$this->load->view('forms/fiche',$data);
			$this->load->view('templates/footer');
		}
	}
	
	private function getFile($inputName, $dir){
		if(isset($_FILES[$inputName])) return $_FILES[$inputName]['name'];
		return false;
	}

	
}