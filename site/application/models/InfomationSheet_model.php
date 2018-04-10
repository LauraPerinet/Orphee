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
}




?>