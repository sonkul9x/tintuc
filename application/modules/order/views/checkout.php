
<div class="box-center"><!-- The box-center product-->
   <div class="tittle-box-center">
      <h2>Thông tin thanh toán</h2>
    </div>
   <div class="box-content-center" style="padding: 0;"><!-- The box-content-center -->
   			
   				<table style="width: 100%;text-align: center;">
   			<thead style="color:#fff; background: #4c66a4;font-weight: 600;">
   					<th style="border: 1px solid #ccc; padding: 5px;">STT</th>
   						<th style="border: 1px solid #ccc; padding: 5px;">Tên sản phẩm</th>
   						<th style="border: 1px solid #ccc; padding: 5px;">Số lượng</th>
   			
   				</thead>
   				<tbody>
   				<?php $i=0; foreach ($carts as $row) { $i++; ?>   			
   					<tr style="border: 1px solid #ccc; padding: 5px;">
   						<td  style="border: 1px solid #ccc; padding: 5px;"><?php echo $i; ?></td>
   						<td  style="border: 1px solid #ccc; padding: 5px;"><?php echo $row['name']; ?></td>
   						<td  style="border: 1px solid #ccc; padding: 5px;"><?php echo $row['qty']; ?></td>
   					</tr>
   					 <?php } ?>
   					 <tr  style="border: 1px solid #ccc; padding: 5px;">
   					 	<td  style="border: 1px solid #ccc; padding: 5px;">Tổng tiền</td>
   					 	<td colspan="2"  style="border: 1px solid #ccc; padding: 5px;"><?php echo number_format($total_amount,'0','0','.'); ?> VNĐ</td>
   					 </tr>
   				</tbody>
   			
   				
   			</table>
	       
            <h1>Thông tin thanh toán</h1>            
            <form enctype="multipart/form-data" action="<?php echo base_url('order/checkout'); ?>" method="post" class="t-form form_action">
                   <div class="form-row">
            <label class="form-label" for="param_email">Email:<span class="req">*</span></label>
            <div class="form-item">
              <input type="text" value="<?php echo isset($user->email) ? $user->email : ''; ?>" name="email" id="email" class="input">
              <div class="clear"></div>
              <div id="email_error" class="error"><?php echo form_error('email'); ?></div>
            </div>
            <div class="clear"></div>
          </div>
                  
          <div class="form-row">
            <label class="form-label" for="param_name">Họ và tên:<span class="req">*</span></label>
            <div class="form-item">
              <input type="text" value="<?php echo isset($user->name) ? $user->name : ''; ?>" name="name" id="name" class="input">
              <div class="clear"></div>
              <div id="name_error" class="error"><?php echo form_error('name'); ?></div>
            </div>

            <div class="clear"></div>
          </div>
          <div class="form-row">
            <label class="form-label" for="param_phone">Số điện thoại:<span class="req">*</span></label>
            <div class="form-item">
              <input type="text" value="<?php echo isset($user->phone) ? $user->phone : ''; ?>" name="phone" id="phone" class="input">
              <div class="clear"></div>
              <div id="phone_error" class="error"><?php echo form_error('phone'); ?></div>
            </div>
            <div class="clear"></div>
          </div>
          
          <div class="form-row">
            <label class="form-label" for="param_address">Địa chỉ nhận hàng:<span class="req">*</span></label>
            <div class="form-item">
              <textarea name="address" id="address" class="input"><?php echo isset($user->address) ? $user->address : ''; ?></textarea>
              <div class="clear"></div>
              <div id="address_error" class="error"><?php echo form_error('address'); ?></div>
            </div>
            <div class="clear"></div>
          </div>          
          <div class="form-row">
            <label class="form-label" for="param_message">Yêu cầu thêm:<span class="req">*</span></label>
            <div class="form-item">
              <textarea name="message" id="message" class="input"><?php echo set_value('message'); ?></textarea>
              <p>Ghi chú thêm về đơn hàng!</p>
              <div class="clear"></div>
              <div id="messages_error" class="error"><?php echo form_error('message'); ?></div>
            </div>
            <div class="clear"></div>
          </div> 
          <div class="form-row">
            <label class="form-label" for="param_payment">Thanh toán qua:<span class="req">*</span></label>
            <div class="form-item">
               	<select name="payment" id="payment">
               		<option value="offline">Thanh toán khi nhận hàng</option>
               		<option value="banking">Thanh toán qua Ngân hàng</option>               		
              <!--  	<option value="nganluong">Thanh toán qua Ngân Lượng</option> -->
               		<option value="baokim">Thanh toán qua Bảo Kim</option>
               	</select>
              <div class="clear"></div>
              <div id="payment_error" class="error"><?php echo form_error('payment'); ?></div>
            </div>
            <div class="clear"></div>
          </div> 
          <div class="form-row">
            <label class="form-label">&nbsp;</label>
            <div class="form-item">
                    <input type="submit" name="submit" value="Đặt hàng" class="button">
            </div>
           </div>
            </form>
         </div><!-- End box-content-center register-->
</div>  <!-- End box-center product-->   
