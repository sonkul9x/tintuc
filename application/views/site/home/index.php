<?php $this->load->view('site/home/slide') ?>
<!-- lay san pham moi nhat -->
<?php if(isset($product_news) && !empty($product_news)){ ?>
<div class="box-center"><!-- The box-center product-->
   <div class="tittle-box-center">
		  <h2>Sản phẩm mới</h2>
		</div>
    <div class="box-content-center product"><!-- The box-content-center -->
      <?php foreach ($product_news as $row) { ?>      
       <div class='product_item'>
           <h3>
             <a  href="#" title="<?php echo $row->name; ?>"><?php echo $row->name; ?></a>
           </h3>
           <div class='product_img'>
              <a  href="#" title="<?php echo $row->name; ?>">
                <img src="<?php echo base_url('upload/product/'.$row->image_link) ?>" alt='<?php echo $row->name; ?>'/>
              </a>
           </div>
           <p class='price'>
           <?php if($row->discount > 0): ?>
                <?php $pricenew = $row->price -(($row->price / 100) * $row->discount); 
                 ?> <?php echo number_format($pricenew,'0','0','.'); ?> đ
                         <span class='price_old'><?php echo number_format($row->price,'0','0','.'); ?> đ</span>
               <?php else: ?>
                   <?php echo number_format($row->price,'0','0','.'); ?> đ                      
               <?php endif; ?>  
           </p>
            <center>
               <div class='raty' style='margin:10px 0px' id='9' data-score='4'></div>
            </center>
           <div class='action'>
               <p style='float:left;margin-left:10px'>Lượt xem: <b><?php echo $row->view; ?></b></p>
             <a class='button' href="them-vao-gio-9.html" title='Mua ngay'>Mua ngay</a>
             <div class='clear'></div>
           </div>
       </div>    
       <?php } ?>              
       <div class='clear'></div>
	 </div><!-- End box-content-center -->
</div>	<!-- End box-center product-->	 
<?php } ?>   


<!-- lay san pham mua nhiều nhất-->

<?php if(isset($product_hot) && !empty($product_hot)){ ?>
<div class="box-center"><!-- The box-center product-->
   <div class="tittle-box-center">
      <h2>Sản phẩm hot nhất</h2>
    </div>
    <div class="box-content-center product"><!-- The box-content-center -->
      <?php foreach ($product_hot as $row) { ?>      
       <div class='product_item'>
           <h3>
             <a  href="#" title="<?php echo $row->name; ?>"><?php echo $row->name; ?></a>
           </h3>
           <div class='product_img'>
              <a  href="#" title="<?php echo $row->name; ?>">
                <img src="<?php echo base_url('upload/product/'.$row->image_link) ?>" alt='<?php echo $row->name; ?>'/>
              </a>
           </div>
           <p class='price'>
           <?php if($row->discount > 0): ?>
                <?php $pricenew = $row->price -(($row->price / 100) * $row->discount); 
                 ?> <?php echo number_format($pricenew,'0','0','.'); ?> đ
                         <span class='price_old'><?php echo number_format($row->price,'0','0','.'); ?> đ</span>
               <?php else: ?>
                   <?php echo number_format($row->price,'0','0','.'); ?> đ                      
               <?php endif; ?>  
           </p>
            <center>
               <div class='raty' style='margin:10px 0px' id='9' data-score='4'></div>
            </center>
           <div class='action'>
               <p style='float:left;margin-left:10px'>Lượt mua: <b><?php echo $row->buyed; ?></b></p>
             <a class='button' href="them-vao-gio-9.html" title='Mua ngay'>Mua ngay</a>
             <div class='clear'></div>
           </div>
       </div>    
       <?php } ?>              
       <div class='clear'></div>
   </div><!-- End box-content-center -->
</div>  <!-- End box-center product-->   
<?php } ?>   
