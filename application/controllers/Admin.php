<?php  
class Admin extends CI_Controller{
	
    function __construct(){
        parent::__construct();

        $this->load->database();
        $this->load->helper("url");
        $this->load->helper("fields");
        $this->load->library("session");
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