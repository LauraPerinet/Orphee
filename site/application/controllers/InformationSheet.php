<?php 
class InformationSheet extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('InformationSheet_model','InformationSheet');
    }

    public function index(){
        redirect('InformationSheet/show');
    }

    public function show(){
        $informationSheets = $this->InformationSheet->getAllSheets();
        if(is_null($informationSheets)){
                $this->load->view('templates/header');
                echo "Aucune fiche n'a été trouvé";
                $this->load->view('templates/footer');
        }
        else{
            $data['InformationSheets'] = $this->InformationSheet->getFormatedSheetsList($informationSheets);
            $this->load->view('templates/header');
            $this->load->view('pages/informationSheetSlider',$data);
            $this->load->view('templates/footer');
        }
        
    }
}
?>