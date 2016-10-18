<?php

/* 
 * Copyright 2016 Exairie
 * Any application should be used with the developer's permission * 
 */
//function checkSuperadminAccount(){
//    $ci =& get_instance();
//    
//    $ci->db->select("*")
//            ->from("m_password_login")
//            ->where("password_for",99);
//    
//    $q = $ci->db->get();
//    
//    if($q->num_rows() != 1){
//        //Dont allow more than 1 superadmin account
//        $this->db->where("password_for",99)->delete("m_password_login");                    
//        $this->db->
//        
//        //Insert superadmin account        
//    }   
//}
function showFields($field){
    $flds = explode(",", DB_HIDE_FIELDS);
    
    if(is_numeric(array_search($field, $flds)))
        return false;
    else return true;
}

function returnDefaultIfNull($var, $default){
    return $var == null?$default:$var;
}
function instantiateJS($classname,$objname){
    $ci =& get_instance();
    
    $ci->output->append_output("<script>var ".$objname." = new ".$classname."();</script>");
}
function getGeneratedPassword($length){
    $pwd = "";
    
    for($i = 0;$i<$length;$i++){
        $pwd .= rand(0, 9);
    }
    
    return $pwd;
}
function getValue($index,$obj){
    if(is_object($obj)){
        return isset($obj->$index)?$obj->$index:"";
    }
    else if(is_array($obj)){
        return isset($obj[$index])?$obj[$index]:"";
    }
}
function getValueEncoded($index,$obj){
    if(is_object($obj)){
        return base64_encode(isset($obj->$index)?$obj->$index:"");
    }
    else if(is_array($obj)){
        return base64_encode(isset($obj[$index])?$obj[$index]:"");
    }
}
function getUserData(){
    $ci =& get_instance();
    
    $ci->db
        ->select("*")
        ->where("id",$ci->session->userdata("login_id_user"));
        
    if($ci->session->userdata("login_level") == FIELD_CODE_GURU){
        $data = $ci->db->get("m_guru");
    }else if($ci->session->userdata("login_level") == FIELD_CODE_SISWA){
        $data = $ci->db->get("m_siswa");
    }else if($ci->session->userdata("login_level") == SUPERADMIN_LEVEL){
        $data = new stdClass();
        
        $data->id = 99;
        $data->nama_guru = "SUPERADMIN";
        $data->kode_identitas = 99;
        $data->jenis_kelamin = "X";
        $data->email = "admin@domain.com";
        $data->timestamp = date("Y-m-d H s");
        
        goto directreturn;
    }
    
    if($data == null) return null;
    if($data->num_rows() != 1) return null;
    
    $data = $data->result();
    $data = end($data);
    
    directreturn:
    return $data;
}
function show_custom_error($message,$resolve = null){
    $vwdata = array();
    
    $vwdata["error"] = $message;
    
    if($resolve != null)
    {
        $vwdata["resolve"] = $resolve;
    }
    
    $ci =& get_instance();
    
    $ci->load->view("component/header",array("contain"=>true));
    $ci->load->view("partial/error_notification",$vwdata);
    $ci->load->view("component/footer");
    
    
}

function query_first($q){
    $d = $q->result();
    $d = end($d);
    return $d;
}

function search_where($search, $arr, $field){
    for($i = 0;$i < count($arr); $i++){
        if($arr[$i]->$field == $search)
            return $i;
    }
    return -1;
}

function getTingkat($kelas, $tahun_masuk){
    $year_now = intval(date("Y"));
    $tingkat = (intval($year_now - $tahun_masuk) + 10);

    $kelas = ($tingkat > 12?12:$tingkat)." ".$kelas.($tingkat > 12?"(".($tahun_masuk).")":"");
    return $kelas;
}