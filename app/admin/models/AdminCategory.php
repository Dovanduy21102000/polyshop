<?php 
class AdminCategory{
    private $db;
    public function __construct(){
        $this->db = connectDB();
    }
}
