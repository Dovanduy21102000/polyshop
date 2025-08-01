<?php 
class AdminCommentController{
    private $model;
    public function __construct(){
        $this->model = new AdminComment();
    }
}