<?php
class User_Controller extends Controller {
    
    public function Index() {
        return $this->renderTemplate('login');
    }
    /**
     * create news
     * @permission user/create|user create @end_permission
     */
    public function Create() {
        $param = $this->get_param(array('user_name', 'pass'));
        $param['pass'] = md5($param['pass']);
        $User_model = new User_model();
        $User_model->create_user($param);
        // return to successfull page
        return true;
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
        var_dump($data);
        
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
        $param = $this->get_param(array('user_name', 'pass', 'id'));
        $result = false;
        if(!empty($param['id'])) {
            $id = $param['id'];
            $data = array();
            
            // update data
            if(!empty($param['user_name'])) {
                $data['user_name'] = $param['user_name'];
            }
            
            if(!empty($param['pass'])) {
                $param['pass'] = md5($param['pass']);
                $data['pass'] = $param['pass'];
            }
            
            $User_model = new User_model();
            $result = $User_model->update_user($data, $id);
        }
        
        View::Json($result);
    }
}