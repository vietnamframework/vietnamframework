<?php 

Class Download
{
    private $xpath ;
    private $sdom ;
    function __construct($url='')
    {
        if(strlen($url) > 0){
            $result = $this->GetData_Url($url);
            $this->sdom = str_get_html($result);
        }        
        /*$doc = new DOMDocument();
        @$doc->loadHTML($result);
        $this->xpath= new DOMXpath($doc);*/
    }
    public function Set_URL($url){
        $result = $this->GetData_Url($url);
        $this->sdom = str_get_html($result);
    }
    public function GetData_Url($url){
        $curl = curl_init();
        $agent = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36';
      
        curl_setopt($curl, CURLOPT_USERAGENT, $agent);
	    curl_setopt($curl, CURLOPT_URL, $url);
	    //curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl, CURLOPT_DNS_CACHE_TIMEOUT, 2048); // default expire time is 120s//1024
        
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
	    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
	    $result = curl_exec($curl);
	    curl_close($curl);

	    return $result;
    }
    public function get_text($condition){
        $arr_con = explode(';',$condition);
        $res ='';
        foreach($arr_con as $item){
            $elements = $this->xpath->query($item);
            
    		foreach ($elements as $element) { 
    			//$res .= $element->nodeValue.'<br>' ;
                $res.= $this->get_innerHTML($element);
    		}    
        }
        return $res;
    }
    public function get_innerHTML($condition){
        /*$res ='';        
        foreach($this->sdom->find('div[id$="main_article"]',1) as $input) {
             $res .= $input->innertext().'<br />';
        }
         return $res;*/
        //return  $this->sdom->find('div#main_article article',0)->innertext();
		return  $this->sdom->find($condition,0)->innertext();
    }
    public function file_save($data,$filename)
	{		
   		// Open a file for writing.
	    $fh = fopen($filename, 'w');
	   
	   if(!$fh) {
	     return 'faild';
		}
		else {
	       fwrite($fh,$data);
	       fclose($fh);
	       return true;
	   }
	}
    public function remove_element($remove_con,$count=NULL){
        //$remove_con= "div#mobile_byline;div#alh-postdate;div#alh-byline;div#bb";
        $arr_con = explode(';',$remove_con);  
        if($count=='1'){
            //$count = 0; // remove first item
            foreach($arr_con as $item_rem){
                $item =$this->sdom ->find($item_rem,0) ;
                //$parent = $item->parentnode;
                //$parent->removeChild($item);
                $item->outertext = '';
            }
        }else{
            foreach($arr_con as $item_rem){
                foreach($this->sdom ->find($item_rem) as $item) {
                    //$parent = $item->parentnode;
                    //$parent->removeChild($item);
                    //$item->outertext = '';
                }
            }
        }
        
        $this->sdom->save();
    }
    public function Xpath_Remove($remove_con){
        $res ='';
        $arr_con = explode(';',$remove_con);        
        foreach($arr_con as $item){
            $elements = $this->xpath->query($item);            
    		foreach ($elements as $element) {                
                $element->parentNode->removeChild($element);
    		}    
        }       
    }
    public function get_attributes($condition){
        
        /*$elements = $this->xpath->query($condition);
		foreach ($elements as $element) {
			$array = array();
            foreach ($element->attributes as $attr) { 
                $array['@'.$attr->localName] = $attr->nodeValue; 
            }
            return $array;
		}*/
        return  $this->sdom->find($condition,0)->src;
    }
    public function get_img($condition){
        $year = date('Y');
        $month = date('m');
        $y_path = PHO_UPLOAD_DIR.'/'. $year;
        $m_path = $y_path .'/'. $month;
        if(!is_dir($y_path)){
            mkdir($y_path);
        }
        if(!is_dir($m_path)){
            mkdir($m_path);
        }
        $src =$this->get_attributes($condition);
        if(strpos($src,'http')===false){
			$src="http:".$src;
		}
        $extension = pathinfo($src, PATHINFO_EXTENSION);
        $file_name = $year.'/'.$month.'/'. uniqid(TRUE).'.'.$extension;
        $file_full = PHO_UPLOAD_DIR.'/'.$file_name;
        //$attr = $this->get_attributes($condition);
        //echo $src;
        //echo $file_full;die;
        $data = $this->GetData_Url($src);
        
        $this->file_save($data,$file_full);
        return $file_name;
    }
    public function get_img_byurl($src)
    {
         $year = date('Y');
        $month = date('m');
        $y_path = PHO_UPLOAD_DIR.'/'. $year;
        $m_path = $y_path .'/'. $month;
        if(!is_dir($y_path)){
            mkdir($y_path);
        }
        if(!is_dir($m_path)){
            mkdir($m_path);
        }
        
        $extension = pathinfo($src, PATHINFO_EXTENSION);
        $file_name = $year.'/'.$month.'/'. uniqid(TRUE).'.'.$extension;
        $file_full = PHO_UPLOAD_DIR.'/'.$file_name;
        $data = $this->GetData_Url($src);        
        $this->file_save($data,$file_full);
        return $file_name;
    }
    public function GetTitle($condition){
        /*$elements = $this->xpath->query('//'.$condition);
		foreach ($elements as $element) {
			return $element->nodeValue ;
		}*/
        return  $this->sdom->find($condition,0)->plaintext;
    }
    public function Xpath_GetContent($obj_xpath,$condition){
        $res ='';
        $arr_con = explode(';',$condition);
        //$arr_con = explode(';',$condition);
        /*$el_remove = $xpath->query("//div[@id='alh-byline']");
        foreach ($el_remove as $rem) {
            $rem->parentNode->removeChild($rem);
        }*/
        
        foreach($arr_con as $item){
            $elements = $obj_xpath->query($item);
            
    		foreach ($elements as $element) {
                
                //foreach ($el_remove as $rem) {
                    //$elements->removeChild($el_remove);
                //}
                
    			$res .= $element->nodeValue.'<br>' ;
    		}    
        }
        return $res;
    }
    public function  get_content($condition){
        $html = $this->get_innerHTML($condition);
        $html = trim($this->replace_img_src($html));
        if(substr($html,0,5)=='<br/>' ){
            $html = substr($html,5,strlen($html));
        }
        return $html;
    }
    public function replace_img_src($html){
        $year = date('Y');
        $month = date('m');
        $this->check_folder_download($year,$month);
        $htmldom = str_get_html($html);
        $list_img = $htmldom->find('img');
        foreach($list_img as $img)
        {
            $src = $img->src;
            $data = $this->GetData_Url($src);           
            $extension = pathinfo($src, PATHINFO_EXTENSION);
            $img_name =$year.'/'.$month.'/'. uniqid(TRUE).'.'.$extension;
            //$file_name = $path_dl.'/'. $img_name;         
            $src_new = PHO_UPLOAD_DIR.'/'.$img_name;   
            $this->file_save($data,$src_new);
            $img->src = '../../images/'.$img_name;
        }
        return $htmldom->save();
    }
    public function check_folder_download($year,$month){
        $y_path = PHO_UPLOAD_DIR.'/'. $year;
        $m_path = $y_path .'/'. $month;		
        if(!is_dir($y_path)){
            mkdir($y_path);
        }
        if(!is_dir($m_path)){
            mkdir($m_path);
        }
        //return $m_path;
    }
}



?>


