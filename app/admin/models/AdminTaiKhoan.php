<?php
class AdminTaiKhoan
{
    private $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllTaiKhoan($chuc_vu_id)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE chuc_vu_id = :chuc_vu_id ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':chuc_vu_id' => $chuc_vu_id
            ]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

    public function insertTaiKhoan($ho_ten, $email, $password, $so_dien_thoai, $dia_chi, $chuc_vu_id, $ngay_sinh, $gioi_tinh, $anh_dai_dien = null)
{
    try {
        // Bật chế độ exception cho PDO
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Hash mật khẩu
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO tai_khoans 
                (ho_ten, email, mat_khau, so_dien_thoai, dia_chi, chuc_vu_id, ngay_sinh, gioi_tinh, anh_dai_dien)
                VALUES 
                (:ho_ten, :email, :mat_khau, :so_dien_thoai, :dia_chi, :chuc_vu_id, :ngay_sinh, :gioi_tinh, :anh_dai_dien)';

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':ho_ten' => $ho_ten,
            ':email' => $email,
            ':mat_khau' => $hashedPassword,
            ':so_dien_thoai' => $so_dien_thoai,
            ':dia_chi' => $dia_chi,
            ':chuc_vu_id' => $chuc_vu_id,
            ':ngay_sinh' => $ngay_sinh,        // Định dạng YYYY-MM-DD
            ':gioi_tinh' => $gioi_tinh,        // 1 = Nam, 0 = Nữ
            ':anh_dai_dien' => $anh_dai_dien   // Có thể null
        ]);

        // Kiểm tra có insert thành công không
        return $stmt->rowCount() > 0;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}


    public function getDetailTaiKhoan($id)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id

            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }


    public function updateTaiKhoan($id, $ho_ten, $anh_dai_dien, $email, $so_dien_thoai, $dia_chi, $chuc_vu_id)
    {
        try {

            $sql = 'UPDATE tai_khoans 
                    SET
                    ho_ten = :ho_ten,
                    anh_dai_dien = :anh_dai_dien,
                    email = :email,
                    so_dien_thoai = :so_dien_thoai,
                    dia_chi = :dia_chi,
                    
                    chuc_vu_id=:chuc_vu_id


                    
                    
                WHERE id = :id ';

            $stmt = $this->conn->prepare($sql);

            // var_dump($stmt);die;
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':anh_dai_dien' => $anh_dai_dien,
                ':email' => $email,

                ':so_dien_thoai' => $so_dien_thoai,

                ':dia_chi' => $dia_chi,


                ':chuc_vu_id' => $chuc_vu_id,




                ':id' => $id

            ]);


            return true;
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    /////////////////////

    public function updateTaiKhoan2($id, $ho_ten, $anh_dai_dien, $email, $so_dien_thoai, $dia_chi, $ngay_sinh, $gioi_tinh, $chuc_vu_id)
    {
        try {

            $sql = 'UPDATE tai_khoans 
                SET
                ho_ten = :ho_ten,
                anh_dai_dien = :anh_dai_dien,
                email = :email,
                so_dien_thoai = :so_dien_thoai,
                dia_chi = :dia_chi,
                ngay_sinh = :ngay_sinh,

                gioi_tinh = :gioi_tinh,
                
                chuc_vu_id=:chuc_vu_id


                
                
            WHERE id = :id ';

            $stmt = $this->conn->prepare($sql);

            // var_dump($stmt);die;
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':anh_dai_dien' => $anh_dai_dien,
                ':email' => $email,

                ':so_dien_thoai' => $so_dien_thoai,

                ':dia_chi' => $dia_chi,
                ':ngay_sinh' => $ngay_sinh,
                ':gioi_tinh' => $gioi_tinh,


                ':chuc_vu_id' => $chuc_vu_id,




                ':id' => $id

            ]);


            return true;
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

    public function checkLogin($email, $mat_khau)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

        
        //    
    
            if ($user && $mat_khau=='123456') {
                if ($user['chuc_vu_id'] == 1) {

                    return $user['email'];
                } else {
                    return "tài khoản không có quyền đăng nhập";
                }
            } else {
                return "Tài khoản hoặc mật khẩu không chính xác";
            }
        } catch (\Exception $e) {
            echo "Lỗi" . $e->getMessage();
            return false;
        }
    }

    public function getTaiKhoanFormEmail($email)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':email' => $email

            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    public function resetPassword($id, $mat_khau)
    {
        try {

            $sql = 'UPDATE tai_khoans 
                    SET
                    mat_khau = :mat_khau
                    
                    
                   
                WHERE id = :id ';

            $stmt = $this->conn->prepare($sql);

            // var_dump($stmt);die;
            $stmt->execute([
                ':mat_khau' => $mat_khau,

                ':id' => $id

            ]);


            return true;
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
}
