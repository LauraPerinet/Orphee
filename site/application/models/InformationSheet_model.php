<?php

class InformationSheet_model extends CI_Model{

    protected $table = 'Fiche';

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('security');
    }

    public function checkResult($query){
        if($query->num_rows){
            return $query->result_array();
        }
        else{
            return null;
        }
    }

    public function getAllSheets(){
        $query = $this->db->select('*')
                ->from($this->table)
                ->get();

        $result = $this->checkResult($query);
        return $result;
    }

    public function getAllSheetsByUser($idUser){
        $query = $this->db->select('*')
                ->from($this->table)
                ->join('ficheutilisateur','ficheutilisateur.ID = '.$this->table.'.ID')
                ->where('ficheutilisateur.ID_Utilisateur',$idUser)
                ->get();

            $result = $this->checkResult($query);
            return $result;
    }
	
	public function creation_fiche($fiche, $ficheGenre,$historique, $musique){
		foreach($fiche as $key=>$value){
			$this->db->set($key, $value);
		}
		$this->db->insert("Fiche");
		$idFiche=$this->db->insert_id();
		$this->db->set("ID", $idFiche)->set("ID_Genre", $ficheGenre)->insert("FicheGenre");
		$this->db->set("ID", $idFiche)->set("ID_Utilisateur", $this->session->user->ID)->insert("FicheUtilisateur");
		
		foreach($historique as $histo){
			foreach($histo as $key=>$value){
				$this->db->set($key, $value);
			}
			$this->db->set('ID_Fiche', $idFiche)->insert("Historique");
		}
		
		if($musique){ 
			$this->db->set("Nom", $musique["Nom"])->set("Chemin", $musique["Chemin"])->insert("Musique");
			$idMusique=$this->db->insert_id();
			$this->db->set('ID', $idFiche)->set('ID_Musique', $idMusique)->insert("MusiqueFiche");
		}
	}
	
	public function get_genres(){
		return $this->db->select('*')
			->from("Genre")
			->get()
			->result_array();
	}
	public function get_fiche($id){
		$query = $this->db->query(
			"SELECT Fiche.*, Genre.Nom AS Genre FROM Fiche
			INNER JOIN Genre ON Genre.ID = (SELECT ID_Genre FROM FicheGenre WHERE FicheGenre.ID=Fiche.ID) 
			WHERE Fiche.ID=".$id
		 )->row();
		 $query->Historique = $this->db->query(
			"SELECT DateHistorique, Description FROM Historique WHERE ID_Fiche=".$id
		 )->result();
		//$result = $this->checkResult($query);

		return $query;
	}
}
 //Musique.Nom AS nomMusique, Chemin AS srcMusique
 /*SELECT Fiche.*, DateHistorique, Historique.Description, Genre.Nom AS Genre, Musique.Nom AS nomMusique FROM Fiche
			INNER JOIN Historique ON ID_Fiche=Fiche.ID 
			INNER JOIN Genre ON Genre.ID = (SELECT ID_Genre FROM FicheGenre WHERE FicheGenre.ID=Fiche.ID) 
			INNER JOIN Musique ON Musique.ID = (SELECT ID_Musique From MusiqueFiche WHERE MusiqueFiche.ID=Fiche.ID) 
			WHERE Fiche.ID=".$id*/



?>