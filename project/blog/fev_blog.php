<?php
if(count(get_included_files()) ==1)exit("<meta http-equiv='refresh' content='0;url="."http://".$_SERVER['SERVER_NAME']."'>");

class fev_project extends fe_view{
	function __construct(){
		parent::__construct();
	    echo "View";
	}
}
?>