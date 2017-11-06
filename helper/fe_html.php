<?php
if(count(get_included_files()) ==1)exit("<meta http-equiv='refresh' content='0;url="."http://".$_SERVER['SERVER_NAME']."'>");

class fe_html extends fe{
	function __construct(){

	}

	function b($str){
		return "<b>$str</b>";
	}
}
?>