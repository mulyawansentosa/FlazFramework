<?php
if(count(get_included_files()) ==1)exit("<meta http-equiv='refresh' content='0;url="."http://".$_SERVER['SERVER_NAME']."'>");

class fec_blog extends fe_controller{
	function __construct(){
	    parent::__construct();
  	}

  	function index(){
  		echo "Hello";
  	}
}
?>