<?php 
class User{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function checkLogin($email, $mat_khau){
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            $user = $stmt->fetch();
            if ($user && password_verify($mat_khau, $user['mat_khau'])) {
                    return $user['email'];
            } else {
                return "Bạn nhập sai thông tin";
            }
        } catch (\Exception $e) {
            echo "Lỗi" . $e-> getMessage();
            return false;
        }
   }
   public function insertTaiKhoan($ho_ten, $email, $password, $so_dien_thoai, $dia_chi, $chuc_vu_id)
    {
        try {
            $sql = 'INSERT INTO tai_khoans (ho_ten, email, mat_khau,so_dien_thoai,dia_chi , chuc_vu_id)
             VALUE (:ho_ten,:email,:password,:so_dien_thoai,:dia_chi,:chuc_vu_id)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':password' => $password,
                ':so_dien_thoai' => $so_dien_thoai,
                ':dia_chi' => $dia_chi,

                ':chuc_vu_id' => $chuc_vu_id

            ]);

            return true;
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

    public function getTaiKhoanFromEmail($email)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':email' => $email]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
}