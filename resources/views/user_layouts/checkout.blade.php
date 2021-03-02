
<script>
$(document).on('click','#payment',function(){
	alert('s');

	var meta = $('#meta-token').attr('content');

	$.ajax({
        url: "{{route('checkout')}}",
        type: 'POST',
        data:{
            '_token': meta,

        },
        dataType: 'json',
        success: function(response){
          alert(response);
        },
        error: function(response){
            alert('error');
        },
    });
});

</script>