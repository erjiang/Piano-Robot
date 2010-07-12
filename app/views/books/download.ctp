<?php
$md5sum = $book['Book']['filename'];
$initial = substr($md5sum, 0, 1);
$pdfpath = sprintf("%s%s/%s.pdf", PDF_STORE, $initial, $md5sum);

header('Content-Type: application/pdf');
header(sprintf('Content-Disposition: attachment; filename="%s - %s.pdf"',
        $book['Book']['creator'],
        $book['Book']['title']));

readfile($pdfpath);

?>
