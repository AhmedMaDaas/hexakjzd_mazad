$(document).ready(function(){
	var url = $('input[name="url"]').val();
	var unblock="<img src='" + url + "/admin_design/images/blockg.png' style='cursor:pointer;width:30px;height:30px' class='unbimg'>";
	var block="<img src='" + url + "/admin_design/images/blockr.png' style='cursor:pointer;width:28px;height:28px' class='bimg'>";

	
	// 	$("table tr td.block").append(block);
	// $("table tr td.block").append(unblock);
	// $("table tr td.block .unbimg").hide();
	
		$("table tr td.approval img").click(function(){
		$(this).toggleClass("filter-red");
		
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


	

});