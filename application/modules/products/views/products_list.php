<?php $this->load->view('head-product'); ?>
<div class="line"></div>
<!-- Message -->

<!-- Main content wrapper -->
<div class="wrapper" id="main_product">
	 <?php  $this->load->view('admin/message') ?>
	<div class="widget">	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>
				Danh sách sản phẩm			</h6>
		 	<div class="num f12">Số lượng: <b>0</b></div>
		</div>		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
		
			<thead class="filter"><tr><td colspan="6">
				<form class="list_filter form" action="<?php echo admin_url('san-pham'); ?>" method="get">
					<table cellpadding="0" cellspacing="0" width="80%"><tbody>
					
						<tr>
							<td class="label" style="width:40px;"><label for="filter_id">Mã số</label></td>
							<td class="item"><input name="id" value="<?php echo $this->input->get('id'); ?>" id="filter_id" type="text" style="width:55px;" /></td>
							
							<td class="label" style="width:40px;"><label for="filter_id">Tên</label></td>
							<td class="item" style="width:155px;" ><input name="name" value="" id="filter_iname" type="text" style="width:155px;" /></td>
							
							<td class="label" style="width:60px;"><label for="filter_status">Thể loại</label></td>
							<td class="item">
							<?php if (isset($catalogs) && !empty($catalogs)) { ?>							
								<select name="catalog">
									<option value=""></option>
									<?php foreach ($catalogs as $vcatalog) {
											if (count($vcatalog->subs) > 1) { ?>																	
									     <optgroup label="<?php echo $vcatalog->name; ?>">
											<?php foreach ($vcatalog->subs as $value) { ?>											
									       		<option value="<?php echo $value->id; ?>" ><?php echo $value->name; ?> </option>
											<?php }; ?>
									     </optgroup>
									     <?php }else{ ?>
									     	<option value="<?php echo $vcatalog->id; ?>" ><?php echo $vcatalog->name; ?></option>
									     <?php } ?>
									<?php } ?>

								</select>
							<?php } ?>

							</td>
							
							<td style='width:150px'>
							<input type="submit" class="button blueB" value="Lọc" />
							<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('san-pham'); ?>'; ">
							</td>
							
						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin'); ?>/images/icons/tableArrows.png" /></td>
					<td style="width:60px;">Mã số</td>
					<td>Tên</td>
					<td>Giá</td>
					<td style="width:75px;">Ngày tạo</td>
					<td style="width:120px;">Hành động</td>
				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="6">
					     <div class="list_action itemActions">
								<a href="#submit" id="submit" class="button blueB" url="admin/cat/del_all.html">
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
					
					<td class="textC"><?php echo $row->id; ?></td>
					
					<td>
					<div class="image_thumb">
						<img src="<?php echo base_url('upload/product/').$row->image_link; ?>" height="50">
						<div class="clear"></div>
					</div>
					
					<a href="#" class="tipS" title="" target="_blank">
						<b><?php echo $row->name; ?></b>
					</a>
					
					<div class="f11" >
					  Đã bán: <?php echo $row->buyed; ?>				  | Xem: <?php echo $row->view; ?>					</div>
						
					</td>
					
					<td class="textR">
					     <?php if($row->discount > 0): ?>
								<?php $pricenew = $row->price - $row->discount;
								 ?> <p style="color:red;"><?php echo number_format($pricenew,'0','0','.'); ?> đ</p>
	                       <p style='text-decoration:line-through'><?php echo number_format($row->price,'0','0','.'); ?> đ</p>
					     <?php else: ?>
								   <p style="color:red;"><?php echo number_format($row->price,'0','0','.'); ?> đ</p>	                      
					     <?php endif; ?>
                           				
					</td>

					
					<td class="textC">01-01-1970</td>
					
					<td class="option textC">
						<!-- <a href="" title="Gán là nhạc tiêu biểu" class="tipE">
							<img src="<?php //echo public_url('admin'); ?>/images/icons/color/star.png" />
						</a> -->
												<a  href="product/view/9.html" target='_blank' class='tipS' title="Xem chi tiết sản phẩm">
								<img src="<?php echo public_url('admin'); ?>/images/icons/color/view.png" />
						 </a>
						 <a href="admin/product/edit/9.html" title="Chỉnh sửa" class="tipS">
							<img src="<?php echo public_url('admin'); ?>/images/icons/color/edit.png" />
						</a>
						
						<a href="admin/product/del/9.html" title="Xóa" class="tipS verify_action" >
						    <img src="<?php echo public_url('admin'); ?>/images/icons/color/delete.png" />
						</a>
					</td>
				</tr>
			<?php endforeach; else: ?>
		        			    <tr><p>Sản phẩm đang được cập nhập!</p></tr>
		        			    <?php endif; ?>

		        			</tbody>

			
		</table>
	</div>
	
</div>		<div class="clear mt30"></div>
		
	