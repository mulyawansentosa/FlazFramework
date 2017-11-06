<?php
if(count(get_included_files()) ==1)exit("<meta http-equiv='refresh' content='0;url="."http://".$_SERVER['SERVER_NAME']."'>");

class fe_view extends fe{

	private $controller;

	function __construct(){
		parent::uri();
		parent::html();
	}

	public function load($file,$data){
		foreach($data as $key => $val){
			${$key} 	= $val;
		}
		include fe_project_dir.'/'.$this->uri->cont().'/'.$file;
	}
}
?>