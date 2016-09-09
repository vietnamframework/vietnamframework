<?php
class order_Model extends VNModel {
	// khai bao ten bang
	protected $table ='orderthathi';
	protected $log_name = 'product_model_';
	
	public function get_list_order($limmit = 0, $offset = 0) {
		try{
			$sql = "SELECT * FROM orderthathi ORDER BY id DESC";
			if($limmit == 0 && $offset == 0) {
				// don't anything
				return $this->query($sql);
			} else {
				if(is_integer($limmit) && is_integer($offset)) {
					$sql .= " LIMIT $limmit OFFSET $offset";
					return $this->query($sql);
				} else {
					return false;
				}
	
			}
		} catch (Exception $e) {
			VNLog::debug_var($this->log_name, $e->getMessage());
			return false;
		}
	}	
	
     public function create_order($status,$name,$phone,$email,$address,$city,$note) { 
		try {
		    $sql = "INSERT INTO orderthathi (status,name,phone,email,address,city,note)
              VALUES (:trangthai,:ten,:sdt,:mail,:diachi1,:thanhpho,:gichu)";

		//$status = 1;
		$param = array( 'trangthai' => $status,'ten' => $name,'sdt' => $phone,'mail' => $email,'diachi1' => $address
				,'thanhpho' => $city,'gichu' => $note);
		//var_dump($param); die();
		$result= $this->execute($sql, $param);
	
		return true;
		}
		catch (Exception $e){
		    return false;		}
	   // return $result;
	}
	public function get_last_id() {
	
		$sql = "SELECT max(id) FROM orderthathi";
        $test = $this->query($sql);
	    return $test;
	    
	
	
	}
	
	public function update($id,$status) {
		$sql = "UPDATE orderthathi SET status = :status WHERE id = :id";
		$param = array('id'=> $id ,'status' => $status);
	    $this->execute($sql,$param);
		return true;
		 
	
	
	}
	public function delete_order($order_id) {
		 $sql = "id = :id";
		$param = array('id' => $order_id);
		$result = $this->delete($sql, $param);
		return $result;
	}
	public function count_data() {
		$sql = "SELECT count(*) as total FROM ".$this->table;
		$result =  $this->query($sql);
	
		if($result[0]['total'] != 0) {
			return $result[0]['total'];
		}
	
		return 0;
	}
	
	
	
} /**end class **/