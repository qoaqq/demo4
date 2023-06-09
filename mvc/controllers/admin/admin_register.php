<?php
class admin_register extends Controller {
    public $admin_register;

    public function __construct(){
        $this->admin_register = $this->admin_Model("adminUser_Model");
    }

    public function Theme() {
        $this->view_Admin("admin_register", [
            'page' => 'register'
        ]);
    }


    public function InsertFeature() {
        $fullname = $_POST['fullname'];
        $phonenumber = $_POST['phonenumber'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $type = $_POST['type'];
        $errors= array();

        // ['img', 'fullname', 'phonenumber', 'address', 'email', 'type']
        
        $file = $_FILES['img'];
        $img = $file['name'];
        if ($file['size'] <= 0) {
            $errors['img'] = "Bạn cần nhập ảnh";
        } else {
            $img_type = ['jpg', 'png', 'gif'];
            $ext = pathinfo($img, PATHINFO_EXTENSION);
            if (!in_array($ext, $img_type)) {
                $errors['img'] = "File không phải là ảnh";
            }
        }

        // die;
        if(isset($_POST["btn_insertUser"])){
            $this->admin_register->insertUser($fullname, $phonenumber, $address, $email, $img, $type);
            move_uploaded_file($file['tmp_name'], "./public/img/".$img);
            header("location: http://localhost/live/admin/admin_register");
            exit();
        }

        $this->view_Admin("admin_register", [
            'error' => $errors
        ]);
    }
}