<?php
class Urlfriend_model extends VNModel{
    //table urlfriend
    protected $table = 'url_friendly';
    
    // name log file
    protected $log_name = 'urlfriend_model_';
    
    
    /**
     *  get urlfriend by id
     * @param $id
     * @return array
     */
    public function get_urlfriend_by($id) {
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
     * get list urlfriend
     * @param number $limmit
     * @param number $offset
     * @return data
     */
    public function get_list_urlfriend($limmit = 0, $offset = 0) {
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
     * create urlfriend
     * @todo make sql with data $urlfriend to :
     *  INSERT INTO table_name (column1, column2, column3,...)
     *   VALUES (value1, value2, value3,...)
     * @param array $urlfriend
     * @return boolean
     */
    public function create_urlfriend($urlfriend) {
        if(count($urlfriend) > 0) {
            try{
                $this->create($urlfriend);
                return true;
            } catch (Exception $e) {
                VNLog::debug_var($this->log_name, $e->getMessage());
                return false;
            }
    
        }
        return false;
    }
    
    /**
     * delete urlfriend by id
     * @param (int)urlfriend_id
     * @return boolean
     */
    public function delete_urlfriend($urlfriend_id) {
        $sql = "id = :id";
        $param = array('id' => $urlfriend_id);
        $result = $this->delete($sql, $param);
        return $result;
    }
    
    /**
     * update urlfriend data
     * @todo: data id array data , element name(key) is fields in database
     * @param array $data
     * @param integer $id
     * @return bool $result
     */
    public function update_urlfriend($data, $id) {
        
        $sql_where = "id = :id";
        $param_where = array('id' => $id);
        $result = $this->update($data, $sql_where, $param_where);
        return $result;
        
    }
}