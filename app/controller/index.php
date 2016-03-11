<?php
class Index_Controller extends Controller {
    public function index() {
        
        //$model = new User_model();
        //$tmp = $model->loveme();
        //$this->addHeader(array('acd' =>$tmp));
        //$data['a'] = $tmp;
        //return $this->renderTemplate('index', $data);
       
        
       $all_table = array("actor"," address"," category"," city"," content"," country"," customer"," film"," film_actor"," film_category"," film_text"," frontend_trans"," func"," grand_permission"," group"," inventory"," language"," language_copy"," payment"," rental"," staff"," store"," url_friendly"," user");
       $model = new VNModel();
       $start_time = microtime();
       //Cache::clear();
       foreach ($all_table as $item) {
           $model->settable($item);
           $count = $model->count_length('');
           VNLog::debug_var("hungbu", $item."  ".$count);
       }
       $end_time = microtime() - $start_time;
       
       echo $end_time;
       die;
       
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