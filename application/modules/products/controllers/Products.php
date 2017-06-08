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
		$catalogid = intval($this->input->get('catalog'));
		if($catalogid > 0){
			$input['where']['catalog_id'] = $catalogid;
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
	//Thêm sản phẩm
	public function add()
	{

		if($this->input->post()){
			$this->form_validation->set_rules('name', 'Tên sản phẩm', 'trim|required|min_length[4]|max_length[20]');
			$this->form_validation->set_rules('catalog', 'Danh mục sản phẩm', 'trim|required|is_natural');
			$this->form_validation->set_rules('price', 'Giá sản phẩm', 'trim|required');
			//Nhập liệu chính xác
			if ($this->form_validation->run() == TRUE) {
				//Thêm vào csdl
				$name = $this->input->post('name');
				$catalog = $this->input->post('catalog');
				$price = str_replace(',', '', $this->input->post('price'));	
				//ảnh đại diện			
				$image_link = '';
				$upload_path = './upload/product';
				$upload_data = $this->upload_library->upload($upload_path,'image');				
				if(isset($upload_data['file_name'])){
					$image_link = $upload_data['file_name'];
				}
				//upload ảnh kèm keo
				$image_list = '';
				$image_listdata = $this->upload_library->upload_file($upload_path,'image_list');				
				$image_list = json_encode($image_listdata);				
				$data = array(
					'name' => $name,
					'catalog_id' => $catalog,
					'price' => $price,
					'image_link' => $image_link,
					'image_list' => $image_list,
					'discount' => $this->input->post('discount'),
					'warranty' => $this->input->post('warranty'),
					'gifts' => $this->input->post('gifts'),
					'site_title' => $this->input->post('site_title'),
					'meta_desc'  => $this->input->post('meta_desc'),
					'meta_key'   => $this->input->post('meta_key'),
					'content'    => $this->input->post('content'),
					'created'    => strtotime("now")
					);		

				if($this->products_model->create($data)){
					$message = array('status' => 'nSuccess','mes' => 'Thêm Sản phẩm thành công');
					$this->session->set_flashdata('message',$message);
				}else{
					$message = array('status' => 'nWarning','mes' => 'Thêm Sản phẩm không thành công');
					$this->session->set_flashdata('message',$message);
				}
				redirect(base_url('quan-tri/san-pham'),'refresh');		

			} 
		}
		//Lấy danh sách danh mục sản phẩm
		(array)$input2['where'] = array('parent_id' => 0);
		$catalogs = $this->catalog_model->get_list($input2);
		foreach ($catalogs as $row) {
			(array)$input2['where'] = array('parent_id' => $row->id);
			$subs = $this->catalog_model->get_list($input2);
			$row->subs = $subs;
		}		
		$data['catalogs'] = $catalogs;
		
		$data['title'] = 'Thêm sản phẩm';
		$data['message'] = $this->session->flashdata('message');
		$data['temp'] = 'products_add';
		$this->load->view('admin/main',$data);	
	}
	function edit()
	{

		$id = $this->uri->segment(4);
		$product = $this->products_model->get_info($id);
		if(!($product)){
			$message = array('status' => 'nWarning','mes' => 'Không tồn tại sản phẩm');
			$this->session->set_flashdata('message',$message);
			redirect(admin_url('san-pham'),'refresh');
		}
		$data['product'] = $product;

			if($this->input->post()){
			$this->form_validation->set_rules('name', 'Tên sản phẩm', 'trim|required|min_length[4]|max_length[20]');
			$this->form_validation->set_rules('catalog', 'Danh mục sản phẩm', 'trim|required|is_natural');
			$this->form_validation->set_rules('price', 'Giá sản phẩm', 'trim|required');
			//Nhập liệu chính xác
				if ($this->form_validation->run() == TRUE) {
					//Thêm vào csdl
					$name = $this->input->post('name');
					$catalog = $this->input->post('catalog');
					$price = str_replace(',', '', $this->input->post('price'));	
					//ảnh đại diện			
					$image_link = '';
					$upload_path = './upload/product';
					$upload_data = $this->upload_library->upload($upload_path,'image');				
					if(isset($upload_data['file_name'])){
						$image_link = $upload_data['file_name'];
					}
					//upload ảnh kèm keo
					$image_list = '';
					$image_listdata = $this->upload_library->upload_file($upload_path,'image_list');				
					$image_list_json = json_encode($image_listdata);		

					$data = array(
						'name' => $name,
						'catalog_id' => $catalog,
						'price' => $price,						
						'discount' => $this->input->post('discount'),
						'warranty' => $this->input->post('warranty'),
						'gifts' => $this->input->post('gifts'),
						'site_title' => $this->input->post('site_title'),
						'meta_desc'  => $this->input->post('meta_desc'),
						'meta_key'   => $this->input->post('meta_key'),
						'content'    => $this->input->post('content'),
						'updated'    => strtotime("now")
						);	
					if($image_link != ''){
						$data['image_link'] = $image_link;
					}
					if(!empty($image_listdata)){
						$data['image_list'] = $image_list_json;
					}				



					if($this->products_model->update($product->id,$data)){
						$message = array('status' => 'nSuccess','mes' => 'Cập nhập sản phẩm thành công');
						$this->session->set_flashdata('message',$message);
					}else{
						$message = array('status' => 'nWarning','mes' => 'Cập nhập sản phẩm không thành công');
						$this->session->set_flashdata('message',$message);
					}
					redirect(base_url('quan-tri/san-pham'),'refresh');		

				} 
			}
			//Lấy danh sách danh mục sản phẩm
			(array)$input2['where'] = array('parent_id' => 0);
			$catalogs = $this->catalog_model->get_list($input2);
			foreach ($catalogs as $row) {
				(array)$input2['where'] = array('parent_id' => $row->id);
				$subs = $this->catalog_model->get_list($input2);
				$row->subs = $subs;
			}		
			$data['catalogs'] = $catalogs;			
			$data['title'] = 'Chỉnh sửa sản phẩm';
			$data['message'] = $this->session->flashdata('message');
			$data['temp'] = 'products_edit';
			$this->load->view('admin/main',$data);	
		}
	

}

/* End of file Products.php */
/* Location: ./application/modules/products/controllers/Products.php */