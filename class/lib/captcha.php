<?php
	$rand_str = md5(time());
	$rand_str = substr($rand_str, rand(0, 26), 6);
	$rand_str = strtoupper($rand_str);
?>

<img src="<?php echo PLUGIN_URL . "captcha/index.php?code=$rand_str&rand=" . rand(1000, 9999); ?>"/>

<script>
	PG_Easycomment_front['sc'] = '<?php echo $rand_str;?>';
</script>