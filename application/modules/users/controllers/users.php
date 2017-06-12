<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
	}
	public function index()
	{
		if(!$this->session->userdata('user_login')){
			redirect(base_url('users/login'),'refresh');
		}
		$user_id = $this->session->userdata('user_login');
		$user = $this->users_model->get_info($user_id['id']);
		if(!$user){
			redirect(base_url(),'refresh');
		}
		
		$data['user'] = $user;
		$data['title'] = 'Thông tin cá nhân';
		$data['meta_desc'] ='';
		$data['meta_key'] = '';
		$data['temp'] = 'index';
		$this->load->view('site/layout',$data);		
	}
	/*
		Đăng ký thành viên
	*/
	public function regiter($value='')
	{
		if($this->session->userdata('user_login')){
			redirect(base_url('users/index'),'refresh');
		}
		if($this->input->post()){
			$this->form_validation->set_rules('name', 'Họ và tên', 'trim|required|min_length[6]|max_length[20]');
			$this->form_validation->set_rules('email', 'Email đăng nhập', 'trim|required|min_length[4]|max_length[50]|callback__check_email');
			$this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'trim|required|matches[password]');
			$this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required');
			$this->form_validation->set_rules('address', 'Địa chỉ', 'trim');
			//Nhập liệu chính xác
			if ($this->form_validation->run() == TRUE) {
				//Thêm vào csdl
				$name = $this->input->post('name');
				$email = $this->input->post('email');
				$pass = $this->input->post('password');
				$data = array(
					'name' => $name,
					'email' => $email,
					'password' => md5($pass),
					'phone'    => $this->input->post('phone'),
					'address'    => $this->input->post('address'),
					'created' => strtotime("now")
					);
				if($this->users_model->create($data)){
					$message = array('status' => 'nSuccess','mes' => 'Đăng ký thành công!');
					$this->session->set_flashdata('message',$message);
				}else{
					$message = array('status' => 'nWarning','mes' => 'Đăng ký không thành công!');
					$this->session->set_flashdata('message',$message);
				}
				redirect(base_url(''),'refresh');

			} 
		}
		$data['title'] = 'Đăng ký thành viên';
		$data['meta_desc'] ='';
		$data['meta_key'] = '';
		$data['temp'] = 'regiter';
		$this->load->view('site/layout',$data);		
	}

	/*
		SỬA THÔNG TIN THÀNH VIÊN
	*/
	public function edit()
	{
		if(!$this->session->userdata('user_login')){
			redirect(base_url('users/login'),'refresh');
		}
		$user_id = $this->session->userdata('user_login');
		$user = $this->users_model->get_info($user_id['id']);
		if(!$user){
			redirect(base_url(),'refresh');
		}

		if($this->input->post()){
			$this->form_validation->set_rules('name', 'Họ và tên', 'trim|required|min_length[6]|max_length[20]');			
			$this->form_validation->set_rules('password', 'Mật khẩu', 'trim');
			$this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'trim|matches[password]');
			$this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required');
			$this->form_validation->set_rules('address', 'Địa chỉ', 'trim');
			//Nhập liệu chính xác
			if ($this->form_validation->run() == TRUE) {
				//Thêm vào csdl
				$name = $this->input->post('name');
				$pass = $this->input->post('password');
				$data = array(
					'name' => $name,
					'email' => $user->email,
					'phone'    => $this->input->post('phone'),
					'address'    => $this->input->post('address'),
					'updated' => strtotime("now")
					);
				if($pass) {
					$data['password'] = md5($pass);
				}
				if($this->users_model->update($user_id['id'],$data)){
					$message = array('status' => 'nSuccess','mes' => 'Cập nhập thông tin cá nhân thành công!');
					$this->session->set_flashdata('message',$message);
				}else{
					$message = array('status' => 'nWarning','mes' => 'Cập nhập thông tin cá nhân không thành công!');
					$this->session->set_flashdata('message',$message);
				}
				redirect(base_url('users/index'),'refresh');

			} 
		}

		
		$data['user'] = $user;
		$data['title'] = 'Chỉnh sửa thông tin cá nhân';
		$data['meta_desc'] ='';
		$data['meta_key'] = '';
		$data['temp'] = 'edit';
		$this->load->view('site/layout',$data);	
	}


	//Kiểm tra user name đã tồn tại chưa
	function _check_email()
	{
		$email = $this->input->post('email');
		$where = array('email' => $email);
		if($this->users_model->check_exists($where)){
			//trả về thông báo lôi
			$this->form_validation->set_message(__FUNCTION__,'email đã tồn tại');
			return false;
		}
		return true;
	}

	public function login()
	{
		if($this->session->userdata('user_login')){
			redirect(base_url('users/index'),'refresh');
		}
		if($this->input->post()){
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required');
			$this->form_validation->set_rules('login', 'login', 'callback__check_login');



			if ($this->form_validation->run() == TRUE) {
				$id = $this->users_model->get_info_rule(array('email'=> $this->input->post('email')),'id');
				$name = $this->users_model->get_info_rule(array('email'=> $this->input->post('email')),'name');				
				$login = array(
					'id'        => $id->id,				   
				    'name'      => $name->name,
				);

				$this->session->set_userdata('user_login',$login);
				$message = array('status' => 'nSuccess','mes' => 'Đăng nhập thành công!');
				$this->session->set_flashdata('message',$message);
				redirect(base_url(''),'refresh');
			} 
		}
		$data['title'] = 'Đăng nhập';
		$data['meta_desc'] ='';
		$data['meta_key'] = '';
		$data['temp'] = 'login';
		$this->load->view('site/layout',$data);	
	}
	function _check_login()
	{
		$username = $this->input->post('email');
		$password = $this->input->post('password');
		$password = md5($password);
		$where = array('email' => $username, 'password' => $password);
		if($this->users_model->check_exists($where)){
			return TRUE;
		}
		$this->form_validation->set_message(__FUNCTION__,'Bạn không đăng nhập thành công!');
		return FALSE;
	}
	function logout()
	{
		if ($this->session->userdata('user_login')) {
			
			$this->session->unset_userdata('user_login');
		}
		 redirect(base_url(''),'refresh');
	}
}

/* End of file Login.php */
/* Location: ./application/modules/admin_login/controllers/Login.php */