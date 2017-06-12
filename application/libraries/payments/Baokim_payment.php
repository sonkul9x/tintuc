<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class BaoKim_payment 
{
	var $CI = '';
	var $data= array();


	//THÔNG SỐ CÀI ĐẶT PAYMENT

	var $code = 'baokim';
	$var $setting = array(
						'business'        =>  'tson171192@gmail.com' , //TÀI KHOẢN NGƯỜI NHẬN TIỀN
						'merchant_id'     =>  '28782', //ID WEBSITE ĐANG KÝ BÊN BẢO KIM
						'secure_pass'     => 'e1a301439afe98b6', //MẬT KHẨU GIAO TIẾP
						'cost_constant'   => 1700,
						'cost_percent'    => 1
						);	

	// URL checkout của baokim.vn
	var $baokim_url = 'https://www.baokim.vn/payment/customize_payment/order';
	var $ip = array();
	public function __construct()
	{
		$this->CI =& get_instance();
	}


}