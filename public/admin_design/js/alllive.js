$(document).ready(function(){
	var url = $('input[name="url"]').val();
	var t="<img src='" + url + "/admin_design/images/edit.png' class='editimg' style='width:14px;margin-right:5px;cursor:pointer'>";
	var input="<input type='text' style='width:70px'>";
	var tt="<input type='datetime-local' style='width:140px'>";
	var load = "<i class='fa fa-spin fa-spinner load hidden'></i>";
	var time="<input type='time' style='width:130px'>";
	var del="<img src='" + url + "/admin_design/images/delete.png' style='width:20px;margin-right:5px;cursor:pointer;height:20px' class='delimg'>";
	let isTextNode = (_, el) => el.nodeType === Node.TEXT_NODE;
	$(".submit").hide();
	$("td").prepend(t);
	$("tr td.d").prepend(del + load);
	$("tr td.d img").hide();
	$("td img").hide();

	
	
	$(".basic .basicform .deletel").on("click",function(){
		$("td.d img.delimg").toggle();
		$(".submit").show();
	});
		
	$("td.d img.delimg").on("click",function(){
		//$(this).parent(".d").parent("tr").remove();
	});
		
	/* edit */
	$(".basic .basicform .editl").on("click",function(){
	$("td img").not($(".delimg")).toggle();
		$(".submit").show();
	});
	
	$(".basic .basicform .editl").on("click",function(){
		$("td img").not($(".delimg")).on("click",function(){
			$(this).hide();
			var t=$(this).parent("td").text();
			$(this).parent("td").not($(".d")).not($(".time")).prepend(input);
			$(this).parent("td").not($(".d")).not($(".time")).find("input[type=text]").val(t);
			$(this).parent("td").not($(".d")).not($(".time")).contents().filter(isTextNode).remove();
		});
	});
	$("td img").not($(".delimg")).on("click",function(){
		$(this).hide();
		$(this).parent("td.d").prepend(tt);
		$(this).parent("td.d").css("overflow","visible");
		$(this).parent("td.d").contents().filter(isTextNode).remove();
	});

	$("td img").not($(".delimg")).on("click",function(){
		$(this).hide();
		$(this).parent("td.time").prepend(time);
		$(this).parent("td.time").css("overflow","visible");
		$(this).parent("td.time").contents().filter(isTextNode).remove();
	});
});