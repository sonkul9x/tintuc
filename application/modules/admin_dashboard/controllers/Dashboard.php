<?php 	
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Dashboard extends MY_Controller {
	
		public function index()
		{
			$data = array();
			$data['title'] = 'Bảng điều khiển';
			$data['temp'] = 'index';
			$this->load->view('admin/main',$data);		
			
		}
	
	}
	
	/* End of file Dashboard.php */
	/* Location: ./application/modules/admin_dashboard/controllers/Dashboard.php */