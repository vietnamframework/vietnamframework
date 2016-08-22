<?php
class Product_model extends VNModel{
    //table product
    protected $table = 'product';
    
    // name log file
    protected $log_name = 'product_model_';
    
    
    /**
     *  get product by id
     * @param $id
     * @return array
     */
    public function get_product_by($id) {
        try{
            /*
            $sql = "SELECT * FROM ". $this->table." WHERE id = :id";
            return $this->query($sql, array("id" => $id));
            */
            return $this->get_by_id($id);
        } catch (Exception $e) {
            VNLog::debug_var($this->log_name, $e->getMessage());
            return false;
        }
    }
    
    public function get_product_view($id) {
        try{
            $this->begin_transaction();
            //counter
            $sql_update = "UPDATE ".$this->table." SET counter = counter+1 WHERE id = ':id'";
            $this->execute($sql_update, array('id' => $id));
            $result = $this->get_by_id($id);
            
            $this->commit();
            return $result;
        } catch (Exception $e) {
            VNLog::debug_var($this->log_name, $e->getMessage());
            return false;
        }
    }
    
    /**
     * get list product
     * @param number $limmit
     * @param number $offset
     * @return data
     */
    public function get_list_product($limmit = 0, $offset = 0) {
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

    /**
     * create product
     * @todo make sql with data $product to :
     *  INSERT INTO table_name (column1, column2, column3,...)
     *   VALUES (value1, value2, value3,...)
     * @param array $product
     * @return boolean
     */
    public function create_product($product) {
        if(count($product) > 0) {
            try{
                $this->create($product);
                return true;
            } catch (Exception $e) {
                VNLog::debug_var($this->log_name, $e->getMessage());
                return false;
            }
    
        }
        return false;
    }
    
    /**
     * delete product by id
     * @param (int)product_id
     * @return boolean
     */
    public function delete_product($product_id) {
        $sql = "id = :id";
        $param = array('id' => $product_id);
        $result = $this->delete($sql, $param);
        return $result;
    }
    
    /**
     * update product data
     * @todo: data id array data , element name(key) is fields in database
     * @param array $data
     * @param integer $id
     * @return bool $result
     */
    public function update_product($data, $id) {
        
        $sql_where = "id = :id";
        $param_where = array('id' => $id);
        $result = $this->update($data, $sql_where, $param_where);
        return $result;
        
    }
    public function get_new_post() {
        try{
            
            $sql = "SELECT * FROM ". $this->table." order by id desc LIMIT 4";
            return $this->query($sql, array("id" => $id));
            
            return $this->get_by_id($id);
        } catch (Exception $e) {
            VNLog::debug_var($this->log_name, $e->getMessage());
            return false;
        }
    }
}