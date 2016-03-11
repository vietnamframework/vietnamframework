<?php
class User_model extends VNModel{
    //table user
    protected $table = 'user';
    
    // name log file
    protected $log_name = 'User_model_';
    
    
    /**
     *  get user by id
     * @param $id
     * @return array
     */
    public function get_user_by($id) {
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
     * get list user
     * @param number $limmit
     * @param number $offset
     * @return data
     */
    public function get_list_user($limmit = 0, $offset = 0) {
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
     * Login
     *
     * @param array $param
     * @return boolean
     */
    public function login($param) {
        try{
            //Login status
            $login_flg = false;
    
            //param for sql
            //$param = array('user_name' => $user, 'pass' => md5($password));
    
            // sql login
            //$sql = "SELECT * FROM ". $this->table." WHERE user_name = :user_name AND pass = :pass";
            
            //$result = $this->query($sql, $param);
            $where = " user_name = :user_name AND pass = :pass";
            
            $result = $this->get_list_normal($where, $param);
            if (count($result) == 1) {
                $_SESSION['user_curent'] = $result[0];
                $login_flg = true;
                VNLog::debug_var($this->log_name, $result[0]);
            }
    
            return $login_flg;
    
        } catch (Exception $e) {
            VNLog::debug_var($this->log_name, $e->getMessage());
            return false;
        }
    }
    
    /**
     * create user
     * @todo make sql with data $user to :
     *  INSERT INTO table_name (column1, column2, column3,...)
     *   VALUES (value1, value2, value3,...)
     * @param array $user
     * @return boolean
     */
    public function create_user($user) {
        if(count($user) > 0) {
            try{
                
                $this->create($user);
                
                /*
                //Create sql insert Start Region
                $list_properties = array();
                foreach ($user as $key => $value) {
                    $list_properties[] = $key;
                }
    
                $str_values_add = implode(",", $list_properties);
    
                $str_param_add  = ":" . implode(",", $list_properties);
                $str_param_add = str_replace(",", ", :", $str_param_add);
                $sql = "INSERT INTO ".$this->table." (".$str_values_add.") VALUES (".$str_param_add.")";
                //Create sql insert End Region
    
                $this->execute($sql, $user);
                */
                return true;
            } catch (Exception $e) {
                VNLog::debug_var($this->log_name, $e->getMessage());
                return false;
            }
    
        }
        return false;
    }
    
    /**
     * delete user by id
     * @param (int)user_id
     * @return boolean
     */
    public function delete_user($user_id) {
        $sql = "id = :id";
        $param = array('id' => $user_id);
        $result = $this->delete($sql, $param);
        return $result;
    }
    
    /**
     * update user data
     * @todo: data id array data , element name(key) is fields in database
     * @param array $data
     * @param integer $id
     * @return bool $result
     */
    public function update_user($data, $id) {
        
        $sql_where = "id = :id";
        $param_where = array('id' => $id);
        $result = $this->update($data, $sql_where, $param_where);
        return $result;
        
    }
    
}