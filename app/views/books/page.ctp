<?php
date_default_timezone_set('UTC');
header('Expires: '.date('r', time() + 600));

$md5sum = $book['Book']['filename'];
$initial = substr($md5sum, 0, 1);
$pdfpath = sprintf("%s%s/%s.pdf", PDF_STORE, $initial, $md5sum);
if(!is_file($pdfpath)) {
	echo $pdfpath . " not found!";
	exit;
}
if(!$height) {
	$height = Configure::read('PDFDisplay.height');
}

$imagename = sprintf("%spages/%s/%s/%d_%d.png", CACHE, $initial, $md5sum, $height, $page);
if(!file_exists(CACHE . "pages/$initial")) mkdir(CACHE . "pages/$initial");
if(!file_exists(CACHE . "pages/$initial/$md5sum")) mkdir(CACHE . "pages/$initial/$md5sum");

header("Content-type: image/png");
/*
 * Check if the needed file already exists
 */
if(!is_file($imagename)) {
	passthru(sprintf('convert -density %d "%s"[%d] -type Grayscale -resize %dx%d "%s"',
		Configure::read('PDFDisplay.dpi'),
		$pdfpath,
		$page - 1,
		$height, $height,
		$imagename));
}
$imageHandle = fopen($imagename, 'r');
fpassthru($imageHandle);

 ?>
