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
					redirect(base_url('quan-tri/dang-nhap'),'refresh');					
					break;
				default:

					$this->load->model('admin_products/catalog_model'); // load modules catalog
					//LẤY DANH MỤC SẢN PHẨM BÊN CỘT TRÁI DÙNG CHUNG CHO TẤT CẢ CÁC TRANG FRONT END;
					(array)$input['where'] = array('parent_id' => 0);
					$catalog_list = $this->catalog_model->get_list($input);
					foreach ($catalog_list as $row) {
						(array)$input['where'] = array('parent_id' => $row->id);
						$subs = $this->catalog_model->get_list($input);
						$row->subs = $subs;
					}		
					$this->data['catalog_list'] = $catalog_list;	
					//LẤY DANH SÁCH BÀI VIẾT MỚI
					$this->load->model('admin_news/news_model'); // load modules catalog
					$input2['limit'] = array(2 , 0);
					$new_list = $this->news_model->get_list($input2);
					$this->data['new_list'] = $new_list;











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