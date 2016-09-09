<?php
Class Home_Controller extends Frontend_Controller {
    public function Index() {
    	
    	$model = new Product_model();
    	$result['product'] = $model->get_list_product();
    	
    	$db = new Slide_model();
    	$result['slide'] = $db->get_list_slide();
    	
        Session::set('template', 'thathi');
        return $this->renderTemplateFronend('index',$result); // homepage
    }
    
    public  function View() {
        return $this->renderTemplateFronend('news'); 
    }
    
    public function Lg() {
        return $this->renderTemplate('login');
    }
    
    public  function addorder() {
    	session_start();
    	$qty = $_GET['qty'];
    	$id = $_GET['id'];
    	$pro = new Product_model();
    	$result = $pro -> get_product_by($id);
    	$array = array();  //Chuyển Đổi mảng mới để tạo khóa
    	foreach ($result as $val){
    		$array[$val['id']] = $val;
    			
    	};
    	if (!isset($_SESSION['cart']) || $_SESSION['cart'] ==null){
    		$array[$id]['qty'] = $qty;
    		$_SESSION['cart'][$id] = $array[$id];          //thêm sản phẩm vào session
    			
    	}else {
    			
    		if(array_key_exists($id, $_SESSION['cart']))  //kiểm tra key có tồn tại trong giỏ hàng chưa
    		{
    			$_SESSION['cart'][$id]['qty'] =$qty ;
    			//var_dump($_SESSION['cart']);
    		}else {
    			$array[$id]['qty'] = $qty;
    			$_SESSION['cart'][$id] = $array[$id];
    		}
    	}
    	Session::set('template', 'thathi');
    	return $this->renderTemplateFronend('cart',$result); // homepage
    }
    
    /**
     * create news
     * @permission news/create|news create @end_permission
     */
        public function productdetail(){
			  $id = $_GET['id'];
			  $pro = new Product_model();
			  $result = $pro -> get_product_by($id);
			  Session::set('template', 'thathi');
			  return $this->renderTemplateFronend('productdetail',$result);
			
		}
		public function destroy(){
			unset($_SESSION['cart']);
			Session::set('template', 'thathi');
			return $this->renderTemplateFronend('cart',$result); // homepage
			
		}
		public function unsetpro(){
			$id = $_GET['id'];
			unset($_SESSION['cart']['id']);
			
		}
		public function viewcart(){
			Session::set('template', 'thathi');
			return $this->renderTemplateFronend('cart',$result); // homepage
				
		}
		
		public function checkout(){
			Session::set('template', 'thathi');
			return $this->renderTemplateFronend('checkout',$result); // homepage
			
		}
		
		public function finish(){
			$id = $_POST['id'];
			//var_dump($marge);
			$name = $_POST['name'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$city = $_POST['province'];
			//echo $city;
			$note = $_POST['note'];
			$status = 1;
			$detail = new orderdetail_Model();
			$order = new order_Model();
			$pro = new product_Model();
		    $order -> create_order($status,$name,$phone,$email,$address,$city,$note);
			$last_id_oder = $order->get_last_id();     // lấy id vừa insert
			$orderid = $last_id_oder[0]['max(id)'];
			//echo $orderid;
			$order-> update($orderid,$status);
			//echo $userid; die();
			foreach ($id as $item){
		    $tmp = explode("_", $item);
			$detail -> create_orderdetail($tmp[0],$orderid,$tmp[1]); //thêm dữ liệu vào bảng orderdetail
			}
			unset($_SESSION['cart']);
			Session::set('template', 'thathi');
			$data['status'] = 'OK';
			return $this->renderTemplateFronend('checkout',$data); // homepage
		}
		
		public function gioithieu() {
			
			Session::set('template', 'thathi');
			return $this->renderTemplateFronend('gioithieu'); // homepage
		}
		
		public function lienhe() {
			
			Session::set('template', 'thathi');
			return $this->renderTemplateFronend('lienhe'); // homepage
		}

	
}/** end Class **/
