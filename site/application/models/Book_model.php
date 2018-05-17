<?php
class Book_model extends CI_Model{
	public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	public function createBook($data, $id=null){
		foreach($data as $key=>$value){
			if(!empty($value)) $this->db->set($key, $value);
		}
		if($id){
			$this->db->where("id", $id);
			$this->db->update("ouvrage");
		}else{
			$this->db->insert("ouvrage");
			$id=$this->db->insert_id();
		}
		return $id;
	}
	public function getAllBooks(){
		$books = $this->db->select("*")->from("ouvrage")->where("ID_utilisateur", $this->session->user->ID)->get()->result();
		return $books;
	}
	
	public function getBook($id){
		$book=$this->db->query("SELECT * FROM ouvrage WHERE ID=".$id." AND ID_utilisateur=".$this->session->user->ID)->row();
		$book->fiches=$this->db->query("SELECT fiche.ID, Nom, Portrait, Couverture, Page, Video, template from fiche, ouvragefiche WHERE ouvragefiche.ID=".$id." AND fiche.ID=ouvragefiche.ID_Fiche ORDER BY ouvragefiche.Page")->result();
			
		return $book;
	}
	
	public function deleteBook($id){
		$this->db->query("DELETE FROM ouvragefiche WHERE ID=".$id);
		$this->db->query("DELETE FROM ouvrage WHERE ID=".$id);
	}
	public function deleteSheet($id_book, $id_sheet){
		$this->db->query("DELETE FROM ouvragefiche WHERE ID=".$id_book." AND ID_Fiche=".$id_sheet);
	}
	public function addSheet($id_book, $id_sheet, $num){
		$this->db->set("ID", $id_book)->set('ID_Fiche', $id_sheet)->set("Page", $num+1)->insert("ouvragefiche");
	}
	public function changePage($id_book, $id_sheet, $sens){
		$page=$this->db->query("SELECT Page FROM ouvragefiche WHERE ID=".$id_book." AND ID_Fiche=".$id_sheet)->row()->Page;
		$newPage = $sens=="right" ? $page+1 : $page-1;
		
		
		$query="UPDATE ouvragefiche SET Page=".$page." WHERE ID=".$id_book." AND Page=".$newPage;
		$query2="UPDATE ouvragefiche SET Page=".$newPage." WHERE ID=".$id_book." AND ID_Fiche=".$id_sheet;
		$this->db->query("UPDATE ouvragefiche SET Page=".$page." WHERE ID=".$id_book." AND Page=".$newPage);
		$this->db->query("UPDATE ouvragefiche SET Page=".$newPage." WHERE ID=".$id_book." AND ID_Fiche=".$id_sheet);
	}
    public function reorganisePage($id_book, $list_sheets) {
        $i = 1;
        foreach ($list_sheets as $sheet) {
            if ($sheet) $this->db->query("UPDATE ouvragefiche SET Page=".$i." WHERE ID=".$id_book." AND ID_Fiche=".$sheet);
            $i++;
        }
    }
}

