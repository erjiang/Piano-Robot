<?php
$md5sum = $book['Book']['filename'];
$initial = substr($md5sum, 0, 1);
$pdfpath = sprintf("%s%s/%s.pdf", PDF_STORE, $initial, $md5sum);
if(!is_file($pdfpath)) {
	echo $pdfpath . " not found!";
	exit;
}
header("Content-type: image/png");
passthru(sprintf('convert -density %d -crop 100%%x20%%+0+0 "%s"[%d] -type Grayscale -resize 600x120 png:-',
	Configure::read('PDFDisplay.dpi'), $pdfpath, $page - 1));

 ?>
