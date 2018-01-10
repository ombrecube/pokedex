<?php

function imgToThumb($oldname, $newh = 240) {
	$a = explode("/", $oldname);
	$b = $a[count($a)-1];
	$newname = "thumbnails/thumb_".$b;

	if(!file_exists($newname)) {
		$size = getImageSize($oldname);
		$w = $size[0];
		$h = $size[1];
		$neww = intval($newh * $w / $h);

		// echo "Previous: $w x $h \n";
		// echo "Now: $neww x $newh \n";

		$resimage = imagecreatefromjpeg($oldname);
		$newimage = imagecreatetruecolor($neww, $newh); // use alternate function if not installed
		imageCopyResampled($newimage, $resimage,0,0,0,0,$neww, $newh, $w, $h);

		imageJpeg($newimage, $newname, 85);

	}

	return $newname;
}


