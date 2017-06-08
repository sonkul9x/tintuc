<?php 
	/**
	* My controller
	*/
	class MY_Controller extends CI_Controller
	{
		//biến gửi dứ liệu sang view
		public $data = array();
		
		function __construct()
		{			
			parent::__construct();
			//kế thừa từ CI controller
			date_default_timezone_set('Asia/Ho_Chi_Minh');
			$controller = $this->uri->segment(1);	
			switch ($controller) {
				case 'quan-tri':
					$this->load->helper('admin');
					$this->_check_login();
					break;			
				case 'dang-nhap':
					$this->load->helper('admin');
					$this->_check_login();
					break;
			}
		}
		/*
			Check login
		*/	
		private function _check_login()
		{
			$controller = $this->uri->segment(2);
			$controller = strtolower($controller);
			$login = $this->session->userdata('login');			
			if(!$login && $controller != 'dang-nhap'){
			
				redirect(admin_url('dang-nhap'),'refresh');
			}
			if($login && ($controller == 'dang-nhap')){

				redirect(admin_url('dashboard'),'refresh');
			}
		}
	}