$(document).ready(function(){
	var url = $('input[name="url"]').val();
	var approval="<img src='" + url + "/admin_design/images/user.png' style='cursor:pointer' class='appimg'>";
	var notapproval="<img src='" + url + "/admin_design/images/question.png' style='cursor:pointer' class='nappimg'>";
	var unblock="<img src='" + url + "/admin_design/images/blockg.png' style='cursor:pointer;width:30px;height:30px' class='unbimg'>";
	var block="<img src='" + url + "/admin_design/images/blockr.png' style='cursor:pointer;width:28px;height:28px' class='bimg'>";
	// $("table tr td.approval").append(approval);
	// $("table tr td.approval").append(notapproval);
	// $("table tr td.approval .nappimg").hide();
	
	// 	$("table tr td.block").append(block);
	// $("table tr td.block").append(unblock);
	// $("table tr td.block .unbimg").hide();
	
	
		$("table tr td.approval img.appimg").on("click",function(){
				$(this).siblings("img.nappimg").show();
		$(this).hide();
				$("table tr td.approval img.nappimg").on("click",function(){
		$(this).siblings("img.appimg").show();
			$(this).hide();
		});
	
	
		});
	
			$("table tr td.block img.bimg").on("click",function(){
				$(this).siblings("img.unbimg").show();
		$(this).hide();
				$("table tr td.block img.unbimg").on("click",function(){
		$(this).siblings("img.bimg").show();
			$(this).hide();
		});
	
	
		});
	$(".info .searchby").on("click",function(){
		$(".info .search ul").slideToggle();
	
	});
	$(".info .search .inputsearch").hide();
	$(".info .search ul li").on("click",function(){
		$(".info .search .inputsearch").show(500);
		$(".info .search ul").slideToggle();
		
	});
	$(".info .search .inputsearch input[type=text]").focusin(function(){
	$(this).addClass("css");
	
	});
	
	var editimg="<img src='" + url + "/admin_design/images/edit.png' style='width:16px;height:16px;margin-right:5px;cursor:pointer' class='editi' >";
	var checkimg="<img src='" + url + "/admin_design/images/check.png' style='width:16px;height:16px;margin-right:5px;cursor:pointer' class='checki'>";
	$("table tr td.locinput").prepend(editimg);
	$("table tr td.locinput").prepend(checkimg);
	$("table tr td.locinput .editi").hide();
	$("table tr td.locinput .checki").hide();
	$(".basic .basicform .editl").on("click",function(){
		$("table tr td.locinput .editi").toggle();
	});

	$("table tr td.locinput input[type=text]").focusin(function(){
		$(this).siblings(".checki").show();
	});

	$("table tr td.locinput .checki").on("click",function(){
		$(this).siblings("input[type=text]").hide();
		$(this).hide();
	});

	let isTextNode = (_, el) => el.nodeType === Node.TEXT_NODE;
	
	$("table tr td.locinput .editi").on("click",function(){
		$(this).hide();
		$(this).siblings(".checki").show();
		v = $(this).parent("td.locinput").text().replace(/^\s+|\s+$/gm,'');;
		$(this).siblings("input[type=text]").show();
		$(this).siblings("input[type=text]").val(v);
		$(this).parent("td.locinput").contents().filter(isTextNode).remove();	
	});

	//////////////////////////////////////////////

	$("table tr td.numinput").prepend(editimg);
	$("table tr td.numinput").prepend(checkimg);
	$("table tr td.numinput .editi").hide();
	$("table tr td.numinput .checki").hide();
	$(".basic .basicform .editl").on("click",function(){
		$("table tr td.numinput .editi").toggle();
	});

	$("table tr td.numinput input[type=text]").focusin(function(){
		$(this).siblings(".checki").show();
	});

	$("table tr td.numinput .checki").on("click",function(){
		$(this).siblings("input[type=text]").hide();
		$(this).hide();
	});
	
	let isText = (_, el) => el.nodeType === Node.TEXT_NODE;
	
	$("table tr td.numinput .editi").on("click",function(){
		$(this).hide();
		$(this).siblings(".checki").show();
		v = $(this).parent("td.numinput").text().replace(/^\s+|\s+$/gm,'');;
		$(this).siblings("input[type=text]").show();
		$(this).siblings("input[type=text]").val(v);
		$(this).parent("td.numinput").contents().filter(isText).remove();
	});
});