<?php
class Menu_model extends VNModel{
    //table menu
    protected $table = 'menu';
    
    // name log file
    protected $log_name = 'menu_model_';
    
    
    /**
     *  get menu by id
     * @param $id
     * @return array
     */
    public function get_menu_by($id) {
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
     * get list menu
     * @param number $limmit
     * @param number $offset
     * @return data
     */
    public function get_list_menu($limmit = 0, $offset = 0) {
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
     * create menu
     * @todo make sql with data $menu to :
     *  INSERT INTO table_name (column1, column2, column3,...)
     *   VALUES (value1, value2, value3,...)
     * @param array $menu
     * @return boolean
     */
    public function create_menu($menu) {
        if(count($menu) > 0) {
            try{
                $this->create($menu);
                return true;
            } catch (Exception $e) {
                VNLog::debug_var($this->log_name, $e->getMessage());
                return false;
            }
    
        }
        return false;
    }
    
    /**
     * delete menu by id
     * @param (int)menu_id
     * @return boolean
     */
    public function delete_menu($menu_id) {
        $sql = "id = :id";
        $param = array('id' => $menu_id);
        $result = $this->delete($sql, $param);
        return $result;
    }
    
    /**
     * update menu data
     * @todo: data id array data , element name(key) is fields in database
     * @param array $data
     * @param integer $id
     * @return bool $result
     */
    public function update_menu($data, $id) {
        
        $sql_where = "id = :id";
        $param_where = array('id' => $id);
        $result = $this->update($data, $sql_where, $param_where);
        return $result;
        
    }
    
}