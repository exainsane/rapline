<?php

/* 
 * Copyright 2016 Exairie
 * Any application should be used with the developer's permission * 
 */

class Actions extends CI_Controller{
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->helper("fields");
        $this->load->library("session");
    }        
    
    function importkelas(){
        $this->load->model("IOModel");
        
        $handle = $this->IOModel->handleDocumentUpload();
        
        if($handle == null) {
            $vwdata = array(
                "error"=>"Upload Error!",
                "resolve"=>"Cek kembali file yang anda upload<br/>".$this->IOModel->recentError
            );
            
            $this->load->view("component/header",array("contain"=>true));
            $this->load->view("partial/error_notification",$vwdata);
            $this->load->view("component/footer");
            return;
        }
        
        $kelas_input = $this->input->post("kelas");
        if($kelas_input == null){
            $vwdata = array(
                "error"=>"Form Error!",
                "resolve"=>"Terjadi kesalahan sistem<br/>Error act(31)"
            );
            $this->load->view("component/header",array("contain"=>true));
            $this->load->view("partial/error_notification",$vwdata);
            $this->load->view("component/footer");        
            return;
        }
        
        $kelas_input = base64_decode($kelas_input);
        
//        var_dump($handle);
        //$handle is now an array of data
        foreach($handle as $val){
            $this->db
                 ->set("kode_identitas",$val[0])
                 ->set("nama_siswa",$val[1])
                 ->set("jenis_kelamin",$val[2])
                 ->set("kelas",$kelas_input);
            $this->db->insert("m_siswa");
        }
        
        redirect(site_url("data/siswa"));
    }
    function inputnilai(){
        $posts = $this->input->post(null);
        
        $sel = base64_decode($this->input->post("ins"));
        
        $this->db
              ->select("*")
              ->from("as_assign_guru_kelas")
              ->where("id",$sel);
        
        $assigndata = $this->db->get();
        
        if($assigndata->num_rows() < 1){
            show_custom_error("Terjadi Kesalahan Sistem","Error code action (71)");
            return;
        }
        
        $assigndata = $assigndata->result();
        $assigndata = end($assigndata);
        
        $userid = $this->session->userdata("login_id_user");
        
        $arr = array();
        foreach($posts as $key => $value){
            if(preg_match("/nid_./", $key))
            {
                $insid = str_replace("nid_", "", $key);
                $value = $value;
                $this->db
                        ->set("id_mata_pelajaran",$assigndata->id_mata_pelajaran)
                        ->set("id_guru",$userid)
                        ->set("id_semester",$assigndata->id_semester)
                        ->set("nilai",$value)
                        ->where("id",$insid);
                $this->db->update("t_nilai");
            }
        }        
        
        redirect(site_url("data/inputnilai"));
    }
}

