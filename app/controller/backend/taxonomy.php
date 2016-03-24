<?php
class Taxonomy_Backend_Controller extends Backend_Controller {
    
    public function Index() {
        return $this->renderTemplate('taxonomy');
    }
    /**
     * create news
     * @permission taxonomy/create|taxonomy create @end_permission
     */
    public function Create() {
        $param = $this->get_param(array('taxonomy_name', 'type', 'parent'));

        if(empty($param['taxonomy_name'])) {
            unset($param['taxonomy_name']);
        }
        
        if(empty($param['type'])) {
            unset($param['type']);
        }
        
        if(empty($param['parent'])) {
            unset($param['parent']);
        }
        
        $result['errorMsg'] = '';
        $taxonomy_model = new Taxonomy_model();
        
        if($taxonomy_model->create_taxonomy($param) != true) {
            $result['errorMsg'] = "Have an error, please contact your admin";
        }
        // return to successfull page
        return View::Json($result);
    }
    
    /**
     * @permission taxonomy/list|list taxonomy @end_permission
     */
    public function Listdata() {
        $taxonomy_model = new Taxonomy_model();
        $data = $taxonomy_model->get_list_taxonomy();
        return View::Json($data);
    }
    
    /**
     * Check login
     * @return boolean
     */
    public function Checklogin() {
        $taxonomy_model = new Taxonomy_model();
        $result = $taxonomy_model->checklogin(); 
        return View::Json($result);
    }
    
    /**
     * update data
     * @permission taxonomy/update|Update taxonomy @end_permission
     */
    public function Update() {
        $param = $this->get_param(array('taxonomy_name', 'type', 'parent', 'id'));
        $result['errorMsg'] = '';
        if(!empty($param['id'])) {
            $id = $param['id'];
            $data = array();
            
            // update data
            if($param['taxonomy_name'] != '') {
                $data['taxonomy_name'] = $param['taxonomy_name'];
            }
            
            if($param['type'] != '') {
                $data['type'] = $param['type'];
            }
            
            if($param['parent'] != '') {
                $data['parent'] = $param['parent'];
            }
            
            $taxonomy_model = new Taxonomy_model();
            if($taxonomy_model->update_taxonomy($data, $id) != true) {
                $result['errorMsg'] = "Have an error, please contact your admin";
            }
        }
        
        return View::Json($result);
    }
    
    /**
     * Delete taxonomy action
     */
    public function Delete() {
        $param = $this->get_param(array('id'));
        $result['errorMsg'] = "";
        $result['success'] = true;
        if(!empty($param['id'])) {
            $taxonomy_model = new Taxonomy_model();
            if($taxonomy_model->delete_taxonomy($param['id']) != true) {
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