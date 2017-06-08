<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalog extends MY_Controller {

	function __construct()
	{
		$data = array();
		parent::__construct();
		$this->load->model('catalog_model');
	}
	public function index()
		{
			$list = $this->catalog_model->get_list();
			$data['title'] = 'Danh mục sản phẩm';
			$data['list'] = $list;
			$data['message'] = $this->session->flashdata('message');
			$data['temp'] = 'catalog_list';
			$this->load->view('admin/main',$data);		
			
		}
	public function add()
	{

		if($this->input->post()){
			$this->form_validation->set_rules('name', 'Tên danh mục', 'trim|required|min_length[2]|max_length[20]');
			$this->form_validation->set_rules('parent_id', 'Danh mục cha', 'trim|is_natural');
			$this->form_validation->set_rules('sort_order', 'Vị trí', 'trim|required|is_natural');
			//Nhập liệu chính xác
			if ($this->form_validation->run() == TRUE) {
				//Thêm vào csdl
				$name = $this->input->post('name');
				$parent_id = $this->input->post('parent_id');
				$sort_order = $this->input->post('sort_order');
				
				$data = array(
					'name' => $name,
					'parent_id' => $parent_id,
					'sort_order' => $sort_order
					);		
				if($this->catalog_model->create($data)){
					$message = array('status' => 'nSuccess','mes' => 'Thêm danh mục sản phẩm thành công');
					$this->session->set_flashdata('message',$message);
				}else{
					$message = array('status' => 'nWarning','mes' => 'Thêm danh mục sản phẩm không thành công');
					$this->session->set_flashdata('message',$message);
				}
				redirect(base_url('quan-tri/danh-muc-san-pham'),'refresh');

			} 
		}

		// Lấy danh sách danh mục cha
		$list = $this->catalog_model->get_list();
		$data['title'] = 'Thêm mới danh mục sản phẩm';
		$data['list'] = $list;
		$data['temp'] = 'catalog_add';
		$this->load->view('admin/main',$data);
	}
	function edit()
	{
		$id = $this->uri->segment(4);
		$id = intval($id);
		$cata = $this->catalog_model->get_info($id);			
		if(!$cata){
			$message = array('status' => 'nFailure','mes' => 'Danh mục sản phẩm không tồn tại');
			$this->session->set_flashdata('message',$message);
			redirect(admin_url('danh-muc-san-pham'));			
		}
		$data['cata'] = $cata;		
		if($this->input->post()){
			$this->form_validation->set_rules('name', 'Tên danh mục', 'trim|required|min_length[2]|max_length[20]');
			$this->form_validation->set_rules('parent_id', 'Danh mục cha', 'trim|is_natural');
			$this->form_validation->set_rules('sort_order', 'Vị trí', 'trim|required|is_natural');			
			//Nhập liệu chính xác
			if ($this->form_validation->run() == TRUE) {
				$name = $this->input->post('name');
				$parent_id = $this->input->post('parent_id');
				$sort_order = $this->input->post('sort_order');				
				$data = array(
					'name' => $name,
					'parent_id' => $parent_id,
					'sort_order' => $sort_order
					);	

				if($this->catalog_model->update($id,$data)){
					$message = array('status' => 'nSuccess','mes' => 'Cập nhập danh mục sản phẩm thành công');
					$this->session->set_flashdata('message',$message);				
				}else{
					$message = array('status' => 'nWarning','mes' => 'Cập nhập danh mục sản phẩm không thành công');
					$this->session->set_flashdata('message',$message);
					
				}
			redirect(admin_url('danh-muc-san-pham'),'refresh');

			} 
		}

		$list = $this->catalog_model->get_list();
		$data['list'] = $list;
		$data['temp'] = 'catalog_edit';
		$this->load->view('admin/main',$data);
	}

		function delete()
		{
			$id = $this->uri->segment(4);
			$id = intval($id);
			
			$info = $this->catalog_model->get_info($id);	
			if(!isset($info) && empty($info)){
				$message = array('status' => 'nFailure','mes' => 'Danh mục sản phẩm không tồn tại');
				$this->session->set_flashdata('message',$message);
				redirect(admin_url('danh-muc-san-pham'));			
			}			
			//thực hiện xóa
			$where = array('parent_id' => $info->id);
			if($this->catalog_model->check_exists($where) == TRUE){								
				$message = array('status' => 'nWarning','mes' => 'Danh mục sản phẩm còn danh mục con, không thể xóa');
				$this->session->set_flashdata('message',$message);
				redirect(admin_url('danh-muc-san-pham'));	

			}else{
				//kiểm tra danh mục còn sản phẩm hay không
				$this->load->model('products_model');
				$product = $this->products_model->get_info_rule(array('catalog_id'=> $id), 'id');
				if($product)
				{					
					$message = array('status' => 'nWarning','mes' => 'Danh mục sản phẩm còn chứa sản phẩm, không thể xóa!');
					$this->session->set_flashdata('message',$message);
					redirect(admin_url('danh-muc-san-pham'));	
				}
			}
			//xóa danh mục		

			$this->catalog_model->delete($id);
			$message = array('status' => 'nSuccess','mes' => 'Xóa danh mục sản phẩm thành công!');
			$this->session->set_flashdata('message',$message);
			redirect(admin_url('danh-muc-san-pham'));		
			
		}

		function deleteall()
		{			
			
			$ids = $this->input->post('ids');	

				 foreach ($ids as $id) {
				 	$this->_del($id,false);
				 }	
		}
		private function _del($id,$redirect = true)
		{
			//Lấy thông tin quản trị viên
			$info = $this->catalog_model->get_info($id);	
			if(!isset($info) && empty($info)){
				$message = array('status' => 'nFailure','mes' => 'Danh mục sản phẩm không tồn tại');
				$this->session->set_flashdata('message',$message);
				if($redirect){
				redirect(admin_url('danh-muc-san-pham'));		
				}else{
					return false;
				}	
			}			
			//thực hiện xóa			
			//kiểm tra danh mục còn sản phẩm hay không
			$this->load->model('products_model');
			$product = $this->products_model->get_info_rule(array('catalog_id'=> $id), 'id');
			if($product)
			{
				$message = array('status' => 'nWarning','mes' => 'Danh mục sản phẩm còn chứa sản phẩm, không thể xóa!');
				$this->session->set_flashdata('message',$message);
				if($redirect){
				redirect(admin_url('danh-muc-san-pham'));		
				}else{
					return false;
				}	
			}
		
		}

}

/* End of file Catalog.php */
/* Location: ./application/modules/products/controllers/Catalog.php */