<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('products_model');
		$this->load->model('catalog_model');
	}

	//Hiển thị danh sách sản phẩm!
	public function index()
	{
		
		$total_rows = $this->products_model->get_total();

		$config['base_url'] = admin_url('san-pham');; // Link hiện tại hiển thị dữ liệu
		$config['total_rows'] = $total_rows; //Tổng số sản phẩm
		$config['per_page'] = 4; //Số sản phẩm hiển thị trên 1 trang
		$config['uri_segment'] = 3;
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
		$segment = intval($this->uri->segment(3));
		$this->pagination->initialize($config);		

		//Lấy danh sách danh mục sản phẩm
		(array)$input2['where'] = array('parent_id' => 0);
		$catalogs = $this->catalog_model->get_list($input2);
		foreach ($catalogs as $row) {
			(array)$input2['where'] = array('parent_id' => $row->id);
			$subs = $this->catalog_model->get_list($input2);
			$row->subs = $subs;
		}		
		$data['catalogs'] = $catalogs;

		$input = array();
		//Kiểm tra lọc
		$id = $this->input->get('id');
		$id = intval($id);
		$input['where'] = array();
		if($id > 0){
			$input['where']['id'] = $id;
		}
		$name = $this->input->get('name');
		if(isset($name) && !empty($name)){
			$input['like'] = array('name', $name);
		}

		$input['limit'] = array($config['per_page'] ,$segment );
  		$list = $this->products_model->get_list($input);
		$data['list'] = $list;

		$data['total'] = count($list);
		$data['title'] = 'Danh sách sản phẩm';
		$data['message'] = $this->session->flashdata('message');
		$data['temp'] = 'products_list';
		$this->load->view('admin/main',$data);		
	}

}

/* End of file Products.php */
/* Location: ./application/modules/products/controllers/Products.php */