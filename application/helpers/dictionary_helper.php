<?php

/* 
 * Copyright 2016 Exairie
 * Any application should be used with the developer's permission * 
 */

function getDictionary($masterkey){
    $ci =& get_instance();
    
    $ci->db
        ->select("*")
        ->from("m_dictionary")
        ->where("masterkey",$masterkey);
    
    $q = $ci->db->get()->result();
    
    $ret = array();
    
    foreach ($q as $result){
        $ret[$result->itemkey] = $result->itemvalue;
    }
    
    return $ret;
}

function saveDictionary($masterkey,$data){
    $ci =& get_instance();    
    foreach($data as $k=>$v){
        $dr = array();
        
        $dr["masterkey"] = $masterkey;
        $dr["itemkey"] = $k;
        $dr["itemvalue"] = $v;
        
        $ci->db->where("masterkey",$masterkey);
        $ci->db->replace("m_dictionary",$dr);
    }
    
}