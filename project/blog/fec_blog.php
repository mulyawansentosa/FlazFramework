<?php
if(count(get_included_files()) ==1)exit("<meta http-equiv='refresh' content='0;url="."http://".$_SERVER['SERVER_NAME']."'>");

class fec_blog extends fe_controller{

	public $model;
	public $view;

	public function __construct(){
		$this->model 	= new fem_blog();
		$this->view 	= new fe_view();
	}

	function index(){
  		echo "Hello";
	}
	  
	function model(){
		$this->model->test();
	}

	function tampilkan(){
		$data 	= $this->model->get_data();
		$this->view->load('design/kepala.php',$data);
		$this->view->load('design/tengah.php',$data);
		$this->view->load('design/kaki.php',$data);
	}
}
?>