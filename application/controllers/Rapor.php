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
        requirePermission(FIELD_CODE_SISWA);
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
    function raporkelas(){
        requirePermission(FIELD_CODE_GURU_WALI);        
        if($this->input->post("kls") != null){
            $this->session->set_userdata("view_nilai_kelas",  base64_decode($this->input->post("kls")));
        }
        if($this->session->userdata("view_nilai_kelas") == null){
            $q = "SELECT * FROM t_assign_wali a"
                    . " where id_guru = ".getUserID();
            $kls = $this->db->query($q);
            if($kls->num_rows() < 1){
                quit("Anda tidak memiliki kelas yang diwakilkan!","");
            }
            
            $kls = $kls->result();
            $kls = end($kls);
            
            $this->session->set_userdata("view_nilai_kelas",  $kls->id);
        }
        
        $current_selection = $this->session->userdata("view_nilai_kelas");
        
        $q = "SELECT a.*,b.nama_kelas,b.tahun_masuk,c.nomor_semester FROM t_assign_wali a"
                . " left join m_kelas b"
                . " on a.id_kelas = b.id"
                . " left join m_semester c"
                . " on a.id_semester = c.id"
                . " where a.id_guru = ".getUserID();        
        $qsmt = $this->db->query($q);                
        $datasmt = $qsmt->result();
        
        $dmapel = $this->db->get("m_mata_pelajaran")->result();
        
        $assigned = $datasmt[search_where($current_selection, $datasmt, "id")];
        
        $dsiswa = $this->db->get_where("m_siswa","kelas = ".$assigned->id_kelas)->result();
        
        $ssarr = array();
        $dnilai = $this->db
                ->select("a.*")
                ->from("t_nilai a")
                ->join("m_siswa b","a.id_siswa = b.id","LEFT")
                ->where("b.kelas",$assigned->id_kelas)
                ->where("a.id_semester",$assigned->id_semester)
                ->get()
                ->result();
//        $dnilai = $this->db->get_where("t_nilai","id_kelas = ".$assigned->id_kelas." AND id_semester = ".$assigned->id_semester)->result();
        $dataarr = array();
        foreach($dnilai as $data){
            if(!isset($ssarr[$data->id_siswa])){
                $ssarr[$data->id_siswa] = array();
            }
            
            $ssarr[$data->id_siswa][$data->id_mata_pelajaran] = $data->nilai;
                        
        }
        
        $dataarr = array();
        foreach ($ssarr as $key => $value){
            $arr = array();
            $arr["id"] = $key;
            foreach ($dmapel as $mapel){
                if(!isset($value[$mapel->id]))
                {
                    $value[$mapel->id] = 0;
                }
            }
            $arr["nilai"] = $value;
            
            array_push($dataarr, $arr);
        }    
        
        $vwdata = array();
        $vwdata["datasmt"] = $datasmt;
        $vwdata["datasiswa"] = $dsiswa;
        $vwdata["datamapel"] = $dmapel;
        $vwdata["datanilai"] = $dataarr;
        $vwdata["table_title"] = "Data nilai kelas ".$assigned->nama_kelas." ".$assigned->nomor_semester;
        $vwdata["input_selection"] = $current_selection;
        
        $this->load->view("component/header",array("contain"=>true));
        
        $this->load->view("partial/view_nilaikelas",$vwdata);
        
        $this->load->view("component/footer");
        
//        var_dump($dataarr);
    }
    function catatan_siswa(){
        requirePermission(FIELD_CODE_GURU_WALI);
        $_sess_key = "cat_smt";
        if($this->input->post("smt") != null){
            $this->session->set_userdata($_sess_key, base64_decode($this->input->post("smt")));
        }
        if($this->session->userdata($_sess_key) == null){
            $q = $this->db->get("m_semester");
            if($q->num_rows() < 1){
                quit("Tidak ada data semester!","Input data semester terlebih dahulu");
            }
            
            $q = $this->db->get_where("t_assign_wali","id_guru = ".getUserID());
            if($q->num_rows() < 1){
                quit("Anda tidak memiliki kelas perwalian!","");
            }
            
            $q = $q->result();
            $q = end($q);
            $this->session->set_userdata($q->id);
        }
        
        $qklsw = $this->db
                ->select("a.*,b.nama_kelas,b.id as kelasid,c.nomor_semester")
                ->from("t_assign_wali a")
                ->join("m_kelas b","a.id_kelas = b.id","LEFT")
                ->join("m_semester c","a.id_semester = c.id","LEFT")
                ->where("id_guru",  getUserID());
        
        $dklsw = $qklsw->result();
        $current_selection = $this->session->userdata($_sess_key);
        
        $assigned = $dklsw[search_where($current_selection, $dklsw, "id")];
        
        $q = "SELECT a.*,b.deskripsi,b.cat_sikap FROM m_siswa a"
                . " left join (select * from t_catatan_siswa where id_semester = ".$assigned->id_semester." AND id_guru = ".  getUserID() .") as b"
                . " on a.id = b.id_siswa"
                . " where a.kelas = ".$assigned->kelasid;
        $qdata = $this->db->query($q);
        
        $vwdata = array();
        
        $this->load->view("component/header",array("contain"=>true));
        
        $this->load->view("partial/view_catatan_siswa",$vwdata);
        
        $this->load->view("component/footer");
    }
}
