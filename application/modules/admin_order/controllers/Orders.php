<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaction_model');
		$this->load->model('order_model'); 
		$this->load->model('products_model');
	}

	//Hiển thị danh sách sản phẩm!
	public function index()
	{
		
		$total_rows = $this->transaction_model->get_total();

		$config['base_url'] = admin_url('don-hang');; // Link hiện tại hiển thị dữ liệu
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
		$status = $this->input->get('status');

		if(isset($status) && !empty($status)){			
			$input['where']['status'] = $status;
		}elseif($status == 3){
			$input['where']['status'] = 3;
		}
		

		$input['limit'] = array($config['per_page'] ,$segment );
  		$list = $this->transaction_model->get_list($input);
		$data['list'] = $list;

		$data['total'] = count($list);
		$data['title'] = 'Đơn hàng';
		$data['message'] = $this->session->flashdata('message');
		$data['temp'] = 'index';
		$this->load->view('admin/main',$data);		
	}
	//Thêm sản phẩm
	// public function add()
	// {

	// 	if($this->input->post()){
	// 		$this->form_validation->set_rules('title', 'Tiêu đề đơn hàng', 'trim|required|min_length[4]|max_length[50]');			
	// 		$this->form_validation->set_rules('content', 'Nội dung', 'trim|required');
	// 		//Nhập liệu chính xác
	// 		if ($this->form_validation->run() == TRUE) {
	// 			//Thêm vào csdl
	// 			$title = $this->input->post('title');
	// 			$content = $this->input->post('content');
				
	// 			//ảnh đại diện			
	// 			$image_link = '';
	// 			$upload_path = './upload/news';
	// 			$upload_data = $this->upload_library->upload($upload_path,'image');				
	// 			if(isset($upload_data['file_name'])){
	// 				$image_link = $upload_data['file_name'];
	// 			}				
					
	// 			$data = array(
	// 				'title' => $title,
	// 				'content' => $content,					
	// 				'intro' => $this->input->post('intro'),					
	// 				'meta_desc'  => $this->input->post('meta_desc'),
	// 				'meta_key'   => $this->input->post('meta_key'),
	// 				'image_link' => $image_link,
	// 				'created'    => strtotime("now")
	// 				);		

	// 			if($this->news_model->create($data)){
	// 				$message = array('status' => 'nSuccess','mes' => 'Thêm đơn hàng thành công');
	// 				$this->session->set_flashdata('message',$message);
	// 			}else{
	// 				$message = array('status' => 'nWarning','mes' => 'Thêm đơn hàng không thành công');
	// 				$this->session->set_flashdata('message',$message);
	// 			}
	// 			redirect(admin_url('don-hang'),'refresh');		

	// 		} 
	// 	}
		
	// 	$data['title'] = 'Thêm đơn hàng';
	// 	$data['message'] = $this->session->flashdata('message');
	// 	$data['temp'] = 'new_add';
	// 	$this->load->view('admin/main',$data);	
	// }
	function edit()
	{

		$id = $this->uri->segment(4);
		$transaction = $this->transaction_model->get_info($id);
		if(!($transaction)){
			$message = array('status' => 'nWarning','mes' => 'Không tồn tại đơn hàng');
			$this->session->set_flashdata('message',$message);
			redirect(admin_url('don-hang'),'refresh');
		}
		$data['transaction'] = $transaction;
		$where2['where'] = array('transaction_id' => $transaction->id);
		$myorder = $this->order_model->get_list($where2);
		$data['myorder'] = $myorder;
		$login = $this->session->userdata('login');		
			if($this->input->post()){
			$this->form_validation->set_rules('user_name', 'Người đặt hàng', 'trim|required');
			$this->form_validation->set_rules('user_phone', 'Số điện thoại', 'trim|required');	
			$this->form_validation->set_rules('user_email', 'Email', 'trim|required');				
			$this->form_validation->set_rules('user_address', 'Địa chỉ giao hàng', 'trim|required');
			$this->form_validation->set_rules('message', 'Nội dung', 'trim');
			//Nhập liệu chính xác
				if ($this->form_validation->run() == TRUE) {
					//Thêm vào csdl
					$user_name = $this->input->post('user_name');		
					$message = $this->input->post('message');			
					//ảnh đại diện			
					
					$data = array(
						'status' => $this->input->post('status'),		
						'user_name' => $user_name,
						'user_email' => $this->input->post('user_email'),
						'user_phone' => $this->input->post('user_phone'),
						'user_address' => $this->input->post('user_address'),
						'admin_edit' => $login['id'],
						'message' => $message,				
									
						'updated'    => strtotime("now")
						);	
					
					if($this->transaction_model->update($id,$data)){
						$message = array('status' => 'nSuccess','mes' => 'Cập nhập đơn hàng thành công');
						$this->session->set_flashdata('message',$message);
					}else{
						$message = array('status' => 'nWarning','mes' => 'Cập nhập đơn hàng không thành công');
						$this->session->set_flashdata('message',$message);
					}
					redirect(base_url('quan-tri/don-hang'),'refresh');		

				} 
			}				
			$data['title'] = 'Chỉnh sửa đơn hàng';
			$data['message'] = $this->session->flashdata('message');
			$data['temp'] = 'order_edit';
			$this->load->view('admin/main',$data);	
		}
	function delete()
	{
		$id = $this->uri->segment(4);
		//Gọi tới _del
		$this->_del($id);
		$message = array('status' => 'nSuccess','mes' => 'Xóa đơn hàng thành công!Chú ý: Tất cả các sản phẩm trong đơn hàng đã bị xóa!');
		$this->session->set_flashdata('message',$message);
		redirect(admin_url('don-hang'),'refresh');

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
		$new = $this->transaction_model->get_info($id);
		if(!($new)){
			$message = array('status' => 'nWarning','mes' => 'Không tồn tại đơn hàng');
			$this->session->set_flashdata('message',$message);
			redirect(admin_url('don-hang'),'refresh');
		}
		//Thực hiện xóa sản phẩm
		$this->transaction_model->delete($id);

		$where = array('transaction_id' => $id);
		$this->order_model->del_rule($where);		
		
	}
	function order_edit($id)
	{


		$data['title'] = 'Chỉnh sửa đơn hàng';
		$data['message'] = $this->session->flashdata('message');
		$data['temp'] = 'ordermain_edit';
		$this->load->view('admin/main',$data);	
	}

}	

/* End of file news.php */
/* Location: ./application/modules/news/controllers/news.php */