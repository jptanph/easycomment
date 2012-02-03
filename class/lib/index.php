<?php
	# start a session

	# this function is called recursivelly
	
	# create the random string using the upper function 
	# (if you want more than 5 characters just modify the parameter)

	$rand_str = $_GET['code'];
	# We memorize the md5 sum of the string into a session variable
	// $_SESSION['security_code'] = $rand_str;
	
	# Get each letter in one valiable, we will format all letters different
	$letter1 = substr($rand_str, 0, 1); $letter2 = substr($rand_str, 1, 1); $letter3 = substr($rand_str, 2, 1);
	$letter4 = substr($rand_str, 3, 1); $letter5 = substr($rand_str, 4, 1); $letter6 = substr($rand_str, 5, 1);
	
	# Select random background image
	$bg_image 	= "background/white.png";
	
	# Creates an image from a png file. 
	# If you want to use gif or jpg images, just use the coresponding 
	# functions: imagecreatefromjpeg and imagecreatefromgif.
	$image 		= imagecreatefrompng($bg_image);
	
	# Get a random angle for each letter to be rotated with.
	$angle1 = rand(-20, 20); $angle2 = rand(-20, 20); $angle3 = rand(-20, 20); $angle4 = rand(-20, 20); $angle5 = rand(-20, 20); $angle6 = rand(-20, 20);
	
	# Get a random font. (In this examples, the fonts are located in 
	# "fonts" directory and named from 1.ttf to 10.ttf)
	$font_dir = dirname(__FILE__) . "/fonts/";
	$font1 = "fonts/16.ttf"; $font2 = $font_dir . rand(11, 17) . ".ttf"; $font3 = $font_dir . rand(11, 17) . ".ttf"; $font4 = $font_dir . rand(11, 17) . ".ttf";
	$font5 = $font_dir . rand(11, 17) . ".ttf"; $font6 = $font_dir . rand(11, 17) . ".ttf";
	
	# Define a table with colors (the values are the RGB components for each color).
	$colors[0] = array(35, 113, 191);  $colors[1] = array(55, 85, 114); $colors[2] = array(55, 114, 85);
	$colors[3] = array(114, 21, 67); $colors[4] = array(0, 0, 0); $colors[5] = array(255, 120, 0);
	
	# Get a random color for each letter.
	$color1 = rand(0, 5); $color2 = rand(0, 5); $color3 = rand(0, 5); $color4 = rand(0, 5); $color5 = rand(0, 5); $color6 = rand(0, 5);
	
	# Allocate colors for letters.
	$textColor1 = imagecolorallocate ($image, $colors[$color1][0], $colors[$color1][1], $colors[$color1][2]);
	$textColor2 = imagecolorallocate ($image, $colors[$color2][0], $colors[$color2][1], $colors[$color2][2]);
	$textColor3 = imagecolorallocate ($image, $colors[$color3][0], $colors[$color3][1], $colors[$color3][2]);
	$textColor4 = imagecolorallocate ($image, $colors[$color4][0], $colors[$color4][1], $colors[$color4][2]);
	$textColor5 = imagecolorallocate ($image, $colors[$color5][0], $colors[$color5][1], $colors[$color5][2]);
	$textColor6 = imagecolorallocate ($image, $colors[$color5][0], $colors[$color6][1], $colors[$color6][2]);
	
	# Write text to the image using TrueType fonts.
	$size = 15; 
	$chart_start 	= 40; 
	$char_space 	= 23; 
	$y	= 29;
	
	imagettftext($image, $size, $angle1, $chart_start, $y, $textColor1, $font1, $letter1);
	imagettftext($image, $size, $angle2, $chart_start + ($char_space * 1), $y, $textColor2, $font2, $letter2);
	imagettftext($image, $size, $angle3, $chart_start + ($char_space * 2), $y, $textColor3, $font3, $letter3);
	imagettftext($image, $size, $angle4, $chart_start + ($char_space * 3), $y, $textColor4, $font4, $letter4);
	imagettftext($image, $size, $angle5, $chart_start + ($char_space * 4), $y, $textColor5, $font5, $letter5);
	imagettftext($image, $size, $angle6, $chart_start + ($char_space * 5), $y, $textColor6, $font6, $letter6);
	
	header('Content-type: image/png');
	# Output image to browser
	imagepng($image);
	# Destroys the image
	imagedestroy($image);
?>
