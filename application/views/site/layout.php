<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('site/head'); ?>
</head>
<body>
	 <a href="#" id="back_to_top">
		<img src="<?php echo public_url(); ?>site/images/top.png" />
	  </a>
	  <div class="wraper">
          <!-- the header -->
	      <div class='header'>
	           <!-- The box-header-->
			<?php $this->load->view('site/header'); ?>    		       
		  </div>
		  <!-- End header -->		  
		  <!-- The container -->
		  <div id="container">
		      <!-- The left -->
			  <div class='left'>
			      <?php $this->load->view('site/left'); ?>
			  </div>
			  <!-- End left -->			  
			  <!-- The content -->
			  <div class='content'> 
			  		<?php $this->load->view($temp); ?>
			   </div>
			  <!-- End content -->
			  
			  <!-- The right -->
			  <div class='right'>
			     <?php $this->load->view('site/right'); ?>   
			  </div>
			  <!-- End right -->
			  <div class="clear"></div>
			  
		  </div>
		  <!-- End container -->
		  <center>
			<img src="<?php echo public_url(); ?>site/images/bank.png" /> 
		  </center>
		  <!-- The footer -->
		  <div class="footer">
			    <!-- The box-footer-->		       
     		 <?php $this->load->view('site/footer'); ?>   
		  </div>
		  <!-- End footer -->
		  
	  </div>
	  <!-- End wraper -->
</body>
</html>