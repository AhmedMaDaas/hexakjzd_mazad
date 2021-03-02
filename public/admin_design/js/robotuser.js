$(document).ready(function(){
	var t="<tr class='newproduct' style='margin-top:10px'><td><input type='text'></td>fffff<td><img src='images/camera.png' class='camera'><input type='file' required hidden></td><td class='checknew'><img class='newimg' src='images/check.png'></td><td class='checkedit'><img class='editimg' src='images/check.png'></td><td class='checkdelete'><img class='deletimg' src='images/check.png'></td></tr>";

	/*aSettings*/
		
	$(".formlive").hide();
	$(".formlive table tr td #edit").hide();
	$(".formlive table tr td .dimg").hide();
	$(".basicinfo .binfo").addClass("effect");
	$(".all .sidebar .multiple .multi .alive .aliveul").hide();
	$(".all .sidebar .multiple .multi .robot .robotul").hide();
		$(".all .sidebar .multiple .multi .alive").click(function(){
		$(".all .sidebar .multiple .multi .alive .aliveul").slideToggle();
	});
	$(".all .sidebar .multiple .multi .robot .robotul").hide();
		$(".all .sidebar .multiple .multi .robot").click(function(){
		$(".all .sidebar .multiple .multi .robot .robotul").slideToggle();
	});
	
		$(".linfo").click(function(){
		$(".formbasic").hide();
		$(".formlive").show();
			$(".basicinfo .binfo").removeClass("effect");
		$(".basicinfo .linfo").addClass("effect");
	});
		$(".binfo").click(function(){
		$(".formbasic").show();
		$(".formlive").hide();
		$(".basicinfo .binfo").addClass("effect");
		$(".basicinfo .linfo").removeClass("effect");
	});
	$(".formlive table tr th.edit").click(function(){
		$(".formlive table tr td #edit").toggle();
		
	});
	
			$(".all .content .navbar .list").click(function(){
			$(".all .sidebar").toggleClass("width");
			$(".all .sidebar .logo img").toggleClass("test");
			$(".all .sidebar .logo").toggleClass("effectlogo")
			$(".all .content").toggleClass("b");
		$(".all .sidebar .multi").children("li").children("a").toggle();
			$(".all .sidebar .logo").children("p").toggle();
			$(".all .sidebar .multiple .multi .aliveul").toggleClass("sub");
			$(".all .sidebar .multiple .multi .robot .robotul").toggleClass("subb");
		});
	
	/*New*/
		$(".formlive table tr td#p input[type=text]").hide();

	/*Delete*/
	$(".formlive table tr th.delete").click(function(){
			$(".formlive table tr td.checkdelete .deletimg").toggle();	
			$(".formlive table tr td.checkdelete .deletimg").on("click",function(){
			$(this).parent(".checkdelete").parent("tr").remove();
			
			});
	});
	
		let isTextNode = (_, el) => el.nodeType === Node.TEXT_NODE;
	/*Edit*/
	$(".formlive table tr td#p #edit").click(function(){
		$(this).parent("td#p").find("input[type=text]").show();
		var t=$(this).parent("td#p").text();
	
	  $(this).parent("td#p").find("input[type=text]").val(t);
		
		  $(this).parent("td#p").parent("tr").find(".editimg").show();
			$(this).parent("td#p").contents().filter(isTextNode).remove();
		$(this).hide();	

	});
			  $(".editimg").on("click",function(){
					 $(this).parent("td").parent("tr").find("td").children().not($(".contentt")).hide();  
																  
				  });

		

});