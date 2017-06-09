<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	function index()
	{		
		$this->load->model('login_model');
		if($this->input->post()){
			//$this->form_validation->set_rules('username', 'Họ và tên', 'trim|required');
			//$this->form_validation->set_rules('password', 'Tài khoản', 'trim|required');
			$this->form_validation->set_rules('login', 'login', 'callback__check_login');



			if ($this->form_validation->run() == TRUE) {
				$id = $this->login_model->get_info_rule(array('username'=> $this->input->post('username')),'id');
				$name = $this->login_model->get_info_rule(array('username'=> $this->input->post('username')),'name');
				$admin_group_id = $this->login_model->get_info_rule(array('username'=> $this->input->post('username')),'admin_group_id');
				$login = array(
					'id'        => $id->id,
				    'username'  => $this->input->post('username'),
				    'name'      => $name->name,
				    'admin_group_id' => $admin_group_id->admin_group_id

				);

				$this->session->set_userdata('login',$login);
				redirect(base_url('quan-tri'),'refresh');
			} 
		}
		$data = array();
		$data['title'] = 'Đăng nhập';
		$this->load->view('index',$data);
	}
	function _check_login()
	{
		$this->load->model('login_model');
		$username = $this->input->post('username');
		$password = $this->input->post('pass');
		$password = md5($password);
		$where = array('username' => $username, 'password' => $password);
		if($this->login_model->check_exists($where)){
			return TRUE;
		}
		$this->form_validation->set_message(__FUNCTION__,'Bạn không đăng nhập thành công!');
		return FALSE;
	}
	function logout()
	{
		if ($this->session->userdata('login')) {
			
			$this->session->unset_userdata('login');
		}
		 redirect(admin_url('dang-nhap'),'refresh');
	}

}

/* End of file Login.php */
/* Location: ./application/modules/admin_login/controllers/Login.php */