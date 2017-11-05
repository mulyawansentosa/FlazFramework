<?php
if(count(get_included_files()) ==1)exit("<meta http-equiv='refresh' content='0;url="."http://".$_SERVER['SERVER_NAME']."'>");

class fe{

	function __construct(){
		include "config/fe_config.php";
		include "fe_controller.php";
		include "fe_model.php";
		include "fe_view.php";
		$this->include_mvc();

  	}

  	function run(){
		if($this->page()){
			if($this->check_class(0)){
				if(!$this->check_method(0,1)){
					echo "Method Not Found";
				}else{
					$classname 	= 'fec_'.$this->uri_segment(0);
					$def 	 	= new $classname();
					/*
					$methodname = $this->uri_segment(1);
					$default->$methodname();
					*/
				}
			}else{
				echo "No Controller Found";
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

	function include_mvc(){
		$folder_list = array();
		$folder_list = $this->dir_list("project", $folder_list);
		foreach($folder_list as $key => $val){
			foreach($folder_list[$key] as $val1){
				if(file_exists($key.'/'.$val1.'/fec_'.$val1.'.php')){
					include $key.'/'.$val1.'/fec_'.$val1.'.php';
				}
				if(file_exists($key.'/'.$val1.'/fem_'.$val1.'.php')){
					include $key.'/'.$val1.'/fem_'.$val1.'.php';
				}
				if(file_exists($key.'/'.$val1.'/fev_'.$val1.'.php')){
					include $key.'/'.$val1.'/fev_'.$val1.'.php';
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
		if($this->check_class_name(fe_default_root)){
			if($this->check_method_name(fe_default_root,'index')){
				header('Location: '.fe_default_root.'/index');
			}else{
				echo "No Default Method Specify";
			}
		}else{
			echo "This Controller is not defined";
		}
	}
}
?>