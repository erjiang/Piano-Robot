<?php
if(!isset($height) || !$height) {
	$height = Configure::read('PDFDisplay.height');
}
if(!isset($page) || !$page) {
	$page = 1;
}
$id = $book['Book']['id'];

$this->Html->script('jquery.history.js', false);

?>
<div id="topbar">
<form id="pageForm">
<input type="button" id="prevPage" value="<<" />
<input type="text" id="pageNumber" />
<input type="button" id="pageGo" value="Go" />
<input type="button" id="nextPage" value=">>" />
</form>
</div>
<div id="pages" style="white-space:nowrap">
<img id="left" class="books page" /><img id="right" class="books page" />
</div>
<script type="text/javascript">

var currentPage = 1;

// Set up the jquery.history plugin to allow the back/forward
// browser buttons to function as expected
$.history.init(
	// everything has to go through history.load in
    // order to make it available for back/forward buttons
	function(num) {
		if(num) {
			loadPage(parseInt(num));
		} else {
			loadPage(1);
		}
});

var height = <?php echo $height; ?>;
var id = <?php echo $id; ?>;
var maxPage = <?php echo $book['Book']['length']; ?>;
function makeOdd(number) {
	if(number % 2 == 0) {
		number -= 1;
	}
	return number;
}

function loadPage(num) {
	if(currentPage != num) {
		currentPage = num;
		changePages();
	}
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
	if(currentPage > 1) {
	    window.location.hash = '#'+currentPage;
	}
	// preload next two pages
	if(currentPage + 2 <= maxPage) { //check bounds
		preloadImage("/books/page/"+id+"/"+(currentPage+2)+"/"+height);
	}
	if(currentPage + 3 <= maxPage) {
		preloadImage("/books/page/"+id+"/"+(currentPage+3)+"/"+height);
	} 
}
// Image preloading stuff
var imgCache = [];
function preloadImage(url) {
	var cacheImage = document.createElement('img');
	cacheImage.src = url;
	imgCache.push(cacheImage);
}

function nextPage () {
	$.history.load(fixPage(currentPage + 2));
}

function prevPage () {
	$.history.load(fixPage(currentPage - 2));
}

function fixPage (page) {
    if(page < 1) {
        return 1;
    }
    if(page > maxPage) {
        page = maxPage;
    }
    if(page % 2 == 0) {
        page--;
    }
    return page;
}

$(document).ready(function () {
	$("#prevPage").click(function () {
		prevPage();
	});
	$("#nextPage").click(function () {
		nextPage();
	});
    $("#pageNumber").focus();
    $("#pageGo").click(function () {
        var fixed = parseInt($("#pageNumber").val());
        if(isNaN(fixed)) {
            $("#pageNumber").val(currentPage);
            return;
        }
        fixed = fixPage(fixed);
        $("#pageNumber").val(fixed);
        loadPage(fixed);
    });
    $("#pageForm").submit(function () {
        $("#pageGo").click();
        return false;
    });
    currentPage = fixPage(currentPage);
    changePages();
});

$(document).keydown(function (e) {
	switch (e.keyCode) {
		case 40:
			//alert('down');
			break;
		case 38:
			//alert('up');
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
