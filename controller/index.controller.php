<?php
use Config\Database\Data as DB;
include 'configs/data.config.php';

class IndexController {
    
    public function __construct() {
        // instancia base de dados
        $database = new DB(); 
    }
    
}

new IndexController();