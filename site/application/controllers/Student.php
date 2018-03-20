<?php
class Student extends CI_Controller{
	public function view(){
		
		$this->load->helper('url');
		if(!isset($this->session->user)){
			redirect("login/view");
		};
		$data['subtitle']="Candidats et apprentis";
		
		$query='SELECT * FROM student';
		if($this->input->post('formation') || $this->input->post('year')|| $this->input->post('type')){ 
			$query=$this->createQuery(
				$query, 
				$data["query"]["formation"] = $this->input->post('formation') == "null" ? null : $this->input->post('formation'), 
				$data["query"]["year"]=$this->input->post('year')=="null" ? null: $this->input->post('year'), 
				$data["query"]["type"]=$this->input->post('type')== "null" ? null: $this->input->post('type')
			);
			$data['subtitle'] = $this->createSubtitle($data);
		}
		$query=$this->db->query($query);
		
		$data['students']=$query->result();
		foreach($data['students'] as $student){
			$student->formations = $this->db->query("SELECT * FROM formation WHERE id IN (SELECT id_formation FROM student_formation WHERE id_candidate=".$student->id.")")->result();
		}
		$data['title']="Gestion des aprentis";
		
		$data['formations']=$this->db->query('SELECT ypareo, id FROM formation')->result();
		$data['minYear']=$this->db->query('SELECT MIN(date_candidature) AS minYear FROM student')->row()->minYear;
		
		$this->load->view('templates/header', $data);
		$this->load->view('forms/selectionStudents', $data);
		$this->load->view('pages/student_table', $data);
		$this->load->view('templates/footer', $data);
	}
	private function createQuery($query='SELECT * FROM student', $formation=null, $year=null, $type=null){
		if($formation | $year | $type) $query.=' where ';
		if($formation){
			$query.='id IN ( SELECT id_candidate FROM student_formation WHERE id_formation='.$formation.')';
			if($year || $type) $query.=" and ";
		}
		if($year){
			$query.="date_candidature=".$year;
			if($type) $query.=" and ";
		}
		if($type){
			$query.="id_status=".$type;
		}

		return $query;
	}
	
	private function createSubtitle($data){
		if($data["query"]["type"]) $data['subtitle'] = $data["query"]["type"]=="student" ? "Apprentis" : "Candidats";
		if($data["query"]["formation"]) $data['subtitle'].=" | ".$this->db->query('SELECT ypareo FROM formation WHERE id='.$data["query"]["formation"])->row()->ypareo;
		if($data["query"]["year"]) $data['subtitle'].=" | ".$data["query"]["year"];
		
		return $data['subtitle'];
	}
}