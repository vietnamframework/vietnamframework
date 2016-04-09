<?php
Class Download_Backend_Controller extends Backend_Controller
{    
    public function Index() {
        $ctg_model = new Category_model();
        $data_category = $ctg_model->get_list_category();
        //$data['category'] = json_encode($data_category);
        $data['category'] = ($data_category);
        /*$language_model = new Language_model();
        $data_language = $language_model->get_list_language();
        $data['language'] = json_encode($data_language);*/
        
        return $this->renderTemplate('download', $data);
    }
    public function exe() {
        //$param = $this->get_param(array('link_dl,category'));
        $param = $_POST;
        if(isset($param['link_dl']) && strlen($param['link_dl'])>0){
            $dl = new Download_model();
            $url= $param['link_dl'];
            
            preg_match('/^(http:\/\/).+?\//',$url,$match);
            $result = $dl->getstructure_bylink($match[0]);
            
            if(isset($param['category'])&& strlen($param['category'])>0){
                $category_id = $param['category'];
            }else{
                //$category_name = $dl->get_text($result['category']);
            }
            $dl->set_URL($url);            
            $title ='';
            $file_name ='';
            $content ='';
            $category_name="";
            foreach($result as $row){
                if($row['key']=='title'){
                    $title = $dl->GetTitle($row['xpath']);
                }else if($row['key']=='image'){                
                    $file_name = $dl->get_img($row['xpath']);
                }else if($row['key']=='category'){                
                    $category_name = $dl->get_text($row['xpath']);
                }else if($row['key']=='content'){
                    foreach($result as $item){
                        if($item['key']=='del'){
                            $dl->remove_element($item['xpath'],$item['element_remove']);
                        }
                    }
                    $content = $dl->get_content($row['xpath']);
                }
            }
            if(isset($param['category'])&& strlen($param['category'])>0){
                $category_id = $param['category'];
            }else{
                $ctg = new Category_model();
                $ctg_info=$ctg->get_category_byname($category_name);
                if(isset($ctg_info[0]['id'])){
                    $category_id = $ctg_info[0]['id'];
                }else{                    
                    $ctg->create_category(array('category_name'=>$category_name,'parent'=>1));
                    $ctg_info=$ctg->get_category_byname($category_name);
                    if(isset($ctg_info[0]['id'])){
                        $category_id = $ctg_info[0]['id'];
                    }
                }                
                //$category_name = $dl->get_text($result['category']);
            }
            $param_news['lang_id']=1; 
            $param_news['key']=0;  
            $param_news['title']=$title;
            $param_news['tag']=$title;
            $param_news['file_name']=$file_name;
            $param_news['content']=$content;
            $param_news['category_id']=$category_id; 		
    		
    	    $post = new News_model();
            $post->create_news($param_news);
    	    
        }
        //$result['errorMsg']='';
        //return View::Json($result);
        header(Core::base_url().'download_Backend');
        exit;
        
    }
}



?>


