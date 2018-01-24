
	$.ajaxSetup({

         headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }
    });

	$(function(){
		$("body").on("click","a[data-type=delete]",function(){
		    var c_obj = $(this).parents("tr");
		    var url = $(this).data('url') ;
		    var type = $(this).data('request') ? $(this).data('request') : 'delete' ;
		    //alert(url);
		    $.ajax({

		        dataType: 'json',

		        type:type,

		        url: url ,

		    }).done(function(data){

		        c_obj.remove();
		        //var data = JSON.parse(data.responseText);
		        //console.log(data);
		        toastr.success(data.success, '', {timeOut: 1000});

		       // getPageData();

		    }).fail(function(data){
		    	var data = JSON.parse(data.responseText);
				toastr.error(data.error,'',{"positionClass": "toast-top-full-width","timeOut": "2000"});
		    });

	    });
	});
