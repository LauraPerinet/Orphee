<?php 
class Ouvrage extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
		if(!isset($this->session->user)){
			redirect("login/view");
		};
		$this->load->model('book_model','bookManager');
		$this->load->model('InformationSheet_model','sheetManager');
	}
	
	public function show(){
		$books = $this->bookManager->getAllBooks();

        if(is_null($books) || empty($books)){
				$data['type']="ouvrage";
                $this->load->view('templates/header');
                $this->load->view('pages/nothing',$data);
                $this->load->view('templates/footer');
        }
        else{
			$data["books"]=$books;
            $this->load->view('templates/header');
            $this->load->view('pages/displayBooks',$data);
            $this->load->view('templates/footer');
        }
	}
	public function export_reussit($data){
		$this->load->view('templates/header');
        $this->load->view('pages/export_ok',$data);
        $this->load->view('templates/footer');
	}
	public function suppression($id=null){
		if($id) $this->bookManager->deleteBook($id);
		redirect("ouvrage/show");
	}
	
	public function creation($id=null){
		$this->form_validation->set_rules('title', 'Title', 'required');
		$data=array();
		if($this->form_validation->run()){
			$id=$this->bookManager->createBook($this->getDataBook(), $id);
			redirect("ouvrage/completerOuvrage/".$id);
		}else{
			if($id) $data['book']=$this->bookManager->getBook($id);
			$this->load->view('templates/header');
			$this->load->view('forms/book', $data);
			$this->load->view('templates/footer');
		}
	}
	
	public function modification($id){
		$this->creation($id);
	}
	public function completerOuvrage($id){
		
		$this->load->view('templates/header');
		if($this->form_validation->run()){
			redirect("pages/merci");
		}else{
			$data['book']=$this->bookManager->getBook($id);
			$data['sheets']=$this->sheetManager->getAllSheetsByUser($this->session->user->ID);
			
			foreach($data['book']->fiches as $sheet){
				for($i=0; $i<count($data["sheets"]); $i++){
					if($sheet->ID==$data["sheets"][$i]['ID']){
						array_splice($data["sheets"], $i,1);
					}
				}
			}
			$this->load->view('forms/sheetsinBook', $data);
			$this->load->view('forms/menu_book', $data);
		}
		$this->load->view('templates/footer');
		
	}
	private function getDataBook(){
		$data=array(
			"Nom"=>$this->input->post("title"),
			"Auteur"=>$this->input->post("author"),
			"imagecouverture"=>$this->do_upload(),
			"DateCreation"=>date("Y-m-d"),
			"ID_utilisateur"=>$this->session->user->ID
		);
		return $data;
	}
	private function do_upload(){
		$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
		 $config['upload_path']   = './img/'; 
         $config['max_size']      = 1000; 
         $config['max_width']     = 2000; 
         $config['max_height']    = 2000;  
         $this->load->library('upload', $config);
			
         if ( ! $this->upload->do_upload("imagecouverture")) {
            $error = array('error' => $this->upload->display_errors()); 

			return false;
         }else { 
            $data = array('upload_data' => $this->upload->data()); 
			return $this->upload->data('file_name');
         } 

		
	}
	public function deleteSheet($id_book=null, $id_sheet=null){
		if($id_book && $id_sheet) $this->bookManager->deleteSheet($id_book, $id_sheet);
		redirect("ouvrage/completerOuvrage/".$id_book);
	}
	public function addSheet($id_book=null, $id_sheet=null){
		if($id_book && $id_sheet) $this->bookManager->addSheet($id_book, $id_sheet, count($this->bookManager->getBook($id_book)->fiches));
		redirect("ouvrage/completerOuvrage/".$id_book);
	}
	
	public function moveSheet($id_book=null, $id_sheet=null, $sens){
		$this->bookManager->changePage($id_book, $id_sheet, $sens);
		redirect("ouvrage/completerOuvrage/".$id_book);
	}
	public function export($id){
		$book=$this->bookManager->getBook($id);
		$directory=$this->checkDirectory($book->ID);
		$data["export"]="";
		$summary=array();
		foreach($book->fiches as $sheet){
			$data["export"].=$this->exportSheet($sheet->ID, $directory);
			array_push($summary, array("ID"=>$sheet->ID, "Nom"=>$sheet->Nom));
		}
		$data["export"].=$this->exportCouv($book, $directory);
		$data["export"].=$this->exportSummary($summary, $directory);
		$data['export'].=$this->exportParams($book, $directory);
		$this->export_reussit($data);
	}
	private function exportSheet($id_fiche, $directory){
		$data="";
		$fiche=$this->sheetManager->get_fiche($id_fiche);
		$filename=base_url().'epubs/templates/'.$fiche->template.'.html';
		$handle=fopen($filename, 'rb');
		$template=fread($handle, 10000);
		fclose($handle);
		foreach($fiche as $key=>$value){
			if($key==="Historique"){
				$histo="";
				foreach($value as $disque){
					$histo.="<p><span class='dateDisque'>".$disque->DateHistorique."</span> • <span class='DescriptionHistorique'>".$disque->Description."</span></p>";
				} 
				$template=str_replace("%historique%", $histo, $template);
			}else{
				$template=str_replace("%".$key."%", $fiche->$key, $template);
			}
		}
		
		if(!copy(base_url()."img/".$fiche->Portrait, $directory.'/'.$fiche->Portrait)){ $data.=$fiche->Nom." n'a pas d'image Portrait !<br/><br/>";} ;
		if(!copy(base_url()."img/".$fiche->Couverture, $directory.'/'.$fiche->Couverture)){$data.=$fiche->Nom." n'a pas d'image de couverture !<br/><br/>";} ;
		file_put_contents($directory.'/'.$fiche->ID.'.html', $template);
		if (!file_exists($directory.'/'.$fiche->template.'.css')) {
			if(!copy(base_url().'epubs/templates/'.$fiche->template.'.css', $directory.'/'.$fiche->template.'.css')){ echo "<br/><br/>Probleme CSS<br/><br/>";};}
		return $data;
	}
	private function exportCouv($book, $directory){
		$data="";
		$filename=base_url().'epubs/templates/couv.html';
		$handle=fopen($filename, 'rb');
		$template=fread($handle, 10000);
		fclose($handle);
		foreach($book as $key=>$value){
			if($key!="fiches") $template=str_replace("%".$key."%", $book->$key, $template);
		}
		
		if(!copy(base_url()."img/".$book->imagecouverture, $directory.'/'.$book->imagecouverture)){ 
			$data.="La couverture n'a pas d'image de couverture !<br/><br/>";
		} 
		file_put_contents($directory.'/couv.html', $template);
		return $data;
	}
	
	private function exportSummary($summary, $directory){
		$data="";
		$filename=base_url().'epubs/templates/summary.html';
		$handle=fopen($filename, 'rb');
		$template=fread($handle, 10000);
		fclose($handle);
		$sum="";
		$i=2;
		foreach($summary as $row){
			$sum.="<div><p><a href='".$row['ID'].".html'/>".$row["Nom"]."</p><p class='left'>".$i."</p></a></div>";
			$i++;
		}
		$template=str_replace("%summary%", $sum, $template);
		
		file_put_contents($directory.'/summary.html', $template);
		return $data;
	}
	
	private function checkDirectory($id_book){
		$dirname=$this->session->user->ID.$this->session->user->Nom.'_'.$id_book;
		$filename=FCPATH.'epubs/'.$dirname.'/';

		if (!file_exists($filename)) {
			mkdir(FCPATH.'epubs/'. $dirname, 0777);
		} 
		return FCPATH.'epubs/'. $dirname;
	}
	
	private function exportParams($book, $directory){
		$directory=$directory.'/params';
		mkdir($directory, 0777);
		$data = array(
			"metadata"=>array (
				array("title",$book->Nom),
				array("author",$book->Auteur),
				array("lang","fr")
			),
			"manifest"=>array(
				array("ncx1","summary.html","application/xhtml+xml")
			),
			"toc"=>array(
				array("ncx1","summary.html","Sommaire")
			),
			"spine"=>array(
				array("ncx1")
			)
		);
		$i=2;
		foreach($book->fiches as $fiche){
			array_push($data["manifest"], array("ncx".$i,$fiche->ID.".html","application/xhtml+xml"));
			array_push($data["toc"], array("ncx".$i,$fiche->ID.".html",$fiche->Nom));
			array_push($data["spine"], array("ncx".$i));
			$i++;
		}
		foreach($data as $filename=>$content){
			$fp = fopen($directory.'/'.$filename.'.csv', 'w');
			foreach ($content as $row) {
				fputcsv($fp,$row, ":");
			}
			fclose($fp);
		}
		

		
		
		return ""; 
	}
	
}






























