<?php

class Fiche extends CI_Controller {
	private $champsFiche=["Nom","Portrait","Couverture","SousTitre","Description","Citation"];
	public function creation(){
		$data['problemes']="";
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
			
			$fichiers=array("Video"=>"video", "Portrait"=>"img", "Couverture"=>"img");
			foreach($fichiers as $type=>$dir){
				if(isset($_FILES[$type]) && !empty($_FILES[$type]['name'])){
					$fiche[$type]=$this->do_upload($type, $dir);
					if(!$fiche[$type]) $data['problemes'] .= "<br/>Mauvaise extension pour le fichier ".$type;
				}
			}
			 

			$ficheGenre=$this->input->post('Genre');
	
			$historique=array();
			$dates=$this->input->post('dateHisto');
			if(count($dates)>0){
				$descriptions=$this->input->post('descriptionHisto');
				for($i=0; $i<count($dates);$i++){
					$newHisto=array(
						'DateHistorique'=>$dates[$i], 
						'Description'=>$descriptions[$i]
					);
					array_push($historique,$newHisto);
				}
			}
			$musique=null;
			if(isset($_FILES["Musique"]) && !empty($_FILES["Musique"]['name'])){
				$musique=array(
					"Nom"=>$this->input->post("nomMusique"),
					"Chemin"=>$this->do_upload("Musique", "musique")
				);
				if(!$musique["Chemin"]) $data["problemes"].="<br/>Mauvaise extension pour le fichier Musique.";
			}
			if(!isset($data["problemes"]) && $data["problemes"]==="") $this->ficheManager->creation_fiche($fiche, $ficheGenre,$historique, $musique);
			$this->load->view('templates/header');
			$this->load->view('pages/fiche_cree', $data);
			$this->load->view('templates/footer');
		}else{
			$data["genres"]=$this->ficheManager->get_genres();
			$this->load->view('templates/header');
			$this->load->view('forms/fiche',$data);
			$this->load->view('templates/footer');
		}
	}
	
	private function do_upload($inputName, $dir){
		 $config['upload_path']   = './'.$dir.'/'; 
		 switch($dir){
			 case "video":
				$config['allowed_types'] = 'mp4|ogg|mov'; 
				break;
			 case "musique":
				$config['allowed_types'] = 'mp3'; 
				break;
			 case "img":
				$config['allowed_types'] = 'gif|jpg|png'; 
				break;
		 }
         
         $config['max_size']      = 100; 
         $config['max_width']     = 1024; 
         $config['max_height']    = 768;  
         $this->load->library('upload', $config);
			
         if ( ! $this->upload->do_upload($inputName)) {
            $error = array('error' => $this->upload->display_errors()); 
			return false;
            //$this->load->view('forms/fiche', $error); 
         }
			
         else { 
            $data = array('upload_data' => $this->upload->data()); 
			return $this->upload->data('file_name');
            //$this->load->view('upload_success', $data); 
         } 
		 
		/*
		$filename = $_FILES[$inputName]['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		switch($dir){
			case "video":
				$allowed =  array('mp4', 'ogg', 'mov');
				break;
			case "musique":
				$allowed =  array('mp3');
				break;
			default : $allowed=array("jpg", "jpeg", "gif", "png");
		}
		
		if(!in_array($ext,$allowed) ) return false;
		$uploaddir = base_url().$dir.'/';
		$uploadfile = $uploaddir . basename($filename);
		if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $uploadfile)) {
			echo "oui ".$uploaddir;
			return $filename;
		}else{
			echo "non ".$uploaddir;
			return false;
		}*/
		
	}

	
}