<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('products_model');
		$this->load->model('catalog_model');
	}
	function catalog()
	{
		//Lấy ra ID của thể loại
		$id = intval($this->uri->segment(3));		
		//Lấy ra thông tin của thể loại
		$catalog = $this->catalog_model->get_info($id);
		if(!$catalog){
			redirect(base_url(),'refresh');
		}	
		$input = array();
		$input['where'] = array('catalog_id' => $id);	
		$total_rows = $this->products_model->get_total($input);

		$config['base_url'] = base_url('products/catalog/'.$id);; // Link hiện tại hiển thị dữ liệu
		$config['total_rows'] = $total_rows; //Tổng số sản phẩm
		$config['per_page'] = 1; //Số sản phẩm hiển thị trên 1 trang
		$config['uri_segment'] = 4;
		$config['num_links'] = 3;
		$config['full_tag_open'] = '';
		$config['full_tag_close'] = '';
		$config['first_link'] = 'Trang đầu tiên';
		//$config['first_tag_open'] = '<div>';
		//$config['first_tag_close'] = '</div>';
		$config['last_link'] = 'Trang cuối cùng';
		//$config['last_tag_open'] = '<div>';
		//$config['last_tag_close'] = '</div>';
		$config['next_link'] = '&gt;';
		//$config['next_tag_open'] = '<div>';
		//$config['next_tag_close'] = '</div>';
		$config['prev_link'] = '&lt;';
		//$config['prev_tag_open'] = '<div>';
		//$config['prev_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<strong>';
		$config['cur_tag_close'] = '</strong>';
		//$segment = $this->uri->segment(3);
		$segment = intval($this->uri->segment(4));
		$this->pagination->initialize($config);	
		
		$input['limit'] = array($config['per_page'] ,$segment );
		$list = $this->products_model->get_list($input);

		$data['list'] = $list;
		$data['catalog'] = $catalog;
		//Hiển thị ra phần view
		$data['total'] = count($list);
		$data['title'] = 'Danh mục: '.$catalog->name;
		$data['temp'] = 'catalog';
		$this->load->view('site/layout',$data);		
	}
	

}	

/* End of file Products.php */
/* Location: ./application/modules/products/controllers/Products.php */