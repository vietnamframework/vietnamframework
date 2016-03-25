<?php
class Index_Controller extends Frontend_Controller {
    public function index() {
        return $this->renderTemplateFronend('index'); // homepage
    }

}