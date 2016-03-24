<?php
class Frontend_Controller extends Controller {
    protected $param;
    
    public function init() {
        // set default template
        Session::set('template', 'newstreecolumn');
    }

}