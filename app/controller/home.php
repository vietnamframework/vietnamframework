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
			  $data = $pro -> get_product_by($id);
			  //$cateid= $data[0]['category_id'];
			  //$data1 = $pro->relate($cateid);
			  Session::set('template', 'thathi');
			  return $this->renderTemplateFronend('productdetail',$data);
			
		}
		public function destroy(){
			unset($_SESSION['cart']);
			Session::set('template', 'thathi');
			return $this->renderTemplateFronend('cart',$result); // homepage
			
		}
		public function unsetpro(){
			$id = $_GET['id'];
			unset($_SESSION['cart'][$id]);
			Session::set('template', 'thathi');
			return $this->renderTemplateFronend('checkout',$result);
			
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
		public function contact(){
			$param = $this->get_param(array('name', 'email', 'phone','address','title','content'));
			$c = new Contact_model();
			$data1 = $c ->create_contact($param);	
			Session::set('template', 'thathi');	
			$data['status']= 'OK';
			return $this->renderTemplateFronend('lienhe',$data); // homepage
			
		}
		
		public function search(){
			$q=$_GET["q"];
			//var_dump($q);die();
			$s = new Product_model();	
			$x =$s->search_product($q);
			//lookup all links from the xml file if length of q>0
			if (strlen($q)>0) {
				$hint="";
				foreach($x as $gan) {
					$y=$gan['product_name'];
					$z=$gan['id'];
						//find a link matching the search text
						if (stristr($y,$q)) {
							if ($hint=="") {
								
								$hint="<a href='". Core::base_url() ."home/productdetail?id=$z'>".$y."</a><br>";

							} else {
								$hint = $hint . "<a href='". Core::base_url() ."home/productdetail?id=$z'>".$y."</a><br>";
							}
						
					}
				}
			}
			
			// Set output to "no suggestion" if no hint was found
			// or to the correct value
			if ($hint=="") {
				$response="no suggestion";
			} else {
				$response=$hint;
			}
			
			//output the response
			echo $response;
			
		}
		public function showsearch(){
			$q=$_GET["q"];
			$s = new Product_model();
			$data['product'] =$s->search_product($q);
			Session::set('template', 'thathi');
			return $this->renderTemplateFronend('showsearch',$data); // homepage
			
			
		}
	
}/** end Class **/
