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
        $data = $this->InformationSheet->getAllSheets();
        $this->load->view('template/header');
        $this->load->view('pages/',$data);
        $this->load->view('template/footer');
    }
}
?>