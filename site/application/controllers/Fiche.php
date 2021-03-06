<?php

class Fiche extends CI_Controller {
	private $champsFiche=["Nom","Portrait","Couverture","SousTitre","Description","Citation", "template","nationnalite"];
	
	public function __construct(){
        parent::__construct();
		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
		if(!isset($this->session->user)){
			redirect("login/view");
		};
		$this->load->model('InformationSheet_model','ficheManager');
		
    }
	public function show(){
        $informationSheets = $this->ficheManager->getAllSheetsByUser($this->session->user->ID);

        if(is_null($informationSheets) || empty($informationSheets)){
				$data['type']="fiche";
                $this->load->view('templates/header');
                $this->load->view('pages/nothing',$data);
                $this->load->view('templates/footer');
        }
        else{
            $data['InformationSheets'] = $this->ficheManager->getFormatedSheetsList($informationSheets);
            $this->load->view('templates/header');
            $this->load->view('pages/informationSheetSlider',$data);
            $this->load->view('templates/footer');
        }
        
    }
	
	public function creation($ficheModifiee=null){
		$data['fiche']=$ficheModifiee;
		$data['problemes']="";
		
		
        $this->form_validation->set_rules('Nom', 'Nom', 'required');
        $this->form_validation->set_rules('Description', 'Description', 'required');
		
		$data["genres"]=$this->ficheManager->get_genres();
		
		if($this->form_validation->run()){
			$dataFiche=$this->getDataFiche($ficheModifiee!=null);
			if($ficheModifiee){
				$this->ficheManager->creation_fiche($dataFiche, $ficheModifiee->ID);
			}else{
				$this->ficheManager->creation_fiche($dataFiche);
			}
			$this->load->view('templates/header');
			$this->load->view('pages/fiche_cree', $data);
			$this->load->view('templates/footer');
		}else{
			$this->load->view('templates/header');
			$this->load->view('forms/fiche',$data);
			$this->load->view('templates/footer');
		}
	}
	
	public function modification($id){
		$ficheModifiee=$this->ficheManager->get_fiche($id);
		$this->creation($ficheModifiee);
	}
	
	private function do_upload($inputName, $dir){

			$config['upload_path']   = './uploads/'; 
			$config['allowed_types'] = 'gif|jpg|png|jpeg|mp4|ogg|mov|mp3|JPG'; 
			$config['max_size']      = 10000; 
			$config['max_width']     = 4000; 
			$config['max_height']    = 4000;  

			$this->load->library('upload', $config);
				
			 if ( $this->upload->do_upload($inputName)) {

				$data = array('upload_data' => $this->upload->data()); 
				return $this->upload->data('file_name');
	
			}
			return false;					
	}
	public function suppression($id_fiche){
		$fiche=$this->ficheManager->get_fiche($id_fiche);
		if($fiche->Portrait !=="defaultPortrait.jpg" && file_exists("./uploads/".$fiche->Portrait)) unlink("./uploads/".$fiche->Portrait);
		if($fiche->Couverture !=="defaultCouverture.jpg" && file_exists("./uploads/".$fiche->Couverture)) unlink("./uploads/".$fiche->Couverture);
		if($fiche->Video !=="" && $fiche->Video !==null && file_exists("./uploads/".$fiche->Video)) unlink("./uploads/".$fiche->Video);

		$this->ficheManager->supprime($id_fiche);
		redirect("fiche/show");
		$this->show();
	}
	public function getDataFiche($modif){
		
			$ficheData=array();
			foreach($this->champsFiche as $key){
				$ficheData[$key]=$this->input->post($key);
			}

			if(isset($_FILES["Video"]) && !empty($_FILES["Video"]["name"])){
				$ficheData["Video"]=$this->do_upload("Video", "video");
			}
			
			if(isset($_FILES["Portrait"]) && !empty($_FILES["Portrait"]["name"])){
				 $ficheData["Portrait"]=$this->do_upload("Portrait", "img");
			}
			if(!$modif && !$ficheData["Portrait"]) $ficheData["Portrait"]="defaultPortrait.jpg";
			
			
			if(isset($_FILES["Couverture"]) && !empty($_FILES["Couverture"]["name"])){ 
				$ficheData["Couverture"]=$this->do_upload("Couverture", "img");
			}
			if(!$modif && !$ficheData["Couverture"]) $ficheData["Couverture"]="defaultCouverture.jpg";
				 

			$ficheGenre= empty($this->input->post('Genre')) ? 1 : $this->input->post('Genre');
	
			$historique=array();
			$dates= $this->input->post('dateHisto');
	
			if( $dates !=null && count($dates)>0){
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
			for($i=0;$i<3;$i++){
				if(isset($_FILES["mp3Musique".$i]) && !empty($_FILES["mp3Musique".$i]['name'])){
					$nom = empty($this->input->post("nomMusique".$i)) ? "Morceau ".$i+1 : $this->input->post("nomMusique".$i);
					$image= "defaultMusique.jpg";
					$musique=array(
						"Nom"=> $nom,
						"Chemin"=>$this->do_upload("mp3Musique".$i, "musique"),
						"Image"=>$image
					);
				}
			}
			
			$dataFiche=array(
				"fiche"=>$ficheData,
				"fichegenre"=>$ficheGenre,
				"historique"=>$historique,
				"musique"=>$musique
			);
			
			return $dataFiche;
	}
	
	

	
}

































