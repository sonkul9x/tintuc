<?php 
	/**
	* My controller
	*/
	class My_Controller extends CI_Controller
	{
		//biến gửi dứ liệu sang view
		public $data = array();
		
		function __construct()
		{
			parent::__construct();
			//kế thừa từ CI controller
			$controller = $this->uri->segment(1);			
			$prifix = substr( $controller, 0, 5 );
			switch ($prifix) {
				case 'admin':
					$this->load->helper('admin');
					$this->_check_login();
					break;
				
				default:
					# code...
					break;
			}
		}
		/*
			Check login
		*/
		private function _check_login()
		{
			# code...
		}
	}