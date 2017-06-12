<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('products_model');
		$this->load->model('catalog_model');
	}
	public function index()
	{
		// HIỂN THỊ DANH SÁCH SẢN PHẨM GIỎ HÀNG
		$cart = $this->cart->contents();
		
		//TỔNG SỐ SẢN PHẨM TRONG GIỎ HÀNG
		
		$this->data['carts'] = $cart;

		$data['title'] = 'Giỏ Hàng';
		$data['meta_desc'] ='';
		$data['meta_key'] = '';
		$data['temp'] = 'index';
		$this->load->view('site/layout',$data);		

	}

	public function add($id)
	{
		if(empty($id)){redirect(base_url(),'refresh');};
		$product = $this->products_model->get_info($id);
		if(!$product){
			redirect(base_url(),'refresh');
		}
		//Tổng số sản phẩm
		$qty = 1;
		$price = $product->price;
		if($product->discount > 0){
			$price =  $product->price -(($product->price / 100) * $product->discount); 
		}
		//Thông tin thêm giỏ hàng
		$data = array();
		$data['id'] = $product->id;
		$data['qty'] = $qty;
		$data['name'] = url_title($product->name);
		$data['image_link'] = $product->image_link;
		$data['price'] = $price;
		$this->cart->insert($data);

		redirect(base_url('cart'),'refresh');
	}
	public function update()
	{
		$carts = $this->cart->contents();
		foreach ($carts as $key => $row) {
			$total_qty = $this->input->post('qty_'.$row['id']);
			$data = array();
			$data['rowid'] = $key;
			$data['qty'] = $total_qty;
			$this->cart->update($data);
		}
		redirect(base_url('cart'),'refresh');
	}
	public function delete($id='')
	{
		if(isset($id) && !empty($id)){
			$id = intval($id);
			$carts = $this->cart->contents();
			foreach ($carts as $key => $row) {
				if($row['id'] == $id){
					$data = array();
					$data['rowid'] = $key;
					$data['qty'] = 0;
					$this->cart->update($data);
				}
			}
		}else{
			$this->cart->destroy();
		}
	redirect(base_url('cart'),'refresh');
	}
}

/* End of file cart.php */
/* Location: ./application/modules/cart/conrollers/cart.php */