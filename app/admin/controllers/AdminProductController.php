<?php 
class AdminProductController{
    private $model;
    public function __construct(){
        $this->model = new AdminProduct();
    }
}