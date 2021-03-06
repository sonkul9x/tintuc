<?php $this->load->view('head'); ?>
<div class="line"></div>
<!-- Message -->
<!-- Main content wrapper -->
<div class="wrapper">
    <?php $this->load->view('admin/message') ?>
    <div class="widget">

        <div class="title">          
            <h6>Danh sách Admin</h6>
            <div class="num f12">Tổng số: <b><?php echo $total; ?></b></div>
        </div>

        <form action="" method="get" class="form" name="filter">
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                <thead>
                    <tr>
                      
                        <td style="width:100px;">Mã số</td>
                        <td>Tên</td>                      
                       
                        <td>Username</td>
                        <td style="width:100px;">Hành động</td>
                    </tr>
                </thead>
                

                <tbody>
                    <!-- Filter -->
                <?php 
                if(isset($list) && !empty($list)){
                	foreach ($list as $row) :                
                 ?>
                    <tr>
                       

                        <td class="textC"><?php echo $row->id; ?></td>

                        <td><span title="<?php echo $row->name; ?>" class="tipS"><?php echo $row->name; ?></span></td>                 

                     

                        <td><?php echo $row->username; ?></td>


                        <td class="option">
                            <a href="<?php echo base_url('quan-tri/quan-tri-vien/edit/'.$row->id); ?>" title="Chỉnh sửa" class="tipS ">
							<img src="<?php echo public_url('admin'); ?>/images/icons/color/edit.png" />
							</a>

                            <a href="<?php echo base_url('quan-tri/quan-tri-vien/delete/'.$row->id); ?>" title="Xóa" class="tipS verify_action">
							    <img src="<?php echo public_url('admin'); ?>/images/icons/color/delete.png" />
							</a>
                        </td>
                    </tr>                  
				<?php 
				endforeach;
				}else{ ?>
					<tr><p>Không có dữ liệu Admin</p></tr>
				<?php } ?>

                </tbody>
            </table>
        </form>
    </div>
</div>
<div class="clear mt30"></div>