<?php
Class VNModel extends VNDB {
    
    /*
     * table var
     */
    protected $table = '';
    
    /*
     * log name
     */
    protected $log_name = "MODEL_ACTION_";
    
    /*
     * order by
     */
    protected  $orderby = '';
    
    /**
     * getparam
     * @param array $param
     * @return array
     */
    public function getparam($param) {
        $param_action = Core::validate_action();
        $param_data = Core::validate_data();
        $result = array();
        foreach ($param as $key) {
            $result[$key] = '';
            if(isset($param_data[$key])) {
                $result[$key] = $param_data[$key];
            }
            
            if($key == 'url_data') {
                $result[$key] = $param_action['data'];
            }
        }
        
        return $result;
    }
    
     /**
     * create data
     * @todo make sql with data to :
     *  INSERT INTO table_name (column1, column2, column3,...)
     *   VALUES (value1, value2, value3,...)
     * @param Array $data
     * @return boolean
     */
    public function create($data) {
        if(count($data) > 0) {
            try{
                //Create sql insert Start Region
                $list_properties = array();
                foreach ($data as $key => $value) {
                    $list_properties[] = $key;
                }
                
                $str_values_add = implode(",", $list_properties);
                
                $str_param_add  = ":" . implode(",", $list_properties);
                $str_param_add = str_replace(",", ", :", $str_param_add);
                $sql = "INSERT INTO ".$this->table." (".$str_values_add.") VALUES (".$str_param_add.")";
                //Create sql insert End Region 
                
                $this->execute($sql, $data);
                return true;
            } catch (Exception $e) {
                VNLog::debug_var($this->log_name, $e->getMessage());
                return false;
            }
            
        }
        return false;
    }
    
    /**
     * update
     * @param array $data
     * @param string $where
     * @param array $param_where
     * @return boolean
     */
    public function update($data, $where, $param_where) {
        if(count($data) > 0) {
            try{
                $str_set = '';
                
                $count_row_total = count($data);
                $count_row = 1;
                foreach ($data as $key => $value) {
                    if($count_row == $count_row_total) {
                        $str_set .= $key.' = :'.$key;
                    } else {
                        $str_set .= $key.' = :'.$key. ',';
                    }
                    $count_row++;
                }

                $sql = "UPDATE ".$this->table;
                $sql .= " SET ".$str_set;
                $sql .= " WHERE 1=1 AND ".$where;

                $sql_param = array_merge($data, $param_where);
                
                $this->execute($sql, $sql_param);
                return true;
            } catch (Exception $e) {
                VNLog::debug_var($this->log_name, $e->getMessage());
                return false;
            }
            
        }
        return false;
    }
    
    /**
     * delete
     * @param string $where
     * @param array $param_where
     * @return bool
     */
    public function delete($where, $param_where) {
        if(count($where) > 0) {
            try{
                $sql = "DELETE FROM ".$this->table;
                $sql .= " WHERE 1=1 AND ".$where;
                $this->execute($sql, $param_where);
                return true;
            } catch (Exception $e) {
                VNLog::debug_var($this->log_name, $e->getMessage());
                return false;
            }
        }
        return false;
    }
    
    /**
     * delete by id
     * @param integer $id
     * @return boolean
     */
    public function delete_id($id) {
        try{
            $sql = "DELETE FROM ".$this->table;
            $sql .= " WHERE id = :id";
            $this->execute($sql, array('id' => $id));
            return true;
        } catch (Exception $e) {
            VNLog::debug_var($this->log_name, $e->getMessage());
            return false;
        }
    }
    
    /**
     * set table
     * @param unknown $table
     */
    public function settable($table) {
        $this->table = $table;
    }
    
    /**
     * getlist
     * @param array $param_column
     * @param string $where
     * @param array $param_where
     * @param string $limmit
     * @param string $offset
     * @param string $orderby
     * @return array |NULL
     */
    public function getlist($param_column = array(), $where = '', $param_where = array(), $limmit = '', $offset = '', $orderby = '') {
        try{
    
            $sql = '';
            $sql_param = array();
    
            if(empty($param_column)) {
                $sql = "SELECT * FROM ".$this->table;
            } else {
                $column = implode(",", $param_column);
                $sql = "SELECT ".$column." FROM ".$this->table;
                $sql_param = $param_column;
            }
    
            if(!empty($where)) {
                $sql .= " WHERE ".$where;
                if(!empty($param_where) && !empty($sql_param)) {
                    $sql_param = array_merge($sql_param, $param_where);
                } else if(!empty($param_where)) {
                    $sql_param = $param_where;
                }
            }
    
            if(!empty($limmit)) {
                $sql .= " LIMMIT ".$limmit;
            }
    
            if(!empty($offset)) {
                $sql .= " OFFSET ".$offset;
            }
    
            if(!empty($orderby)) {
                $sql .= "ORDER BY " . $orderby;
            }
            return $this->data_from_cache($sql, $param_where);
    
        } catch (Exception $e) {
            VNLog::debug_var($this->log_name, $e->getMessage());
            return NULL;
        }
    
        return NULL;
    }
    
    /**
     * get list user
     * @param number $limmit
     * @param number $offset
     * @param string $orderby
     * @return data
     */
    public function get_list_normal($where = '', $param_where = null, $limmit = 0, $offset = 0, $orderby = '') {
        try{
            $sql = "SELECT * FROM ". $this->table;
            if(!empty($where)) {
                $sql .= " WHERE 1=1 AND ".$where;
            }
    
            if($limmit == 0 && $offset == 0) {
                
                if(!empty($orderby)) {
                    $sql .= "ORDER BY " . $orderby;
                }
                
                // don't anything
                if(empty($param_where)) {
                    //return $this->query($sql);
                    return $this->data_from_cache($sql);
                } else {
                    //return $this->query($sql, $param_where);
                    return $this->data_from_cache($sql, $param_where);
                }
    
            } else {
                
                if(is_integer($limmit) && is_integer($offset)) {
                    $sql .= " LIMIT $limmit OFFSET $offset";
                }
                
                if(!empty($orderby)) {
                    $sql .= "ORDER BY " . $orderby;
                }
                
                if(!empty($param_where)) {
                    //return $this->query($sql, $param_where);
                    return $this->data_from_cache($sql, $param_where);
                } else {
                    //return $this->query($sql);
                    return $this->data_from_cache($sql);
                }
                
            }
        } catch (Exception $e) {
            VNLog::debug_var($this->log_name, $e->getMessage());
            return false;
        }
    }
    
    /**
     *  get user by id
     * @param $id
     * @return array
     */
    public function get_by_id($id) {
        
        try{
            $sql = "SELECT * FROM ". $this->table." WHERE id = :id";
            //return $this->query($sql, array("id" => $id));
            return $this->data_from_cache($sql, array("id" => $id));
        } catch (Exception $e) {
            VNLog::debug_var($this->log_name, $e->getMessage());
            return false;
        }
        
    }
    
    /**
     * Count length for Pagination
     * @param string $where
     * @param array $param_where
     * @return number
     */
    public function count_length($where = '', $param_where = null) {
        try{
            $sql = "SELECT count(id) as count FROM " . $this->table;
            if(!empty($where)) {
                $sql .= " WHERE 1=1 AND " . $where;
            }
            
            $result = '';
            if(empty($param_where)) {
                //$result = $this->query($sql);
                $result = $this->data_from_cache($sql);
            } else {
                //$result = $this->query($sql, $param_where);
                $result = $this->data_from_cache($sql, $param_where);
            }
            $abc = $result[0];
            
            VNLog::debug_var("data_cache", $abc[0]['count']);
            if(isset($result[0]['count']) && $result[0]['count'] != 0) {
                return $result[0]['count'];
            }
            
            return -1;
        } catch (Exception $e) {
            VNLog::debug_var($this->log_name, $e->getMessage());
            return -1;
        }
    }
    
    /**
     * query_multi_table
     * @param array $column
     * @param array $table
     * @param string $where
     * @param array $param_where
     * @param string $orderby
     */
    public function query_multi_table($column = array(), $tables = array(), $where = '', $param_where = array(), $orderby = '') {
        try{
            $sql = '';
            if(!empty($column)) {
                if(count($column) == 1) {
                    $sql = "SELECT " . $column[0] . " FROM ";
                } else {
                    $sql = "SELECT " . implode(",", $column) . " FROM ";
                }
                
            } else {
                $sql = "SELECT * FROM ";
            }
            
            $sql_join = '';
            if(!empty($tables)) {
                $i = 0;
                foreach ($tables as $table =>$table_join) {
                    $tmp = explode("|", $table);
                    $table_str = $tmp[0];
                    $table_as = '';
                    // if isset table as name
                    if(isset($tmp[1])) {
                        $table_as = $tmp[1];
                    }
                    
                    if($i == 0) {
                        $sql_join = $table . " " . $table_as . " ";
                    } else {
                        $sql_join = $table . " " . $table_as . " ON(".$table_join.") ";
                    }
                    
                    $i++;
                }
            }
            
            if(!empty($sql_join)) {
                $sql .= $sql_join;
            }
            
            if(!empty($where)) {
                $sql .= $where;
            }
            
            if(!empty($orderby)) {
                $sql .= "ORDER BY " . $orderby;
            }
            
            if(!empty($param_where)) {
                //return $this->query($sql, $param_where);
                return $this->data_from_cache($sql, $param_where);
            } else {
                //return $this->query($sql);
                return $this->data_from_cache($sql);
            }
            
        } catch (Exception $e) {
            VNLog::debug_var($this->log_name, $e->getMessage());
            return false;
        }
        
    }
    
    /**
     * data_from_cache
     * @param string $sql
     * @param array $sql_param
     * @return multitype:unknown |Ambigous
     */
    public function data_from_cache($sql, $sql_param = NULL) {
        if(VN_CACHE_ACTION_FLG == FALSE) {
            return $this->query($sql, $sql_param);
        } else {
        
            $data_cache = Cache::get_cache_db($sql, $sql_param);
            if(!empty($data_cache)) {
                return $data_cache;
            } else {
                $data = $this->query($sql, $sql_param);
                Cache::set_cache_db($sql, $sql_param, $data);
                return $data;
            }
        }
    }
}