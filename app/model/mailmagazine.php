<?php
class Mailmagazine_model extends VNModel{
    //table mailmagazine
    protected $table = 'mailmagazine';
    
    // name log file
    protected $log_name = 'Mailmagazine_model_';
    
    
    /**
     *  get mailmagazine by id
     * @param $id
     * @return array
     */
    public function get_mailmagazine_by($id) {
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
     * get list mailmagazine
     * @param number $limmit
     * @param number $offset
     * @return data
     */
    public function get_list_mailmagazine($limmit = 0, $offset = 0) {
        try{
            $sql = "SELECT * FROM " . $this->table;
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
     * create mailmagazine
     * @todo make sql with data $mailmagazine to :
     *  INSERT INTO table_name (column1, column2, column3,...)
     *   VALUES (value1, value2, value3,...)
     * @param array $mailmagazine
     * @return boolean
     */
    public function create_mailmagazine($mailmagazine) {
        if(count($mailmagazine) > 0) {
            try{
                $this->create($mailmagazine);
                return true;
            } catch (Exception $e) {
                VNLog::debug_var($this->log_name, $e->getMessage());
                return false;
            }
    
        }
        return false;
    }
    
    /**
     * delete mailmagazine by id
     * @param (int)mailmagazine_id
     * @return boolean
     */
    public function delete_mailmagazine($mailmagazine_id) {
        $sql = "id = :id";
        $param = array('id' => $mailmagazine_id);
        $result = $this->delete($sql, $param);
        return $result;
    }
    
    /**
     * update mailmagazine data
     * @todo: data id array data , element name(key) is fields in database
     * @param array $data
     * @param integer $id
     * @return bool $result
     */
    public function update_mailmagazine($data, $id) {
        
        $sql_where = "id = :id";
        $param_where = array('id' => $id);
        $result = $this->update($data, $sql_where, $param_where);
        return $result;
        
    }
    public function check_email_replace($param_check) {
		$sql_where = "email = :email AND del_flg = 0";
		$result = $this->get_list_normal($sql_where, $param_check);
		if(count($result) > 0) {
			return FALSE;
		}
		return true;
	}
}