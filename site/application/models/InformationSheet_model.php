<?php

class InformationSheet_model extends CI_Model{

    protected $table = 'fiche';

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
                ->from('fiche')
                ->get();
        $result = $query->result_array();
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

}




?>