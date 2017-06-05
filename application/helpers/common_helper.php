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
