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
}
?>