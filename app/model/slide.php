<?php
class Slide_model extends VNModel{
    //table slide
    protected $table = 'slide';
    
    // name log file
    protected $log_name = 'slide_model_';
    
    
    /**
     *  get slide by id
     * @param $id
     * @return array
     */
    public function get_slide_by($id) {
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
     * get list slide
     * @param number $limmit
     * @param number $offset
     * @return data
     */
    public function get_list_slide($limmit = 0, $offset = 0) {
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
     * create slide
     * @todo make sql with data $slide to :
     *  INSERT INTO table_name (column1, column2, column3,...)
     *   VALUES (value1, value2, value3,...)
     * @param array $slide
     * @return boolean
     */
    public function create_slide($slide) {
        if(count($slide) > 0) {
            try{
                $this->create($slide);
                return true;
            } catch (Exception $e) {
                VNLog::debug_var($this->log_name, $e->getMessage());
                return false;
            }
    
        }
        return false;
    }
    
    /**
     * delete slide by id
     * @param (int)slide_id
     * @return boolean
     */
    public function delete_slide($slide_id) {
        $sql = "id = :id";
        $param = array('id' => $slide_id);
        $result = $this->delete($sql, $param);
        return $result;
    }
    
    /**
     * update slide data
     * @todo: data id array data , element name(key) is fields in database
     * @param array $data
     * @param integer $id
     * @return bool $result
     */
    public function update_slide($data, $id) {
        
        $sql_where = "id = :id";
        $param_where = array('id' => $id);
        $result = $this->update($data, $sql_where, $param_where);
        return $result;
        
    }
    
}