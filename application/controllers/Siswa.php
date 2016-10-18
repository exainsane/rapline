<?php

/*
 * Copyright 2016 Exairie
 * Any application should be used with the developer's permission * 
 */

/**
 * Description of Siswa
 *
 * @author exain
 */
class Siswa extends CI_Controller{
    function __construct() {
        parent::__construct();
        
        
    }
    function biodata(){
        requirePermission(FIELD_CODE_SISWA);
        
        if(getUserLevel() != FIELD_CODE_SISWA){
            quit("Access Denied", "You don't have the rights to access this page!");                        
        }
        
        $table = "m_siswa";
        
        $this->load->model("FormAction");
        $this->FormAction->scanForInput($table);
        
        $this->db->select("*")
                ->from($table)
                ->where("id",  getUserID());
        
        $q = $this->db->get();
        
        if($q->num_rows() != 1){
            quit("Error!","Tidak dapat menemukan data!");
        }
        
        $q = $q->result();
        $q = end($q);
        
        $vwdata["data"] = $q;
        
        $this->load->view("component/header",array("contain"=>true));
        
        $this->load->view("partial/view_biodata_siswa",$vwdata);
        
        $this->load->view("component/footer");
                
    }
}
