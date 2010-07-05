<?php
if(!isset($height) || !$height) {
	$height = Configure::read('PDFDisplay.height');
}
if(!isset($page) || !$page) {
	$page = 1;
}
$id = $book['Book']['id'];

?>
<input type="button" id="prevPage" value="<<" />
<input type="text" id="pageNumber" value="<?php echo $page; ?>" />
<input type="button" id="pageGo" value="Go" />
<input type="button" id="nextPage" value=">>" />
<br />
<img id="left" class="books page"
	src="/books/page/<?php echo $id; ?>/1/<?php echo $height; ?>" />

<img id="right" class="books page"
	src="/books/page/<?php echo $id; ?>/2/<?php echo $height; ?>" />

<script style="text/javascript">
var currentPage = <?php echo $page; ?>;
var height = <?php echo $height; ?>;
var id = <?php echo $id; ?>;
var maxPage = <?php echo $book['Book']['length']; ?>;
function makeOdd(number) {
	if(number % 2 == 0) {
		number--;
	}
	return number;
}
function changePages() {
	$("#left").attr("src","/books/page/"+id+"/"+currentPage+"/"+height);
	if(currentPage < maxPage) {
		$("#right").attr("src","/books/page/"+id+"/"+(currentPage+1)+"/"+height);
		$("#right").css({'display':'inline'});
	} else {
		$("#right").css({'display':'none'});
	}
	$("#pageNumber").val(currentPage);
	setLoading();
}

function setLoading() {
	$("#left").load(function () {
		$(this).css({'opacity': 1.0});
	});
	$("#right").load(function () {
		$(this).css({'opacity': 1.0});
	});
	$("#left").css({'opacity': 0.3});
	$("#right").css({'opacity': 0.3});
}

$(document).ready(function () {
	$("#prevPage").click(function () {
		currentPage -= 2;
		if(currentPage < 1) {
			currentPage = 1;
		}
		currentPage = makeOdd(currentPage);
		changePages();
	});
	$("#nextPage").click(function () {
		currentPage += 2;
		if(currentPage > maxPage) {
			currentPage = maxPage;
		}
		currentPage = makeOdd(currentPage);
		changePages();
	});
});
</script>
