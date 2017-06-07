<?php if(isset($message) && !empty($message)){ ?>
<?php if($message['status'] == 'nWarning'){
	 $str = 'Cảnh Báo';
	}elseif($message['status'] == 'nFailure'){
		$str = 'Lỗi';
	}elseif($message['status'] == 'nSuccess'){
			$str = 'Thành Công';
	}elseif($message['status']){
		$str = 'Thông Báo';
		} ?>
<div class="nNote <?php echo $message['status']; ?> hideit">
    <p><strong><?php echo $str; ?>: </strong><?php echo $message['mes']; ?></p>
</div>
<?php } ?>