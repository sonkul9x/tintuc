  <!-- Main content -->
	<!-- 	<script type="text/javascript">
		(function($)
		{
			$(document).ready(function()
			{
		var main = $('#main_product');		
		// Tips
		main.find('.tipN').tipsy({gravity:'n', fade:false, html:true});
		main.find('.tipS').tipsy({gravity:'s', fade:false, html:true});
		main.find('.tipW').tipsy({gravity:'w', fade:false, html:true});
		main.find('.tipE').tipsy({gravity:'e', fade:false, html:true});
		
		// Tooltip
		main.find('[_tooltip]').nstUI({
			method:	'tooltip'
					});
				});
			})(jQuery);
			</script> -->
		<!-- Common view -->
		<script type="text/javascript">
		(function($)
		{
			$(document).ready(function()
			{
				var main = $('#form');
				
				// Tabs
				main.contentTabs();
			});
		})(jQuery);
		</script>
<!-- Title area -->
<div class="titleArea">
	<div class="wrapper">
		<div class="pageTitle">
			<h5>Sản phẩm</h5>
			<span>Quản lý sản phẩm</span>
		</div>
		
		<div class="horControlB menu_action">
			<ul>
				<li><a href="<?php echo admin_url('san-pham/add'); ?>">
					<img src="<?php echo public_url('admin'); ?>/images/icons/control/16/add.png" />
					<span>Thêm mới</span>
				</a></li>
			
			<!-- 	<li>
					<a href="admin/product/?feature=1.html">
						<img src="<?php // echo public_url('admin'); ?>/images/icons/control/16/feature.png" />
						<span>Tiêu biểu</span>
					</a>
				</li> -->

				<li><a href="<?php echo admin_url('san-pham'); ?>">
					<img src="<?php echo public_url('admin'); ?>/images/icons/control/16/list.png" />
					<span>Danh sách</span>
				</a></li>
				
			</ul>
		</div>
		
		<div class="clear"></div>
	</div>
</div>