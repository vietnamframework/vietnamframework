<?php
class Backend_Controller extends Controller {
    protected $param;
    
    public function init() {
        // set default template
        Session::set('template', 'backend');
    }

}