<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<?php $this->load->view('admin/head'); ?>
</head>

<body class="nobg loginPage" style="min-height:100%;">
	<!-- Main content wrapper -->
	<div class="loginWrapper" style="top:45%;">
	    <div class="widget" id="admin_login" style="height:auto; margin:auto;">
	        <div class="title"><img src="<?php echo public_url('admin'); ?>/images/icons/dark/laptop.png" alt="" class="titleIcon" />
	        	<h6>Đăng nhập</h6>
	        </div>
	        <form class="form" id="form" action="" method="post">
	           <fieldset>
	                <div class="formRow">
	                    <label for="param_username">Tên đăng nhập:</label>
	                    <div class="loginInput"><input type="text" name="username" id="param_username" /></div>
	                    <div class="clear"></div>
	                </div>
	                
	                <div class="formRow">
	                    <label for="param_password">Mật khẩu:</label>
	                    <div class="loginInput"><input type="password" name="pass" id="param_password" /></div>
	                    <div class="clear"></div>
	                </div>
	                <div  style="padding: 0 10px;color: #f00;"><?php echo form_error('login'); ?></div>
	                <div class="loginControl">
	                    <input type='hidden' name="submit" value='1'/>
	                    <input type="submit"  value="Đăng nhập" class="dredB logMeIn" />
	                    <div class="clear"></div>
	                </div>
	            </fieldset>
	        </form>
	    </div>
	    
	</div> 
	   
	
	<?php $this->load->view('admin/footer'); ?>
</body>
</html>