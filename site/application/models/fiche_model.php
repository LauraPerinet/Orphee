<?php

class Fiche_model extends CI_Model{

    protected $table = 'fiche';

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('security');
    }

    public function checkResult($query){
        if($query->num_rows()){
            return $query->result_array();
        }
        else{
            return null;
        }
    }

    public function getAllSheets(){
        $query = $this->db->select('*')
                ->from('fiche')
                ->get();
        $result = $query->result_array();
        return $result;
    }

    public function getAllSheetsByUser($idUser){
        $query = $this->db->select('*')
                ->from('fiche')
                ->join('ficheutilisateur','ficheutilisateur.ID = fiche.ID')
                ->where('ficheutilisateur.ID_Utilisateur',$idUser)
                ->get();

            $result = $this->checkResult($query);
            return $result;
    }

    public function getFormatedSheetsList($informationSheets){
        $counterSheet = 0;
        $counterList = 0;
        $counterPage = 0;
        $sheetPages = array();
        $sheetPagesList = array();
        foreach($informationSheets as $sheet){
            $sheetList[$counterSheet] = $sheet;
            $counterSheet++;
            if($counterSheet == 6){
                $sheetPages = $this->insertSheetListInPage($sheetPages, $sheetList, $counterList);
                $counterList++;
                $sheetList = array();
                $counterSheet = 0;
            }
            if($counterList == 2){
                $sheetPagesList = $this->insertSheetPagesInPagesList($sheetPagesList, $sheetPages, $counterPage);
                $sheetPages = array();
                $counterList = 0;
                $counterPage++;
            }            
        }
        if($counterSheet <= 6){
            $sheetPages = $this->insertSheetListInPage($sheetPages, $sheetList, $counterList);
            $counterList++;
        }
        if($counterList <= 2){
            $sheetPagesList = $this->insertSheetPagesInPagesList($sheetPagesList, $sheetPages, $counterPage);
            $counterPage++;
        }
        return $sheetPagesList;
    }

    public function insertSheetListInPage($sheetPages, $sheetList, $counterList){
        $sheetPages[$counterList] = $sheetList;
        return $sheetPages;
    }

    public function insertSheetPagesInPagesList($sheetPagesList, $sheetPages, $counterPage){
        $sheetPagesList[$counterPage] = $sheetPages;
        return $sheetPagesList;
    }

    public function creation_fiche($dataFiche, $id_ficheModifiee=null){
		foreach($dataFiche["fiche"] as $key=>$value){
			$this->db->set($key, $value);
		}
		if($id_ficheModifiee){
			$this->db->update("fiche");
			$idFiche=$id_ficheModifiee;
		}else{
			$this->db->insert("fiche");
			$idFiche=$this->db->insert_id();
			$this->db->set("ID", $idFiche)->set("ID_Utilisateur", $this->session->user->ID)->insert("ficheutilisateur");
		}
		if($id_ficheModifiee){ 
			$this->db->query("DELETE FROM fichegenre WHERE ID=".$id_ficheModifiee);
			$this->db->query("DELETE FROM historique WHERE ID_Fiche=".$id_ficheModifiee);
			};
		$this->db->set("ID", $idFiche)->set("ID_Genre", $dataFiche['fichegenre'])->insert("fichegenre");
		
		
		foreach($dataFiche["historique"] as $histo){
			foreach($histo as $key=>$value){
				$this->db->set($key, $value);
			}
			$this->db->set('ID_Fiche', $idFiche)->insert("historique");
		}
		
		if($dataFiche["musique"]){ 
			$this->db->set("Nom", $musique["Nom"])->set("Chemin", $musique["Chemin"])->insert("musique");
			$idMusique=$this->db->insert_id();
			$this->db->set('ID', $idFiche)->set('ID_Musique', $idMusique)->insert("musiquefiche");
		}
    }
    
	public function get_genres(){
		return $this->db->select('*')
			->from("genre")
			->get()
			->result_array();
    }
    
	public function get_fiche($id){
		$query = $this->db->query(
			"SELECT fiche.*, genre.Nom AS genre FROM fiche
			INNER JOIN genre ON genre.ID = (SELECT ID_Genre FROM fichegenre WHERE fichegenre.ID=fiche.ID) 
			WHERE fiche.ID=".$id
		 )->row();
		 $query->Historique = $this->db->query(
			"SELECT DateHistorique, Description FROM historique WHERE ID_Fiche=".$id
		 )->result();
		return $query;
	}
	
	public function supprime($id_fiche){
		$deleteTable=array("ID_Fiche"=>array("historique", "ouvragefiche"),
			"ID"=>array("fichegenre", "musiquefiche","ficheutilisateur","fiche")
		);
		
		foreach($deleteTable as $colonne=>$tables){
			foreach($tables as $table){
				$this->db->query("DELETE FROM ".$table." WHERE ".$colonne."=".$id_fiche);
			}
		}
    }
    
}




?>