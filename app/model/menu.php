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
            $sql = "SELECT *,'0' as chk ,(select count(*) from menu m where m.parent = t.id) have_child FROM " . $this->table .' t';
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
    
    public function gen_menu() {
		$data = $this->get_list_menu();
		
		$menu_tree = array();
		if(count($data) > 0) {
			foreach($data as $menu) {
				
				$menu_parent = array();
				if($menu['parent'] == 0) {
					$menu_parent = $menu;
					if($menu['have_child'] > 0) {
						$child = array();
						foreach($data as $child_menu) {
							if($menu['id'] == $child_menu['parent']) {
								$child[] = $child_menu;
							}
						}
						$menu_parent['child'] = $child;
						
					}
					$menu_tree[] = $menu_parent;
				}
				
			}
			
			foreach($menu_tree as $tree) {
				$child_has = '';
				$menu_sub = '';
				if(isset($tree['child']) && count($tree['child']) > 0) {
					$child_has = '<span>+</span>';
					$menu_sub = '<ul class="submenu">';
					foreach($tree['child'] as $child) {
						$menu_sub .= '<li><a class="" href="'.Core::base_url().$child['link'].'" title="'.$child['title'].'">'.$child['title'].'</a></li>';
					}
					$menu_sub .= '</ul>';
				}
				$menu_gnav =  '<li><a class="" href="'.Core::base_url().$tree['link'].'" title="'.$tree['title'].'">'.$tree['title'].$child_has.'</a>'.$menu_sub.' </li>';
				echo $menu_gnav;
			}
			
		}

	}
}