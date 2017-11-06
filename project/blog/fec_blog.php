<?php
if(count(get_included_files()) ==1)exit("<meta http-equiv='refresh' content='0;url="."http://".$_SERVER['SERVER_NAME']."'>");

class fec_blog extends fe_controller{
	
	public function __construct(){

	}

	public function index(){
  		echo "Hello";
	}
	  
	public function model(){
		$model 		= new fem_blog();
		$model->test();
	}

	public function tampilkan(){
		$data['nama'] 	= "Mulyawan Sentosa";
		$data['alamat']	= "Rangkasbitung";

		$view 			= new fe_view();		
		$view->load('design/kepala.php',$data);
		$view->load('design/tengah.php',$data);
		$view->load('design/kaki.php',$data);
	}
}
?>