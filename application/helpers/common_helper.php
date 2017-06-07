<?php 
	function public_url($url = '')
	{
		return base_url('public/'.$url);
	}
	function pre($param,$exit = true)
	{
		echo "<pre>";
		print_r($param);
		echo "</pre>";
		if($exit){
			die;
		}
	}

	function showCategories($categories, $parent_id = 0, $char = '')
		{
		    foreach ($categories as $key => $item)
		    {
		        // Nếu là chuyên mục con thì hiển thị
		        if ($item->parent_id == $parent_id)
		        {
		           
		            echo '<tr class="row_'.$item->id.'">';
		            echo '<td><input type="checkbox" name="id[]" value="'.$item->id.'" /></td>';                 
		            echo '<td style="text-align:left;">'.$char .' '. $item->name.'</td>';
		            echo '<td class="option">';
		            echo 	'<a href="'.admin_url('danh-muc-san-pham/edit/'.$item->id).'" title="Chỉnh sửa" class="tipS ">';
		            echo 		'<img src="'.public_url('admin').'/images/icons/color/edit.png" />';
		            echo 	'</a>';                        
		            echo 	'<a href="'.admin_url('danh-muc-san-pham/delete/'.$item->id).'" title="Xóa" class="tipS verify_action" >';
		            echo 		'<img src="'.public_url('admin').'/images/icons/color/delete.png" />';
		            echo 	'</a>';
		             echo '</td>';
		            echo '</tr>';
		            
		            // Xóa chuyên mục đã lặp
		            unset($categories[$key]);
		            
		            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
		            showCategories($categories, $item->id, $char.'|---');
		        }
		    }
		}
	function abc($categories, $parent_id = 0, $char = '',$active='')
	{
	    foreach ($categories as $key => $item)
	    {
	        // Nếu là chuyên mục con thì hiển thị
	        if ($item->parent_id == $parent_id)
	        { ?>
	            <option <?php if(isset($active) && !empty($active) && ($active == $item->id)){ echo 'selected'; }; ?> value="<?php echo $item->id; ?>">
	            <?php echo $char . $item->name; ?>
	            </option>	             
	         <?php   unset($categories[$key]);
	             
	            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
	            abc($categories, $item->id, $char.'|--- ');
	        }
	    }
	}