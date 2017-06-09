<?php $this->load->view('head'); ?>
<div class="line"></div>
<!-- Message -->
<!-- Main content wrapper -->
<div class="wrapper">	   	<!-- Form -->
		<form class="form" id="form" action="<?php echo admin_url('slide/add'); ?>" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="widget">
				    <div class="title">
						<img src="<?php echo public_url('admin'); ?>/images/icons/dark/add.png" class="titleIcon" />
						<h6>Thêm Slide</h6>
					</div>
					
				    <ul class="tabs">
		                <li><a href="#tab1">Thông tin chung</a></li>          
		                
					</ul>
					
					<div class="tab_container">
					     <div id='tab1' class="tab_content pd0">
					         <div class="formRow">
								<label class="formLeft" for="param_name">Tên Slide:<span class="req">*</span></label>
								<div class="formRight">
									<span class="oneTwo"><input name="name" id="param_name" _autocheck="true" type="text" /></span>
									<span name="name_autocheck" class="autocheck"></span>
									<div name="name_error" class="clear error"><?php echo form_error('name'); ?></div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="formRow">
								<label class="formLeft">Ảnh Slide:<span class="req">*</span></label>
								<div class="formRight">
									<div class="left"><input type="file"  id="image" name="image"  ></div>
									<div name="image_error" class="clear error"><?php echo form_error('image'); ?></div>
								</div>
								<div class="clear"></div>
							</div>
							 <div class="formRow">
								<label class="formLeft" for="param_name">Tiêu đề ảnh:<span class="req">*</span></label>
								<div class="formRight">
									<span class="oneTwo"><input name="image_name" id="param_image_name" _autocheck="true" type="text" /></span>
									<span name="image_name_autocheck" class="autocheck"></span>
									<div name="image_name_error" class="clear error"><?php echo form_error('image_name'); ?></div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="formRow">
								<label class="formLeft" for="param_name">Link trỏ đi:<span class="req">*</span></label>
								<div class="formRight">
									<span class="oneTwo"><input name="link" id="param_link" _autocheck="true" type="text" /></span>
									<span name="link_autocheck" class="autocheck"></span>
									<div name="link_error" class="clear error"><?php echo form_error('link'); ?></div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="formRow">
								<label class="formLeft" for="param_info">Mô tả:</label>
								<div class="formRight">
									<span class="oneTwo"><textarea name="info" id="param_info" rows="4" cols=""></textarea></span>
									<span name="info_autocheck" class="autocheck"></span>
									<div name="info_error" class="clear error"><?php echo form_error('info'); ?></div>
								</div>
								<div class="clear"></div>
							</div>		
							 <div class="formRow">
								<label class="formLeft" for="param_sort_order">Vị trí:</label>
								<div class="formRight">
									<span class="oneTwo"><input style="width: 50px;" name="sort_order" id="param_sort_order" _autocheck="true" type="text" /></span>
									<span name="sort_order_autocheck" class="autocheck"></span>
									<div name="sort_order_error" class="clear error"><?php echo form_error('sort_order'); ?></div>
								</div>
								<div class="clear"></div>
							</div>			         
							<div class="formRow hide"></div>
						 </div>
						 
						
						 
						
						
	        		</div><!-- End tab_container-->
	        		
	        		<div class="formSubmit">
	           			<input type="submit" value="Thêm mới" class="redB" />
	           			<input type="reset" value="Làm lại" class="basic" />
	           		</div>
	        		<div class="clear"></div>
				</div>
			</fieldset>
		</form>
</div>
	<div class="clear mt30"></div>