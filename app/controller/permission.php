<?php
class Permission_Controller extends Controller {
    public function index() {
        
    }
    
    public function update_grand() {
        
        $param = $this->get_param(array('id', 'groupid', 'funcid', 'permission'));
        $param = Validate::remove_empty($param);
        
        $message = "update false";
        
        if(!empty($param['id'])) {
            $md_permission = new Permision_model();
    
            $result = $md_permission->grand_update($param, $param['id']);
            
            
            if($result == true) {
                $message = "update true";
            }
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
    
    /**
     * permission scan
     */
    public function permission_scan() {
        
       $file  =new File_lib();
       $md_permission = new Permision_model();
       $md_permission->permission_scaner(WEB_DIR."/app/controller", $file);
       
       $result['status'] = 'OK';
       return View::Json($result);
    }
    
}