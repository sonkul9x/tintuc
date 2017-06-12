<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('order_model');
		$this->load->model('transaction_model');
	}
	public function index()
	{
		
	}
	public function checkout()
	{
		$cart = $this->cart->contents();
		if(count($cart) <= 0){
			redirect(base_url(),'refresh');
		}
		$this->data['carts'] = $cart;

		$userid = 0;
		//NẾU ĐÃ ĐĂNG NHẬP THÌ LẤY LUÔN THÔNG TIN THÀNH VIÊN
		if($this->session->userdata('user_login')){
			$user_id = $this->session->userdata('user_login');
			$userid = $user_id['id'];
			$user = $this->users_model->get_info($user_id['id']);
			if($user){
				$data['user'] = $user;
			}
		}
		$totalitems = 0;
		foreach ($cart as $row) {
			$totalitems = $totalitems + $row['subtotal'];
		}
		$this->data['totalitems'] = $totalitems;

		if($this->input->post()){
			$this->form_validation->set_rules('name', 'Họ và tên', 'trim|required|min_length[2]|max_length[20]');
			$this->form_validation->set_rules('email', 'Email thanh toán', 'trim|required|valid_email');
			$this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('address', 'Địa chỉ nhận hàng', 'trim|required');
			$this->form_validation->set_rules('payment', 'Cổng thanh toán', 'trim|required');
			$this->form_validation->set_rules('message', 'Yêu cầu thêm', 'trim');
			//Nhập liệu chính xác
			if ($this->form_validation->run() == TRUE) {
				//Thêm vào csdl
				$name = $this->input->post('name');
				$email = $this->input->post('email');
				$phone = $this->input->post('phone');				
				$address = $this->input->post('address');
				$message = $this->input->post('message');
				$payment = $this->input->post('payment');
				$data = array(
					'status' => 0,
					'user_id' => $userid, //ID TV mua hàng nếu đã đăng nhập  = 0 nếu chưa đăng nhập
					'user_name' => $name,
					'user_email' => $email,   
					'user_phone'    => $phone,
					'user_address'    => $address,
					'message' => $message,
					'amount'  => $totalitems,//TỔNG SỐ TIỀN CẦN THANH TOÁN
					'payment' => $payment,          //CỔNG THANH TOÁN
					'created' => strtotime("now")
					);
				$transaction = $this->transaction_model->create($data);
				if($transaction){
					$transaction_id = $this->db->insert_id();
					foreach ($cart as $row) {
						$data2 = array(
							'transaction_id' => $transaction_id,
							'product_id'  => $row['id'],
							'qty'         => $row['qty'],
							'amount'      => $row['subtotal'],
							'status'      => 0
							);
						$this->order_model->create($data2);					
					}
				 $this->cart->destroy();
				 if($payment == 'offline' || $payment =='banking'){
				 	$message = array('status' => 'nSuccess','mes' => 'Đặt hàng thành công!');
					 $this->session->set_flashdata('message',$message);
					 redirect(base_url(''),'refresh');
					}elseif($payment == 'nganluong' || $payment =='baokim'){

					}
				}else{
					$message = array('status' => 'nWarning','mes' => 'Đặt hàng không thành công, vui lòng liên hệ số hotline để biết thêm thông tin!');
					$this->session->set_flashdata('message',$message);
					redirect(base_url(''),'refresh');
				}
				

			} 
		}


		
		$data['title'] = 'Thanh toán';
		$data['meta_desc'] ='';
		$data['meta_key'] = '';
		$data['temp'] = 'checkout';
		$this->load->view('site/layout',$data);		
	}
}

/* End of file order.php */
/* Location: ./application/modules/order/controllers/order.php */ ?>