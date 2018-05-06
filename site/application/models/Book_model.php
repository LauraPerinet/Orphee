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
		$book->fiches=$this->db->query("SELECT fiche.ID, Nom, Portrait from fiche, ouvragefiche WHERE ouvragefiche.ID=".$id." AND fiche.ID=ouvragefiche.ID_Fiche")->result();
			
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
		$this->db->set("ID", $id_book)->set('ID_Fiche', $id_sheet)->set("Page", $num)->insert("ouvragefiche");
	}
}