
<div class="box-center"><!-- The box-center product-->
   <div class="tittle-box-center">
      <h2>Đăng nhập</h2>
    </div>
   <div class="box-content-center register"><!-- The box-content-center -->
            <h1>Đăng nhập</h1>
            <h3><?php echo form_error('login'); ?></h3>
            <form enctype="multipart/form-data" action="<?php echo base_url('users/login'); ?>" method="post" class="t-form form_action">
                  <div class="form-row">
            <label class="form-label" for="param_email">Email:<span class="req">*</span></label>
            <div class="form-item">
              <input type="text" value="<?php echo set_value('email'); ?>" name="email" id="email" class="input">
              <div class="clear"></div>
              <div id="email_error" class="error"><?php echo form_error('email'); ?></div>
            </div>
            <div class="clear"></div>
          </div>
          
          <div class="form-row">
            <label class="form-label" for="param_password">Mật khẩu:<span class="req">*</span></label>
            <div class="form-item">
              <input type="password" name="password" id="password" class="input">
              <div class="clear"></div>
              <div id="password_error" class="error"><?php echo form_error('password'); ?></div>
            </div>
            <div class="clear"></div>
          </div>
          
         
          
          <div class="form-row">
            <label class="form-label">&nbsp;</label>
            <div class="form-item">
                    <input type="submit" name="submit" value="Đăng ký" class="button">
            </div>
           </div>
            </form>
         </div><!-- End box-content-center register-->
</div>  <!-- End box-center product-->   
