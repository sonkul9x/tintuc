
<div class="box-center"><!-- The box-center product-->
   <div class="tittle-box-center">
      <h2>Thông tin cá nhân</h2>
    </div>
    <?php if($user && !empty($user)) :
     ?>
  <style>
    .infouser table{
    width: 100%;
    }
    .infouser tr,.infouser td{border: 1px solid #ccc;}
    .infouser td{padding: 5px;}
    .infouser td:first-child{width: 150px;background: #3b5998;color: #fff;}
  </style>
   <div class="box-content-center infouser" style="padding: 0;"><!-- The box-content-center -->
            <h1>Thông tin cá nhân: </h1>
            <table>
              <tr>
                <td>Họ và tên: </td>
                <td><?php echo $user->name; ?></td>
              </tr>
              <tr>
                <td>Email: </td>
                <td><?php echo $user->email; ?></td>
              </tr>
              <tr>
                <td>Địa chỉ: </td>
                <td><?php echo $user->address; ?></td>
              </tr>
              <tr>
                <td>Số điện thoại: </td>
                <td><?php echo $user->phone; ?></td>
              </tr>
               <tr>
                <td>Ngày đăng ký: </td>
                <td><?php echo date("d-m-Y",$user->created); ?></td>
              </tr>
              <tr>
                <td></td>
                <td colspan=""><a href="<?php echo base_url('users/edit'); ?>" style="color: #3b5998;font-weight: 600;">Sửa thông tin cá nhân</a></td>
              </tr>

            </table>
         </div><!-- End box-content-center register-->
  <?php endif; ?>
</div>  <!-- End box-center product-->   
