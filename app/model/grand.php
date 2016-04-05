<?php
class grand_model extends VNModel{
    //table grand
    protected $table = 'grand_permission';
    
    // name log file
    protected $log_name = 'grand_model_';
    
    
    /**
     *  get grand by id
     * @param $id
     * @return array
     */
    public function get_grand_by($id) {
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

    /**
     * 
     * @param unknown $group_id
     * @return array|boolean
     */
    public function getlistbygroup($group_id) {
        try{
            $sql_where = "groupid = :groupid";
            $data = $this->get_list_normal($sql_where, array('groupid' => $group_id));
            return $data;
        } catch (Exception $e) {
            VNLog::debug_var($this->log_name, $e->getMessage());
            return false;
        }
    }
    /**
     * get list grand
     * @param number $limmit
     * @param number $offset
     * @return data
     */
    public function get_list_grand($limmit = 0, $offset = 0) {
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
     * create grand
     * @todo make sql with data $grand to :
     *  INSERT INTO table_name (column1, column2, column3,...)
     *   VALUES (value1, value2, value3,...)
     * @param array $grand
     * @return boolean
     */
    public function create_grand($grand) {
        if(count($grand) > 0) {
            try{
                $this->create($grand);
                return true;
            } catch (Exception $e) {
                VNLog::debug_var($this->log_name, $e->getMessage());
                return false;
            }
    
        }
        return false;
    }
    
    /**
     * delete grand by id
     * @param (int)grand_id
     * @return boolean
     */
    public function delete_grand($grand_id) {
        $sql = "id = :id";
        $param = array('id' => $grand_id);
        $result = $this->delete($sql, $param);
        return $result;
    }
    
    /**
     * update grand data
     * @todo: data id array data , element name(key) is fields in database
     * @param array $data
     * @param integer $id
     * @return bool $result
     */
    public function update_grand($data, $id) {
        
        $sql_where = "id = :id";
        $param_where = array('id' => $id);
        $result = $this->update($data, $sql_where, $param_where);
        return $result;
        
    }
}