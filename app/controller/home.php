<?php
Class Home_Controller extends Frontend_Controller {
    public function Index() {
    	
    	$model = new Product_model();
    	$result['product'] = $model->get_list_product();
    	
        Session::set('template', 'thathi');
        return $this->renderTemplateFronend('index',$result); // homepage
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