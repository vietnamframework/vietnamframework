<?php
class Language_Backend_Controller extends Backend_Controller {
    
    public function Index() {
        return $this->renderTemplate('language');
    }
    /**
     * create news
     * @permission language/create|language create @end_permission
     */
    public function Create() {
        $param = $this->get_param(array('lang', 'short_name', 'flag'));

        if(empty($param['short_name'])) {
            unset($param['short_name']);
        }
        
        if(empty($param['flag'])) {
            unset($param['flag']);
        }
        
        $result['errorMsg'] = '';
        $language_model = new Language_model();
        
        if($language_model->create_language($param) != true) {
            $result['errorMsg'] = "Have an error, please contact your admin";
        }
        // return to successfull page
        return View::Json($result);
    }
    
    /**
     * @permission language/list|list language @end_permission
     */
    public function Listdata() {
        $language_model = new Language_model();
        $data = $language_model->get_list_language();
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
        $language_model = new Language_model();
        $result = $language_model->checklogin(); 
        return View::Json($result);
    }
    
    /**
     * update data
     * @permission language/update|Update language @end_permission
     */
    public function Update() {
        $param = $this->get_param(array('lang', 'short_name', 'flag', 'id'));
        $result['errorMsg'] = '';
        if(!empty($param['id'])) {
            $id = $param['id'];
            $data = array();
            
            // update data
            if(!empty($param['lang'])) {
                $data['lang'] = $param['lang'];
            }
            
            if($param['short_name'] != '') {
                $data['short_name'] = $param['short_name'];
            }
            
            if($param['flag'] != '') {
                $data['flag'] = $param['flag'];
            }
            $language_model = new Language_model();
            if($language_model->update_language($data, $id) != true) {
                $result['errorMsg'] = "Have an error, please contact your admin";
            }
        }
        
        return View::Json($result);
    }
    
    /**
     * Delete language action
     */
    public function Delete() {
        $param = $this->get_param(array('id'));
        $result['errorMsg'] = "";
        $result['success'] = true;
        if(!empty($param['id'])) {
            $language_model = new Language_model();
            if($language_model->delete_language($param['id']) != true) {
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