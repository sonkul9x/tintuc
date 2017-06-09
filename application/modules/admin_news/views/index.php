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
				Danh sách bài viết			</h6>
		 	<div class="num f12">Số lượng: <b><?php echo count($list); ?></b></div>
		</div>		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
		
			<thead class="filter"><tr><td colspan="6">
				<form class="list_filter form" action="<?php echo admin_url('san-pham'); ?>" method="get">
					<table cellpadding="0" cellspacing="0" width="80%"><tbody>
					
						<tr>
							<td class="label" style="width:40px;"><label for="filter_id">Mã số</label></td>
							<td class="item"><input name="id" value="<?php echo $this->input->get('id'); ?>" id="filter_id" type="text" style="width:55px;" /></td>
							
							<td class="label" style="width:40px;"><label for="filter_id">Tiêu đề</label></td>
							<td class="item" style="width:155px;" ><input name="title" value="<?php echo $this->input->get('title'); ?>" id="filter_title" type="text" style="width:155px;" /></td>
							
							
							
							<td style='width:150px'>
							<input type="submit" class="button blueB" value="Lọc" />
							<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('tin-tuc'); ?>'; ">
							</td>
							
						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin'); ?>/images/icons/tableArrows.png" /></td>
					<td style="width:60px;">Mã số</td>
					<td>Tiêu đề</td>				
					<td style="width:150px;">Ngày tạo</td>
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
					
					<td class="textC"><?php echo $row->id; ?></td>
					
					<td>
					<div class="image_thumb">
						<img src="<?php echo base_url('upload/news/').$row->image_link; ?>" height="50">
						<div class="clear"></div>
					</div>
					
					<a href="#" class="tipS" title="" target="_blank">
						<b><?php echo $row->title; ?></b>
					</a>
					
					<div class="f11" >Xem: <?php echo $row->count_view; ?></div>
						
					</td>					
					<td class="textC"><?php echo date("h:i:s d-m-Y",$row->created); ?></td>
					
					<td class="option textC">
						<!-- <a href="" title="Gán là nhạc tiêu biểu" class="tipE">
							<img src="<?php //echo public_url('admin'); ?>/images/icons/color/star.png" />
						</a> -->
												<a  href="#" target='_blank' class='tipS' title="Xem chi tiết bài viết">
								<img src="<?php echo public_url('admin'); ?>/images/icons/color/view.png" />
						 </a>
						 <a href="<?php echo admin_url('tin-tuc/edit/'.$row->id); ?>" title="Chỉnh sửa" class="tipS">
							<img src="<?php echo public_url('admin'); ?>/images/icons/color/edit.png" />
						</a>
						
						<a href="<?php echo admin_url('tin-tuc/delete/'.$row->id); ?>" title="Xóa" class="tipS verify_action" >
						    <img src="<?php echo public_url('admin'); ?>/images/icons/color/delete.png" />
						</a>
					</td>
				</tr>
			<?php endforeach; else: ?>
		        			    <td colspan="6"><p>Bài viết đang được cập nhập!</p></td>
		        			    <?php endif; ?>

		        			</tbody>

			
		</table>
	</div>
	
</div>		<div class="clear mt30"></div>
		
	