<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ViewAdapter{
  private $CI;  
  private $frame = '',$viewPort,$frame_bound;
  private $data, $metadata, $viewPort_bound;
  function __construct(){
    $this->CI =& get_instance();
    
    return $this;
  }
  
  static function getFormByTableName($tbl, $data = null, $post_to = null){
    $ci =& get_instance();
    $ci->load->model("DataManipulationModel","dmm");
    $ci->load->library("ViewAdapter");


    $vw = new ViewAdapter();

    $vw
        ->setFrame($ci->load->view("listadapter/form_basic_frame", "", TRUE))
        ->setViewPort($ci->load->view("listadapter/form_basic_viewport","",TRUE));                



    $fields = $ci->dmm->getTableFieldList($tbl);

    $data = array();

    foreach ($fields as $f) {
        $generalized_name = explode("_", $f);
        for($i = 0; $i < count($generalized_name);$i++) {
            $generalized_name[$i] = ucfirst($generalized_name[$i]);
        }
        
        $generalized_name = implode(" ", $generalized_name);
        $q = array(
            'placeholder'=>'input '.$generalized_name,
            'title'=>$generalized_name,
            'inputname'=>$f,
            'id'=>$f.'-field'
        );
        array_push($data, $q);
    }

    $metadata = array(
        'action'=>  '',
        'title'=> 'Form Input',
        'submittext' => 'Send',
        'tbname' => base64_encode($tbl),
        'action_post'=>$post_to
    );

    $vw->setMetaData($metadata);
    $vw->setData($data);

    return $vw->get();
  }
  
  function setFrame($viewstr){    
    $this->frame = $viewstr;
    
    return $this;
  }
  
  function setViewPort($vp){
    $this->viewPort = $vp;
    
    return $this;
  }
  
  function setMetaData($arr,$autobind = true){
      $this->metadata = $arr;
      
      if($autobind)
          return $this->bindMetaData ();
      
      return $this;
  }
  
  function bindMetaData(){
      foreach ($this->metadata as $key => $value){
          $this->frame = str_replace(":[".$key."]:", $value, $this->frame);
      }
      
      return $this;
  }
  
  function setData($arr,$autobind = true){
    $this->data = $arr;
    
    if($autobind)
      return $this->bindViewPort();
    
    return $this;
  }
  
  function bindViewPort(){
    $this->viewPort_bound = array();
    
    foreach ($this->data as $data){
      $d = $this->viewPort;
      foreach ($data as $key => $value) {
        $d = str_replace(":[".$key."]:", $value, $d);              
      }      
      array_push($this->viewPort_bound, $d);
    }
    
    $this->bindFrame();
  }
  
  function bindFrame(){
    $this->frame_bound = str_replace(":[content]:", implode("", $this->viewPort_bound), $this->frame);    
    
    return $this;
  }
  
  function render(){
    echo $this->frame_bound;
  }
  
  function get(){
      return $this->frame_bound;
  }
}
?>