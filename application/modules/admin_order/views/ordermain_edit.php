<?php $this->load->view('head'); ?>
<div class="line"></div>
<!-- Message -->
<!-- Main content wrapper -->
<div class="wrapper">	   	<!-- Form -->
		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="widget">
				    <div class="title">
						<img src="<?php echo public_url('admin'); ?>/images/icons/dark/add.png" class="titleIcon" />
						<h6>Chỉnh sửa đơn hàng</h6>
					</div>
					
				    <ul class="tabs">
		                <li><a href="#tab1">Thông tin chung</a></li>
		                <li><a href="#tab2">Sản phẩm trong đơn hàng</a></li>		                
					</ul>
					
					<div class="tab_container">
					     <div id='tab1' class="tab_content pd0">
					     	<div class="formRow">
								<label class="formLeft" for="param_id">Mã đơn hàng:<span class="req">*</span></label>
								<div class="formRight">
									<span class="oneTwo">#<?php echo $transaction->id; ?></span>									
								</div>
								<div class="clear"></div>
							</div>
					         <div class="formRow">
								<label class="formLeft" for="param_user_name">Người đặt hàng:<span class="req">*</span></label>
								<div class="formRight">
									<span class="oneTwo"><input name="user_name" id="param_user_name" _autocheck="true" type="text" value="<?php echo $transaction->user_name; ?>" /></span>
									<span name="user_name_autocheck" class="autocheck"></span>
									<div name="user_name_error" class="clear error"><?php echo form_error('user_name'); ?></div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="formRow">
								<label class="formLeft" for="param_status">Trạng thái đơn hàng:<span class="req">*</span></label>
								<div class="formRight">
									<span class="oneTwo">
										<select name="status" id="status">
											<option <?php echo ($transaction->status == 3) ? 'selected' : ''; ?> value="3">Chưa xử lý</option>
											<option <?php echo ($transaction->status == 1) ? 'selected' : ''; ?> value="1">Đang xử lý</option>
											<option <?php echo ($transaction->status == 2) ? 'selected' : ''; ?> value="2">Đã hoàn tất</option>		
										</select>
									</span>
									<span name="status_autocheck" class="autocheck"></span>
									<div name="status_error" class="clear error"><?php echo form_error('status'); ?></div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="formRow">
								<label class="formLeft" for="param_status">Cổng thanh toán:<span class="req">*</span></label>
								<div class="formRight">
									<span class="oneTwo">
										<select name="payment" id="payment">
											<option <?php echo ($transaction->payment == 'offline') ? 'selected' : ''; ?> value="offline">Thanh toán tại nhà</option>
											<option <?php echo ($transaction->payment == 'banking') ? 'selected' : ''; ?> value="banking">Thanh toán qua ngân hàng</option>
											<option <?php echo ($transaction->payment == 'baokim') ? 'selected' : ''; ?> value="baokim">Thanh toán qua bảo kim</option>		
										</select>
									</span>
									<span name="payment_autocheck" class="autocheck"></span>
									<div name="payment_error" class="clear error"><?php echo form_error('payment'); ?></div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="formRow">
								<label class="formLeft" for="param_user_phone">Số điện thoại:<span class="req">*</span></label>
								<div class="formRight">
									<span class="oneTwo"><input name="user_phone" id="param_user_phone" _autocheck="true" type="text" value="<?php echo $transaction->user_phone; ?>" /></span>
									<span name="user_phone_autocheck" class="autocheck"></span>
									<div name="user_phone_error" class="clear error"><?php echo form_error('user_phone'); ?></div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="formRow">
								<label class="formLeft" for="param_user_email">Email:<span class="req">*</span></label>
								<div class="formRight">
									<span class="oneTwo"><input name="user_email" id="param_user_email" _autocheck="true" type="text" value="<?php echo $transaction->user_email; ?>" /></span>
									<span name="user_email_autocheck" class="autocheck"></span>
									<div name="user_email_error" class="clear error"><?php echo form_error('user_email'); ?></div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="formRow">
								<label class="formLeft" for="param_user_addressl">Địa chỉ giao hàng:<span class="req">*</span></label>
								<div class="formRight">
									<span class="oneTwo"><input name="user_address" id="param_user_address" _autocheck="true" type="text" value="<?php echo $transaction->user_address; ?>" /></span>
									<span name="user_address_autocheck" class="autocheck"></span>
									<div name="user_address_error" class="clear error"><?php echo form_error('user_address'); ?></div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="formRow">
								<label class="formLeft" for="param_message">Yêu cầu thêm:</label>
								<div class="formRight">
									<span class="oneTwo"><textarea name="message" id="param_message" rows="4" cols=""><?php echo $transaction->message; ?></textarea></span>
									<span name="message_autocheck" class="autocheck"></span>
									<div name="message_error" class="clear error"><?php echo form_error('message'); ?></div>
								</div>
								<div class="clear"></div>
							</div>
										         
<div class="formRow hide"></div>
						 </div>
						 
						 <div id='tab2' class="tab_content pd0" >
						
							<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" >								
								<thead>
									<tr>
										<td>Mã sản phẩm</td>
										<td>Tên sản phẩm</td>
										<td>Giá</td>
										<td>Số lượng</td>
										<td>Tổng giá</td>
										<td>Trạng thái</td>
										<td>Hành động</td>
									</tr>
								</thead>
								<tbody  class="list_item">
								<?php foreach ($myorder as $value) { ?>								
									<tr>
										<td style="text-align: center;"><?php echo $value->id; ?></td>
										<td><?php 
										$product_name = $this->products_model->get_info_rule(array('id' => $value->product_id), 'name,price') ;			
										echo $product_name->name; ?></td>
										<td><?php echo number_format($product_name->price,'0','0','.'); ?> vnđ</td>
										<td style="text-align: center;"><?php echo $value->qty; ?></td>
										<td><?php echo number_format($value->amount,'0','0','.'); ?> vnđ</td>
										<td style="text-align: center;">
											<?php if($value->status == 0){ ?>
											<span>Chưa gửi hàng</span>
											<?php }elseif($value->status == 1){ ?>
											<span>Đã gửi hàng</span>
											<?php }elseif($value->status == 2){ ?>
											<span>Đã hoàn thành</span>
											<?php } ?>
										</td>
										<td style="text-align: center;">
											 <a href="<?php echo admin_url('don-hang/order_edit/'.$value->id); ?>" title="Chỉnh sửa trạng thái" class="tipS">
												<img src="<?php echo public_url('admin'); ?>/images/icons/color/edit.png" />
											</a>
											
											<a href="<?php echo admin_url('don-hang/order_delete/'.$value->id); ?>" title="Xóa" class="tipS verify_action" >
											    <img src="<?php echo public_url('admin'); ?>/images/icons/color/delete.png" />
											</a>

										</td>
									</tr>
								<?php } ?>
									<tr>
										<td colspan="5"></td>
										<td>Tổng giá trị : <?php echo number_format($transaction->amount,'0','0','.'); ?> vnđ</td>
										<td></td>
									</tr>
								</tbody>
							</table>

						     <div class="formRow hide"></div>
						 </div>
						 
						 
						
						
	        		</div><!-- End tab_container-->
	        		
	        		<div class="formSubmit">
	           			<input type="submit" value="Cập nhập" class="redB" />
	           		</div>
	        		<div class="clear"></div>
				</div>
			</fieldset>
		</form>
</div>
	<div class="clear mt30"></div>