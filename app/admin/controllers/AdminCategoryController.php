<?php 
class AdminCategoryController{
    private $model;
    public function __construct(){
        $this->model = new AdminCategory();
    }
}