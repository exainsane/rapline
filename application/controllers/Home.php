<?php  
class Home extends CI_Controller{
	
    function __construct(){
        parent::__construct();

        $this->load->database();
        $this->load->helper("url");
        $this->load->helper("fields");
        $this->load->library("session");
    }
    function logout(){         
        $this->session->sess_destroy();    
        redirect(site_url("home"));
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
    
    private function getTableListLink(){
        $this->load->library("ViewAdapter");

        $viewAdapter = new ViewAdapter();

        $viewAdapter->setFrame($this->load->view("listadapter/list_collection_frame","",true));
        $viewAdapter->setViewPort($this->load->view("listadapter/list_collection_viewport_link","",true));
        
        $tables = $this->db->list_tables();
        
        $data = array();
        
        foreach ($tables as $t){
            $q = array(
                'href'=>  site_url("home/getForms?table=". urlencode(base64_encode($t))),
                'link'=> 'Edit table '.$t
            );
            
            array_push($data, $q);            
        }
        
        $viewAdapter->setData($data);
        
        return $viewAdapter->get();
    }
    
    function login($verify = null){
        if($verify == "verify")
            $this->_login_verify ();
        else
            $this->_login_showpage ();
    }
    private function _login_showpage($failed = false){
        $this->index(array(
            "login"=>array(
                "failed"=>$failed
            )
        ));
    }
    private function _login_verify(){
        $username = $this->input->post("username");
        $password = md5($this->input->post("password"));
        
        $this->load->model("DataManipulationModel");
        
        $dmm = new DataManipulationModel();
        
        //Search id guru
        $data_guru = $dmm->getData("m_guru", null, null, null, null, "kode_identitas = '".$username."'");
        
        if($data_guru->num_rows() == 1){
            
            $user_info = $data_guru->result();
            $user_info = end($user_info);
            
            $this->db
                 ->where("password_for",FIELD_CODE_GURU)
                 ->where("id_user",$user_info->id)
                 ->where("password",$password);
            
            $data_exist = $this->db->get("m_password_login")->num_rows() == 1;
            
            if(!$data_exist)
            {                
                return $this->_login_showpage(true);
            }
            
            $vwdata = array(
                "name"=>$user_info->nama_guru,
                "id_code"=>$user_info->kode_identitas,
                "level"=>"Guru"
            );
            
            $this->_login_set_session($user_info->id, FIELD_CODE_GURU);
            
            return $this->_post_login($vwdata);
        }
        
        $data_siswa = $dmm->getData("m_siswa", null, null, null, null, "kode_identitas = '".$username."'");
        
        if($data_siswa->num_rows() == 1){
            
            $user_info = $data_siswa->result();
            $user_info = end($user_info);
            
            $this->db
                 ->where("password_for",FIELD_CODE_SISWA)
                 ->where("id_user",$user_info->id)
                 ->where("password",$password);
            
            $data_exist = $this->db->get("m_password_login")->num_rows() == 1;
            
            if(!$data_exist)
            {                
                return $this->_login_showpage(true);
            }
            
            $vwdata = array(
                "name"=>$user_info->nama_siswa,
                "id_code"=>$user_info->kode_identitas,
                "level"=>"Siswa"
            );
            
            $this->_login_set_session($user_info->id, FIELD_CODE_SISWA);
            
            return $this->_post_login($vwdata);
        }
        
        return $this->_login_showpage(true);
    }
    private function _login_set_session($id, $fieldcode){
        $sessdata = array(
            "login_id_user"=>$id,
            "login_level"=>$fieldcode
        );

        $this->session->set_userdata($sessdata);
    }
    private function _post_login($data){
        $this->load->view("component/header");
        
        $vwdata = array();
        $data["redir"]    = site_url("home");
        $data["time"]     = 3;
        $this->load->view("usernotification/post_login",$data);
        
        $this->load->view("component/footer");
    }
    function getPassword($get = null){
        if($get == null){            
            $this->load->view("component/header",array('contain'=>true));
            
            instantiateJS("getPasswordPage","pwdpage");

            $this->load->view("getpassword");

            $this->load->view("component/footer");            
        }
        
        if($get == "true"){
            //TODO : set variable for password generations
            $pwd = getGeneratedPassword(6);

            $table = "m_password_login";

            $cred_info = base64_decode($this->input->post("cred"));
            
            $cred_info = explode("./",$cred_info);
            
            if(count($cred_info) != 2)
                show_404 ();
            
            $this->load->model("DataManipulationModel");
            
            $dmm = new DataManipulationModel();                        
            
            if($cred_info[0] == FIELD_CODE_GURU){
                $user_info = $dmm->getData("m_guru", null, null, null, null, "kode_identitas = '".$cred_info[1]."'");
                
                if($user_info->num_rows() != 1)
                    show_404;
                
                $user_info = $user_info->result();
                $user_info = end($user_info);
                
                //Clear previous password if exist
                $this->db
                        ->where("password_for",$cred_info[0])
                        ->where("id_user",$user_info->id)
                        ->delete($table);  
                
                $this->db->set("id_user",$user_info->id);
            }
            else if($cred_info[0] == FIELD_CODE_SISWA){
                $user_info = $dmm->getData("m_siswa", null, null, null, null, "kode_identitas = '".$cred_info[1]."'");
                
                if($user_info->num_rows() != 1)
                    show_404;
                
                $user_info = $user_info->result();
                $user_info = end($user_info);
                
                //Clear previous password if exist
                $this->db
                        ->where("password_for",$cred_info[0])
                        ->where("id_user",$user_info->id)
                        ->delete($table);               
                
                $this->db->set("id_user",$user_info->id);
            }
            
            
            $this->db->set("password_for",$cred_info[0]);
            $this->db->set("password",md5($pwd));
            
            $this->db->insert($table);
            
            $vwdata = array(
                'password_show' => $pwd
            );
            
            $this->load->view("component/header",array('contain'=>true));
            $this->load->view("getpassword",$vwdata);
            $this->load->view("component/footer");
            
        }
    }    
    function credCheck(){
        $this->load->model("DataManipulationModel","dmm");
        $this->load->library("ViewAdapter");
        
        $usertype = "unknown";
        $cred_id = $this->input->post("cred_id");
        
        $search_data = $this->dmm->getData("m_siswa",null,null,null,null,"kode_identitas = '".$cred_id."'");
        
        if($search_data->num_rows() == 1)
        {
            $usertype = "Siswa";
            goto setup_view;
            
        }
        
        $search_data = $this->dmm->getData("m_guru",null,null,null,null,"kode_identitas = '".$cred_id."'");
        
        if($search_data->num_rows() == 1)
        {
            $usertype = "Guru";
            goto setup_view;
            
        }
        
        goto exit_view;
        
        setup_view:
        $viewAdapter = new ViewAdapter();
        
        $viewAdapter->setFrame($this->load->view("listadapter/list_collection_frame_form","",true));
        $viewAdapter->setViewPort($this->load->view("listadapter/list_collection_viewport","",true));
        
        
         
        $qdata = $search_data->result();
        $qdata = end($qdata);
        
        $field_nama = null;
        $fieldcode = -1;
        
        switch ($usertype){
            case "Guru":
                $field_nama = "nama_guru";
                $fieldcode = FIELD_CODE_GURU;
                break;
            case "Siswa":
                $field_nama = "nama_siswa";
                $fieldcode = FIELD_CODE_SISWA;
                break;
        }
        
        $viewAdapter->setMetaData(array(
            'form_action'=>  site_url('home/getPassword/true'),
            'cred_value'=>  base64_encode($fieldcode."./".$qdata->kode_identitas)
        ));
        
        $data = array(
          array(
             'label'=>'Tipe User',
             'text'=>$usertype)
          ,array(
              'label'=>'Kode Indentitas',
              'text'=>$qdata->kode_identitas                
          ),array(
              'label'=>'Nama',
              'text'=>$qdata->$field_nama                
          )
        );

        $viewAdapter->setData($data);

        $viewAdapter->render();
        return;
        exit_view:
        echo "<h4>User tidak ditemukan!</h4><a class=\"right btn btn-flat\" onclick=\"pwdpage.reverseCredentialForm()\">Retry</a>";
    }
    function getForms(){
        
//        error_reporting(E_ALL);
        //table in GET marks table name input
        if($this->input->get("table") == null) 
            show_404 ();                
        
        //table in FORM marks data input
        if($this->input->post("table") != null){            
            $this->load->model("FormAction");
            $this->FormAction->input();
        }
        
        $tbl = base64_decode(urldecode($this->input->get("table")));
        
        $this->load->model("DataManipulationModel","dmm");
        $this->load->library("ViewAdapter");
                        
        
        $vw = new ViewAdapter();
        
        $vw
            ->setFrame($this->load->view("listadapter/form_basic_frame", "", TRUE))
            ->setViewPort($this->load->view("listadapter/form_basic_viewport","",TRUE));                
        
        
        
        $fields = $this->dmm->getTableFieldList($tbl);
        
        $data = array();
        
        foreach ($fields as $f) {
            $q = array(
                'placeholder'=>'input '.$f,
                'title'=>$f,
                'inputname'=>$f,
                'id'=>$f.'-field'
            );
            array_push($data, $q);
        }
        
        $metadata = array(
            'action'=>  '',
            'title'=> 'Form Input',
            'submittext' => 'Send',
            'tbname' => base64_encode($tbl)
        );
        
        $vw->setMetaData($metadata);
        $vw->setData($data);
                        
        $data = array(
            'data'=>$this->dmm->getData($tbl)->result_array(),
            'fields'=>$this->dmm->getTableFieldList($tbl),
            'form'=>$vw->get()
        );
        
        $this->load->view("component/header",array("contain"=>true));
        $this->load->view("partial/datatable", $data);
        $this->load->view("component/footer");
    }
}
?>