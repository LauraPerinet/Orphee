<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class fiche_model extends CI_Model
{

	public function creation_fiche($fiche, $ficheGenre,$historique){
		foreach($fiche as $key=>$value){
			$this->db->set($key, $value);
		}
		$this->db->insert("Fiche");
		$id=$this->db->insert_id();
		$this->db->set("ID", $id)->set("ID_Genre", $ficheGenre)->insert("FicheGenre");
		$this->db->set("ID", $id)->set("ID_Utilisateur", $this->session->user->ID)->insert("FicheUtilisateur");
		
		foreach($historique as $histo){
			foreach($histo as $key=>$value){
				$this->db->set($key, $value);
			}
			$this->db->set('ID_Fiche', $id)->insert("Historique");
		}
	}
	public function get_genres(){
		return $this->db->select('*')
			->from("Genre")
			->get()
			->result_array();
	}
}