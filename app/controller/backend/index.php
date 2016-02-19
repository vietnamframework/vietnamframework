<?php
class Index_Backend_Controller extends Controller {
    public function index() {
        
        $model = new User_model();
        //$tmp = $model->loveme();
        //$this->addHeader(array('acd' =>$tmp));
        //$data['a'] = $tmp;
        //return $this->renderTemplate('index', $data);
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