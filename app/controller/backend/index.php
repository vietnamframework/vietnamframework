<?php
class Index_Backend_Controller extends Backend_Controller {
    public function index() {
        return $this->renderTemplate('index');
    }
    
    public function Createuser() {
        $param = $this->get_param(array('user_name', 'pass'));
        var_dump($param); die;
    }
    
    public function test() {
        $mdtest = new User_model();
        //$data = $mdtest->get_list_user(1,1);
        //get_list_normal
        //$data = $mdtest->get_list_normal('','',1,1);
        $data = $mdtest->get_by_id(1);
        
        return $this->renderTemplate('test', $data);
    }
}