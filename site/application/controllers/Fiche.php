<?php

class Fiche extends CI_Controller {
	private $champsFiche=["Nom","Portrait","Couverture","SousTitre","Description","Citation", "Video", "template","nationnalite"];
	
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
        if(is_null($informationSheets)){
                $this->load->view('templates/header');
                echo "Aucune fiche n'a été trouvé";
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
        $this->form_validation->set_rules('Genre', 'Genre', 'required');
        $this->form_validation->set_rules('Description', 'Description', 'required');
		
		$data["genres"]=$this->ficheManager->get_genres();
		
		if($this->form_validation->run()){
			$dataFiche=$this->getDataFiche();
			if(!isset($data["problemes"]) || $data["problemes"]===""){ 
				if($ficheModifiee){
					echo "modifie fiche";
					$this->ficheManager->creation_fiche($dataFiche, $ficheModifiee);
				}else{
					echo "creation nouveau fiche";
					$this->ficheManager->creation_fiche($dataFiche);
				}
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
		 $config['upload_path']   = './'.$dir.'/'; 
		 switch($dir){
			 case "video":
				$config['allowed_types'] = 'mp4|ogg|mov'; 
				break;
			 case "musique":
				$config['allowed_types'] = 'mp3'; 
				break;
			 case "img":
				$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
				break;
		 }
         
         $config['max_size']      = 1000; 
         $config['max_width']     = 2000; 
         $config['max_height']    = 2000;  
         $this->load->library('upload', $config);
			
         if ( ! $this->upload->do_upload($inputName)) {
            $error = array('error' => $this->upload->display_errors()); 
			print_r($error);
			return false;
         }
			
         else { 
            $data = array('upload_data' => $this->upload->data()); 
			return $this->upload->data('file_name');
         } 

		
	}
	public function suppression($id_fiche){
		$this->ficheManager->supprime($id_fiche);
		$this->show();
	}
	public function getDataFiche(){
		
			$ficheData=array();
			foreach($this->champsFiche as $key){
				$ficheData[$key]=$this->input->post($key);
			}
			
			$fichiers=array("Video"=>"video", "Portrait"=>"img", "Couverture"=>"img");
			foreach($fichiers as $type=>$dir){
				if(isset($_FILES[$type]) && !empty($_FILES[$type]['name'])){
					$ficheData[$type]=$this->do_upload($type, $dir);
					if(!$ficheData[$type]) $data['problemes'] .= "<br/>Mauvaise extension pour le fichier ".$type;
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
			$dataFiche=array(
				"fiche"=>$ficheData,
				"fichegenre"=>$ficheGenre,
				"historique"=>$historique,
				"musique"=>$musique
			);
			
			return $dataFiche;
	}
	
	public function exportEpub($id_fiche){
		$fiche=$this->ficheManager->get_fiche($id_fiche);
		$test="Laura";
		$filename=base_url().'epubs/templates/'.$fiche->template.'.html';
		$handle=fopen($filename, 'rb');
		$template=fread($handle, 10000);
		fclose($handle);
		/*
		foreach($this->champsFiche as $champs){
			$template=str_replace("%".$champs."%", $fiche->$champs, $template);
		}*/
		foreach($fiche as $key=>$value){
			echo $key.'<br/>';
			if($key==="Historique"){
				$histo="";
				foreach($value as $disque){
					$histo.="<p><span class='dateDisque'>".$disque->DateHistorique."</span><span class='DescriptionHistorique'>".$disque->Description."</span></p>";
				} 
				$template=str_replace("%historique%", $histo, $template);
			}else{
				$template=str_replace("%".$key."%", $fiche->$key, $template);
			}
		}
		
		print_r($template);
		
		$directory=$this->checkDirectory();
		if(!copy(base_url()."img/".$fiche->Portrait, $directory.'/'.$fiche->Portrait)){ echo "probleme image";}else{echo "pade de PROBLEME";} ;
		copy(base_url()."img/".$fiche->Couverture, $directory.'/'.$fiche->Couverture);
		file_put_contents($directory.'/'.$fiche->ID.'.html', $template);
		
	}
	private function checkDirectory(){
		$dirname=$this->session->user->ID.$this->session->user->Nom;
		$filename=FCPATH.'epubs/'.$dirname.'/';

		if (!file_exists($filename)) {

			mkdir(FCPATH.'epubs/'. $dirname, 0777);
		} 
		return FCPATH.'epubs/'. $dirname;
	}
	

	
}

































