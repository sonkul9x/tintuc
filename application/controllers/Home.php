<?php 
	/**
	* Home
	*/
	class Home extends MY_controller
	{	
		public function __construct()
			{
				parent::__construct();
				
			}	
		
		public function index()
		{			
			//CHỈ HIỂN THỊ TRANG CHỦ SẼ VIẾT TẠI ĐÂY
			//GỌI SLIDER
			$this->load->model('admin_slide/slide_model'); 
			$slide_list = $this->slide_model->get_list();
			$data['slide_list'] = $slide_list;

			//LẤY DANH SÁCH SẢN PHẨM MỚI
			$this->load->model('admin_products/products_model');
			$input = array();
			$input['limit'] = array(3, 0);
			$product_news = $this->products_model->get_list($input);
			$data['product_news'] = $product_news;

			//LẤY DANH SÁCH SẢN PHẨM BÁN NHIỀU NHẤT
			$input2['limit'] = array(3, 0);
			$input2['order'] = array('buyed' , 'DESC');
			$product_hot = $this->products_model->get_list($input2);
			$data['product_hot'] = $product_hot;








			$data['temp'] = 'site/home/index';
			$data['message'] = $this->session->flashdata('message');
			$data['title'] = 'Trang Chủ';
			$data['meta_desc'] = '';
			$data['meta_key'] = '';

			$this->load->view('site/layout',$data);
		}
	}