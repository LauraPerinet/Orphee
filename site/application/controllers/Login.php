<?php

class Login extends CI_Controller {
	public function view($page='login'){
		
		$data['title'] = ucfirst($page);
		
		$this->load->helper(array('form', 'url'));
		if(isset($this->session->user)){
				redirect("pages/view");
		};
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('MotDePasse', 'Mot de passe', 'required');
		
		$this->load->view('templates/header', $data);
		
		if($this->form_validation->run()===true){
			if($this->testConnexion()){
				redirect("pages/view/home");
			}else{
				$this->load->view('pages/home', $data);
				$this->load->view('forms/'.$page, $data);
			}
		}else{
			$this->load->view('pages/home', $data);
			$this->load->view('forms/'.$page, $data);
		}
		
		$this->load->view('templates/footer', $data);
	}
	
	public function disconnect(){
		session_destroy();
		$this->load->helper('url');
		redirect('login/view');
		
	}
	
	private function testConnexion(){
		$email = $this->input->post("email");
		
		$query=$this->db->query('SELECT * FROM utilisateur where email="'.$email.'"' );

		$user=$query->row();
		
		if($user!=null && $user->MotDePasse===md5($this->input->post("MotDePasse"))){
			$this->session->user=$user;
			return true;
		}else{
			return false;
		}
	}
}