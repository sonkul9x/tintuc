<div class="box-center"><!-- The box-center product-->
	<div class="tittle-box-center">
		<h2>Thông tin giỏ hàng ( <?php echo $totalitem; ?> sản phẩm )</h2>
	</div>
	<style>
		#cart_content{
			width: 100%;
		}
		#cart_content tr,#cart_content td,#cart_content th{border: 1px solid #ccc;text-align: center;padding: 5px 0;}
		#cart_content th{
			background: #4c66a4;color: #fff;
		}
		#cart_content .txtqty{width: 30px;border: 1px solid #ccc;padding: 2px 5px;}
		#cart_content tr:nth-child(2n+2){background: #fafafa;}
	</style>
	<div class="box-content-center" style="width: calc(100% - 20px);"><!-- The box-content-center -->
	<?php if($totalitem > 0): ?>
	<form action="<?php echo base_url('cart/update') ?>" method="post">
		<table id="cart_content">
			<thead>
				<th>STT</th>
				<th>Sản phẩm</th>
				<th>Số lượng</th>
				<th>Giá</th>
				<th>Tổng số</th>
				<th>Xóa</th>
			</thead>
			<tbody>
				<?php $totalitems=0;$i=0; foreach ($carts as $row) { 
					$totalitems = $totalitems + $row['subtotal'];
					$i++;?>
				<tr>
					<td>
						<?php echo $i; ?>
					</td>
					<td>
						<?php echo $row['name']; ?>
					</td>
					<td>
						<input class="txtqty" type="text"	value="<?php echo $row['qty']; ?>" name="qty_<?php echo $row['id']; ?>">
					</td>
					<td>
						<?php echo number_format($row['price'],'0','0','.'); ?> VNĐ
					</td>
					<td>
						<?php echo number_format($row['subtotal'],'0','0','.'); ?> VNĐ
					</td>
					<td>
						<a href="<?php echo base_url('cart/delete/'.$row['id']); ?>">Xóa</a>
					</td>
				</tr>
				<?php } ?>
				<tr>
					<td colspan="4"></td>
					<td colspan="2">Tổng tiền: <b style="color:#f00;"><?php echo number_format($totalitems,'0','0','.'); ?> VNĐ</b></td>
					
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Cập nhập giỏ hàng">
					</td>
					<td colspan="2">
						<a href="<?php echo base_url('cart/delete'); ?>">Xóa toàn bộ</a>
					</td>
					<td colspan="2">
						<a href="<?php echo base_url('order/checkout'); ?>" class="button" >Thanh toán</a>
					</td>
				</tr>
			</tbody>
		</table>
		</form>
	<?php else: ?>
		<p>Không có sản phẩm trong giỏ hàng!</p>
	<?php endif; ?>
	</div>
	<div class="clear"></div>
</div>