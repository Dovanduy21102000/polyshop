<?php 
class Category{
    public $conn;
    public function __construct(){
        $this -> conn= connectDB();
    }
    public function getAllDanhMuc() {
        try {
            $sql = 'SELECT * FROM danh_mucs';
            
            // Chuẩn bị truy vấn
            $stmt = $this->conn->prepare($sql);
    
            // Thực thi truy vấn
            $stmt->execute();
    
            // Lấy tất cả kết quả
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng kết hợp (associative array)
    
            // Nếu không có dữ liệu, trả về mảng trống
            return $result ? $result : [];
            
        } catch (Exception $e) {
            // Hiển thị lỗi nếu xảy ra
            echo "Error: " . $e->getMessage();
            return []; // Trả về mảng trống nếu có lỗi
        }
    }
}