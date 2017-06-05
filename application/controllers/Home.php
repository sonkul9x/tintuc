<?php 
	/**
	* Home
	*/
	class Home extends Ci_controller
	{		
		
		public function index()
		{
			$data = array();
			$data['temp'] = 'site/home/index';
			$this->load->view('site/layout',$data);
		}
	}