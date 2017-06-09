<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_library
{
	protected $CI;

	public function __construct()
	{
        $this->CI =& get_instance();
	}

	public function upload($upload_path= '', $file_name ='')
	{
		$config = $this->config($upload_path);
		$this->CI->load->library('upload', $config);
		if ($this->CI->upload->do_upload($file_name)) {
			$data = $this->CI->upload->data();								
		}else{
			//Không upload thành công
			$data = $this->CI->upload->display_errors();					
		}	
		return $data;
	}
	//upload nhiều file(filename)	
	public function upload_file($upload_path= '', $file_name ='')
	{
		$config = $this->config($upload_path);
		//lấy biến môi trường thực hiện upload
		$file = $_FILES[$file_name];
		$count = count($file['name']);
		$images_list = array();//Lưu các file ảnh upload thành công
		for ($i=0; $i <= $count - 1 ; $i++) { 			  
			  $_FILES['userfile']['name']     = $file['name'][$i];
		      $_FILES['userfile']['type']     = $file['type'][$i];
		      $_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i];
		      $_FILES['userfile']['error']    = $file['error'][$i];
		      $_FILES['userfile']['size']     = $file['size'][$i];
		      //Load thư viện cấu hình file
		      $this->CI->load->library('upload',$config);
		      //thực hiện upload từng file(filename)
		      if($this->CI->upload->do_upload()){
		      	$data = $this->CI->upload->data();
		       	$images_list[] = $data['file_name'];
		      }
		}
		return $images_list;
	}


	public function config($upload_path = '')
	{
		//Khai báo biến cấu hình
		$config = array();
		//Thư mục chứa file
		$config['upload_path'] = $upload_path;
		//Định dạng  file đc phép tải
		$config['allowed_types'] = 'jpg|png|gif';
		//Dung lượng tối đa
		$config['max_size'] = '1200';
		//Chiều rộng tối đa
		$config['max_width'] = '1020';
		//Chiều cao tối đa
		$config['max_height'] = '1028';

		return $config;
	}

}

/* End of file Upload_library.php */
/* Location: ./application/libraries/Upload_library.php */
