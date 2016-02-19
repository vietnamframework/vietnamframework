<?php
class User_Controller extends Controller {
    
    public function Index() {
        return $this->renderTemplate('login');
    }
    /**
     * create news
     * @permission user/create|user create @end_permission
     */
    public function Createuser() {
        $param = $this->get_param(array('user_name', 'pass'));
        $param['pass'] = md5($param['pass']);
        $User_model = new User_model();
        $User_model->create_user($param);
        return true;
    }
    
    public function Checklogin() {
        $param = $this->get_param(array('user_name', 'pass'));
        $param['pass'] = md5($param['pass']);
        $User_model = new User_model();
        if($User_model->login($param) === TRUE) {
            echo 'success';
        } else {
            echo 'fail';
        }

        return true;
        
    }
    
    public function Listuser() {
        $User_model = new User_model();
        $data = $User_model->get_list_user();
        var_dump($data);
    }
}