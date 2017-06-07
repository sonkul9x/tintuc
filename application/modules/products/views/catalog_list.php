<?php $this->load->view('head'); ?>
<div class="line"></div>
<!-- Message -->
<!-- Main content wrapper -->
<div class="wrapper">
    <?php  $this->load->view('admin/message') ?>
    <!-- Static table -->
    <div class="widget" id='main_content'>
    
        <div class="title">
            <span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
            <h6>Danh sách Danh mục</h6>
            <div class="num f12">Tổng số: <b><?php echo count($list); ?></b></div>
        </div>
        
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
            <thead>
                <tr>
                    <td style="width:21px;"><img src="<?php echo public_url('admin'); ?>/images/icons/tableArrows.png" /></td>
                    <td>Tên</td>                    
                    <td style="width:150px;">Hành động</td>
                </tr>
            </thead>
            
            <tfoot class="auto_check_pages">
                <tr>
                    <td colspan="3">
                         <div class="list_action itemActions">
                                <a href="<?php echo admin_url('danh-muc-san-pham/deleteall'); ?>" id="submit" class="button blueB" >
                                    <span style='color:white;'>Xóa hết</span>
                                </a>
                         </div>                            
                        
                    </td>
                </tr>
            </tfoot>
            
            <tbody>

            <?php if(isset($list) && !empty($list)){              
                showCategories($list); ?>


            <?php }else{ ?>
                    <tr><p>Hiện tại không có danh mục sản phẩm!</p></tr>   

               <?php } ?>


                                 
            </tbody>
        </table>
    </div>
</div>
<div class="clear mt30"></div>