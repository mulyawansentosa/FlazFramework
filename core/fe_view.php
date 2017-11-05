<?php
if(count(get_included_files()) ==1)exit("<meta http-equiv='refresh' content='0;url="."http://".$_SERVER['SERVER_NAME']."'>");

if (!class_exists('fe')) {
	include "fe.php";
}

class fe_view extends fe{

	function __construct(){
	    parent::__construct();
  	}

	function run(){

	}
}
?>