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

		//Kiểm tra danh mục con hay danh mục cha
		if($catalog->parent_id == 0){
			$input3 = array();
			$input3['where'] = array('parent_id' => $id);
			$catalog_subs = $this->catalog_model->get_list($input3);
			if(!empty($catalog_subs)){
				$catalog_subs_id = array();
				foreach ($catalog_subs as $value) {
					$catalog_subs_id[] = $value->id;
				}	
				$this->db->where_in('catalog_id',$catalog_subs_id);			
			}else{
				$input['where'] = array('catalog_id' => $id);	
			}
			
		}else{
			$input['where'] = array('catalog_id' => $id);	
		}

		$total_rows = $this->products_model->get_total($input);

		$config['base_url'] = base_url('products/catalog/'.$id);; // Link hiện tại hiển thị dữ liệu
		$config['total_rows'] = $total_rows; //Tổng số sản phẩm
		$config['per_page'] = 15; //Số sản phẩm hiển thị trên 1 trang
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
		if(isset($catalog_subs_id)){
			$this->db->where_in('catalog_id',$catalog_subs_id);
		}

		
		$list = $this->products_model->get_list($input);

		$data['list'] = $list;
		$data['catalog'] = $catalog;
		//Hiển thị ra phần view
		$data['total'] = count($list);
		$data['title'] = 'Danh mục: '.$catalog->name;
		$data['temp'] = 'catalog';
		$this->load->view('site/layout',$data);		
	}

	/*
		Xem chi tiết sản phẩm!
	*/
	function view()
	{
		$id = $this->uri->segment(3);
		$product = $this->products_model->get_info($id);
		if(!$product){
			redirect(base_url(),'refresh');
		}
		$data['product'] = $product;
		$image_list = @json_decode($product->image_list);
		$data['image_list'] = $image_list;

		//Cập nhập đếm số lượt xem của sản phẩm
		$views = array();
		$views['view'] = $product->view + 1;
		$this->products_model->update($product->id,$views);

		$catproduct = $this->catalog_model->get_info($product->catalog_id); 
		$data['catalog'] = $catproduct;
		$data['title'] = 'Sản phẩm: '.$product->name;
		$data['meta_desc'] ='';
		$data['meta_key'] = '';
		$data['temp'] = 'product';
		$this->load->view('site/layout',$data);		
	}
	/*
	Tìm kiếm theo tên sản phẩm
	*/
	function search($param = '')
	{
		if($param == 1) {
			//LẤY DỮ LIÊU TỪ AUTOCOMPLATE
			$key = $this->input->get('term');
		}else{
			$key = $this->input->get('key-search');
		}
		
		$input = array();
		$input['like'] = array('name', $key);
		$list = $this->products_model->get_list($input);

		$data['key'] = trim($key);
		$data['list'] = $list;
		if($param == 1) {
			$result = array();
			foreach ($list as $row) {
				$item = array();
				$item['id'] = $row->id;
				$item['label'] = $row->name;
				$item['value'] = $row->name;
				$result[] = $item;
			}
			die(json_encode($result));

		}else{
			$data['title'] = 'Tìm kiếm từ khóa: '.$key;
			$data['meta_desc'] ='Tìm kiếm sản phẩm với từ khóa '.$key;
			$data['meta_key'] = $key;
			$data['temp'] = 'search';
			$this->load->view('site/layout',$data);		
		}
	}
	public function search_prce()
	{
		$price_from = intval($this->input->get('price_from'));
		$price_to = intval($this->input->get('price_to'));
		$input = array();
		$input['where'] = array( 'price >=' => $price_from, 'price <=' => $price_to );


		//PHÂN TRANG
		$total_rows = $this->products_model->get_total($input);
		$config['base_url'] = base_url('products/search_price');; // Link hiện tại hiển thị dữ liệu
		$config['total_rows'] = $total_rows; //Tổng số sản phẩm
		$config['per_page'] = 15; //Số sản phẩm hiển thị trên 1 trang
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



		$data['price_from'] = $price_from;
		$data['price_to'] = $price_to;
		$list = $this->products_model->get_list($input);
		$data['title'] = 'Tìm kiếm theo khoảng giá từ: '.$price_from.' đến '.$price_to;
		$data['list'] = $list;
		$data['temp'] = 'search_price';
		$this->load->view('site/layout',$data);		
	}
}	

/* End of file Products.php */
/* Location: ./application/modules/products/controllers/Products.php */