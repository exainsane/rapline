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
        requirePermission(SUPERADMIN_LEVEL);
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
        requirePermission(FIELD_CODE_GURU);
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
            $insid = null;
            $insert = false;
            if(preg_match("/nid_./", $key))
            {
                $insid = str_replace("nid_", "", $key);                
                $this->db->set("nilai",$value);
                $insert = true;
            }
            if(preg_match("/nik_./", $key))
            {
                $insid = str_replace("nik_", "", $key);
                $this->db->set("nilai_keterampilan",$value);
                $insert = true;
            }
            if(preg_match("/desk_./", $key))
            {
                $insid = str_replace("desk_", "", $key);
                $this->db->set("deskripsi_nilai_keterampilan",$value);
                $insert = true;
            }
            if(preg_match("/desd_./", $key))
            {
                $insid = str_replace("desd_", "", $key);
                $this->db->set("deskripsi_nilai",$value);
                $insert = true;
            }
            if($insert == true){
                $this->db
                        ->set("id_mata_pelajaran",$assigndata->id_mata_pelajaran)
                        ->set("id_guru",$userid)
                        ->set("id_semester",$assigndata->id_semester)
                        ->where("id",$insid);
                $this->db->update("t_nilai");
            }
        }        
        
        redirect(site_url("data/inputnilai"));
    }
    function cat_siswa_save(){
        requirePermission(FIELD_CODE_GURU_WALI);
        
        if($this->input->post("ins") == null){
            quit("Error processing data!","");
        }
        $sel = base64_decode($this->input->post("ins"));
        
        $this->db->select("*")
                ->from("t_assign_wali")
                ->where("id",$sel);
        $q = $this->db->get();
        if($q->num_rows() != 1){
            quit("Permission denied!", "");
        }
        
        $q = $q->result();
        $q = end($q);
        
        foreach ($this->input->post(null) as $key => $value) {
            $insert = false;
            $insid = null;            
            if(preg_match("/inp-des_./", $key))
            {                
                $insid = str_replace("inp-des_", "", $key);                
                $this->db->set("deskripsi",$value);
                $insert = true;
            }
            if(preg_match("/inp-cat_./", $key))
            {
                $insid = str_replace("inp-cat_", "", $key);
                $this->db->set("cat_sikap",$value);                
                $insert = true;
            }
            
            if($insert == true){
                $this->db
                        ->where("id",$insid)
                        ->update("t_catatan_siswa");                     
            }
        }    
        
        redirect(site_url("rapor/catatan_siswa"));
    }
    function save_pkl(){
        requirePermission(FIELD_CODE_GURU_WALI);
        if($this->input->post("smt") == null){
            quit("Required parameter not found!", "");            
        }
        
        $assignid = base64_decode($this->input->post("smt"));
        
        $qassign = $this->db->get_where("t_assign_wali","id = ".$assignid);
        
        if ($qassign->num_rows() != 1) {
            quit("Error on assignment data!", "");
        }
        
        $dassign = $qassign->result();
        $dassign = end($dassign);
        
        $this->db
                ->set("id_siswa",  base64_decode($this->input->post("siswa")))
                ->set("id_semester", $dassign->id_semester)
                ->set("lokasi", $this->input->post("lokasi"))
                ->set("durasi", $this->input->post("durasi"))
                ->set("keterangan", $this->input->post("keterangan"));
        $this->db->insert("t_pkl");
        
        redirect(site_url("data/prakerin"));
    }
    function del_pkl(){
        requirePermission(FIELD_CODE_GURU_WALI);
        $this->db
                ->where("id",  base64_decode($this->input->get("d")))
                ->delete("t_pkl");
        redirect(site_url("data/prakerin"));
    }
    function save_eskul(){
        requirePermission(FIELD_CODE_GURU_WALI);
        if($this->input->post("smt") == null){
            quit("Required parameter not found!", "");            
        }
        
        $assignid = base64_decode($this->input->post("smt"));
        
        $qassign = $this->db->get_where("t_assign_wali","id = ".$assignid);
        
        if ($qassign->num_rows() != 1) {
            quit("Error on assignment data!", "");
        }
        
        $dassign = $qassign->result();
        $dassign = end($dassign);
        
        $this->db
                ->set("id_siswa",  base64_decode($this->input->post("siswa")))
                ->set("id_semester", $dassign->id_semester)
                ->set("nama_eskul", $this->input->post("nama_eskul"))                
                ->set("keterangan", $this->input->post("keterangan"));
        $this->db->insert("t_eskul");
        
        redirect(site_url("data/eskul"));
    }
    function del_eskul(){
        requirePermission(FIELD_CODE_GURU_WALI);
        $this->db
                ->where("id",  base64_decode($this->input->get("d")))
                ->delete("t_eskul");
        redirect(site_url("data/eskul"));
    }
    function save_prestasi(){
        requirePermission(FIELD_CODE_GURU_WALI);
        if($this->input->post("smt") == null){
            quit("Required parameter not found!", "");            
        }
        
        $assignid = base64_decode($this->input->post("smt"));
        
        $qassign = $this->db->get_where("t_assign_wali","id = ".$assignid);
        
        if ($qassign->num_rows() != 1) {
            quit("Error on assignment data!", "");
        }
        
        $dassign = $qassign->result();
        $dassign = end($dassign);
        
        $this->db
                ->set("id_siswa",  base64_decode($this->input->post("siswa")))
                ->set("id_semester", $dassign->id_semester)
                ->set("nama_prestasi", $this->input->post("nama_prestasi"))                
                ->set("keterangan", $this->input->post("keterangan"));
        $this->db->insert("t_prestasi");
        
        redirect(site_url("data/prestasi"));
    }
    function del_prestasi(){
        requirePermission(FIELD_CODE_GURU_WALI);
        $this->db
                ->where("id",  base64_decode($this->input->get("d")))
                ->delete("t_prestasi");
        redirect(site_url("data/prestasi"));
    }
    function abs_siswa_save(){
        requirePermission(FIELD_CODE_GURU_WALI);
        
        if($this->input->post("ins") == null){
            quit("Error processing data!","");
        }
        $sel = base64_decode($this->input->post("ins"));
        
        $this->db->select("*")
                ->from("t_assign_wali")
                ->where("id",$sel);
        $q = $this->db->get();
        if($q->num_rows() != 1){
            quit("Permission denied!", "");
        }
        
        $q = $q->result();
        $q = end($q);
        
        foreach ($this->input->post(null) as $key => $value) {
            $insert = false;
            $insid = null;            
            if(preg_match("/abs-s-./", $key))
            {                
                $insid = str_replace("abs-s-", "", $key);                
                $this->db->set("sakit",$value);
                $insert = true;
            }
            if(preg_match("/abs-i-./", $key))
            {
                $insid = str_replace("abs-i-", "", $key);
                $this->db->set("izin",$value);                
                $insert = true;
            }
            if(preg_match("/abs-a-./", $key))
            {
                $insid = str_replace("abs-a-", "", $key);
                $this->db->set("alfa",$value);                
                $insert = true;
            }
            if($insert == true){
                $this->db
                        ->where("id",$insid)
                        ->update("t_rekap_absensi");                     
            }
        }    
        
        redirect(site_url("rapor/absensi"));
    }
}

