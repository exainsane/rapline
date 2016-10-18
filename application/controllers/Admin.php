<?php  
class Admin extends CI_Controller{
	
    function __construct(){
        parent::__construct();

        $this->load->database();
        $this->load->helper("url");
        $this->load->helper("fields");        
        $this->load->helper("dictionary");
        $this->load->library("ViewAdapter");
    }
    function frmstruct($table = null){
        if($table == null) return;
        
        echo htmlspecialchars(ViewAdapter::getFormByTableName($table));
    }
    function datasekolah(){        
        requirePermission(SUPERADMIN_LEVEL);                               
        
        $dict_key = "identitas_sekolah";
        
        if($this->input->post("save") != null){
            $inp = array();
            foreach($this->input->post(null) as $key=>$value){
                if(preg_match("/dct-./", $key) > 0){
                    $inp[str_replace("dct-", "", $key)] = $value;
                }
            }
            
            saveDictionary($dict_key, $inp);
        }
        
        $vwdata = array();
        $vwdata["data"] = getDictionary($dict_key);
        
        $this->load->view("component/header",array("contain"=>true));
        
        $this->load->view("partial/view_identitas_sekolah",$vwdata);
        
        $this->load->view("component/footer");
                
    
    }
    function index($statusdata = null){
        if($statusdata == null)
        {
            $statusdata = array();
        }
        
        if(!isset($statusdata['login'])){
            $statusdata['login'] = array();
        }
        
        $statusdata['login']['status'] = isUserLoggedIn();
        
        $this->load->view("component/header",array("contain"=>true));
                
        $this->load->view("partial/loginview",isset($statusdata['login'])?$statusdata['login']:null);
        $this->load->view("welcome");
        //$this->load->view("partial/usermenu",array('extra'=>$this->getTableListLink()));        

        $this->load->view("component/footer");
    }        
    function hapus_wali(){
        requirePermission(SUPERADMIN_LEVEL);
        
        if($this->input->get("d") == null){
            show_404();
        }
        
        $this->db->where("id", base64_decode($this->input->get("d")))->delete("t_assign_wali");
        
        redirect(site_url("admin/guru_wali"));
    }
    function save_wali(){
        requirePermission(SUPERADMIN_LEVEL);
        
        if($this->input->post("smt") == null)
        {
            quit("Error!","Kesalahan dalam memproses data : 70");
        }
        
        $smt = base64_decode($this->input->post("smt"));
        $id_guru = base64_decode($this->input->post("guru"));
        $id_kelas = base64_decode($this->input->post("kelas"));
        
        $this->db
                ->set("id_semester",$smt)
                ->set("id_guru",$id_guru)
                ->set("id_kelas",$id_kelas);
        
        if($this->db->insert("t_assign_wali")){
            redirect(site_url("admin/guru_wali"));
        }
        else{
            quit("Error!","Kesalahan dalam input data : 86");
        }
    }
    function guru_wali(){
        requirePermission(SUPERADMIN_LEVEL);
        
        $for_smt = null;
        
        if($this->input->post("smt") != null){
            $for_smt = base64_decode($this->input->post("smt"));
            goto process;
        }
        
        if($this->session->userdata("select_wali_for_semester") != null){
            $for_smt = $this->session->userdata("select_wali_for_semester");
            goto process;
        }
        
        $this->db->select("id")
                ->from("m_semester")
                ->order_by("timestamp")
                ->limit(1,0);
        
        $q = $this->db->get();
        
        if($q->num_rows() < 1){
            quit("Data semester kosong!", "Silahkan input data semester!");
            
        }
        
        $d = $q->result();
        $d = end($d);
        
        $for_smt = $d->id;
        
        
        process:        
        $this->session->set_userdata("select_wali_for_semester",$for_smt);
        $table = "t_assign_wali";
        
        $this->db
                ->select("a.*,b.nama_guru,b.kode_identitas,c.nama_kelas")
                ->from($table." a")
                ->join("m_guru b","a.id_guru = b.id","left")
                ->join("m_kelas c","a.id_kelas = c.id","left")
                ->where("a.id_semester",$for_smt);                
        
        $q = $this->db->get();
        $fields = $q->list_fields();
        $fieldcaption = array();
        
        {
            $fieldcaption["nama_guru"] = "Nama Guru";
            $fieldcaption["nama_kelas"] = "Kelas";            
            $fieldcaption["action"] = "Opsi";  
        }
        
        $data = $q->result();
        for ($i = 0;$i < count($data); $i++){            
            
            $data[$i]->action = array(
                array(
                    "link_caption"=>"Hapus",
                    "link"=>  "javascript:confirmDeletion('".site_url("admin/hapus_wali?d=".  urlencode(base64_encode($data[$i]->id)))."')"
                )
            );
        }
        array_push($fields, "action");
        
        
        $this->db->select("*")
                ->from("m_semester");
        
        $qsmt = $this->db->get();
        $qsmt = $qsmt->result();
        for($i = 0;$i < count($qsmt);$i++){
            $qsmt[$i]->nomor_semester = calculateSmt($qsmt[$i]->tahun_masuk)." (".$qsmt[$i]->tahun_masuk.")";
        }
        
        $this->db
                ->select("*")
                ->from("m_guru");
        $qguru = $this->db->get();
        
        $this->db
                ->select("*")
                ->from("m_kelas");
        $qkelas = $this->db->get();
        
        $dkelas = $qkelas->result();
        for($i = 0;$i < count($dkelas);$i++){
            $dkelas[$i]->nama_kelas = getTingkat($dkelas[$i]->nama_kelas, $dkelas[$i]->tahun_masuk);
        }
        
        $vwdata = array();
        $vwdata["data"] = $data;
        $vwdata["table_title"] = "Data wali kelas semester ".calculateSmt(getValueFromDB("m_semester", "tahun_masuk", "id", $for_smt));
        $vwdata["datasmt"] = $qsmt;
        $vwdata["fields"] = $fields;
        $vwdata["fcaption"] = $fieldcaption;
        $vwdata["smt_now"] = $for_smt;
        $vwdata["dataguru"] = $qguru->result();
        $vwdata["datakelas"] = $dkelas;     
        
        $this->load->view("component/header",array("contain"=>true));
        
        $this->load->view("partial/view_wali_kelas",$vwdata);
        
        $this->load->view("component/footer");
    }
}
?>