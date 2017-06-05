<?php 	
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Dashboard extends MY_Controller {
	
		public function index()
		{
			$this->data['temp'] = 'index';
			$this->load->view('admin/main',$this->data);		
			
		}
	
	}
	
	/* End of file Dashboard.php */
	/* Location: ./application/modules/admin_dashboard/controllers/Dashboard.php */