<?php

/* 
 * Copyright 2016 Exairie
 * Any application should be used with the developer's permission * 
 */

class FormAction extends CI_Model{
    function __construct() {
        parent::__construct();
        
        $this->load->database();
    }
    function scanForInput($tbl){
        if($this->input->post("table") != null && $this->input->post("id") == null)
            $this->input();
        else if($this->input->post("table") != null && $this->input->post("id") != null)
            $this->update();
        else if($this->input->get("ctc") != null)
            $this->delete($tbl);
    }
    function delete($tbl){
        if($this->input->get("ctc") == null){
            show_404();
        }
        
        $id = base64_decode(urldecode($this->input->get("ctc")));
        
        $this->db->where("id",$id)
                ->delete($tbl);
    }
    function update(){
        if($this->input->post("table") == null)
        {
            show_404 ();       
        }
        
        $tbl = base64_decode($this->input->post("table"));
        
        $array = $this->input->post(null);
        
        if(!isset($array["id"]))
        {
            show_error("Error on update method! <br/> <strong>No primary key specified</strong>");
        }

        $this->load->model("DataManipulationModel","dmm");                
        
        $fields = $this->dmm->getTableFieldList($tbl);

        foreach ($fields as $key){

            if($key == "id") continue;
            if(preg_match("/img_.*/", $key)){
                $this->db->set($key,$this->uploadFile($key));
            }
            
            if(isset($array[$key])){
                $this->db->set($key,$array[$key]);
            }            
        }
        
        $this->db->where("id",  base64_decode($array['id']));
        $this->db->update($tbl);
    }
    function uploadFile($field){
        $this->load->library("upload");
        
        $upcfg = array();
        $upcfg['upload_path'] = './assets/uploads/images/';
        $upcfg['allowed_types'] = 'jpg|png';
        
        $this->load->helper("dir");
        
        recursive_check_add_dir($upcfg["upload_path"], "/");
        
        $this->upload->initialize($upcfg,true);
        
        if($this->upload->do_upload($field)){
            return $this->upload->data("full_path");
        }
        else{
            quit("Error uploading picture!", $this->upload->display_errors());
        }
    }
    function input(){        
        if($this->input->post("table") == null)
        {
            show_404 ();
        
        }
        
        $this->load->helper("fields");
        
        $tbl = base64_decode($this->input->post("table"));
        
        $this->load->model("DataManipulationModel","dmm");                
        
        $fields = $this->dmm->getTableFieldList($tbl);
//        
        foreach ($fields as $f){
            if(!showFields($f))
                continue;
            
            if($this->input->post($f) != null){
                $this->db->set($f, $this->input->post($f));
            }
        }
//        
        $this->db->insert($tbl);
    }
}
?>