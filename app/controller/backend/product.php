<?php
class product_Backend_Controller extends Backend_Controller {
    
    public function Index() {
        $ctg_model = new Category_model();
        $data_category = $ctg_model->get_list_category();
        $data['category'] = json_encode($data_category);
        
        $language_model = new Language_model();
        $data_language = $language_model->get_list_language();
        $data['language'] = json_encode($data_language);
        return $this->renderTemplate('product', $data);
    }
    /**
     * create product
     * @permission product/create|product create @end_permission
     */
    public function Create() {
        
        $param = $this->get_param(array(
        		'product_name'
        		, 'price'
        		, 'price_display'
        		, 'discount'
        		, 'product_code'
        		, 'status'
        		, 'rate'
        		, 'description'
        		, 'description_detail'
        		, 'froms_product'
        		, 'material'
        		, 'age_from'
        		, 'age_to'
        		, 'size_id'
        		, 'genders'
        		, 'category_id'
        		
        		
        ));
        
        if(isset($_FILES) && !empty($_FILES) && $_FILES['image_avata']['error'] == '0') {
            $upload = new Upload_Backend_Controller();
            $param['image_avata'] = $upload->uploadLocation('image_avata');
        }
        if(isset($_FILES) && !empty($_FILES) && $_FILES['image_detail_1']['error'] == '0') {
        	$upload = new Upload_Backend_Controller();
        	$param['image_detail_1'] = $upload->uploadLocation('image_detail_1');
        }
        if(isset($_FILES) && !empty($_FILES) && $_FILES['image_detail_2']['error'] == '0') {
        	$upload = new Upload_Backend_Controller();
        	$param['image_detail_2'] = $upload->uploadLocation('image_detail_2');
        }
        
        if(isset($_FILES) && !empty($_FILES) && $_FILES['image_detail_3']['error'] == '0') {
        	$upload = new Upload_Backend_Controller();
        	$param['image_detail_3'] = $upload->uploadLocation('image_detail_3');
        }
        
        if(isset($_FILES) && !empty($_FILES) && $_FILES['image_detail_4']['error'] == '0') {
        	$upload = new Upload_Backend_Controller();
        	$param['image_detail_4'] = $upload->uploadLocation('image_detail_4');
        }
        if(isset($_FILES) && !empty($_FILES) && $_FILES['image_detail_5']['error'] == '0') {
        	$upload = new Upload_Backend_Controller();
        	$param['image_detail_5'] = $upload->uploadLocation('image_detail_5');
        }
        $param['status'] =1;
        $param['user_id'] =1;
       
        
        $result['errorMsg'] = '';
        
        $product_model = new Product_model();
        
        if($product_model->create_product($param) != true) {
            $result['errorMsg'] = "Have an error, please contact your admin";
        }
        // return to successfull page
        return View::Json($result);
    }
    
    /**
     * @permission product/list|list product @end_permission
     */
    public function Listdata() {
        
        
        $param = $this->get_param(array('page', 'rows'));
    	
    	$limmit = '';
    	$offset = '';
    	if($param['page'] != '' && $param['rows'] != '') {
			$limmit = intval($param['rows']);
			$offset = intval(($param['page'] -1) * $limmit);
		}
    	$product_model = new Product_model();
       
        $data = $product_model->get_list_product($limmit, $offset);
        $result['rows'] = $data;
        $count = $product_model->count_data();
        $result['total'] = $count;
        return View::Json($result);
    }
    
    /**
     * update data
     * @permission product/update|Update product @end_permission
     */
    public function Update() {
        $param = $this->get_param(array('lang_id', 'title', 'content', 'category_id', 'file_name', 'tag', 'id'));
        $result['errorMsg'] = '';
        if(!empty($param['id'])) {
            $id = $param['id'];
            $data = array();
            
            if(isset($_FILES) && !empty($_FILES) && $_FILES['file']['error'] == '0') {
                $upload = new Upload_Backend_Controller();
                $param['file_name'] = $upload->uploadLocation('file');
            }
            
            // update data
//             if($param['lang_id'] != '') {
//                 $data['lang_id'] = $param['lang_id'];
//             }
            
//             if($param['title'] != '') {
//                 $data['title'] = $param['title'];
//             }
            
//             if($param['content'] != '') {
//                 $data['content'] = $param['content'];
//             }
            
//             if($param['file_name'] != '') {
//                 $data['file_name'] = $param['file_name'];
//             }
            
//             if($param['category_id'] != '') {
//                 $data['category_id'] = $param['category_id'];
//             }
            
//             if($param['tag'] != '') {
//                 $data['tag'] = $param['tag'];
//             }
            $product_model = new Product_model();
            if($news_model->update_product($param, $id) != true) {
                $result['errorMsg'] = "Have an error, please contact your admin";
            }
        }
        
        return View::Json($result);
    }
    
    /**
     * Delete product action
     */
    public function Delete() {
        $param = $this->get_param(array('id'));
        $result['errorMsg'] = "";
        $result['success'] = true;
        if(!empty($param['id'])) {
            $product_model = new Product_model();
            if($product_model->delete_product($param['id']) != true) {
                $result['errorMsg'] = "Have an error, please contact your admin";
                $result['success'] = false;
            }
        } else {
            $result['errorMsg'] = "Have an error, please contact your admin";
            $result['success'] = false;
        }
        
        return View::Json($result);
    }
    
    /**
     * upload image action
     * @return string|NULL
     */
    public function Upload() {
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

}