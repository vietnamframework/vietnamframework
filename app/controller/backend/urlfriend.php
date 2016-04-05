<?php
class urlfriend_Backend_Controller extends Backend_Controller {
    
    public function Index() {
        return $this->renderTemplate('urlfriend');
    }
    /**
     * create news
     * @permission urlfriend/create|urlfriend create @end_permission
     */
    public function Create() {
        $param = $this->get_param(array('url_friendly', 'controller', 'action'));

        if(empty($param['url_friendly'])) {
            unset($param['url_friendly']);
        }
        
        if(empty($param['controller'])) {
            unset($param['controller']);
        }
        
        if(empty($param['action'])) {
            unset($param['action']);
        }
        
        $result['errorMsg'] = '';
        $urlfriend_model = new Urlfriend_model();
        
        if($urlfriend_model->create_urlfriend($param) != true) {
            $result['errorMsg'] = "Have an error, please contact your admin";
        }
        // return to successfull page
        return View::Json($result);
    }
    
    /**
     * @permission urlfriend/list|list urlfriend @end_permission
     */
    public function Listdata() {
        $urlfriend_model = new Urlfriend_model();
        $data = $urlfriend_model->get_list_urlfriend();
        return View::Json($data);
    }
    
    /**
     * Check login
     * @return boolean
     */
    public function Checklogin() {
        $urlfriend_model = new Urlfriend_model();
        $result = $urlfriend_model->checklogin(); 
        return View::Json($result);
    }
    
    /**
     * update data
     * @permission urlfriend/update|Update urlfriend @end_permission
     */
    public function Update() {
        $param = $this->get_param(array('url_friendly', 'controller', 'action', 'id'));
        $result['errorMsg'] = 'Have an error, please contact your admin';
        if(!empty($param['id'])) {
            $id = $param['id'];
            $data = array();
            
            // update data
            $data['url_friendly'] = $param['url_friendly'];
            $data['controller'] = $param['controller'];
            $data['action'] = $param['action'];
            
            $urlfriend_model = new Urlfriend_model();
            if($urlfriend_model->update_urlfriend($data, $id) === true) {
                $result['errorMsg'] = "";
            }
        }
        
        return View::Json($result);
    }
    
    /**
     * Delete urlfriend action
     */
    public function Delete() {
        $param = $this->get_param(array('id'));
        $result['errorMsg'] = "";
        $result['success'] = true;
        if(!empty($param['id'])) {
            $urlfriend_model = new Urlfriend_model();
            if($urlfriend_model->delete_urlfriend($param['id']) != true) {
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