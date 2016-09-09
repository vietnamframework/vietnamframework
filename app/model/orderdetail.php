<?php
class orderdetail_Model extends VNModel {
	// khai bao ten bang
	protected $table ='orderct';
	public function get_list_orderdetail($limmit = 0, $offset = 0) {
		try{
			$sql = "SELECT * FROM ".$this->table;
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
	public function get_order_by($id) {
		try{
			$sql = "SELECT product.product_name, product.price, orderct.quantity FROM orderct
    INNER JOIN orderthathi ON orderct.idorder = orderthathi.id
    INNER JOIN product ON orderct.idpro = product.id WHERE orderct.idorder= :id";
			$param = array('id' => $id);
			return $this->query($sql,$param);
		} catch (Exception $e) {
			VNLog::debug_var($this->log_name, $e->getMessage());
			return false;
		}
	}
	public function create_orderdetail($idpro,$idorder,$quantity) {
		try {
			$sql = "INSERT INTO orderct (idpro,idorder,quantity)
              VALUES (:idproduct,:iddonhang,:soluong)";
			$param = array( 'idproduct' => $idpro,'iddonhang'=> $idorder,'soluong'=> $quantity);
			//var_dump($param); die();
			$result= $this->execute($sql, $param);
			return true;
		}
		catch (Exception $e){
			return false;		}
			// return $result;
	}

	public function delete_orderdetail($id){
		try {$sql = "DELETE FROM orderct WHERE idpro = :id";
		$param = $_POST;
		$this->execute($sql, $param);
		return true;
		}
	
		catch (Exception $e){
			return false;
		}
	
	}
	
	
	
	
} /**end class **/