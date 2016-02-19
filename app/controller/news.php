<?php
Class News_Controller extends Controller {
    public function Index() {
        echo " url friendly!";
        die;
    }
    
    public  function View() {
        $user_model = new User_model();
        $data = $user_model->loveme();
        var_dump($data);
        die;
    }
    
    public function Lg() {
        return $this->renderTemplate('login');
    }
    
    /**
     * create news
     * @permission news/create|news create @end_permission
     */
    public function create() {
        
    }
}