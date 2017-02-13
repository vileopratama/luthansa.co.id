<?php
namespace App\Classes;
use ImageManager;

class Img {
	public static function resize($image_location,$width,$height) {
		$img = ImageManager::getImagePath(public_path().$image_location, $width, $height, 'fit');
		return url($img);
	}
}