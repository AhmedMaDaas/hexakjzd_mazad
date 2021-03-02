
$(document).ready(function(){
	$(".info .basic .newformlive .date").hide();
	$(".info .basic .newformlive .murl").hide();
	$(".info .basic .newformlive .mminute").hide();
	$(".info .basic .newformlive .mnumber").hide();
$(".info .basic .newformlive .submit").on("click",function(){
if(!$(".info .basic .newformlive table tr td input[type=datetime-local]").val())
	{
		$(".info .basic .newformlive .date").show();
	}
	else
		$(".info .basic .newformlive .date").hide();
	
		if(!$(".info .basic .newformlive table tr .url input[type=text]").val())
			$(".info .basic .newformlive .murl").show();
	else
		$(".info .basic .newformlive .murl").hide();
	
	if(!$(".info .basic .newformlive table tr td.minutes input[type=text]").val())
				{	$(".info .basic .newformlive .mminute").show();}
			else
				$(".info .basic .newformlive .mminute").hide();
});
		$(".info .basic .newformlive table tr td input[type=text]").not($('.urlinput')).blur(function(){
		var v=$(this).val();
		if(!$.isNumeric(v))
			$(".info .basic .newformlive .mnumber").show();
			else
					$(".info .basic .newformlive .mnumber").hide();
					if(!$(this).val())
				$(".info .basic .newformlive .mnumber").hide();
			
		
	});
});