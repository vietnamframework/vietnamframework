<?php
class Upload_Backend_Controller extends Backend_Controller {
    
    public function Index() {
        if($_FILES['image']['error'] == '0') {
            $tmp_name = $_FILES['image']['tmp_name'];
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $file_name = pathinfo($_FILES['image']['name'],PATHINFO_FILENAME);
            $file_name_return = $file_name."_".uniqid().".".$ext;
            $new_name = VN_FILEUPLOAD_DIR.$file_name_return;
        
            if(move_uploaded_file($tmp_name,$new_name) === true) {
        
                $upload['image']['name'] = $file_name_return;
                $upload['image']['title'] = $file_name;
                $upload['image']['caption'] = '';
                $upload['image']['hash'] = "h598GD2";
                $upload['image']['deletehash'] = "nyhakfx5HLAI2Gv";
                $upload['image']['datetime'] = date('Y-m-d H:i:s');
                $upload['image']['type'] = $_FILES["image"]["type"];
                $upload['image']['animated'] = "false";
                // 				$upload['image']['width'] = "200";
                // 				$upload['image']['height'] = "200";
                $upload['image']['views'] = 0;
                $upload['image']['size'] = $_FILES["image"]["size"];
                $upload['image']['bandwidth'] = 0;
        
                $upload['links']['original'] = Core::base_url()."file_upload/".$file_name_return;
                $upload['links']['imgur_page'] = '';
                $upload['links']['delete_page'] = '';
                $upload['links']['small_square'] = '';
                $upload['links']['large_thumbnail'] = '';
        
                echo json_encode(array('upload' => $upload));
                return true;
            } else {
                return null;
            }
        
        }
        return null;
    }
    
    public function uploadLocation($file) {
        if($_FILES[$file]['error'] == '0') {
            $tmp_name = $_FILES[$file]['tmp_name'];
            $ext = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
            $file_name = pathinfo($_FILES[$file]['name'],PATHINFO_FILENAME);
            $file_name_return = $file_name."_".uniqid().".".$ext;
            $new_name = VN_FILEUPLOAD_DIR.$file_name_return;
        
            if(move_uploaded_file($tmp_name,$new_name) === true) {
        
//                 $upload['image']['name'] = $file_name_return;
//                 $upload['image']['title'] = $file_name;
//                 $upload['image']['caption'] = '';
//                 $upload['image']['hash'] = "h598GD2";
//                 $upload['image']['deletehash'] = "nyhakfx5HLAI2Gv";
//                 $upload['image']['datetime'] = date('Y-m-d H:i:s');
//                 $upload['image']['type'] = $_FILES[$file]["type"];
//                 $upload['image']['animated'] = "false";
//                 // 				$upload['image']['width'] = "200";
//                 // 				$upload['image']['height'] = "200";
//                 $upload['image']['views'] = 0;
//                 $upload['image']['size'] = $_FILES[$file]["size"];
//                 $upload['image']['bandwidth'] = 0;
        
//                 $upload['links']['original'] = Core::base_url()."file_upload/".$file_name_return;
//                 $upload['links']['imgur_page'] = '';
//                 $upload['links']['delete_page'] = '';
//                 $upload['links']['small_square'] = '';
//                 $upload['links']['large_thumbnail'] = '';
                return $file_name_return;
            } else {
                return null;
            }
        
        }
        return null;
    }

}