<?php
class Permission_Backend_Controller extends Backend_Controller {
    
    public function Index() {
        return $this->renderTemplate('permission');
    }
    /**
     * create news
     * @permission grand/create|grand create @end_permission
     */
    public function Create() {
        $param = $this->get_param(array('groupid', 'funcid', 'permission'));

        $result['errorMsg'] = '';
        $grand_model = new Grand_model();
        
        if($grand_model->create_grand($param) != true) {
            $result['errorMsg'] = "Have an error, please contact your admin";
        }
        // return to successfull page
        return View::Json($result);
    }
    
    /**
     * @permission grand/list|list grand @end_permission
     */
    public function Listdata() {
        
        $param = $this->get_param(array('groupid'));
        
        $grand_model = new Grand_model();
        $data = '';
        
        if($param['groupid'] != '') {
            $data = $grand_model->getlistbygroup($param['groupid']);
        } else {
            $data = $grand_model->get_list_grand();
        }
        return View::Json($data);
    }
    
    /**
     * permission scan
     */
    public function scanfunc() {
    
        $file = new File_lib();
        $md_permission = new Permision_model();
        $md_permission->permission_scaner(WEB_DIR."/app/controller", $file);
        $result['status'] = 'OK';
        return View::Json($result);
    }
    
    /**
     * Check login
     * @return boolean
     */
    public function Checklogin() {
        $grand_model = new Grand_model();
        $result = $grand_model->checklogin(); 
        return View::Json($result);
    }
    
    /**
     * update data
     * @permission grand/update|Update grand @end_permission
     */
    public function Update() {
        $param = $this->get_param(array('groupid', 'funcid', 'permission', 'id'));
        $result['errorMsg'] = 'Have an error, please contact your admin';
        if(!empty($param['id'])) {
            $id = $param['id'];
            $grand_model = new Grand_model();
            if($grand_model->update_grand($param, $id) === true) {
                $result['errorMsg'] = "";
            }
        }
        
        return View::Json($result);
    }
    
    /**
     * Delete grand action
     */
    public function Delete() {
        $param = $this->get_param(array('id'));
        $result['errorMsg'] = "";
        $result['success'] = true;
        if(!empty($param['id'])) {
            $grand_model = new Grand_model();
            if($grand_model->delete_grand($param['id']) != true) {
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