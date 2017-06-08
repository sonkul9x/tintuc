<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('news_model');
		//$this->load->model('catalog_model'); nếu cần danh mục tạo data và xây dựng data
	}

	//Hiển thị danh sách sản phẩm!
	public function index()
	{
		
		$total_rows = $this->news_model->get_total();

		$config['base_url'] = admin_url('san-pham');; // Link hiện tại hiển thị dữ liệu
		$config['total_rows'] = $total_rows; //Tổng số sản phẩm
		$config['per_page'] = 7; //Số sản phẩm hiển thị trên 1 trang
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

		
		$input = array();
		//Kiểm tra lọc
		$id = $this->input->get('id');
		$id = intval($id);
		$input['where'] = array();
		if($id > 0){
			$input['where']['id'] = $id;
		}
		$title = $this->input->get('title');
		if(isset($title) && !empty($title)){
			$input['like'] = array('title', $name);
		}
		//Danh mục bài viết nếu có
		// $catalogid = intval($this->input->get('catalog'));
		// if($catalogid > 0){
		// 	$input['where']['catalog_id'] = $catalogid;
		// }


		$input['limit'] = array($config['per_page'] ,$segment );
  		$list = $this->news_model->get_list($input);
		$data['list'] = $list;

		$data['total'] = count($list);
		$data['title'] = 'Bài viết';
		$data['message'] = $this->session->flashdata('message');
		$data['temp'] = 'index';
		$this->load->view('admin/main',$data);		
	}
	//Thêm sản phẩm
	public function add()
	{

		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Tiêu đề bài viết', 'trim|required|min_length[4]|max_length[50]');			
			$this->form_validation->set_rules('content', 'Nội dung', 'trim|required');
			//Nhập liệu chính xác
			if ($this->form_validation->run() == TRUE) {
				//Thêm vào csdl
				$title = $this->input->post('title');
				$content = $this->input->post('content');
				
				//ảnh đại diện			
				$image_link = '';
				$upload_path = './upload/news';
				$upload_data = $this->upload_library->upload($upload_path,'image');				
				if(isset($upload_data['file_name'])){
					$image_link = $upload_data['file_name'];
				}				
					
				$data = array(
					'title' => $title,
					'content' => $content,					
					'intro' => $this->input->post('intro'),					
					'meta_desc'  => $this->input->post('meta_desc'),
					'meta_key'   => $this->input->post('meta_key'),
					'image_link' => $image_link,
					'created'    => strtotime("now")
					);		

				if($this->news_model->create($data)){
					$message = array('status' => 'nSuccess','mes' => 'Thêm bài viết thành công');
					$this->session->set_flashdata('message',$message);
				}else{
					$message = array('status' => 'nWarning','mes' => 'Thêm bài viết không thành công');
					$this->session->set_flashdata('message',$message);
				}
				redirect(admin_url('tin-tuc'),'refresh');		

			} 
		}
		
		$data['title'] = 'Thêm bài viết';
		$data['message'] = $this->session->flashdata('message');
		$data['temp'] = 'new_add';
		$this->load->view('admin/main',$data);	
	}
	function edit()
	{

		$id = $this->uri->segment(4);
		$new = $this->news_model->get_info($id);
		if(!($new)){
			$message = array('status' => 'nWarning','mes' => 'Không tồn tại sản phẩm');
			$this->session->set_flashdata('message',$message);
			redirect(admin_url('san-pham'),'refresh');
		}
		$data['new'] = $new;

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
					$upload_path = './upload/new';
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



					if($this->news_model->update($new->id,$data)){
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
			$data['temp'] = 'news_edit';
			$this->load->view('admin/main',$data);	
		}
	function delete()
	{
		$id = $this->uri->segment(4);
		//Gọi tới _del
		$this->_del($id);
		$message = array('status' => 'nSuccess','mes' => 'Xóa sản phẩm thành công!');
		$this->session->set_flashdata('message',$message);
		redirect(admin_url('san-pham'),'refresh');

	}
	function deleteall()
	{
		$ids = $this->input->post('ids');		
		foreach ($ids as $id) {
			$this->_del($id);

		}		
	}
	private function _del($id)
	{
		$new = $this->news_model->get_info($id);
		if(!($new)){
			$message = array('status' => 'nWarning','mes' => 'Không tồn tại sản phẩm');
			$this->session->set_flashdata('message',$message);
			redirect(admin_url('san-pham'),'refresh');
		}
		//Thực hiện xóa sản phẩm
		$this->news_model->delete($id);
		//xóa các ảnh sản phẩm
		$img_link = './upload/new/'.$new->image_link;
		if(file_exists($img_link)){
			unlink($img_link);
		}
		 $image_list = json_decode($new->image_list); 
		 if(is_array($image_list)){
		 	foreach ($image_list as $image) {
		 		$img_link2 = './upload/new/'.$image;
		 		if(file_exists($img_link2)){
					unlink($img_link2);
				}
		 	}
		 }
	}

}	

/* End of file news.php */
/* Location: ./application/modules/news/controllers/news.php */