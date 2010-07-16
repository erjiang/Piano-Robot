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

    ignore_user_abort(true); // don't stop processing the page

    exec(sprintf('gs -dQUIET -dBATCH -dSAFER -dNOPAUSE -dNOPROMPT ' .
            '-r%d -sDEVICE=pnggray -dAlignToPixels=0 -dGridFitTT=0 ' .
            '-dGraphicsAlphaBits=2 -dTextAlphaBits=4 -dUseCropBox ' .
            '-dFirstPage=%d -dLastPage=%d -sOutputFile=- "%s" | ' .
            'convert png:- -filter catrom -resize %dx%d -type Grayscale ' .
            '"%s"',
		Configure::read('PDFDisplay.dpi'),
		$page, $page,
		$pdfpath,
		$height, $height,
		$imagename));
}

// since we chose not to abort if the user hits STOP, check here if
// we still need to send back data
if(connection_status() != CONNECTION_NORMAL) {
    exit;
}

$imageHandle = fopen($imagename, 'r');
fpassthru($imageHandle);
