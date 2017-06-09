<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slide extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('slide_model');
		//$this->load->model('catalog_model'); nếu cần danh mục tạo data và xây dựng data
	}

	//Hiển thị danh sách sản phẩm!
	public function index()
	{
		
		$total_rows = $this->slide_model->get_total();	

		
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
		//Danh mục slide nếu có
		// $catalogid = intval($this->input->get('catalog'));
		// if($catalogid > 0){
		// 	$input['where']['catalog_id'] = $catalogid;
		// }


	
  		$list = $this->slide_model->get_list($input);
		$data['list'] = $list;

		$data['total'] = count($list);
		$data['title'] = 'Quản lý Slides';
		$data['message'] = $this->session->flashdata('message');
		$data['temp'] = 'index';
		$this->load->view('admin/main',$data);		
	}
	//Thêm sản phẩm
	public function add()
	{

		if($this->input->post()){
			$this->form_validation->set_rules('name', 'Tiêu đề slide', 'trim|required|min_length[4]|max_length[50]');			
			$this->form_validation->set_rules('link', 'link trỏ đi', 'trim|required|valid_url');
			//Nhập liệu chính xác
			if ($this->form_validation->run() == TRUE) {
				//Thêm vào csdl
				$name = $this->input->post('name');
				$link = $this->input->post('link');
				
				//ảnh đại diện			
				$image_link = '';
				$upload_path = './upload/slide';
				$upload_data = $this->upload_library->upload($upload_path,'image');				
				if(isset($upload_data['file_name'])){
					$image_link = $upload_data['file_name'];
				}				
					
				$data = array(
					'name' => $name,
					'link' => $link,					
					'info' => $this->input->post('info'),					
					'image_name'  => $this->input->post('image_name'),
					'image_link' => $image_link,
					'sort_order'    => $this->input->post('sort_order')
					);		

				if($this->slide_model->create($data)){
					$message = array('status' => 'nSuccess','mes' => 'Thêm slide thành công');
					$this->session->set_flashdata('message',$message);
				}else{
					$message = array('status' => 'nWarning','mes' => 'Thêm slide không thành công');
					$this->session->set_flashdata('message',$message);
				}
				redirect(admin_url('slide'),'refresh');		

			} 
		}
		
		$data['title'] = 'Thêm slide';
		$data['message'] = $this->session->flashdata('message');
		$data['temp'] = 'slide_add';
		$this->load->view('admin/main',$data);	
	}
	function edit()
	{

		$id = $this->uri->segment(4);
		$slide = $this->slide_model->get_info($id);
		if(!($slide)){
			$message = array('status' => 'nWarning','mes' => 'Không tồn tại slide');
			$this->session->set_flashdata('message',$message);
			redirect(admin_url('slide'),'refresh');
		}
		$data['slide'] = $slide;

			if($this->input->post()){
			$this->form_validation->set_rules('name', 'Tiêu đề slide', 'trim|required|min_length[4]|max_length[50]');			
			$this->form_validation->set_rules('link', 'link trỏ đi', 'trim|required|valid_url');
			//Nhập liệu chính xác
				if ($this->form_validation->run() == TRUE) {
					//Thêm vào csdl
					$name = $this->input->post('name');
					$link = $this->input->post('link');
					//ảnh đại diện			
					$image_link = '';
					$upload_path = './upload/slide';
					$upload_data = $this->upload_library->upload($upload_path,'image');				
					if(isset($upload_data['file_name'])){
						$image_link = $upload_data['file_name'];
					}
				
					$data = array(
					'name' => $name,
					'link' => $link,					
					'info' => $this->input->post('info'),					
					'image_name'  => $this->input->post('image_name'),					
					'sort_order'    => $this->input->post('sort_order')
					);
					if(is_array($upload_data)){
						$data['image_link'] = $image_link;
					}else{
						$message = array('status' => 'nWarning','mes' => 'Cập nhập slide không thành công (Lỗi ảnh)');
						$this->session->set_flashdata('message',$message);
						redirect(admin_url('slide'),'refresh');		
					}

					if($this->slide_model->update($slide->id, $data)){
						$message = array('status' => 'nSuccess','mes' => 'Cập nhập slide thành công');
						$this->session->set_flashdata('message',$message);
					}else{
						$message = array('status' => 'nWarning','mes' => 'Cập nhập slide không thành công');
						$this->session->set_flashdata('message',$message);
					}
					redirect(admin_url('slide'),'refresh');		

				} 
			}				
			$data['title'] = 'Chỉnh sửa Slide';
			$data['message'] = $this->session->flashdata('message');
			$data['temp'] = 'slide_edit';
			$this->load->view('admin/main',$data);	
		}
	function delete()
	{
		$id = $this->uri->segment(4);
		//Gọi tới _del
		$this->_del($id);
		$message = array('status' => 'nSuccess','mes' => 'Xóa slide thành công!');
		$this->session->set_flashdata('message',$message);
		redirect(admin_url('slide'),'refresh');

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
		$new = $this->slide_model->get_info($id);
		if(!($new)){
			$message = array('status' => 'nWarning','mes' => 'Không tồn tại slide');
			$this->session->set_flashdata('message',$message);
			redirect(admin_url('slide'),'refresh');
		}
		//Thực hiện xóa sản phẩm
		$this->slide_model->delete($id);
		//xóa các ảnh sản phẩm
		$img_link = './upload/slide/'.$new->image_link;
		if(file_exists($img_link)){
			unlink($img_link);
		}		 
	}

}	

/* End of file slide.php */
/* Location: ./application/modules/slide/controllers/slide.php */