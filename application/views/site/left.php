 <?php 
 	$price_from = isset($price_from) ? intval($price_from) : 0;
 	$price_to = isset($price_to) ? intval($price_to) : 0;
  ?>
 <div class="box-left">
         <div class="title tittle-box-left">
			  <h2> Tìm kiếm theo giá </h2>
		</div>
		<div class="content-box" ><!-- The content-box -->
	           <form class="t-form form_action" method="get" style='padding:10px' action="<?php echo base_url('products/search_prce'); ?>" name="search" >
                  
                  <div class="form-row">
						<label for="param_price_from" class="form-label" style='width:70px'>Giá từ:<span class="req">*</span></label>
						<div class="form-item"  style='width:90px'>
							<select  class="input" id="price_from" name="price_from" >
							    <?php for ($i=0; $i < 50000000; $i = $i + 5000000) { ?>
							    	<option <?php echo ($price_from == $i) ? 'selected' :' '; ?> value="<?php echo $i; ?>"><?php echo number_format($i,'0','0','.'); ?> đ</option>
							    <?php } ?>
							 </select>
							<div class="clear"></div>
							<div class="error" id="price_from_error"></div>
						</div>
						<div class="clear"></div>
				  </div>
				  <div class="form-row">
						<label for="param_price_from" class="form-label" style='width:70px'>Giá tới:<span class="req">*</span></label>
						<div class="form-item"  style='width:90px'>
							<select  class="input" id="price_to" name="price_to" >
							    <?php for ($i=500000; $i <= 50000000; $i = $i + 5000000) { ?>
							    	<option <?php echo ($price_to == $i) ? 'selected' :' '; ?> value="<?php echo $i; ?>"><?php echo number_format($i,'0','0','.'); ?> đ</option>
							    <?php } ?>  							           
							 </select>
							<div class="clear"></div>
							<div class="error" id="price_from_error"></div>
						</div>
						<div class="clear"></div>
				  </div>
				  
				  <div class="form-row">
						<label class="form-label">&nbsp;</label>
						<div class="form-item">
				           	<input type="submit" class="button" value="Tìm kiềm" style='height:30px !important;line-height:30px !important;padding:0px 10px !important'>
						</div>
						<div class="clear"></div>
				   </div>
            </form>
	    </div><!-- End content-box -->
</div>

<?php if(isset($catalog_list) && !empty($catalog_list)): ?>
<div class="box-left">
     <div class="title tittle-box-left">
		  <h2> Danh mục sản phẩm </h2>
	</div>
	<div class="content-box"><!-- The content-box -->

	    <ul class="catalog-main">
			<?php foreach ($catalog_list as $row) { ?>
			
	        <li>
	            <span><a href="<?php echo base_url('products/catalog/'.$row->id); ?>" title="<?php echo $row->name; ?>"><?php echo $row->name; ?></a></span>
	             <!-- lay danh sach danh muc con -->
	            <?php if(!empty($row->subs)){ ?>
	     	 	 <ul class="catalog-sub">	
	     	 	 	<?php foreach ($row->subs as $sub) { ?>	     	 	 		 	            					                    
                    <li>
                    	<a href="<?php echo base_url('products/catalog/'.$sub->id); ?>" title="<?php echo $sub->name; ?>"><?php echo $sub->name; ?></a>
                    </li>       
                    <?php } ?>   
	             </ul>
	             <?php } ?>
	         </li>
	         <?php } ?>
	    </ul>
	</div><!-- End content-box -->
</div>
<?php endif; ?>