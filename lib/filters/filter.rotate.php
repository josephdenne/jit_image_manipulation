<?php

	require_once(realpath(dirname(__FILE__).'/../') . '/class.imagefilter.php');

	Class FilterRotate extends ImageFilter{

		public static function run($res, $rotation=NULL, $background=NULL){

			// replace transparent background with another color (imagefill or via imagecolortransparent)
			$color = self::html2rgb($background);
			$stubColor = imagecolorallocate($res, $color[0], $color[1], $color[2]);
			imagefill($res, 0, 0, $stubColor);
			$imgcolors = imagecolorstotal($res);

			// rotate the image anticlockwise
			$resRotated = imagerotate($res, $rotation, $stubColor);
			imagedestroy($res);

			// replace color with transparent
			imagetruecolortopalette($resRotated, false, $imgcolors);
			imagecolortransparent($resRotated, imagecolorat($resRotated, 0, 0));

			return $resRotated;
		}

		public static function html2rgb($color){

			if (strlen($color) == 6)
				list($r, $g, $b) = array($color[0].$color[1],
										 $color[2].$color[3],
										 $color[4].$color[5]);

			else if (strlen($color) == 3)
				list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);

			else
				return false;

			$r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
			return array($r, $g, $b);
		}
	}