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
						<h6>Cập nhập bài viết</h6>
					</div>
					
				    <ul class="tabs">
		                <li><a href="#tab1">Thông tin chung</a></li>
		                <li><a href="#tab2">SEO Onpage</a></li>
		                <li><a href="#tab3">Bài viết</a></li>
		                
					</ul>
					
					<div class="tab_container">
					     <div id='tab1' class="tab_content pd0">
					         <div class="formRow">
	<label class="formLeft" for="param_name">Tiêu đề:<span class="req">*</span></label>
	<div class="formRight">
		<span class="oneTwo"><input name="title" id="param_title" _autocheck="true" type="text" value="<?php echo $new->title; ?>" /></span>
		<span name="title_autocheck" class="autocheck"></span>
		<div name="title_error" class="clear error"><?php echo form_error('title'); ?></div>
	</div>
	<div class="clear"></div>
</div>
<div class="formRow">
	<label class="formLeft">Ảnh đại diện:<span class="req">*</span></label>
	<div class="formRight">
		<div class="left"><input type="file"  id="image" name="image"  ></div>
		<?php if($new->image_link){ ?>
		<img src="<?php echo base_url('upload/news/'.$new->image_link); ?>" style="width: 100px;height: 50px;" alt="">
		<?php } ?>
		<div name="image_error" class="clear error"><?php echo form_error('image'); ?></div>
	</div>
	<div class="clear"></div>
</div>
<div class="formRow">
	<label class="formLeft" for="param_sale">Mô tả ngắn:</label>
	<div class="formRight">
		<span class="oneTwo"><textarea name="intro" id="param_intro" rows="4" cols=""><?php echo $new->intro; ?></textarea></span>
		<span name="intro_autocheck" class="autocheck"></span>
		<div name="intro_error" class="clear error"><?php echo form_error('intro'); ?></div>
	</div>
	<div class="clear"></div>
</div>					         
<div class="formRow hide"></div>
						 </div>
						 
						 <div id='tab2' class="tab_content pd0" >
						     			

<div class="formRow">
	<label class="formLeft" for="param_meta_desc">Meta description:</label>
	<div class="formRight">
		<span class="oneTwo"><textarea name="meta_desc" id="param_meta_desc" _autocheck="true" rows="4" cols=""><?php echo $new->meta_desc; ?></textarea></span>
		<span name="meta_desc_autocheck" class="autocheck"></span>
		<div name="meta_desc_error" class="clear error"><?php echo form_error('meta_desc'); ?></div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	<label class="formLeft" for="param_meta_key">Meta keywords:</label>
	<div class="formRight">
		<span class="oneTwo"><textarea name="meta_key" id="param_meta_key" _autocheck="true" rows="4" cols=""><?php echo $new->meta_key; ?></textarea></span>
		<span name="meta_key_autocheck" class="autocheck"></span>
		<div name="meta_key_error" class="clear error"><?php echo form_error('meta_key'); ?></div>
	</div>
	<div class="clear"></div>
</div>
						     <div class="formRow hide"></div>
						 </div>
						 
						 <div id='tab3' class="tab_content pd0">
						      <div class="formRow">
	<label class="formLeft">Nội dung:</label>
	<div class="formRight">
		<textarea name="content" id="param_content" class="editor"><?php echo $new->content; ?></textarea>
		<div name="content_error" class="clear error"><?php echo form_error('content'); ?></div>
	</div>
	<div class="clear"></div>
</div>
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