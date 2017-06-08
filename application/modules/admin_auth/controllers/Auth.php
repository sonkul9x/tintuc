<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {	

	function __construct()
	{
		$data = array();
		parent::__construct();
		$this->load->model('admin_model');
	}

	// Lấy danh sách Admin
	public function index()
	{
		$input = array();
		$list = $this->admin_model->get_list($input);
		$total = $this->admin_model->get_total();

		$data = array();
		$data['title'] = 'Danh sách quản trị viên';
		$data['message'] = $this->session->flashdata('message');
		$data['list'] = $list;
		$data['total'] = $total;
		$data['temp'] = 'admin_list';		
		$this->load->view('admin/main',$data);
	}
	// Thêm mới quản trị viên
	public function add()
	{

		if($this->input->post()){
			$this->form_validation->set_rules('name', 'Họ và tên', 'trim|required|min_length[6]|max_length[20]');
			$this->form_validation->set_rules('username', 'Tài khoản', 'trim|required|min_length[4]|max_length[12]|callback__check_username');
			$this->form_validation->set_rules('pass', 'Mật khẩu', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('repass', 'Nhập lại mật khẩu', 'trim|required|matches[pass]');
			//Nhập liệu chính xác
			if ($this->form_validation->run() == TRUE) {
				//Thêm vào csdl
				$name = $this->input->post('name');
				$username = $this->input->post('username');
				$pass = $this->input->post('pass');
				$data = array(
					'name' => $name,
					'username' => $username,
					'password' => md5($pass)
					);
				if($this->admin_model->create($data)){
					$message = array('status' => 'nSuccess','mes' => 'Thêm Quản trị viên thành công');
					$this->session->set_flashdata('message',$message);
				}else{
					$message = array('status' => 'nWarning','mes' => 'Thêm Quản trị viên không thành công');
					$this->session->set_flashdata('message',$message);
				}
				redirect(base_url('quan-tri/quan-tri-vien'),'refresh');

			} 
		}
		$data = array();
		$data['title'] = 'Thêm mới quản trị viên';
		$data['temp'] = 'admin_add';
		$this->load->view('admin/main',$data);
	}
	//Kiểm tra user name đã tồn tại chưa
	function _check_username()
	{
		$username = $this->input->post('username');
		$where = array('username' => $username);
		if($this->admin_model->check_exists($where)){
			//trả về thông báo lôi
			$this->form_validation->set_message(__FUNCTION__,'Tài khoản đã tồn tại');
			return false;
		}
		return true;
	}
	function edit()
	{
		$id = $this->uri->segment(4);
		$id = intval($id);

		$info = $this->admin_model->get_info($id);			
		if(!$info){
			$message = array('status' => 'nFailure','mes' => 'Quản trị viện không tồn tại');
			$this->session->set_flashdata('message',$message);
			redirect(base_url('quan-tri/quan-tri-vien'));			
		}
		$data['info'] = $info;		
		if($this->input->post()){
			$this->form_validation->set_rules('name', 'Họ và tên', 'trim|required|min_length[6]|max_length[20]');
			$this->form_validation->set_rules('username', 'Tài khoản', 'trim|required|min_length[4]|max_length[12]');
			$password = $this->input->post('pass');
			if($password){
			$this->form_validation->set_rules('pass', 'Mật khẩu', 'trim|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('repass', 'Nhập lại mật khẩu', 'trim|matches[pass]');
			};
			//Nhập liệu chính xác
			if ($this->form_validation->run() == TRUE) {
				$name = $this->input->post('name');
				$username = $this->input->post('username');
				$data = array(
					'name' => $name,
					'username' => $username,					
					);
				if($password)
				{
					$data['password'] = md5($password);
				};
				if($this->admin_model->update($id,$data)){
					$message = array('status' => 'nSuccess','mes' => 'Cập nhập Quản trị viên thành công');
					$this->session->set_flashdata('message',$message);				
				}else{
					$message = array('status' => 'nWarning','mes' => 'Cập nhập Quản trị viên không thành công');
					$this->session->set_flashdata('message',$message);
					
				}
			redirect(base_url('quan-tri/quan-tri-vien'),'refresh');

			} 
		}
		$data = array();
		$data['title'] = 'Chỉnh sửa quản trị viên';
		$data['temp'] = 'admin_edit';
		$this->load->view('admin/main',$data);
	}
		function delete()
		{
			$id = $this->uri->segment(4);
			$id = intval($id);
			//Lấy thông tin quản trị viên
			$info = $this->admin_model->get_info($id);		
			if(!isset($info) && empty($info)){
				$message = array('status' => 'nFailure','mes' => 'Quản trị viện không tồn tại');
				$this->session->set_flashdata('message',$message);
				redirect(base_url('quan-tri/quan-tri-vien'));			
			}
			//thực hiện xóa
			if($id === 1){
				$message = array('status' => 'nInformation','mes' => 'Không thể xóa tài khoản SupperAdmin');
				$this->session->set_flashdata('message',$message);
				redirect(base_url('quan-tri/quan-tri-vien'));		
			}else{
				$this->admin_model->delete($id);
				$message = array('status' => 'nSuccess','mes' => 'Xóa tài khoản Quản trị viên thành công!');
				$this->session->set_flashdata('message',$message);
				redirect(base_url('quan-tri/quan-tri-vien'));		
			}
		}
	
	
}

/* End of file Admin.php */
/* Location: ./application/modules/admin/controllers/Admin.php */