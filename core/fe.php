<?php
if(count(get_included_files()) ==1)exit("<meta http-equiv='refresh' content='0;url="."http://".$_SERVER['SERVER_NAME']."'>");

class fe{

	function __construct(){
		include "config/fe_config.php";
		include "fe_controller.php";
		include "fe_model.php";
		include "fe_view.php";
		//$this->include_mvc();

  	}

  	function run(){
		if($this->page()){
			$page 	= $this->uri_segment(0);
			if($this->check_controller_file($page)){
				$this->include_controller_class($page);
				$classname 		= 'fec_'.$page;
				$class_file 	= new $classname();
				if($this->check_method(0,1)){
					$methodname = $this->uri_segment(1);
					$class_file->$methodname();
				}else{
					if($this->check_method_name($page,'index')){
						$class_file->index();
					}else{
						echo "Default Method is not found";									
					}
				}
			}else{
				echo "Controller is not found";
			}
		}else{
			$this->default_controller();
		}
  	}

	function dir_list($dir, $dir_array){
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

	function check_controller_file($controller){
		if(file_exists(fe_project_dir.'/'.$controller.'/fec_'.$controller.'.php')){
			return true;
		}else{
			return false;
		}
	}

	function include_controller_class($class){
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

	function check_model_file($controller){
		if(file_exists(fe_project_dir.'/'.$controller.'/fem_'.$controller.'.php')){
			return true;
		}else{
			return false;
		}
	}

	function include_model_class($dir,$class){
		$folder_list = array();
		$folder_list = $this->dir_list($dir, $folder_list);
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

	function check_view_file($controller){
		if(file_exists(fe_project_dir.'/'.$controller.'/fev_'.$controller.'.php')){
			return true;
		}else{
			return false;
		}
	}

	function include_view_class($dir,$class){
		$folder_list = array();
		$folder_list = $this->dir_list($dir, $folder_list);
		foreach($folder_list as $key => $val){
			foreach($folder_list[$key] as $val1){
				if($val1 === $class){
					if(file_exists($key.'/'.$val1.'/fev_'.$val1.'.php')){
						include $key.'/'.$val1.'/fev_'.$val1.'.php';
					}
				}
			}
		}	
	}

	function page(){
		$get 		= array_keys($_GET);
		if(isset($get[0])){
			$url 		= explode('/',$get[0]);
			$page 		= $url[0];
		}else{
			$page 		= "";
		}
		return $page;
	}

	function uri_segment($id){
		$get 		= array_keys($_GET);
		if(isset($get[0])){
			$url 		= explode('/',$get[0]);
			if(sizeof($url)-1 < $id){
				return "";
			}else{
				return $url[$id];
			}
		}else{
			return "";
		}
	}
	function uri_all(){
		$get 		= array_keys($_GET);
		if(isset($get[0])){
			$url 		= explode('/',$get[0]);
			return $url;
		}else{
			return array();
		}
	}
	function uri_last(){
		$get 		= array_keys($_GET);
		if(isset($get[0])){
			$url 		= explode('/',$get[0]);
			return end($url);
		}else{
			return "";
		}
	}
	function uri_except($remove){
		$get 		= array_keys($_GET);
		if(isset($get[0])){
			$url 		= explode('/',$get[0]);
			foreach($url as $key => $value){
				if(in_array($key,$remove)){
					unset($url[$key]);
				}
			}
			return $url;
		}else{
			return array();
		}
	}

	function check_class($segment){
		if(in_array('fec_'.$this->uri_segment($segment),get_declared_classes())){
			return true;
		}else{
			return false;
		}
	}

	function check_class_name($class){
		if(in_array('fec_'.$class,get_declared_classes())){
			return true;
		}else{
			return false;
		}
	}

	function check_method($class,$method){
		if(in_array($this->uri_segment($method),get_class_methods('fec_'.$this->uri_segment($class)))){
			return true;
		}else{
			return false;
		}
	}

	function check_method_name($class,$method){
		if(in_array($method,get_class_methods('fec_'.$class))){
			return true;
		}else{
			return false;
		}
	}

	function default_controller(){
		if($this->check_controller_file(fe_default_root)){
			$this->include_controller_class(fe_default_root);
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