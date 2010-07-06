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
<script type="text/javascript">
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
	$("#left").css({'opacity': 0.3});
	$("#right").css({'opacity': 0.3});
	$("#left").bind('load', function (e) {
		$(this).css({'opacity': 1.0});
	});
	$("#right").bind('load', function (e) {
		$(this).css({'opacity': 1.0});
	});

	$("#left").attr("src","/books/page/"+id+"/"+currentPage+"/"+height);
	if(currentPage < maxPage) {
		$("#right").show();
		$("#right").attr("src","/books/page/"+id+"/"+(currentPage+1)+"/"+height);
	} else {
		$("#right").hide();
		$("#right").removeAttr("src");
	}
	$("#pageNumber").val(currentPage);

}

function nextPage () {
	currentPage -= 2;
	if(currentPage < 1) {
		currentPage = 1;
	}
	currentPage = makeOdd(currentPage);
	changePages();
}

function prevPage () {
	currentPage += 2;
	if(currentPage > maxPage) {
		currentPage = maxPage;
	}
	currentPage = makeOdd(currentPage);
	changePages();
}

$(document).ready(function () {
	$("#prevPage").click(function () {
		nextPage();
	});
	$("#nextPage").click(function () {
		prevPage();
	});
});

$(document).keydown(function (e) {
	switch (e.keyCode) {
		case 40:
			alert('down');
			break;
		case 38:
			alert('up');
			break;
		case 37: // right arrow
		case 34: // page down
			nextPage();
			break;
		case 39: // left arrow
		case 33: // page up
			prevPage();
			break;
		default:
	}
});
</script>
