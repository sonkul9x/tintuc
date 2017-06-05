<?php $this->load->view('head'); ?>
<div class="line"></div>
<!-- Message -->
<!-- Main content wrapper -->
<div class="wrapper">
    <!-- Form -->
    <form class="form" id="form" action="<?php echo base_url(); ?>admin_auth/auth/edit" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="<?php echo public_url('admin'); ?>/images/icons/dark/add.png" class="titleIcon" />
                    <h6>Chỉnh sửa thông tin Quản trị Viên</h6>
                </div>
                <div class="formRow">
                    <label class="formLeft" for="param_name">Tên:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="name" id="param_name" _autocheck="true" value="<?php echo $info->name; ?>" type="text" /></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php echo form_error('name'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label class="formLeft" for="param_username">Username:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="username" id="param_username" _autocheck="true" value="<?php echo $info->username; ?>"  type="text" /></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php echo form_error('username'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                 <div class="formRow">
                    <label class="formLeft" for="param_password">Mật khẩu:</label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="pass" id="param_password" _autocheck="true" value="<?php echo set_value('pass'); ?>" type="password" /></span>    
                        <p>Không cần nhập nếu không cần đổi!</p>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php echo form_error('pass'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                  <div class="formRow">
                    <label class="formLeft" for="param_repassword">Nhập lại mật khẩu:</label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="repass" id="param_repassword" _autocheck="true" value="<?php echo set_value('repass'); ?>" type="password" /></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php echo form_error('repass'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formSubmit">
                    <input type="submit" value="Chỉnh Sửa" class="redB" />
                    <input type="reset" value="Reset" class="basic" />
                </div>
                <div class="clear"></div>
            </div>
        </fieldset>
    </form>
</div>