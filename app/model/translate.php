<?php
class Translate_model extends VNModel{
    //table user
    protected $table = 'frontend_trans';
    
    // name log file
    protected $log_name = 'TRANSLATE_FRONTEND';
    
    /**
     * get_list
     * @param string $where
     * @param array $param_where
     * @param integer $limmit
     * @param integer $offset
     * @return data
     */
    public function get_list($where, $param_where, $limmit, $offset) {
        return $this->get_list_normal($where, $param_where, $limmit, $offset);
    }
    
    /**
     * update trans data
     * @param array $data
     * @param integer $id
     * @return boolean
     */
    public function trans_update($data, $id) {
        $sql_where = "id = :id";
        $param_where = array('id' => $id);
        $result = $this->update($data, $sql_where, $param_where);
        return $result;
    }
    
    /**
     * delete trans
     * @param integer $id
     * @return boolean
     */
    public function trans_delete($id) {
        return $this->delete_id($id);
    }
    
    /**
     * get trans by key
     * @param string $key
     * @return data
     */
    public function get_trans($key) {
        
        $where = " key = :key";
        $param = array('key' => $key);
        $result = $this->get_list_normal($where, $param, 1, 0);
        return $result;
    }
}