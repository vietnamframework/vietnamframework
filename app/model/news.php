<?php
class News_model extends VNModel{
    //table news
    protected $table = 'content';
    
    // name log file
    protected $log_name = 'news_model_';
    
    
    /**
     *  get news by id
     * @param $id
     * @return array
     */
    public function get_news_by($id) {
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
     * get list news
     * @param number $limmit
     * @param number $offset
     * @return data
     */
    public function get_list_news($limmit = 0, $offset = 0) {
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
     * create news
     * @todo make sql with data $news to :
     *  INSERT INTO table_name (column1, column2, column3,...)
     *   VALUES (value1, value2, value3,...)
     * @param array $news
     * @return boolean
     */
    public function create_news($news) {
        if(count($news) > 0) {
            try{
                $this->create($news);
                return true;
            } catch (Exception $e) {
                VNLog::debug_var($this->log_name, $e->getMessage());
                return false;
            }
    
        }
        return false;
    }
    
    /**
     * delete news by id
     * @param (int)news_id
     * @return boolean
     */
    public function delete_news($news_id) {
        $sql = "id = :id";
        $param = array('id' => $news_id);
        $result = $this->delete($sql, $param);
        return $result;
    }
    
    /**
     * update news data
     * @todo: data id array data , element name(key) is fields in database
     * @param array $data
     * @param integer $id
     * @return bool $result
     */
    public function update_news($data, $id) {
        
        $sql_where = "id = :id";
        $param_where = array('id' => $id);
        $result = $this->update($data, $sql_where, $param_where);
        return $result;
        
    }
    
}