<?php
if(!isset($height) || !$height) {
	$height = Configure::read('PDFDisplay.height');
}
if(!isset($page) || !$page) {
	$page = 1;
}
$id = $book['Book']['id'];

?>
<form id="pageForm">
<input type="button" id="prevPage" value="<<" />
<input type="text" id="pageNumber" />
<input type="button" id="pageGo" value="Go" />
<input type="button" id="nextPage" value=">>" />
</form>
<br />
<img id="left" class="books page" />

<img id="right" class="books page" />
<script type="text/javascript">
var currentPage = 1;
if(window.location.hash != "") {
    currentPage = parseInt(window.location.hash.slice(1));
}
var height = <?php echo $height; ?>;
var id = <?php echo $id; ?>;
var maxPage = <?php echo $book['Book']['length']; ?>;
function makeOdd(number) {
	if(number % 2 == 0) {
		number -= 1;
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
    window.location.hash = '#'+currentPage;
}

function nextPage () {
    var oldPage = currentPage;
	currentPage = fixPage(currentPage - 2);
    if(oldPage != currentPage) {
        changePages();
    }
}

function prevPage () {
    var oldPage = currentPage;
	currentPage = fixPage(currentPage + 2);
    if(oldPage != currentPage) {
        changePages();
    }
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
		nextPage();
	});
	$("#nextPage").click(function () {
		prevPage();
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
        currentPage = fixed;
        changePages();
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
