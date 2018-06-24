<?php
$width = 350;
$height = 360;
header("Content-type: image/png");

$im = ImageCreateTrueColor($width, $height);

// switch on image antialising if it is available
ImageAntiAlias($im, true);

// sets background to white
$white = ImageColorAllocate($im, 255, 255, 255); 
ImageFillToBorder($im, 0, 0, $white, $white);

// define black and blue colours
$black = ImageColorAllocate($im, 0, 0, 0);
$blue = ImageColorAllocate($im, 0, 0, 255);


function drawDiamond($x, $y, $width, $colour, $filled) {
	// access the global image reference (the one outside this function)
	global $im;

	// here we work out the four points of the diamond
	$p1_x = $x;
	$p1_y = $y+($width/2);

	$p2_x = $x+($width/2);
	$p2_y = $y;

	$p3_x = $x+$width;
	$p3_y = $y+($width/2);

	$p4_x = $x+($width/2);
	$p4_y = $y+$width;

	// now create an array of points to store these four points
	$points = array($p1_x, $p1_y, $p2_x, $p2_y, $p3_x, $p3_y, $p4_x, $p4_y);

	// the number of vertices for our polygon (four as it is a diamond
	$num_of_points = 4;
	
	if ($filled) {
		// now draw out the filled polygon
		ImageFilledPolygon($im, $points, $num_of_points, $colour);
	}else{
		// draw out an empty polygon
		ImagePolygon($im, $points, $num_of_points, $colour);
	}
}

// now draw the two diamonds
drawDiamond(120, 50, 100, $black, false);
drawDiamond(120, 200, 100, $blue, true);

// send the new PNG image to the browser
ImagePNG($im); 

// destroy the reference pointer to the image in memory to free up resources
ImageDestroy($im); 

?>