<?php
class Taxonomy_model extends VNModel{
    //table taxonomy
    protected $table = 'taxonomy';
    
    // name log file
    protected $log_name = 'taxonomy_model_';
    
    
    /**
     *  get taxonomy by id
     * @param $id
     * @return array
     */
    public function get_taxonomy_by($id) {
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
     * get list taxonomy
     * @param number $limmit
     * @param number $offset
     * @return data
     */
    public function get_list_taxonomy($limmit = 0, $offset = 0) {
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
     * create taxonomy
     * @todo make sql with data $taxonomy to :
     *  INSERT INTO table_name (column1, column2, column3,...)
     *   VALUES (value1, value2, value3,...)
     * @param array $taxonomy
     * @return boolean
     */
    public function create_taxonomy($taxonomy) {
        if(count($taxonomy) > 0) {
            try{
                $this->create($taxonomy);
                return true;
            } catch (Exception $e) {
                VNLog::debug_var($this->log_name, $e->getMessage());
                return false;
            }
    
        }
        return false;
    }
    
    /**
     * delete taxonomy by id
     * @param (int)taxonomy_id
     * @return boolean
     */
    public function delete_taxonomy($taxonomy_id) {
        $sql = "id = :id";
        $param = array('id' => $taxonomy_id);
        $result = $this->delete($sql, $param);
        return $result;
    }
    
    /**
     * update taxonomy data
     * @todo: data id array data , element name(key) is fields in database
     * @param array $data
     * @param integer $id
     * @return bool $result
     */
    public function update_taxonomy($data, $id) {
        
        $sql_where = "id = :id";
        $param_where = array('id' => $id);
        $result = $this->update($data, $sql_where, $param_where);
        return $result;
        
    }
    
}