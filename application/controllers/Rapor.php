<?php

/*
 * Copyright 2016 Exairie
 * Any application should be used with the developer's permission * 
 */

/**
 * Description of Rapor
 *
 * @author exain
 */
class Rapor extends CI_Controller {
    //put your code here
    
    function __construct() {
        parent::__construct();
        
        $this->load->library("session");
        $this->load->database();
        $this->load->helper("fields");
    }
    function show(){
        $vwdata = array();
        if($this->session->userdata("login_id_user") == null){
            show_custom_error("Silahkan login terlebih dahulu");
        }else if($this->session->userdata("login_level") != null && $this->session->userdata("login_level") != FIELD_CODE_SISWA){
            show_custom_error("Silahkan login terlebih dahulu","Anda tidak login sebagai siswa.");
        }
        
        if($this->input->post("smt") != null){
            $this->session->set_userdata("rapor_select_smt",  base64_decode($this->input->post("smt")));
        }
        
        
        $this->db
                ->select("*")
                ->order_by("tahun_masuk","DESC")
                ->from("m_semester");
        $dtsemester = $this->db->get();
        
        $smt_now = $this->session->userdata("rapor_select_smt");
        
        if($smt_now == null && $dtsemester->num_rows() > 0){
            $d = $dtsemester->result();
            $smt_now = $d[0]->id;
        }
        
        $currentsmt = "-";
        if($dtsemester->num_rows() > 0){
            $d = $dtsemester->result();
            $i = search_where($smt_now, $d, "id");
            if($i >= 0){
                $currentsmt = $d[$i]->nomor_semester." (".$d[$i]->tahun_masuk."/".($d[$i]->nomor_semester+1).")";
            }
        }
        
        $basequery = "SELECT a.*,case when b.nilai is null then 0 else b.nilai end as nilai,b.id_semester,c.nomor_semester FROM `m_mata_pelajaran` a
                    left join (
                        select * from t_nilai 
                        where id_siswa = ".$this->session->userdata("login_id_user")." and id_semester = ".$smt_now."
                        ) as b on a.id = b.id_mata_pelajaran
                    left join m_semester c on b.id_semester = c.id
                    group by a.id";
        $q = $this->db->query($basequery);
        $fields = $q->list_fields();
        
        $field_captions = array();
        $field_captions["id"] = "";
        $field_captions["nama_mata_pelajaran"] = "Mata Pelajaran";
        $field_captions["timestamp"] = "";
        $field_captions["nilai"] = "Nilai";
        $field_captions["id_semester"] = "";
        $field_captions["nomor_semester"] = "Nomor Semester";
        
        $vwdata["datasmt"] = $dtsemester->result();
        $vwdata["smt_now"] = $smt_now;
        $vwdata["fcaption"] = $field_captions;
        $vwdata["data"] = $q->result();
        $vwdata["fields"] = $fields;
        $vwdata["table_title"] = "Rapor anda untuk semester ".$currentsmt;
        
        $this->load->view("component/header",array("contain"=>true));
        $this->load->view("partial/view_rapor",$vwdata);
        $this->load->view("component/footer");
    }
}
