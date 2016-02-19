<?php
class Permision_model extends VNModel{
    //table user
    protected $table = 'func';
    
    protected $table_group = 'group';
    
    protected $table_grand = 'grand_permission';
    
    // name log file
    protected $log_name = 'PERMISSION';
    
    /**
     * func_list
     * @param string $where
     * @param array $param_where
     * @param integer $limmit
     * @param integer $offset
     * @return data
     */
    public function func_list($where, $param_where, $limmit, $offset) {
        $result_list = $this->get_list_normal($where, $param_where, $limmit, $offset);
        return $result_list;
    }
    
    /**
     * update permission status
     * @todo: data id array data , element name(key) is fields in database
     * @param array $data
     * @param integer $id
     * @return bool $result
     */
    public function update_status($data, $id) {
        
        $sql_where = "id = :id";
        $param_where = array('id' => $id);
        $result = $this->update($data, $sql_where, $param_where);
        return $result;
    }
    
    /**
     * Scaner permission
     * @todo scan all controller have permission | and add this to database
     * @param unknown $folder
     * @param unknown $file_lib
     */
    public function permission_scaner($folder, $file_lib) {
        /**
         * scan all php file in folder, preg_match_all(@permission) and save this
         */
        if(!empty($folder)) {
            $file_list = $file_lib->FileFolderList($folder);
            if(count($file_list) > 0) {
                foreach ($file_list as $key => $file_item) {
                    
                    if(is_array($file_item) || empty($file_item)) continue;
                    
                    $ext = '';
                    if(is_integer($key)) {
                        $ext = pathinfo($file_item, PATHINFO_EXTENSION);
                    }

                    if($ext == 'php') {
                         //file
                         $content_file = file_get_contents($folder."/".$file_item);
                         preg_match_all("|@permission(.*)@end_permission|U", $content_file, $out, PREG_SET_ORDER);
                         
                         if(count($out) > 0) {
                             $status = true;
                             $this->begin_transaction();
                             foreach ($out as $actions) {
                                 if(isset ($actions[1])) {
                                     // update cache
                                     $result_save = $this->save_func($actions[1]);
                                     if($result_save === false) {
                                         $status = false;
                                     }
                                 }
                             }
                             
                             if($status === false) {
                                 $this->rollback();
                             } else {
                                 $this->commit();
                             }
                         }
                         
                    } else {
                        //folder
                        $this->permission_scaner($folder."/".$file_item, $file_lib);
                    }
                }
            }
        }
    }
    
    /**
     * save func 
     * @todo save success return true| error or empty return false
     * @param unknown $func
     * @return bool
     */
    private function save_func($func) {
        if(!empty($func)) {
            try {
                $tmp = explode("|", $func);
                $param['func'] = $tmp[0];
                $param['description'] = $tmp[1];
                
                $sql_check = "select count(id) as count from " . $this->table . " where func = :func";
                
                $result_check = $this->query($sql_check, array('func' => $param['func']));
                
                if($result_check[0]['count'] == 0) {
                    // have not func --> save this func to db
                    $this->create($param);
                }
                return true;
            } catch (Exception $e) {
                VNLog::debug_var($this->log_name, "save_func " . $e->getMessage());
                return false;
            }
           
        }
        return false;
    }
    
    /**
     * group_list
     * @param string $where
     * @param array $param_where
     * @param integer $limmit
     * @param integer $offset
     * @return data
     */
    public function group_list($where, $param_where, $limmit, $offset) {
        $model = new VNModel();
        $model->settable($this->table_group);
        $result_list = $model->get_list_normal($where, $param_where, $limmit, $offset);
        return $result_list;
    }
    
    /**
     * group_add
     * @param unknown $param
     * @return bool
     */
    public function group_add($param) {
        try {
            $model = new VNModel();
            $model->settable($this->table_group);
            $model->create($param);
            return true;
        } catch (Exception $e) {
            VNLog::debug_var($this->log_name, "group_add " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * group_remove
     * @param unknown $id
     * @return boolean
     */
    public  function group_remove($id) {
        try {
            $model = new VNModel();
            $model->settable($this->table_group);
            $model->delete_id($id);
            return true;
        } catch (Exception $e) {
            VNLog::debug_var($this->log_name, "group_add " . $e->getMessage());
            return false;
        }
        
    }
    
    /**
     * grand_list
     * @param string $where
     * @param array $param_where
     * @param integer $limmit
     * @param integer $offset
     * @return data result
     */
    public function grand_list($where, $param_where, $limmit, $offset) {
        $model = new VNModel();
        $model->settable($this->table_group);
        $result_list = $model->get_list_normal($where, $param_where, $limmit, $offset);
        return $result_list;
    }
    
    /**
     * grand_add
     * @param unknown $param
     * @return boolean
     */
    public function grand_add($param) {
        try {
            $model = new VNModel();
            $model->settable($this->table_grand);
            $model->create($param);
            return true;
        } catch (Exception $e) {
            VNLog::debug_var($this->log_name, "group_add " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * grand_remove
     * @param unknown $id
     * @return boolean
     */
    public  function grand_remove($id) {
        try {
            $model = new VNModel();
            $model->settable($this->table_grand);
            $model->delete_id($id);
            return true;
        } catch (Exception $e) {
            VNLog::debug_var($this->log_name, "group_add " . $e->getMessage());
            return false;
        }
    }
    
}