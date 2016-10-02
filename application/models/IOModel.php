<?php

/*
 * Copyright 2016 Exairie
 * Any application should be used with the developer"s permission * 
 */

/**
 * Description of IOModel
 *
 * @author exain
 */
class IOModel extends CI_Model {
    
    function __construct(){
        parent::__construct();
        
        $this->load->database();
    }
    public $recentError;
    function handleDocumentUpload(){
        $docuploadfield = "doc";
        
        $config["upload_path"]          = "./assets/cache/";
        $config["allowed_types"]        = "xlsx";
        
        
        $this->load->helper("dir");
        $this->load->library("upload", $config);

        recursive_check_add_dir($config["upload_path"], "/");
        
        if ( ! $this->upload->do_upload($docuploadfield))
        {                
                $this->recentError = $this->upload->display_errors();
                return null;
        }
        else
        {
                $data = array("upload_data" => $this->upload->data());
                $file = $this->upload->data("full_path");  
                return $this->handleXLSX($file);
        }
        
                     
    }
    
    function handleXLSX($file){
        include_once "./assets/extlib/PHPExcel.php";                
        
       
        $xlsReader = PHPExcel_IOFactory::createReader(PHPExcel_IOFactory::identify($file));
        
        $xls = $xlsReader->load($file);
        
        //First sheet
        $sheet = $xls->getSheet(0);
        
        $data = array();
        
        for($i = 1;$i <= $sheet->getHighestRow();$i++){
            $rowData = $sheet->rangeToArray('A' . $i . ':' . $sheet->getHighestColumn() . $i, 
            NULL, TRUE, FALSE);
            array_push($data,$rowData[0]);
        }
        
        //Delete cache
        unlink($file);                
        
        return $data;
    }
}
