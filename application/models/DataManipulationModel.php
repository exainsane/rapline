<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class DataManipulationModel extends CI_Model{
    function __construct(){
        parent::__construct();

    }
    /**
     * 
     * @param String $tbl
     * return array
     */
    public function getTableFieldList($tbl,$display_all = false){
        $this->db
            ->select("*")
            ->from($tbl)
            ->limit(1);
        
        if($display_all) return $this->db->get()->list_fields();
        
        $flds = $this->db->get()->list_fields();        
        return $this->trim_fields($flds);         
    }
    
    public function trim_fields($array){
        $flds = array();
        $this->load->helper("fields");
        foreach($array as $field){
            if(showFields($field)){
                array_push($flds, $field);
            }
        }
        return $flds;
    }
    
    public function insert($tbl,$array){
        $fields = $this->getTableFieldList($tbl);

        foreach ($fields as $key => $value){
          if(isset($array[$key])){
            $this->db->set($key,$value);
          }
        }

        return $this->db->insert($tbl);
    }

    public function delete($tbl,$id){
        return $this->db
              ->where("id",$id)
              ->delete($tbl);
    }

    public function update($tbl,$array){
        if(!isset($array["id"]))
            show_error("Error on update method! <br/> <strong>No primary key specified</strong>");

        $fields = $this->getTableFieldList($tbl);

        foreach ($fields as $key => $value){

            if($key == "id") continue;

            if(isset($array[$key])){
                $this->db->set($key,$value);
            }            
        }

        return $this->db->update($tbl);
    }
    
    public function getData($tbl,$limit = null,$search = null,$orderby = null,$orderby_type = null, $exact_search = null){
        $this->db
                ->select("*")
                ->from($tbl);
                
        
        if($limit != null)
            $this->db->limit($limit);
        
        if($search != null)
        {
            $flds = $this->getTableFieldList($tbl);
            
            $ascarr = array();
            
            foreach ($flds as $f){
                $ascarr[$f] = $search;
            }
            
            $this->db->like($ascarr);
        }
        
        if($orderby != null)
            $this->db->order_by($orderby,($orderby_type != null? $orderby_type : 'ASC'));
        
        if($exact_search != null){
            $this->db->where($exact_search);
        }
        
        return $this->db->get();
    }
    
    public function filterQuery($limit = null,$search = null,$orderby = null,$orderby_type = null, $exact_search = null){
        if($limit != null)
            $this->db->limit($limit);
        
        if($search != null)
        {
            $flds = $this->getTableFieldList($tbl);
            
            $ascarr = array();
            
            foreach ($flds as $f){
                $ascarr[$f] = $search;
            }
            
            $this->db->like($ascarr);
        }
        
        if($orderby != null)
            $this->db->order_by($orderby,($orderby_type != null? $orderby_type : 'ASC'));
        
        if($exact_search != null){
            $this->db->where($exact_search);
        }
    }
}
?>