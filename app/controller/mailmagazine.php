<?php
Class Mailmagazine_Controller extends Frontend_Controller {
    public function Index() {
    	$param = self::get_param(array('email'));
    	$result['message'] = '';
    	$result['status'] = 'NG';
    	if(!empty($param)) {
			$model = new Mailmagazine_model();
			if($model->check_email_replace($param)) {
				// save to he thong
				$model->create($param);
				$result['status'] = "OK";
			} else {
				$result['message'] = 'email đã tồn tại trong hệ thống';
			}
		} else {
			$result['message'] = 'email không tồn tại';
		}
		 
		return View::Json($result);
    }
}