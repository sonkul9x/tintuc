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
			$this->form_validation->set_rules('username', 'Tài khoản', 'trim|required|min_length[6]|max_length[12]|callback__check_username');
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
					echo "Thêm Thành Công!";
				}else{
					ECHO "Không thêm thành công";
				}

			} else {
				# code...
			}
		}
		$data['temp'] = 'admin_add';
		$this->load->view('admin/main',$data);
	}
	function _check_username()
	{
		# code...
	}
	
}

/* End of file Admin.php */
/* Location: ./application/modules/admin/controllers/Admin.php */