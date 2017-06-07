<?php $this->load->view('head'); ?>
<div class="line"></div>
<!-- Message -->
<!-- Main content wrapper -->
<div class="wrapper">
    <!-- Form -->
    <form class="form" id="form" action="<?php echo admin_url(); ?>danh-muc-san-pham/add" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="<?php echo public_url('admin'); ?>/images/icons/dark/add.png" class="titleIcon" />
                    <h6>Thêm mới Danh mục sản phẩm</h6>
                </div>
                <div class="formRow">
                    <label class="formLeft" for="param_name">Tên:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="name" id="param_name" _autocheck="true" value="<?php echo set_value('name'); ?>" type="text" /></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php echo form_error('name'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>  
                 
                <div class="formRow">
                    <label class="formLeft" for="param_parent_cat">Danh mục cha:<span class="req">*</span></label>
                    <div class="formRight">
                     <?php if(isset($list) && !empty($list)){ ?>  
                        <span class="oneTwo">
                            <select name="parent_id" id="param_parent_cat">
                                <option value="0">Danh mục gốc</option>  
                                <?php  abc($list); ?>                              
                            </select>
                       </span>
                         <?php }else{ ?>

                    <span>Hiện tại không có danh mục sản phẩm!</span>   

                  <?php } ?>     
                        <span name="parent_id_autocheck" class="autocheck"></span>
                        <div name="parent_id_error" class="clear error"><?php echo form_error('parent_id'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>  
                           
                <div class="formRow">
                    <label class="formLeft" for="sort_order_name">Thứ tự hiển thị:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="sort_order" id="sort_order_name" placeholder="1, 2, 3, etc." _autocheck="true" value="<?php echo set_value('sort_order'); ?>" type="text" /></span>
                        <span name="sort_order_autocheck" class="autocheck"></span>
                        <div name="sort_order_error" class="clear error"><?php echo form_error('sort_order'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>     

                <div class="formSubmit">
                    <input type="submit" value="Thêm mới" class="redB" />
                    <input type="reset" value="Reset" class="basic" />
                </div>
                <div class="clear"></div>
            </div>
        </fieldset>
    </form>
</div>