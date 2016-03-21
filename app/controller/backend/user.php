<?php
class User_Backend_Controller extends Backend_Controller {
    
    public function Index() {
        return $this->renderTemplate('login');
    }
    /**
     * create news
     * @permission user/create|user create @end_permission
     */
    public function Create() {
        $param = $this->get_param(array('user_name', 'pass', 'email'));
        $result['errorMsg'] = '';
        $param['pass'] = md5($param['pass']);
        $User_model = new User_model();
        
        if($User_model->create_user($param) != true) {
            $result['errorMsg'] = "Have an error, please contact your admin";
        }
        // return to successfull page
        return View::Json($result);
    }
    
    /**
     * Login
     * @return boolean
     */
    public function Login() {
        $param = $this->get_param(array('user_name', 'pass'));
        $param['pass'] = md5($param['pass']);
        $User_model = new User_model();
        if($User_model->login($param) === TRUE) {
            echo 'success';
            // return to homepage
        } else {
            echo 'fail';
            // return login false
        }
        return true;
    }
    /**
     * @permission user/list|list user @end_permission
     */
    public function Listdata() {
        $User_model = new User_model();
        $data = $User_model->get_list_user();
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
        $User_model = new User_model();
        $result = $User_model->checklogin(); 
        return View::Json($result);
    }
    
    /**
     * update data
     * @permission user/update|Update user @end_permission
     */
    public function Update() {
        $param = $this->get_param(array('user_name', 'pass', 'id', 'email'));
        $result['errorMsg'] = '';
        if(!empty($param['id'])) {
            $id = $param['id'];
            $data = array();
            
            // update data
            if(!empty($param['user_name'])) {
                $data['user_name'] = $param['user_name'];
            }
            
            if(!empty($param['email'])) {
                $data['email'] = $param['email'];
            }
            
            if(!empty($param['pass'])) {
                $param['pass'] = md5($param['pass']);
                $data['pass'] = $param['pass'];
            }
            
            $User_model = new User_model();
            if($User_model->update_user($data, $id) != true) {
                $result['errorMsg'] = "Have an error, please contact your admin";
            }
        }
        
        return View::Json($result);
    }
    
    /**
     * Delete user action
     */
    public function Delete() {
        $param = $this->get_param(array('id'));
        $result['errorMsg'] = "";
        $result['success'] = true;
        if(!empty($param['id'])) {
            $User_model = new User_model();
            if($User_model->delete_user($param['id']) != true) {
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