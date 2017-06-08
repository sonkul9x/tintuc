<?php $this->load->view('head-product'); ?>
<div class="line"></div>
<!-- Message -->
<!-- Main content wrapper -->
<div class="wrapper">	   	<!-- Form -->
		<form class="form" id="form" action="<?php echo admin_url('san-pham/add'); ?>" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="widget">
				    <div class="title">
						<img src="<?php echo public_url('admin'); ?>/images/icons/dark/add.png" class="titleIcon" />
						<h6>Thêm mới Sản phẩm</h6>
					</div>
					
				    <ul class="tabs">
		                <li><a href="#tab1">Thông tin chung</a></li>
		                <li><a href="#tab2">SEO Onpage</a></li>
		                <li><a href="#tab3">Bài viết</a></li>
		                
					</ul>
					
					<div class="tab_container">
					     <div id='tab1' class="tab_content pd0">
					         <div class="formRow">
	<label class="formLeft" for="param_name">Tên:<span class="req">*</span></label>
	<div class="formRight">
		<span class="oneTwo"><input name="name" id="param_name" _autocheck="true" type="text" /></span>
		<span name="name_autocheck" class="autocheck"></span>
		<div name="name_error" class="clear error"><?php echo form_error('name'); ?></div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
	<div class="formRight">
		<div class="left"><input type="file"  id="image" name="image"  ></div>
		<div name="image_error" class="clear error"><?php echo form_error('image'); ?></div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	<label class="formLeft">Ảnh kèm theo:</label>
	<div class="formRight">
		<div class="left"><input type="file"  id="image_list" name="image_list[]" multiple></div>
		<div name="image_list_error" class="clear error"><?php echo form_error('image_list'); ?></div>
	</div>
	<div class="clear"></div>
</div>

<!-- Price -->
<div class="formRow">
	<label class="formLeft" for="param_price">
		Giá :
		<span class="req">*</span>
	</label>
	<div class="formRight">
		<span class="oneTwo">
			<input name="price"  style='width:100px' id="param_price" class="format_number" _autocheck="true" type="text" />
			<img class='tipS' title='Giá bán sử dụng để giao dịch' style='margin-bottom:-8px'  src='<?php echo public_url('admin'); ?>/crown/images/icons/notifications/information.png'/>
		</span>
		<span name="price_autocheck" class="autocheck"></span>
		<div name="price_error" class="clear error"><?php echo form_error('price'); ?></div>
	</div>
	<div class="clear"></div>
</div>

<!-- Price -->
<div class="formRow">
	<label class="formLeft" for="param_discount">
		Giảm giá (%) 
		<span></span>:
	</label>
	<div class="formRight">
		<span>
			<input name="discount"  style='width:100px' id="param_discount" class="format_number"  type="text" />
			<img class='tipS' title='phần trăm giảm giá' style='margin-bottom:-8px'  src='<?php echo public_url('admin'); ?>/crown/images/icons/notifications/information.png'/>
		</span>
		<span name="discount_autocheck" class="autocheck"></span>
		<div name="discount_error" class="clear error"><?php echo form_error('discount'); ?></div>
	</div>
	<div class="clear"></div>
</div>


<div class="formRow">
	<label class="formLeft" for="param_cat">Thể loại:<span class="req">*</span></label>
	<div class="formRight">
		
				<?php if (isset($catalogs) && !empty($catalogs)) { ?>							
							<select name="catalog" _autocheck="true" id='param_cat' class="left">
									<option value="">Chọn danh mục</option>
									<?php foreach ($catalogs as $vcatalog) {
											if (count($vcatalog->subs) > 1) { ?>																	
									     <optgroup label="<?php echo $vcatalog->name; ?>">
											<?php foreach ($vcatalog->subs as $value) { ?>											
									       		<option value="<?php echo $value->id; ?>"  ><?php echo $value->name; ?> </option>
											<?php }; ?>
									     </optgroup>
									     <?php }else{ ?>
									     	<option value="<?php echo $vcatalog->id; ?>" ><?php echo $vcatalog->name; ?></option>
									     <?php } ?>
									<?php } ?>

								</select>
							<?php } ?>
		<span name="cat_autocheck" class="autocheck"></span>
		<div name="cat_error" class="clear error"><?php echo form_error('catalog'); ?></div>
	</div>
	<div class="clear"></div>
</div>


<!-- warranty -->
<div class="formRow">
	<label class="formLeft" for="param_warranty">
		Bảo hành :
	</label>
	<div class="formRight">
		<span class="oneFour"><input name="warranty" id="param_warranty"  type="text" /></span>
		<span name="warranty_autocheck" class="autocheck"></span>
		<div name="warranty_error" class="clear error"><?php echo form_error('warranty'); ?></div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	<label class="formLeft" for="param_sale">Tặng quà:</label>
	<div class="formRight">
		<span class="oneTwo"><textarea name="gifts" id="param_gifts" rows="4" cols=""></textarea></span>
		<span name="gifts_autocheck" class="autocheck"></span>
		<div name="gifts_error" class="clear error"><?php echo form_error('gifts'); ?></div>
	</div>
	<div class="clear"></div>
</div>					         <div class="formRow hide"></div>
						 </div>
						 
						 <div id='tab2' class="tab_content pd0" >
						     			
<div class="formRow">
	<label class="formLeft" for="param_site_title">Title:</label>
	<div class="formRight">
		<span class="oneTwo"><textarea name="site_title" id="param_site_title" _autocheck="true" rows="4" cols=""></textarea></span>
		<span name="site_title_autocheck" class="autocheck"></span>
		<div name="site_title_error" class="clear error"><?php echo form_error('site_title'); ?></div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	<label class="formLeft" for="param_meta_desc">Meta description:</label>
	<div class="formRight">
		<span class="oneTwo"><textarea name="meta_desc" id="param_meta_desc" _autocheck="true" rows="4" cols=""></textarea></span>
		<span name="meta_desc_autocheck" class="autocheck"></span>
		<div name="meta_desc_error" class="clear error"><?php echo form_error('meta_desc'); ?></div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	<label class="formLeft" for="param_meta_key">Meta keywords:</label>
	<div class="formRight">
		<span class="oneTwo"><textarea name="meta_key" id="param_meta_key" _autocheck="true" rows="4" cols=""></textarea></span>
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
		<textarea name="content" id="param_content" class="editor"></textarea>
		<div name="content_error" class="clear error"><?php echo form_error('content'); ?></div>
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