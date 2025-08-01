<?php 
class AdminComment{
    private $db;
    public function __construct(){
        $this->db = connectDB();
    }
}