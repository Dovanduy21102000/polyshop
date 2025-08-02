<?php 
class Product{
    public $conn; //khai báo phương thức

    public function __construct(){
        $this->conn = connectDB();
    }

    //Viết hàm lấy toàn bộ danh sách sản phẩm

    public function getAllSanPham(){
        try{
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
                    FROM san_phams
                    INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                    WHERE san_phams.trang_thai = 1';  
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
    
            return $stmt->fetchAll();
        }catch (Exception $e){
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getDetailSanPham($id){
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
            FROM san_phams 
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
            WHERE san_phams.id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id'=>$id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

}