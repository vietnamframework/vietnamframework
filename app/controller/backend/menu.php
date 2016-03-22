<?php
class menu_Backend_Controller extends Backend_Controller {
    
    public function Index() {
        return $this->renderTemplate('menu');
    }
    /**
     * create news
     * @permission menu/create|menu create @end_permission
     */
    public function Create() {
        $param = $this->get_param(array('title', 'link', 'status', 'parent'));

        if(empty($param['status'])) {
            unset($param['status']);
        }
        
        if(empty($param['parent'])) {
            unset($param['parent']);
        }
        
        $result['errorMsg'] = '';
        $menu_model = new Menu_model();
        
        if($menu_model->create_menu($param) != true) {
            $result['errorMsg'] = "Have an error, please contact your admin";
        }
        // return to successfull page
        return View::Json($result);
    }
    
    /**
     * @permission menu/list|list menu @end_permission
     */
    public function Listdata() {
        $menu_model = new Menu_model();
        $data = $menu_model->get_list_menu();
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
        $menu_model = new menu_model();
        $result = $menu_model->checklogin(); 
        return View::Json($result);
    }
    
    /**
     * update data
     * @permission menu/update|Update menu @end_permission
     */
    public function Update() {
        $param = $this->get_param(array('title', 'link', 'status', 'parent', 'id'));
        $result['errorMsg'] = '';
        if(!empty($param['id'])) {
            $id = $param['id'];
            $data = array();
            
            // update data
            if(!empty($param['title'])) {
                $data['title'] = $param['title'];
            }
            
            if(!empty($param['link'])) {
                $data['link'] = $param['link'];
            }
            
            if($param['status'] != '') {
                $data['status'] = $param['status'];
            }
            
            if($param['parent'] != '') {
                $data['parent'] = $param['parent'];
            }
            $menu_model = new Menu_model();
            if($menu_model->update_menu($data, $id) != true) {
                $result['errorMsg'] = "Have an error, please contact your admin";
            }
        }
        
        return View::Json($result);
    }
    
    /**
     * Delete menu action
     */
    public function Delete() {
        $param = $this->get_param(array('id'));
        $result['errorMsg'] = "";
        $result['success'] = true;
        if(!empty($param['id'])) {
            $menu_model = new Menu_model();
            if($menu_model->delete_menu($param['id']) != true) {
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