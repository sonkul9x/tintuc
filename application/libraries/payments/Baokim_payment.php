<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class BaoKim_payment 
{
	var $CI = '';
	var $data= array();


	//THÔNG SỐ CÀI ĐẶT PAYMENT

	var $code = 'baokim';
	var $setting = array(
						'business'        =>  'tson171192@gmail.com' , //TÀI KHOẢN NGƯỜI NHẬN TIỀN
						'merchant_id'     =>  '28782', //ID WEBSITE ĐANG KÝ BÊN BẢO KIM
						'secure_pass'     => 'e1a301439afe98b6', //MẬT KHẨU GIAO TIẾP
						'cost_constant'   => 1700,
						'cost_percent'    => 1
						);	

	// URL checkout của baokim.vn
	var $url = 'https://www.baokim.vn/payment/customize_payment/order';

	var $ip = array();
	public function __construct()
	{
		$this->CI =& get_instance();
	}




	public function payment($tran_id, $amount, $return_url)
	{
	
		$tran_info = 'Thanh toán cho đơn hàng '.$tran_id;
		$url = array();
		$url['success'] = $return_url;
		$url['cancel'] = $return_url;
		$url['detail'] = $return_url;

		$url = $this->_bk_create_url($tran_id, $this->setting['business'], $amount, '', '', $tran_info,$url['success'],$url['cancel'],$url['detail'] );
		redirect($url); 
		
	}

	/* Xử lý kết quả trả về từ payment */

	public function result($tran_id, $amount)
	{
		//Lưu dữ liệu trả về, lưu vào cột payment info trong bảng transaction	
		$result = $this->CI->input->post();
		$this->CI->load->model('order/transaction_model');
		$data = array();
		$data['payment_info'] = serialize($result);
		$this->CI->transaction_model->update($tran_id, $data);

		// Nếu là link user chuyển về sau khi bảo kim thanh toán thành công xong
		if(!$this->CI->input->post('order_id')){
			return NULL;
		}
		//Kiểm tra IP
		if($this->ip != $this->CI->input->ip_address()){
			return FALSE;
		}
		//Kiểm tra mã số giao dịch
		if($tran_id != $this->CI->input->post('order_id')){
			return FALSE;
		}
		//Kiểm tra amount
		$amount_pay = floatval($this->CI->input->post('total_amount'));
		$amount =floatval($amount);
		if($amount_pay < $amount){
			return FALSE;
		}
		//Kiểm tra trạng thái giao dịch
		if($this->CI->input->post('transaction_status') != 4){
			return NULL;
		}
		return TRUE;

	}
	public function checkout_result_get_tran_id(&$security = '')
	{
		$tran_id = $this->CI->input->post('order_id');
		return $tran_id;
	}

	/**
	 * Hàm xây dựng url chuyển đến BaoKim.vn thực hiện thanh toán, trong đó có tham số mã hóa (còn gọi là public key)
	 * @param $order_id				Mã đơn hàng
	 * @param $business 			Email tài khoản người bán
	 * @param $total_amount			Giá trị đơn hàng
	 * @param $shipping_fee			Phí vận chuyển
	 * @param $tax_fee				Thuế
	 * @param $order_description	Mô tả đơn hàng
	 * @param $url_success			Url trả về khi thanh toán thành công
	 * @param $url_cancel			Url trả về khi hủy thanh toán
	 * @param $url_detail			Url chi tiết đơn hàng
	 * @return url cần tạo
	 */

	public function _bk_create_url($order_id, $business, $total_amount, $shipping_fee, $tax_fee, $order_description, $url_success, $url_cancel, $url_detail)
	{
		// Mảng các tham số chuyển tới baokim.vn
		$params = array(
			'merchant_id'		=>	strval($this->setting['merchant_id']),
			'order_id'			=>	strval($order_id),
			'business'			=>	strval($business),
			'total_amount'		=>	strval($total_amount),
			'shipping_fee'		=>  strval($shipping_fee),
			'tax_fee'			=>  strval($tax_fee),
			'order_description'	=>	strval($order_description),
			'url_success'		=>	strtolower(urlencode($url_success)),
			'url_cancel'		=>	strtolower(urlencode($url_cancel)),
			'url_detail'		=>	strtolower(urlencode($url_detail))
		);
		ksort($params);
		
		$str_combined = $this->setting['secure_pass'].implode('', $params);
		$params['checksum'] = strtoupper(md5($str_combined));
		
		//Kiểm tra  biến $redirect_url xem có '?' không, nếu không có thì bổ sung vào
		$redirect_url = $this->url;
		if (strpos($redirect_url, '?') === false)
		{
			$redirect_url .= '?';
		}
		else if (substr($redirect_url, strlen($redirect_url)-1, 1) != '?' && strpos($redirect_url, '&') === false)
		{
			// Nếu biến $redirect_url có '?' nhưng không kết thúc bằng '?' và có chứa dấu '&' thì bổ sung vào cuối
			$redirect_url .= '&';			
		}
				
		// Tạo đoạn url chứa tham số
		$url_params = '';
		foreach ($params as $key=>$value)
		{
			if ($url_params == '')
				$url_params .= $key . '=' . urlencode($value);
			else
				$url_params .= '&' . $key . '=' . urlencode($value);
		}
		return $redirect_url.$url_params;
	}
		public function _bk_check_result($data = array())
	{
		$checksum = $data['checksum'];
		unset($data['checksum']);
		
		ksort($data);
		$str_combined = $this->setting['secure_pass'].implode('', $data);

        // Mã hóa các tham số
		$verify_checksum = strtoupper(md5($str_combined));
		
		// Xác thực mã của chủ web với mã trả về từ baokim.vn
		if ($verify_checksum === $checksum) 
			return true;
		
		return false;
	}

}