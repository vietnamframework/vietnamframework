<?php
class Index_Controller extends Controller {
    public function index() {
        
        //$model = new User_model();
        //$tmp = $model->loveme();
        //$this->addHeader(array('acd' =>$tmp));
        //$data['a'] = $tmp;
        //return $this->renderTemplate('index', $data);
        
        $array = array('hung' => array('cotien' => array("khong", "co")));
        
        $key = Cache::genaral_key("hung", $array);
        Cache::set_array($key, $array);
        $data = Cache::get_array($key);
        
        var_dump($data); die;
        
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