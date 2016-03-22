<?php
class News_Backend_Controller extends Backend_Controller {
    
    public function Index() {
        return $this->renderTemplate('news');
    }
    /**
     * create news
     * @permission news/create|news create @end_permission
     */
    public function Create() {
        $param = $this->get_param(array('lang_id', 'title', 'content', 'file_name', 'tag'));
        
        VNLog::debug_var('hungbuit_123', $param);
        
        $param['authour_id'] = 1;
        
        $result['errorMsg'] = '';
        
        $news_model = new News_model();
        
        if($news_model->create_news($param) != true) {
            $result['errorMsg'] = "Have an error, please contact your admin";
        }
        // return to successfull page
        return View::Json($result);
    }
    
    /**
     * @permission news/list|list news @end_permission
     */
    public function Listdata() {
        $news_model = new News_model();
        $data = $news_model->get_list_news();
        return View::Json($data);
    }
    
    /**
     * update data
     * @permission news/update|Update news @end_permission
     */
    public function Update() {
        $param = $this->get_param(array('lang_id', 'title', 'content', 'file_name', 'tag', 'id'));
        $result['errorMsg'] = '';
        if(!empty($param['id'])) {
            $id = $param['id'];
            $data = array();
            
            // update data
            if($param['lang_id'] != '') {
                $data['lang_id'] = $param['lang_id'];
            }
            
            if($param['title'] != '') {
                $data['title'] = $param['title'];
            }
            
            if($param['content'] != '') {
                $data['content'] = $param['content'];
            }
            
            if($param['file_name'] != '') {
                $data['file_name'] = $param['file_name'];
            }
            
            if($param['tag'] != '') {
                $data['tag'] = $param['tag'];
            }
            
            $news_model = new news_model();
            if($news_model->update_news($data, $id) != true) {
                $result['errorMsg'] = "Have an error, please contact your admin";
            }
        }
        
        return View::Json($result);
    }
    
    /**
     * Delete news action
     */
    public function Delete() {
        $param = $this->get_param(array('id'));
        $result['errorMsg'] = "";
        $result['success'] = true;
        if(!empty($param['id'])) {
            $news_model = new news_model();
            if($news_model->delete_news($param['id']) != true) {
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