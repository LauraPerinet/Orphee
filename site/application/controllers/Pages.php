<?php
class Pages extends CI_Controller {
	public function view($page='home'){
			$this->load->helper(array('url','form'));
			if(!isset($this->session->user)){
				redirect("login/view");
			};
			
			$data['title'] = ucfirst($page);
		

			if( !file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			} 
			
			
			$this->load->view('templates/header', $data);
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer', $data);
			
	}
	
}