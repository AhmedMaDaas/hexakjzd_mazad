$(document).ready(function(){
//	var t="<tr class='newproduct' style='margin-top:10px'><td id='p'><input type='text' style='width:190px'></td>fffff<td><img src='images/add.png' style='cursor:pointer' class='adduser'></td><td><img src='images/add.png' style='cursor:pointer' class='addtimer'></td><td class='checknew'><img class='newimg' src='images/check.png'></td><td class='checkedit'><img class='editimg' src='images/check.png'></td><td class='checkdelete'><img class='deletimg' src='images/check.png'></td></tr>";//

	/*aSettings*/

	$(".basic table tr td #edit").hide();
	$(".all .content .info .basic .formlive .submit").hide();
	//$(".formlive table tr.newproduct").hide();
	
	// sidebar
	$(".basicinfo .binfo").addClass("effect");
	
	

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
	
////
	
	/*New*/
			$(".newproduct").hide();
		$(".basic table tr:not('.newproduct') input[type=text]").hide();
		$(".basic table tr th.new").click(function(){
			$(".basic table .newproduct").show();
		$(".basic table tr.newproduct td.checknew .newimg").show();
			$(".basic table tr.newproduct td.checknew .newimg").on("click",function(){
			 // $(this).parent("td").parent("tr.newproduct").children("td#p").children("input[type='text']").hide(); 
				// $(this).hide();			                      
			});

	});
	/*Delete*/
	$(".basic table tr th.delete").click(function(){
			$(".basic table tr td.checkdelete .deletimg").toggle();	
			$(".basic table tr td.checkdelete .deletimg").on("click",function(){
			//$(this).parent(".checkdelete").parent("tr").remove();
			
			});
	});
	
	/*Edit*/
		$(".basic table tr th.edit").click(function(){
		$(".basic table tr td #edit").toggle();
		
	});
		let isTextNode = (_, el) => el.nodeType === Node.TEXT_NODE;
	$(document).on('click', '.basic table tr td#p #edit', function(){
		$(this).parent("td#p").find("input[type=text]").show();
		var t=$(this).parent("td#p").text().replace(/^\s+|\s+$/gm,'');
	  $(this).parent("td#p").find("input[type=text]").val(t);
		  $(this).parent("td#p").parent("tr").find(".editimg").show();
		$(this).hide();	
			$(this).parent("td#p").contents().filter(isTextNode).remove();
			$(".basic table tr td.timer input[type=time]").change(function(){
	  $(this).parent("td.timer").parent("tr").find(".editimg").show();
				
		
		
	
	});

	});
	  $(document).on("click", ".editimg",function(){
					 // $(this).parent("td").parent("tr").children("td#p").children("input[type='text']").hide();  
						// 	$(this).hide();									  
				  });

		
			/*السيليكت تبع اليوزر*/
$(".userselect .first").on("click",function(){
	$(this).parent(".userselect").children("ul").toggle();

});
	$(".userselect ul li").click(function(){
	$(this).toggleClass("eff");
		  $(this).parent("ul").parent(".userselect").parent(".uselect").parent("tr").find(".editimg").show()
	
	});
// تبع السيرش
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