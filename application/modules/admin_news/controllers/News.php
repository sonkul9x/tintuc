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
			$input['like'] = array('title', $title);
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
			$message = array('status' => 'nWarning','mes' => 'Không tồn tại bài viết');
			$this->session->set_flashdata('message',$message);
			redirect(admin_url('tin-tuc'),'refresh');
		}
		$data['new'] = $new;

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
						'updated'    => strtotime("now")
						);	
					if($image_link != ''){
						$data['image_link'] = $image_link;
					}
					if($this->news_model->update($new->id,$data)){
						$message = array('status' => 'nSuccess','mes' => 'Cập nhập bài viết thành công');
						$this->session->set_flashdata('message',$message);
					}else{
						$message = array('status' => 'nWarning','mes' => 'Cập nhập bài viết không thành công');
						$this->session->set_flashdata('message',$message);
					}
					redirect(base_url('quan-tri/tin-tuc'),'refresh');		

				} 
			}				
			$data['title'] = 'Chỉnh sửa bài viết';
			$data['message'] = $this->session->flashdata('message');
			$data['temp'] = 'new_edit';
			$this->load->view('admin/main',$data);	
		}
	function delete()
	{
		$id = $this->uri->segment(4);
		//Gọi tới _del
		$this->_del($id);
		$message = array('status' => 'nSuccess','mes' => 'Xóa bài viết thành công!');
		$this->session->set_flashdata('message',$message);
		redirect(admin_url('tin-tuc'),'refresh');

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
			$message = array('status' => 'nWarning','mes' => 'Không tồn tại bài viết');
			$this->session->set_flashdata('message',$message);
			redirect(admin_url('tin-tuc'),'refresh');
		}
		//Thực hiện xóa sản phẩm
		$this->news_model->delete($id);
		//xóa các ảnh sản phẩm
		$img_link = './upload/news/'.$new->image_link;
		if(file_exists($img_link)){
			unlink($img_link);
		}		 
	}

}	

/* End of file news.php */
/* Location: ./application/modules/news/controllers/news.php */