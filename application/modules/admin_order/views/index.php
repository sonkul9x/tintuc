\<?php $this->load->view('head'); ?>
<div class="line"></div>
<!-- Message -->

<!-- Main content wrapper -->
<div class="wrapper" id="main_new">
	 <?php  $this->load->view('admin/message') ?>	 
	<div class="widget">	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>
				Danh sách đơn hàng			</h6>
		 	<div class="num f12">Số lượng: <b><?php echo count($list); ?></b></div>
		</div>		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
		
			<thead class="filter"><tr><td colspan="8">
				<form class="list_filter form" action="<?php echo admin_url('don-hang'); ?>" method="get">
					<table cellpadding="0" cellspacing="0" width="80%"><tbody>
					
						<tr>
							<td class="label" style="width:40px;"><label for="filter_id">Mã số</label></td>
							<td class="item"><input name="id" value="<?php echo $this->input->get('id'); ?>" id="filter_id" type="text" style="width:55px;" /></td>
							
							<td class="label" style="width:100px;"><label for="filter_id">Trạng thái đơn hàng</label></td>
							<td class="item" style="width:155px;" >
							<select name="status" id="status">
							    <option value="">Chọn trạng thái</option>
								<option <?php echo ($this->input->get('status') === 3) ? 'selected' : ''; ?> value="3">Chưa xử lý</option>
								<option <?php echo ($this->input->get('status') === 1) ? 'selected' : ''; ?> value="1">Đang xử lý</option>
								<option <?php echo ($this->input->get('status') === 2) ? 'selected' : ''; ?> value="2">Đã hoàn tất</option>							
							</select>
						</td>
							
							
							
							<td style='width:150px'>
							<input type="submit" class="button blueB" value="Lọc" />
							<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('don-hang'); ?>'; ">
							</td>
							
						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin'); ?>/images/icons/tableArrows.png" /></td>
					<td style="width:100px;">Mã đơn hàng</td>
					<td>Người đặt hàng</td>		
					<td>Số điện thoại</td>		
					<td style="width:150px;">Giá trị đơn hàng</td>	
					<td style="width:150px;">Ngày đặt</td>
					<td style="width:50px;">Trạng thái</td>
					<td style="width:120px;">Hành động</td>
				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="6">
					     <div class="list_action itemActions">
								<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('tin-tuc/deleteall'); ?>">
									<span style='color:white;'>Xóa hết</span>
								</a>
						 </div>
					
			                  <div class='pagination' style="margin:8px auto auto;">
					     <?php echo $this->pagination->create_links(); ?>
			               			            </div>
					</td>
				</tr>
			</tfoot>
			
			<tbody class="list_item">			
			<?php if (isset($list) && !empty($list)) :
		
			foreach ($list as $row) :  ?>
					       <tr class='row_<?php echo $row->id; ?>'>
					<td><input type="checkbox" name="id[]" value="<?php echo $row->id; ?>" /></td>
					
					<td class="textC">#<?php echo $row->id; ?></td>
					
					<td>
						<b><?php echo $row->user_name; ?></b>						
					</td>	
					<td>
						<b><?php echo $row->user_phone; ?></b>						
					</td>
					<td>
						<span style="color: #f00;"><?php echo number_format($row->amount,'0','0','.'); ?> </span>vnđ				
					</td>
										
					<td class="textC"><?php echo date("h:i:s d-m-Y",$row->created); ?></td>
					<td style="text-align: center;">
						<?php echo order_status($row->status);?>
					</td>
					<td class="option textC">
						<!-- <a href="" title="Gán là nhạc tiêu biểu" class="tipE">
							<img src="<?php //echo public_url('admin'); ?>/images/icons/color/star.png" />
						</a> -->						
						 <a href="<?php echo admin_url('don-hang/edit/'.$row->id); ?>" title="Chỉnh sửa" class="tipS">
							<img src="<?php echo public_url('admin'); ?>/images/icons/color/edit.png" />
						</a>
						
						<a href="<?php echo admin_url('don-hang/delete/'.$row->id); ?>" title="Xóa" class="tipS verify_action" >
						    <img src="<?php echo public_url('admin'); ?>/images/icons/color/delete.png" />
						</a>
					</td>
				</tr>
			<?php endforeach; else: ?>
		        			    <td colspan="6"><p>Không có đơn hàng!</p></td>
		        			    <?php endif; ?>

		        			</tbody>

			
		</table>
	</div>
	
</div>
<div class="clear mt30"></div>
		
	