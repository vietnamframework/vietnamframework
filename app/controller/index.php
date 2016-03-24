<?php
class Index_Controller extends Frontend_Controller {
    public function index() {
        return $this->renderTemplate('index'); // homepage
    }

}