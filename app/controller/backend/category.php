<?php
class Category_Backend_Controller extends Backend_Controller {
    
    public function Index() {
        return $this->renderTemplate('category');
    }
    /**
     * create news
     * @permission category/create|category create @end_permission
     */
    public function Create() {
        $param = $this->get_param(array('category_name', 'parent'));

        if(empty($param['category_name'])) {
            unset($param['category_name']);
        }
        
        if(empty($param['parent'])) {
            unset($param['parent']);
        }
        
        $result['errorMsg'] = '';
        $category_model = new Category_model();
        
        if($category_model->create_category($param) != true) {
            $result['errorMsg'] = "Have an error, please contact your admin";
        }
        // return to successfull page
        return View::Json($result);
    }
    
    /**
     * @permission category/list|list category @end_permission
     */
    public function Listdata() {
        $category_model = new Category_model();
        $data = $category_model->get_list_category();
        //echo json_encode($data);
        //die;
        //var_dump($data); //Core::base_url()
        return View::Json($data);
    }
    
    /**
     * Check login
     * @return boolean
     */
    public function Checklogin() {
        $category_model = new Category_model();
        $result = $category_model->checklogin(); 
        return View::Json($result);
    }
    
    /**
     * update data
     * @permission category/update|Update category @end_permission
     */
    public function Update() {
        $param = $this->get_param(array('category_name', 'parent', 'id'));
        $result['errorMsg'] = '';
        if(!empty($param['id'])) {
            $id = $param['id'];
            $data = array();
                        
            if($param['category_name'] != '') {
                $data['category_name'] = $param['category_name'];
            }
            
            if($param['parent'] != '') {
                $data['parent'] = $param['parent'];
            }
            $category_model = new Category_model();
            if($category_model->update_category($data, $id) != true) {
                $result['errorMsg'] = "Have an error, please contact your admin";
            }
        }
        
        return View::Json($result);
    }
    
    /**
     * Delete category action
     */
    public function Delete() {
        $param = $this->get_param(array('id'));
        $result['errorMsg'] = "";
        $result['success'] = true;
        if(!empty($param['id'])) {
            $category_model = new Category_model();
            if($category_model->delete_category($param['id']) != true) {
                $result['errorMsg'] = "Have an error, please contact your admin";
                $result['success'] = false;
            }
        } else {
            $result['errorMsg'] = "Have an error, please contact your admin";
            $result['success'] = false;
        }
        
        return View::Json($result);
    }
}