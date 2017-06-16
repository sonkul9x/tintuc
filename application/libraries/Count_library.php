<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Count_library
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
       
	}
	public function count_trans3()
	{
		 $this->ci->load->model('admin_order/transaction_model');
		 $input['where'] = array('status' => 3);		 
		 $count = count($this->ci->transaction_model->get_list($input));
		 return $count;
	}
	

}

/* End of file Count_library.php */
/* Location: ./application/libraries/Count_library.php */
 ?>