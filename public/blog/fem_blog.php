<?php
if(count(get_included_files()) ==1)exit("<meta http-equiv='refresh' content='0;url="."http://".$_SERVER['SERVER_NAME']."'>");

class fem_blog extends fe_model{
	
	function __construct(){
		parent::__construct();
	}

	function test(){
		echo "Ini Model";
	}

	function get_data(){
		$data['nama'] 	= "Mulyawan Sentosa";
		$data['alamat']	= "Rangkasbitung";
		return $data;		
	}
	
}
?>