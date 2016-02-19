<?php
class Permission_Controller extends Controller {
    public function index() {
        
    }
    
    public function update() {
        $param = $this->get_param(array('id', 'groupid', 'module', 'permission'));
        
        $md_permission = new Permision_model();
        
        $param['groupid'] = 2;
        $param['module'] = "news/update";
        $param['permission'] = 0;
        
        $result = $md_permission->update_status($param, 2);
        
        $message = "update false";
        if($result == true) {
            $message = "update true";
        }
        
        echo $message; die;
    }
    
    public function create() {
        $param = $this->get_param(array('groupid', 'module', 'permission'));
        
        //data test
        $param['groupid'] = 1;
        $param['module'] = "news/create";
        $param['permission'] = 1;
        
        $md_permission = new Permision_model();
        $result = $md_permission->create($param);
        
        $message = "create false";
        if($result == true) {
            $message = "create true";
        }
        
        echo $message; die;
        
    }
    
    public function Createuser() {
        $param = $this->get_param(array('user_name', 'pass'));
        var_dump($param); die;
    }
    
    public function permission_scan() {
       $file  =new File_lib();
       
       $md_permission = new Permision_model();
       $md_permission->permission_scaner(WEB_DIR."/app/controller", $file);
       //WEB_DIR
       
       die;
    }
    
}