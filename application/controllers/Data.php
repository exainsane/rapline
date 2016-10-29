<?php

/* 
 * Copyright 2016 Exairie
 * Any application should be used with the developer's permission * 
 */

class Data extends CI_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->database();        
        $this->load->model("DataManipulationModel");
        $this->load->library("ViewAdapter");        
    }
    
    function kelas(){
        requirePermission(SUPERADMIN_LEVEL);
        $limit = returnDefaultIfNull($this->input->get("show"), 10);
        $search = returnDefaultIfNull($this->input->get("search"), null);
        $bysemester = returnDefaultIfNull($this->input->get("smt"), null);
        
        $exact_search = array();
        
        if($bysemester != null)
        {
            array_push($exact_search, "tahun_masuk = ".$bysemester);
        }
        
        $table = "m_kelas";
        
        if($this->input->get("hapuskelas") != null){
            $id = base64_decode(urldecode($this->input->get("hapuskelas")));
            $this->DataManipulationModel->delete($table,$id);
        }
        
        $this->load->model("FormAction");
        $this->FormAction->scanForInput($table);
        
        $exact_search = count($exact_search) < 1?null:implode(" and ", $exact_search);
        $data = $this->DataManipulationModel->getData($table, null, $search, "tahun_masuk", "desc", $exact_search)->result();
        
        if($this->session->userdata("login_id_user") != null && $this->session->userdata("login_level") != null){
            if($this->session->userdata("login_level") == FIELD_CODE_GURU){
                $this->db->where("id_guru",$this->session->userdata("login_id_user"));
                $this->db->group_by("id_mata_pelajaran,id_kelas");
                $this->db->order_by("id","DESC");
                $asg = $this->db->get("as_assign_guru_kelas");
                if($asg->num_rows() > 0){
                    $dassign = $asg->result();                    
                    for($i = 0;$i < count($data);$i++){
//                        echo "Search ".$data[$i]->id." in \$dassign with iduser ".$this->session->userdata("login_id_user");
                        $in = search_where($data[$i]->id, $dassign, "id_kelas");
//                        echo ": found $in<br>";
                        if($in >= 0){                            
                            $data[$i]->aux = array(
                              "assignclass"=>$dassign[$in]->id  
                            );
                        }
                    }
                }
            }
        }
        
        $fields = $this->DataManipulationModel->getTableFieldList($table);
        
        array_push($fields,"action");
                
        $field_captions = array(
            "id"=>"",
            "nama_kelas"=>"Nama Kelas",
            "tahun_masuk"=>"Tahun Masuk",
            "action"=>"Opsi"
        );
        
        $year_now = intval(date("Y"));
        
        for ($i = 0;$i < count($data); $i++){            
            
            $data[$i]->nama_kelas = getTingkat($data[$i]->nama_kelas, $data[$i]->tahun_masuk);
            
            $data[$i]->action = array(                
                array(
                    "link_caption"=>"Lihat Daftar Siswa",
                    "link"=>  site_url("data/siswa/?kelas=".  urlencode(base64_encode($data[$i]->id)))
                ),array(
                    "link_caption"=>"Hapus Kelas",
                    "link"=>  site_url("data/kelas/?hapuskelas=".  urlencode(base64_encode($data[$i]->id)))
                )
            );
            
            if(isset($data[$i]->aux)){
                if(isset($data[$i]->aux["assignclass"])){
                    array_push($data[$i]->action,array(
                        "link_caption"=>"Lihat Nilai",
                        "link"=>  site_url("data/inputnilai/?k=".  urlencode(base64_encode($data[$i]->aux["assignclass"])))
                    ));
                }
            }
            
            //remove aux field
            unset($data[$i]->aux);
        }
        
        
        $vwdata = array(
            "fields"=>$fields,
            "fcaption"=>$field_captions,
            "data"=>$data,
            "table_title"=>"Daftar Kelas".($bysemester != null?" Angkatan ".$bysemester:""),
            "form"=>  ViewAdapter::getFormByTableName($table)
        );
        $this->load->view("component/header",array("contain"=>true));
        
        $this->load->view("partial/basic_table",$vwdata);
        
        $this->load->view("component/footer");
    }
   
    function semester(){
        requirePermission(SUPERADMIN_LEVEL);
        $limit = returnDefaultIfNull($this->input->get("show"), 10);
        $search = returnDefaultIfNull($this->input->get("search"), null);
        $table = "m_semester";
        
        if($this->input->get("hapussemester") != null){
            $id = base64_decode(urldecode($this->input->get("hapussemester")));
            $this->DataManipulationModel->delete($table,$id);
        }
        
        $this->load->model("FormAction");
        $this->FormAction->scanForInput($table);
        
        $data = $this->DataManipulationModel->getData($table, $limit, $search, "nomor_semester", "desc")->result();
        
        $fields = $this->DataManipulationModel->getTableFieldList($table);
        
        array_push($fields,"action");
                
        $field_captions = array(
            "id"=>"",
            "nomor_semester"=>"Nomor Semester Kumulatif",
            "tahun_masuk"=>"Tahun Masuk",
            "titimangsa_rapor"=>"Titimangsa Penandatanganan",
            "ganjil"=>"Ganjil/Genap",
            "action"=>"Opsi"
        );
        
        $year_now = intval(date("Y"));
        
        for ($i = 0;$i < count($data); $i++){                                                   
            $data[$i]->action = array(
                array(
                    "link_caption"=>"Lihat Kelas",
                    "link"=>  site_url("data/kelas/?smt=".  $data[$i]->tahun_masuk)
                )
            );
        }
        
        
        $vwdata = array(
            "fields"=>$fields,
            "fcaption"=>$field_captions,
            "data"=>$data,
            "table_title"=>"Daftar Semester",
            "form"=>  ViewAdapter::getFormByTableName($table)            
        );
        
        $vwdata["fnmodify"] = function(&$data){
            $data->ganjil = $data->ganjil == 1?"Ganjil":"Genap";
        };
        $this->load->view("component/header",array("contain"=>true));
        
        $this->load->view("partial/basic_table",$vwdata);
        
        $this->load->view("component/footer");
    }
    function matapelajaran(){
        requirePermission(SUPERADMIN_LEVEL);
        $limit = returnDefaultIfNull($this->input->get("show"), 10);
        $search = returnDefaultIfNull($this->input->get("search"), null);        
        
        $exact_search = array();                
        
        $table = "m_mata_pelajaran";
        
        if($this->input->get("hapuskelas") != null){
            $id = base64_decode(urldecode($this->input->get("hapuskelas")));
            $this->DataManipulationModel->delete($table,$id);
        }
        
        $this->load->model("FormAction");
        $this->FormAction->scanForInput($table);
        
        $exact_search = count($exact_search) < 1?null:implode(" and ", $exact_search);
        $data = $this->DataManipulationModel->getData($table, $limit, $search, "id", "asc", $exact_search)->result();
        
        $fields = $this->DataManipulationModel->getTableFieldList($table);
        
        array_push($fields,"action");
                
        $field_captions = array(
            "id"=>"",
            "nama_mata_pelajaran"=>"Nama Mata Pelajaran",            
            "action"=>"Opsi"
        );
        
        $year_now = intval(date("Y"));
        
        for ($i = 0;$i < count($data); $i++){
            $data[$i]->action = array(
                array(
                    "link_caption"=>"Lihat Nilai",
                    "link"=>  site_url("data/nilaikelas/?mp=".  urlencode(base64_encode($data[$i]->id)))
                )
            );
        }
        
        
        $vwdata = array(
            "fields"=>$fields,
            "fcaption"=>$field_captions,
            "data"=>$data,
            "table_title"=>"Daftar Kelas",
            "form"=>  ViewAdapter::getFormByTableName($table)
        );
        $this->load->view("component/header",array("contain"=>true));
        
        $this->load->view("partial/basic_table",$vwdata);
        
        $this->load->view("component/footer");
    }
    function unassignkelas($kelasid){
        requirePermission(FIELD_CODE_GURU_WALI);
        $id = base64_decode(urldecode($this->input->get("c")));
        
        $this->db->where("id",$id)
                ->delete("as_assign_guru_kelas");
        
        redirect(site_url("data/=[/".$kelasid));
    }
    function assignkelas($kelasid = null){ 
        requirePermission(FIELD_CODE_GURU_WALI);
        if($this->input->post("for_tahun") == null){
            if($this->session->userdata("assign_for_year") != null){
                goto skiptahuncheck;
            }
            $this->session->set_tempdata("assign_for_year", date("Y"));
        }
        else{
            $this->session->set_tempdata("assign_for_year", $this->input->post("for_tahun"));
        }
        skiptahuncheck:
        if($this->input->post("for_semester") == null){
            if($this->session->userdata("assign_for_semester") != null
                    && $this->session->userdata("assign_for_semester") != null){
                goto skipclasscheck;
            }
            $dbq = $this->db
                 ->select("id,tahun_masuk,nomor_semester")
                 ->from("m_semester")
                 ->order_by("id","desc")
                 ->limit(1,0)
                 ->get();                
            if($dbq->num_rows() != 1){
                show_custom_error("Tidak ada data semester","Input terlebih dahulu data semester!");
                return;
            }

            $dqs = $dbq->result();
            $dqs = end($dqs);

            $this->session->set_userdata("assign_for_semester", $dqs->nomor_semester);
            $this->session->set_userdata("assign_for_semester_id", $dqs->id);
        }
        else
        {
            $this->session->set_userdata("assign_for_semester_id", base64_decode($this->input->post("for_semester")));
            
            
            $d = $this->db
                    ->select ("*")
                    ->from("m_semester")
                    ->where("id",  base64_decode($this->input->post("for_semester")))
                    ->limit(1,0)->get();                    
            $d = $d->result();
            $d = end($d);
            
            $this->session->set_userdata("assign_for_semester", $d->nomor_semester);
        }
        skipclasscheck:
        if($kelasid == null)
        {                                    
            $this->_assign_show_list_kelas ();
        }
        else
        {
            $this->_assign_show_data_kelas (base64_decode(urldecode($kelasid)));
        }
    }
    private function _assign_show_list_kelas(){
        $limit = returnDefaultIfNull($this->input->get("show"), 10);
        $search = returnDefaultIfNull($this->input->get("search"), null);
        $table = "m_kelas";                
        
        $smt = $this->session->userdata("assign_for_year");
        
        $query = "SELECT a.*"
                . " FROM m_kelas a"
                . " WHERE a.tahun_masuk = ".$smt;
        
        $dbq = $this->db->query($query);
        
        $fields = $dbq->list_fields();
        $data = $dbq->result();
        
        for($i = 0;$i < count($data); $i++){
            $data[$i]->nama_kelas = getTingkat($data[$i]->nama_kelas, $data[$i]->tahun_masuk);
        }
        
        $fields = $this->DataManipulationModel->trim_fields($fields);
        
        array_push($fields,"action");
                
        $field_captions = array(
            "id"=>"",
            "timestamp"=>"",
            "nama_kelas"=>"Kelas",
            "tahun_masuk"=>"Tahun Masuk",
            "nomor_semester"=>"",
            "action"=>"Opsi"
        );
        
        $year_now = intval(date("Y"));
        
        for ($i = 0;$i < count($data); $i++){                                                   
            $data[$i]->action = array(
                array(
                    "link_caption"=>"Atur Jadwal",
                    "link"=>  site_url("data/assignkelas/". urlencode(base64_encode($data[$i]->id)))
                )
            );
        }
        
        $qsmt = $this->db
                ->query("SELECT * FROM m_kelas group by tahun_masuk")
                ->result();                
        
        $vwdata = array(           
            "datasmt"=>$qsmt,
            "smt_now"=> $smt,
            "fields"=>$fields,
            "fcaption"=>$field_captions,
            "data"=>$data,
            "table_title"=>"Daftar Semester",
            "form"=>  ViewAdapter::getFormByTableName($table)
        );
        $this->load->view("component/header",array("contain"=>true));
        
        $this->load->view("partial/semester_kelas",$vwdata);
        
        $this->load->view("component/footer");
    }
    private function _input_assign_kelas($kid){
        $chk = $this->db
                ->select("id")
                ->from("as_assign_guru_kelas");
        $this->db->where("id_kelas",$kid);
        $this->db->where("id_semester",$this->session->userdata("assign_for_semester_id"));
        $this->db->where("hari",$this->input->post("hari_ke"));
        $this->db->where("jam",$this->input->post("jam_ke"));
        
        if($this->db->get()->num_rows() > 0){
            return array("input"=>false,"error"=>"Jadwal telah terisi");
        }
        
        $this->db
                ->set("id_kelas",$kid)
                ->set("id_semester",$this->session->userdata("assign_for_semester_id"))
                ->set("hari",$this->input->post("hari_ke"))
                ->set("jam",$this->input->post("jam_ke"))
                ->set("id_mata_pelajaran",  base64_decode($this->input->post("mata_pelajaran")))
                ->set("id_guru",  base64_decode($this->input->post("guru_pengampu")));
        $insert = $this->db->insert("as_assign_guru_kelas");
        
        return array("input"=>$insert,"error"=>$this->db->error());        
    }
    private function _assign_show_data_kelas($kid){
        
        if($this->input->post("is_input") != null){
           $ins = $this->_input_assign_kelas($kid);
           if($ins["input"] == false){
               quit($ins["error"],"");
           }
        }
        
        $smt_now = $this->session->userdata("assign_for_semester_id");
        
        $qkelas = $this->db
                ->query(
                        "SELECT a.*"
                        . " FROM m_kelas a"
                        . " WHERE a.id = ".$kid);
        if($qkelas->num_rows() != 1){
            show_custom_error("Jumlah data kelas lebih dari 1");
            return;
        }
        
        $dkelas = $qkelas->result();
        $dkelas = end($dkelas);
        
        $qjadwal = "SELECT a.*,b.nama_guru,c.nama_mata_pelajaran"
                . " FROM as_assign_guru_kelas a"
                . " LEFT JOIN m_guru b on a.id_guru = b.id"
                . " LEFT JOIN m_mata_pelajaran c on a.id_mata_pelajaran = c.id"                
                . " WHERE a.id_kelas = ".$kid                
                . " AND a.id_semester = ".$smt_now
                . " ORDER BY a.hari asc, a.jam asc";
        
        $djadwal = $this->db->query($qjadwal);
        
        $jadwal = array();
        
        foreach ($djadwal->result() as $data){
            if(!isset($jadwal[$data->hari]))
            {
                $jadwal[$data->hari] = array();
            }
            
            $jadwal[$data->hari][$data->jam] = array(
                        "id"=>  urlencode(base64_encode($data->id)),
                        "guru"=>$data->nama_guru,
                        "mp"=>$data->nama_mata_pelajaran
                    );
        }
        
        $dtsmt = $this->DataManipulationModel->getData("m_semester", null, null, "id", "desc")->result();
        
        for($i = 0;$i < count($dtsmt);$i++){
//            $dtsmt[$i]->nomor_semester = calculateSmt($dtsmt[$i]->tahun_masuk,$dtsmt[$i]->ganjil == 1);
        }
        
        $vwdata = array(        
            "datajadwal"=>$jadwal,
            "kelas"=>urlencode(base64_encode($kid)),
            "kelas_name"=>  getTingkat($dkelas->nama_kelas, $dkelas->tahun_masuk),
            "smt_now"=>$smt_now,
            "smt_name"=>$dtsmt[search_where($smt_now, $dtsmt, "id")]->nomor_semester,
            "datasmt"=>$dtsmt,
            "dataguru"=>$this->DataManipulationModel->getData("m_guru", null, null, "id", "desc")->result(),
            "datamapel"=>$this->DataManipulationModel->getData("m_mata_pelajaran", null, null, "id", "desc")->result()
        );
        
        $this->load->view("component/header",array("contain"=>true));
        
        $this->load->view("partial/semester_input",$vwdata);
        
        $this->load->view("component/footer");
    }
    function importXls(){
        show_404();
        $this->load->view("component/header");
        $this->load->view("partial/upload_importxls");
        $this->load->view("component/footer");
    }
    function siswa(){
        requirePermission(SUPERADMIN_LEVEL);
        $limit = returnDefaultIfNull($this->input->get("show"), null);
        $search = returnDefaultIfNull($this->input->get("search"), null);
        $bysemester = returnDefaultIfNull($this->input->get("smt"), null);
        
        
        //cek session
        if($this->input->post("kelas") != null)
        {
            $kelas_now = base64_decode ($this->input->post("kelas"));
            $this->session->set_tempdata("select_kelas", $kelas_now);
        }
        if($this->input->get("kelas") != null)
        {
            $kelas_now = base64_decode ($this->input->get("kelas"));
            $this->session->set_tempdata("select_kelas", $kelas_now);
        }
        
        $kelas_now = $this->session->userdata("select_kelas");        
        
        $exact_search = array();
        
        if($bysemester != null)
        {
            array_push($exact_search, "tahun_masuk = ".$bysemester);
        }
        
        $table = "m_siswa";
        
        //Ambil data kelas
        $this->db
                ->select("*")
                ->from("m_kelas")
                ->order_by("tahun_masuk","DESC")
                ->order_by("nama_kelas","ASC");
               
        $qkelas = $this->db->get();
        
        if($qkelas->num_rows() < 1){
            show_custom_error("Tidak ada kelas!","Input kelas terlebih dahulu!");
        }
        
        $dkelas = $qkelas->result();
        
        $year_now = intval(date("Y"));
        
        for ($i = 0; $i < count($dkelas); $i++){
            $tingkat = (intval($year_now - $dkelas[$i]->tahun_masuk) + 10);
//            $tingkat = $tingkat > 12? 12 : $tingkat;
            
            $dkelas[$i]->nama_kelas = ($tingkat > 12?12:$tingkat)." ".$dkelas[$i]->nama_kelas.($tingkat > 12?"(".($dkelas[$i]->tahun_masuk).")":"");
        }
        
        if ($kelas_now == null && count($dkelas >= 1)) {
            $kelas_now = $dkelas[0]->id;
            $this->session->set_tempdata("select_kelas", $kelas_now);
        }
        
        $vwdata = array(
            "datakelas"=>$dkelas,
            "kls_now"=>$kelas_now
        );
        
        if($this->input->get("d") != null){
            $id = base64_decode(urldecode($this->input->get("d")));
            $this->DataManipulationModel->delete($table,$id);
        }
        
//        $this->load->model("FormAction");
//        $this->FormAction->scanForInput($table);
        
        $exact_search = array();
        
        array_push($exact_search, "kelas = ".$kelas_now);
        
        
        $exact_search = count($exact_search) < 1?null:implode(" and ", $exact_search);
        $data = $this->DataManipulationModel->getData($table, null, $search, "id", "asc", $exact_search)->result();
        
        $fields = $this->DataManipulationModel->getTableFieldList($table);
        
        array_push($fields,"action");
                
        $field_captions = array(
            "id"=>"",
            "kelas"=>"",
            "nama_siswa"=>"Nama Siswa",
            "kode_identitas"=>"NIS",
            "jenis_kelamin"=>"Jenis Kelamin",
            "email"=>"E-Mail",
            "action"=>"Opsi"
        );
        
        $year_now = intval(date("Y"));
        
        for ($i = 0;$i < count($data); $i++){            
            
            $data[$i]->action = array(
                array(
                    "link_caption"=>"Hapus Data",
                    "link"=>  "javascript:confirmDeletion('".site_url("data/siswa/?d=".  urlencode(base64_encode($data[$i]->id)))."')"
                )
            );
        }
        $namakelas_now = "";
        $angkatan_now = -1;
        if($kelas_now != null){
            $i = search_where($kelas_now, $dkelas, "id");
            if($i >= 0)
            {
                $namakelas_now = $dkelas[$i]->nama_kelas;
                $angkatan_now = $dkelas[$i]->tahun_masuk;
            }
        }
                
        $vwdata["fields"] = $fields;
        $vwdata["fcaption"] = $field_captions;
        $vwdata["data"] = $data;
        $vwdata["kelas_now"] = $namakelas_now." Angkatan ".$angkatan_now;
        $vwdata["kelas_id"] = base64_encode($kelas_now);
        $vwdata["table_title"] = "Daftar Siswa ".$namakelas_now;                
        
        $this->load->view("component/header",array("contain"=>true));
        
        $this->load->view("partial/view_siswa",$vwdata);
        
        $this->load->view("component/footer");
    }
    
    function guru(){
        requirePermission(SUPERADMIN_LEVEL);
        $limit = returnDefaultIfNull($this->input->get("show"), null);
        $search = returnDefaultIfNull($this->input->get("search"), null);
        $bysemester = returnDefaultIfNull($this->input->get("smt"), null);
        
        
//        //cek session
//        if($this->input->post("kelas") != null)
//        {
//            $kelas_now = base64_decode ($this->input->post("kelas"));
//            $this->session->set_tempdata("select_kelas", $kelas_now);
//        }
//        if($this->input->get("kelas") != null)
//        {
//            $kelas_now = base64_decode ($this->input->get("kelas"));
//            $this->session->set_tempdata("select_kelas", $kelas_now);
//        }
        
        $kelas_now = $this->session->userdata("select_kelas");        
        
        $exact_search = array();
        
        if($bysemester != null)
        {
            array_push($exact_search, "tahun_masuk = ".$bysemester);
        }
        
        $table = "m_guru";
        
        //Ambil data kelas
//        $this->db
//                ->select("*")
//                ->from("m_kelas")
//                ->order_by("tahun_masuk","DESC")
//                ->order_by("nama_kelas","ASC");
//               
//        
//        $dkelas = $this->db->get()->result();
//        
//        $year_now = intval(date("Y"));
//        
//        for ($i = 0; $i < count($dkelas); $i++){
//            $tingkat = (intval($year_now - $dkelas[$i]->tahun_masuk) + 10);
////            $tingkat = $tingkat > 12? 12 : $tingkat;
//            
//            $dkelas[$i]->nama_kelas = ($tingkat > 12?12:$tingkat)." ".$dkelas[$i]->nama_kelas.($tingkat > 12?"(".($dkelas[$i]->tahun_masuk).")":"");
//        }
//        
//        if ($kelas_now == null && count($dkelas >= 1)) {
//            $kelas_now = $dkelas[0]->id;
//            $this->session->set_tempdata("select_kelas", $kelas_now);
//        }
//        
//        $vwdata = array(
//            "datakelas"=>$dkelas,
//            "kls_now"=>$kelas_now
//        );
//        
        if($this->input->get("d") != null){
            $id = base64_decode(urldecode($this->input->get("d")));
            $this->DataManipulationModel->delete($table,$id);
        }
        
        $edit_data = null;
        if($this->input->get("e") != null){
            $id = base64_decode($this->input->get("e"));
            $this->db->select("*")
                    ->from($table)
                    ->where("id",$id);
            
            $q = $this->db->get();
            
            if($q->num_rows() == 1){
                $edit_data = $q->result_array();
                $edit_data = end($edit_data);                
            }
        }
//        
        $this->load->model("FormAction");
        $this->FormAction->scanForInput($table);
        
        $exact_search = array();
        
//        array_push($exact_search, "kelas = ".$kelas_now);
        
        
//        $exact_search = count($exact_search) < 1?null:implode(" and ", $exact_search);
        $data = $this->DataManipulationModel->getData($table, null, $search, "id", "asc", $exact_search)->result();
        
        $fields = $this->DataManipulationModel->getTableFieldList($table);
        
        array_push($fields,"action");
                
        $field_captions = array(
            "id"=>"",
            "kelas"=>"",
            "nama_guru"=>"Nama Siswa",
            "kode_identitas"=>"NIS",
            "jenis_kelamin"=>"Jenis Kelamin",
            "email"=>"E-Mail",
            "action"=>"Opsi"
        );
        
        $year_now = intval(date("Y"));
        
        for ($i = 0;$i < count($data); $i++){            
            
            $data[$i]->action = array(
                array(
                    "link_caption"=>"Edit",
                    "link"=>  site_url("data/guru/?e=".urlencode(base64_encode($data[$i]->id)))
                ),
                array(
                    "link_caption"=>"Hapus Data",
                    "link"=>  "javascript:confirmDeletion('".site_url("data/guru/?d=".  urlencode(base64_encode($data[$i]->id)))."')"
                )
            );
        }
        $namakelas_now = "";
        $angkatan_now = -1;
//        if($kelas_now != null){
//            $i = search_where($kelas_now, $dkelas, "id");
//            if($i >= 0)
//            {
//                $namakelas_now = $dkelas[$i]->nama_kelas;
//                $angkatan_now = $dkelas[$i]->tahun_masuk;
//            }
//        }
                
        $vwdata["fields"] = $fields;
        $vwdata["fcaption"] = $field_captions;
        $vwdata["data"] = $data;
        $vwdata["kelas_now"] = $namakelas_now." Angkatan ".$angkatan_now;
        $vwdata["kelas_id"] = base64_encode($kelas_now);
        $vwdata["table_title"] = "Daftar Guru";      
        $vwdata["form"] = ViewAdapter::getFormByTableName($table,null,null,$edit_data);
        
        $this->load->view("component/header",array("contain"=>true));
        
        $this->load->view("partial/view_guru",$vwdata);
        
        $this->load->view("component/footer");
    }
    
    function inputnilai(){
//        if($this->session->userdata("login_id_user") == null || $this->session->userdata("login_level") == null){
//            show_custom_error("Anda tidak memiliki wewenang untuk mengakses halaman ini", "Silahkan login sebagai guru");
//            return;
//        }
//        if($this->session->userdata("login_level") != FIELD_CODE_GURU){
//            show_custom_error("User selain user guru tidak memiliki wewenang untuk mengakses halaman ini", "Silahkan login sebagai guru");
//            return;
//        }
        requirePermission(FIELD_CODE_GURU);
        if($this->input->post("smt") != null){
            $this->session->set_userdata("assignnilai_smtselection", base64_decode($this->input->post("smt")));
        }
        if($this->input->post("kelas") != null){
            $this->session->set_userdata("assignnilai_selection",  base64_decode($this->input->post("kelas")));
        } 
        if($this->input->get("k") != null){
            $this->session->set_userdata("assignnilai_selection",  base64_decode($this->input->get("k")));
        } 
        $this->db
             ->select("a.*,b.nama_kelas,b.tahun_masuk,c.nama_mata_pelajaran,d.nomor_semester,d.tahun_masuk,d.ganjil")
             ->from("as_assign_guru_kelas a")
             ->join("m_kelas b", "a.id_kelas = b.id","left")
             ->join("m_mata_pelajaran c","a.id_mata_pelajaran = c.id","left")
             ->join("m_semester d","a.id_semester = d.id","left")
             ->group_by("a.id_mata_pelajaran,a.id_kelas")
             ->where("id_guru",$this->session->userdata("login_id_user"));
//        echo $this->db->get_compiled_select();
        $dtassign = $this->db->get();
        
        
        if($dtassign->num_rows() < 1){
            show_custom_error("Anda tidak memiliki jam mengajar!");
            return;
        }
        
        
        
        $inputclass_selection = $this->session->userdata("assignnilai_selection");
        
        $data_assign = $dtassign->result();
        
//        for($i = 0;$i < count($data_assign);$i++){
//            $data_assign[$i]->nomor_semester = calculateSmt($data_assign[$i]->tahun_masuk,$data_assign[$i]->ganjil ==1)." (".$data_assign[$i]->tahun_masuk.")";
//        }
        
        if($inputclass_selection == null && count($data_assign) > 0){
            $inputclass_selection = $data_assign[0]->id;    
            $inputclass_smtselection = $data_assign[0]->id_semester;
            $this->session->set_userdata("assignnilai_selection", $inputclass_selection);
            $this->session->set_userdata("assignnilai_smtselection", $inputclass_smtselection);
        }
        
        $this->db
                ->select("*")
                ->from("m_semester");
        $dtsemester = $this->db->get();
        
        $dtsmt = $dtsemester->result();
//        for($i = 0;$i < count($dtsmt);$i++){
//            $dtsmt[$i]->nomor_semester = calculateSmt($dtsmt[$i]->tahun_masuk,$dtsmt[$i]->ganjil == 1)." (".$dtsmt[$i]->tahun_masuk.")";
//        }
        
        if($dtsemester->num_rows() < 1){
            show_custom_error("Tidak ada data semester kumulatif!","Silahkan tambahkan semester kumulatif terlebih dahulu");
            return;
        }
        
        $inputclass_smtselection = $this->session->userdata("assignnilai_smtselection");
        if($inputclass_smtselection == null && count($dtsemester) > 0){
            $res = $dtsemester->result();
            $i = search_where(date("Y"), $res, "tahun_masuk");
            $i2 = search_where($res[$i]->id, $data_assign, "id_semester");
            if($i2 >= 0)
            {                
                $inputclass_smtselection = $res[$i]->id;
                
            }
            else
            {
                $inputclass_smtselection = $res[0]->id;                
            }
            
            $this->session->set_userdata("assignnilai_smtselection", $inputclass_smtselection);
            
        }
        
        $initial_inserted = false;
        
        requery:
        $basequery = "
            select a.*,b.id as id_siswa, b.nama_siswa, b.kode_identitas, c.nama_kelas,c.tahun_masuk AS angkatan, d.nomor_semester, d.tahun_masuk,d.ganjil, e.nilai,
            e.deskripsi_nilai, e.nilai_keterampilan,e.deskripsi_nilai_keterampilan,e.id as id_nilai 
            from as_assign_guru_kelas a
            right join m_siswa b on a.id_kelas = b.kelas
            left join m_kelas c on a.id_kelas = c.id
            left join t_nilai e on a.id_mata_pelajaran = e.id_mata_pelajaran AND a.id_guru=e.id_guru and b.id = e.id_siswa
            left join m_semester d on e.id_semester = d.id";
        
        $basequery .= " WHERE a.id_guru = ".$this->session->userdata("login_id_user");
        $basequery .= " AND a.id = ".$inputclass_selection;
        $basequery .= " AND d.id = ".$inputclass_smtselection;
        
        $data = $this->db->query($basequery);
        $fields = $data->list_fields();
        
        $field_captions = array();
        $field_captions["id"] = "";
        $field_captions["id_semester"] = "";
        $field_captions["id_guru"] = "";
        $field_captions["id_kelas"] = "";
        $field_captions["id_mata_pelajaran"] = "";
        $field_captions["id_nilai"] = "";
        $field_captions["hari"] = "";
        $field_captions["jam"] = "";
        $field_captions["kkm"] = "";
        $field_captions["timestamp"] = "";
        $field_captions["id_siswa"] = "";
        $field_captions["nama_siswa"] = "Nama Siswa";
        $field_captions["kode_identitas"] = "NIS";
        $field_captions["nama_kelas"] = "";
        $field_captions["nomor_semester"] = "Semester";
        $field_captions["tahun_masuk"] = "";
        $field_captions["angkatan"] = "";
        $field_captions["nilai"] = "Nilai";
        $field_captions["nilai_keterampilan"] = "Nilai Keterampilan";
        $field_captions["deskripsi_nilai"] = "Desk. Nilai Akademik";
        $field_captions["deskripsi_nilai_keterampilan"] = "Desk. Nilai Keterampilan";        
        
        
        //Check if result is empty, means there is no initial score
        if($data->num_rows() < 1 && $initial_inserted == false){
            $i = search_where($inputclass_selection, $data_assign, "id");
            if($i < 0){
                show_custom_error("Terjadi Kesalahan Sistem!","Error message data(695)");                
                return;
            }
            
            $idmapel = $data_assign[$i]->id_mata_pelajaran;
            $idkelas = $data_assign[$i]->id_kelas;
            
            $dtsiswa = $this->db->select("*")->from("m_siswa")->where("kelas",$idkelas)->get();
            
            foreach($dtsiswa->result() as $dt){
                $this->db
                    ->set("nilai","0")
                    ->set("nilai_keterampilan","0")
                    ->set("id_guru",$this->session->userdata("login_id_user"))
                    ->set("id_semester",$inputclass_smtselection)
                    ->set("id_mata_pelajaran",$idmapel)
                    ->set("id_siswa",$dt->id);
                $this->db->insert("t_nilai");
            }
            
            $initial_inserted = true;
            goto requery;
                    
        }
        
        $dtnilai = $data->result();
        
        for($i = 0;$i < count($dtnilai);$i++){
            $dtnilai[$i]->nomor_semester = calculateSmt($dtnilai[$i]->tahun_masuk,$dtnilai[$i]->ganjil == 1);
        }
        
        $vwdata = array();
        $vwdata["datakelas"] = $data_assign ;
        $vwdata["input_selection"] = $inputclass_selection;
        $vwdata["semester"] = $dtsmt;
        $vwdata["table_title"] = "Nilai Siswa";
        $vwdata["fields"] = $fields;
        $vwdata["fcaption"] = $field_captions;
        $vwdata["data"] = $dtnilai;
        
        
        $this->load->view("component/header",array("contain"=>true));
        $this->load->view("partial/view_inputnilai",$vwdata);
        $this->load->view("component/footer");
    }
}