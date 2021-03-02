$(document).ready(function(){
	var url = $('input[name="url"]').val();
	var t="<tr class='newproduct' style='margin-top:10px'><td><input name='name' type='text'></td>fffff<td><img src='" + url + "/admin_design/images/camera.png' class='camera'><input name='image' type='file' required hidden></td><td class='checknew'><img class='newimg' src='" + url + "/admin_design/images/check.png'><i class='fa fa-spin fa-spinner hidden'></td><td class='checkedit'><img class='editimg' src='" + url + "/admin_design/images/check.png'></td><td class='checkdelete'><img class='deletimg' src='" + url + "/admin_design/images/check.png'></td></tr>";
	
	var h=$(window).height();
  	$(".all .content .info").css("height",h);
	/*aSettings*/
		
	$(".formlive").hide();
	$(".formlive table tr td #edit").hide();
	$(".formlive table tr td .dimg").hide();
	$(".all .content .info .basic .formlive .submit").hide();
	//$(".formlive table tr.newproduct").hide();
	$(".basicinfo .binfo").addClass("effect");
	$(".all .sidebar .multiple .multi .alive .aliveul").hide();
	$(".all .sidebar .multiple .multi .robot .robotul").hide();
	$(".all .sidebar .multiple .multi .alive").on('click', function(){
		$(".all .sidebar .multiple .multi .alive .aliveul").slideToggle();
	});
	$(".all .sidebar .multiple .multi .robot .robotul").hide();
	$(".all .sidebar .multiple .multi .robot").on('click', function(){
		$(".all .sidebar .multiple .multi .robot .robotul").slideToggle();
	});
	
		$(document).on('click', ".linfo", function(){
		$(".formbasic").hide();
		$(".formlive").show();
			$(".basicinfo .binfo").removeClass("effect");
		$(".basicinfo .linfo").addClass("effect");
	});
		$(document).on('click', ".binfo", function(){
		$(".formbasic").show();
		$(".formlive").hide();
		$(".basicinfo .binfo").addClass("effect");
		$(".basicinfo .linfo").removeClass("effect");
	});
	$(document).on('click', ".formlive table tr th.edit", function(){
		$(".formlive table tr td #edit").toggle();
		
	});
	$(document).on('click', ".formlive .whatsapp img#edit", function(){
		$(".formlive .whatsapp").hide();
		$(".formlive .welcomeinput").show();
	});
	$(document).on('click', ".formlive table tr th.edit,.formlive table tr th.new,.formlive table tr th.delete,.formlive .whatsapp img#edit", function(){
			$(".all .content .info .basic .formlive .submit").show();
	});
	
	$(".formlive input[type=text]").focus(function(){
				$(".all .content .info .basic .formlive .submit").show();
	});
	$(document).on('click', ".formlive table tr.newproduct td img.camera", function(){
		$(".formlive table tr.newproduct td input[type=file]").click();
	});
	$('.all .content .navbar .list').on('click', function(){
		$(".all .sidebar").toggleClass("width");
		$(".all .sidebar .logo img").toggleClass("test");
		$(".all .sidebar .logo").toggleClass("effectlogo")
		$(".all .content").toggleClass("b");
		$(".all .sidebar .multi").children("li").children("a").toggle();
		$(".all .sidebar .logo").children("p").toggle();
		$(".all .sidebar .multiple .multi .aliveul").toggleClass("sub");
		$(".all .sidebar .multiple .multi .robot .robotul").toggleClass("subb");
	});
	
	$(document).on('click', ".info .basic .speaker", function(){
		$(this).parent('div').find(".fileaudio").click();
		$(this).parent('div').parent('form').find('button').show();
	});

	$(document).on('click', ".info .basic .formbasic .camera", function(){
		$('.' + $(this).attr('id')).click();
	});

	$(document).on('click', ".info .basic .formbasic .wmsg #edit", function(){
		$(this).hide();
		var l=$(".info .basic .formbasic .wmsg p").html();
		$(".info .basic .formbasic .wmsg p").remove();
		$(this).siblings("input[type=text]").show();
		$(".info .basic .formbasic .wmsg input[type=text]").val(l);
	});
	/*New*/
		$(".formlive table tr td#p input[type=text]").hide();
		$(document).on('click', ".formlive table tr th.new", function(){
			$(".formlive table").append(t);
			$(".formlive table tr:last td.checknew .newimg").show();
			$(".formlive table tr:last td.checknew .newimg").on("click",function(){
			 //$(this).parent("td").parent("tr").find("td").children().hide();
			});
	});
	/*Delete*/
	$(document).on('click', ".formlive table tr th.delete", function(){
		$(".formlive table tr td.checkdelete .deletimg").toggle();	
		$(".formlive table tr td.checkdelete .deletimg").on("click",function(){
			//$(this).parent(".checkdelete").parent("tr").remove();
		
		});
	});
	
	/*Edit*/
	$(document).on('click', ".formlive table tr td#p #edit", function(){
		let isTextNode = (_, el) => el.nodeType === Node.TEXT_NODE;
		$(this).parent("td#p").find("input[type=text]").show();
		var t=$(this).parent("td#p").text();
	  	$(this).parent("td#p").find("input[type=text]").val(t);
		$(this).parent("td#p").parent("tr").find(".editimg").show();
		$(this).parent("td#p").contents().filter(isTextNode).remove();
		$(this).hide();	

	});
	$(document).on("click", ".editimg", function(){
		//$(this).parent("td").parent("tr").find("td").children().not($(".contentt")).hide();  												  
	});
		

	/*Edit For Pic*/
	$(document).on('click', ".formlive table tr td.pimage img#edit", function(){
		$(this).parent("td.pimage").parent("tr").find(".editimg").show();
		$(this).siblings("input[type=file]").click();
		$(this).hide();
		
	});

		

});