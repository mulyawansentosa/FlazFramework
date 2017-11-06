<?php
if(count(get_included_files()) ==1)exit("<meta http-equiv='refresh' content='0;url="."http://".$_SERVER['SERVER_NAME']."'>");

class fe_core extends fe{
	
	function __construct(){
		parent::uri();
	}

	public function dir_list($dir, $dir_array){
	    $files = scandir($dir);	   
	    if(is_array($files)){
	        foreach($files as $val){
	            if($val == '.' || $val == '..')
	                continue;
	            if(is_dir($dir.'/'.$val)){
	                $dir_array[$dir][] = $val;	               
	                $this->dir_list($dir.'/'.$val, $dir_array);
	            }else{
	                $dir_array[$dir][] = $val;
	            }
	        }
	    }
	    ksort($dir_array);
	    return $dir_array;
	}

	public function check_controller_file($controller){
		if(file_exists(fe_project_dir.'/'.$controller.'/fec_'.$controller.'.php')){
			return true;
		}else{
			return false;
		}
	}

	public function include_controller_file($class){
		$folder_list = array();
		$folder_list = $this->dir_list(fe_project_dir,$folder_list);
		foreach($folder_list as $key => $val){
			foreach($folder_list[$key] as $val1){
				if($val1 === $class){
					if(file_exists($key.'/'.$val1.'/fec_'.$val1.'.php')){
						include $key.'/'.$val1.'/fec_'.$val1.'.php';
					}
				}
			}
		}	
	}

	public function check_model_file($controller){
		if(file_exists(fe_project_dir.'/'.$controller.'/fem_'.$controller.'.php')){
			return true;
		}else{
			return false;
		}
	}

	public function include_model_file($class){
		$folder_list = array();
		$folder_list = $this->dir_list(fe_project_dir,$folder_list);
		foreach($folder_list as $key => $val){
			foreach($folder_list[$key] as $val1){
				if($val1 === $class){
					if(file_exists($key.'/'.$val1.'/fem_'.$val1.'.php')){
						include $key.'/'.$val1.'/fem_'.$val1.'.php';
					}
				}
			}
		}	
	}

	public function check_class($segment){
		if(in_array('fec_'.$this->uri->segment($segment),get_declared_classes())){
			return true;
		}else{
			return false;
		}
	}

	public function check_class_name($class){
		if(in_array('fec_'.$class,get_declared_classes())){
			return true;
		}else{
			return false;
		}
	}

	public function check_method($class,$method){
		if(in_array($this->uri->segment($method),get_class_methods('fec_'.$this->uri->segment($class)))){
			return true;
		}else{
			return false;
		}
	}

	public function check_method_name($class,$method){
		if(in_array($method,get_class_methods('fec_'.$class))){
			return true;
		}else{
			return false;
		}
	}

	public function default_controller(){
		if($this->check_controller_file(fe_default_root)){
			$this->include_controller_file(fe_default_root);
			if($this->check_class_name(fe_default_root)){
				if($this->check_method_name(fe_default_root,'index')){
					$classname 		= 'fec_'.fe_default_root;
					$class_file 	= new $classname();
					$class_file->index();
				}else{
					echo "Default Method is not found";									
				}
			}else{
				echo "Default Controller is not found";				
			}
		}else{
				echo "Default Controller is not found";
		}
	}
}
?>