<?php

/* 
 * Copyright 2016 Exairie
 * Any application should be used with the developer's permission * 
 */

function requirePermission($reqlvl){
    $level = get_instance()->session->userdata("login_level");
    if($level == null){
        quit("You must login first before you can continue!",null);
        
    }
    if($level < $reqlvl){
        quit("Access denied","You don't have permission to access this page!");
    }
}
function quit($msg,$resolve){
    show_custom_error($msg, $resolve);
    
    get_instance()->output->_display();
    exit();
}
function isUserLoggedIn(){
    $ci =& get_instance();
    
    $ci->load->library("session");
    
    if($ci->session->userdata("login_id_user") == NULL) {
        return false;
    }
    
    return true;
}
function getUserType(){
    switch(get_instance()->session->userdata("login_level")){
        case 99:
            return "SUPERADMIN";
            break;
        case FIELD_CODE_GURU:
            return "Guru";
            break;
        case FIELD_CODE_SISWA:
            return "Siswa";
            break;
    }
}
function getUserLevel(){
    return get_instance()->session->userdata("login_level");
}
function getUserID(){
    return get_instance()->session->userdata("login_id_user");
}
function isUser($type){
    return getUserLevel() == $type;
}