<?php
class Group_Backend_Controller extends Backend_Controller {
    
    public function Index() {
        return $this->renderTemplate('group');
    }
    /**
     * create news
     * @permission group/create|group create @end_permission
     */
    public function Create() {
        $param = $this->get_param(array('auth_name'));

        $result['errorMsg'] = '';
        $group_model = new Group_model();
        
        if($group_model->create_group($param) != true) {
            $result['errorMsg'] = "Have an error, please contact your admin";
        }
        // return to successfull page
        return View::Json($result);
    }
    
    /**
     * @permission group/list|list group @end_permission
     */
    public function Listdata() {
        $group_model = new Group_model();
        $data = $group_model->get_list_group();
        return View::Json($data);
    }
    
    /**
     * Check login
     * @return boolean
     */
    public function Checklogin() {
        $group_model = new Group_model();
        $result = $group_model->checklogin(); 
        return View::Json($result);
    }
    
    /**
     * update data
     * @permission group/update|Update group @end_permission
     */
    public function Update() {
        $param = $this->get_param(array('auth_name', 'id'));
        $result['errorMsg'] = 'Have an error, please contact your admin';
        if(!empty($param['id'])) {
            $id = $param['id'];
            $data = array();
            
            // update data
            $data['auth_name'] = $param['auth_name'];
            $group_model = new Group_model();
            if($group_model->update_group($data, $id) === true) {
                $result['errorMsg'] = "";
            }
        }
        
        return View::Json($result);
    }
    
    /**
     * Delete group action
     */
    public function Delete() {
        $param = $this->get_param(array('id'));
        $result['errorMsg'] = "";
        $result['success'] = true;
        if(!empty($param['id'])) {
            $group_model = new Group_model();
            if($group_model->delete_group($param['id']) != true) {
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