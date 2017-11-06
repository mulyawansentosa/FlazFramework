<?php
if(count(get_included_files()) ==1)exit("<meta http-equiv='refresh' content='0;url="."http://".$_SERVER['SERVER_NAME']."'>");

class fe{
	public $core;
	public $uri;
	public $cont;
	public $mode;
	public $view;
	public $html;

	public function __construct(){
		include "fe_core.php";
		include "fe_uri.php";
		include "fe_controller.php";
		include "fe_model.php";
		include "fe_view.php";
		include "helper/fe_html.php";
		$this->core = new fe_core();
		$this->uri 	= new fe_uri();
		$this->cont = new fe_controller();
		$this->mode = new fe_model();
		$this->view = new fe_view();
		$this->html = new fe_html();
  	}

  	public function core(){
		$this->core = new fe_core();  		
  	}

  	public function uri(){
		$this->uri = new fe_uri();  		
  	}

  	public function cont(){
		$this->cont = new fe_cont();  		
  	}

  	public function mode(){
		$this->mode = new fe_mode();  		
  	}

  	public function view(){
		$this->view = new fe_view();  		
  	}

  	public function html(){
		$this->html = new fe_html();  		
  	}

  	public function run(){
  		$this->core->execute();
  	}
}
?>