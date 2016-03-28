<?php
Class News_Controller extends Frontend_Controller {
    public function Index() {
        $param = $_GET;
        return $this->renderTemplateFronend('news'); // homepage
    }
    
    public  function View() {
        return $this->renderTemplateFronend('news'); 
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