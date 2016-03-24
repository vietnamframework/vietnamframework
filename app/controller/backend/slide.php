<?php
class Slide_Backend_Controller extends Backend_Controller {
    
    public function Index() {
        return $this->renderTemplate('slide');
    }
    /**
     * create news
     * @permission slide/create|slide create @end_permission
     */
    public function Create() {
        $param = $this->get_param(array('title', 'content', 'image', 'sub_image', 'taxonomy_id'));

        if(empty($param['status'])) {
            unset($param['status']);
        }
        
        if(empty($param['parent'])) {
            unset($param['parent']);
        }
        
        $result['errorMsg'] = '';
        $slide_model = new Slide_model();
        
        if($slide_model->create_slide($param) != true) {
            $result['errorMsg'] = "Have an error, please contact your admin";
        }
        // return to successfull page
        return View::Json($result);
    }
    
    /**
     * @permission slide/list|list slide @end_permission
     */
    public function Listdata() {
        $slide_model = new Slide_model();
        $data = $slide_model->get_list_slide();
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
        $slide_model = new Slide_model();
        $result = $slide_model->checklogin(); 
        return View::Json($result);
    }
    
    /**
     * update data
     * @permission slide/update|Update slide @end_permission
     */
    public function Update() {
        $param = $this->get_param(array('title', 'content', 'image', 'sub_image', 'taxonomy_id', 'id'));
        $result['errorMsg'] = '';
        if(!empty($param['id'])) {
            $id = $param['id'];
            $data = array();
            
            // update data
            if($param['title'] != '') {
                $data['title'] = $param['title'];
            }
            
            if($param['content'] != '') {
                $data['content'] = $param['content'];
            }
            
            if($param['image'] != '') {
                $data['image'] = $param['image'];
            }
            
            if($param['sub_image'] != '') {
                $data['sub_image'] = $param['sub_image'];
            }
            
            if($param['taxonomy_id'] != '') {
                $data['taxonomy_id'] = $param['taxonomy_id'];
            }
            
            $slide_model = new Slide_model();
            if($slide_model->update_slide($data, $id) != true) {
                $result['errorMsg'] = "Have an error, please contact your admin";
            }
        }
        
        return View::Json($result);
    }
    
    /**
     * Delete slide action
     */
    public function Delete() {
        $param = $this->get_param(array('id'));
        $result['errorMsg'] = "";
        $result['success'] = true;
        if(!empty($param['id'])) {
            $slide_model = new Slide_model();
            if($slide_model->delete_slide($param['id']) != true) {
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