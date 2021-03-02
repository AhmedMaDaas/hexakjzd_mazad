$(document).ready(function(){
	var t="<tr class='newproduct' style='margin-top:10px'><td><input type='text'></td>fffff<td><img src='images/camera.png' class='camera'><input type='file' required hidden></td><td class='checknew'><img class='newimg' src='images/check.png'></td><td class='checkedit'><img class='editimg' src='images/check.png'></td><td class='checkdelete'><img class='deletimg' src='images/check.png'></td></tr>";

	/*aSettings*/
		
	$(".formlive").hide();
	$(".formlive table tr td #edit").hide();
	$(".formlive table tr td .dimg").hide();
	$(".all .content .info .basic .formlive .submit").hide();
	//$(".formlive table tr.newproduct").hide();
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
	$(".formlive .whatsapp img#edit").click(function(){
		$(".formlive .whatsapp").hide();
		$(".formlive .welcomeinput").show();
	});
	$(".formlive table tr th.edit,.formlive table tr th.new,.formlive table tr th.delete,.formlive .whatsapp img#edit").click(function(){
			$(".all .content .info .basic .formlive .submit").show();
	});
	
	$(".formlive input[type=text]").focus(function(){
				$(".all .content .info .basic .formlive .submit").show();
	});
	$(".formlive table tr.newproduct td img.camera").click(function(){
		$(".formlive table tr.newproduct td input[type=file]").click();
	});
			$(".all .content .navbar .list").click(function(){
			$(".all .sidebar").toggleClass("width");
			$(".all .sidebar .logo img").toggleClass("test");
			$(".all .sidebar .logo").toggleClass("effectlogo")
			$(".all .content").toggleClass("b");
		$(".all .sidebar .multi").children("li").children("a").toggle();
			$(".all .sidebar .logo").children("p").toggle();
			$(".all .row .sidebar .multiple .multi .aliveul").toggleClass("sub");
			$(".all .sidebar .multiple .multi .robot .robotul").toggleClass("subb");
		});
	
	$(".info .basic .formbasic .speaker").click(function(){
		$(".fileaudio").click();
	});

	$(".info .basic .formbasic .camera").click(function(){
		$(".ad-photo").click();
	});

	$(".info .basic .formbasic .wmsg #edit").click(function(){
		$(this).hide();
		var l=$(".info .basic .formbasic .wmsg p").html();
		$(".info .basic .formbasic .wmsg p").remove();
		$(this).siblings("input[type=text]").show();
		$(".info .basic .formbasic .wmsg input[type=text]").val(l);
	});
	/*New*/
		$(".formlive table tr td#p input[type=text]").hide();
		$(".formlive table tr th.new").click(function(){
			$(".formlive table").append(t);
		$(".formlive table tr:last td.checknew .newimg").show();
			$(".formlive table tr:last td.checknew .newimg").on("click",function(){
			 $(this).parent("td").parent("tr").find("td").children().hide(); /*من هون عم ينحذف سطر الى
			                                                                         جرب الremove 
																					 انا حسيت يمكن يصير خطأ اذا حطيتا 
																					ودمتم
																					 new*/
			});
	});
	/*Delete*/
	$(".formlive table tr th.delete").click(function(){
			$(".formlive table tr td.checkdelete .deletimg").toggle();	
			$(".formlive table tr td.checkdelete .deletimg").on("click",function(){
			$(this).parent(".checkdelete").parent("tr").remove();
			
			});
	});
	
	/*Edit*/
	$(".formlive table tr td#p #edit").click(function(){
		$(this).parent("td#p").find("input[type=text]").show();
		var t=$(this).parent("td#p").text();
	  $(this).parent("td#p").find("input[type=text]").val(t);
		  $(this).parent("td#p").parent("tr").find(".editimg").show();
		$(this).hide();	

	});
			  $(".editimg").on("click",function(){
					 $(this).parent("td").parent("tr").find("td").children().not($(".contentt")).hide();  
																  
				  });
		

	/*Edit For Pic*/
		$(".formlive table tr td.pimage img#edit").click(function(){
		  $(this).parent("td.pimage").parent("tr").find(".editimg").show();
		$(this).siblings("input[type=file]").click();
		$(this).hide();
		
	});

		

});