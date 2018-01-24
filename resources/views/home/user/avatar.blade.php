@extends('home.layouts.user')
@section('content')
 	 <div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">     
			    <div class="modal-header">       
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Image Upload</h4> 
			    </div>      
			    <div class="modal-body">
			         <img width="100%"  src="" id="image_cropper">
			          <p class="text-center">   
			          <button type="button" class="btn btn-primary rotate" data-method="rotate" data-option="-30"><i class="fa fa-undo"></i></button>                      
			          <button type="button" class="btn btn-primary rotate" data-method="rotate" data-option="30"><i class="fa fa-repeat"></i></button> </p>            
			    </div>      
			    <div class="modal-footer"> 
				    <input type="button" class="btn btn-primary" id="Save" value="Save">  </button>        
				    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>      
			    </div>
			</div>    
		</div>
	</div> 
 	<div>@if($user->avatar)<img src="{{asset('storage/avatar/'.$user->avatar)}}"> @endif</div>
	<!-- File Upload Button -->
	<form id="FileUpload" action="{{route('user.storeavatar')}}" method="post" enctype="multipart/form-data"> 
	   <input type="hidden" name="cropped_value" id="cropped_value" value=""> 
	   <input type="file" name="file" id="cropper" /> 
	   
	</form>
	@include('error')
	
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/cropper.js') }}"></script>
<script>
	
$(function() {
/////// Cropper Options set 
var cropper;
 var options = {
     aspectRatio: 1 / 1,
     minContainerWidth: 570,
     minContainerHeight: 350,
     minCropBoxWidth: 100,
     minCropBoxHeight: 100,
     rotatable: true,
     cropBoxResizable: false,
     crop: function(e) {
        $("#cropped_value").val(parseInt(e.detail.width) + "," + parseInt(e.detail.height) + "," + parseInt(e.detail.x) + "," + parseInt(e.detail.y) + "," + parseInt(e.detail.rotate));
     }
 };
///// Show cropper on existing Image
$("body").on("click", "#image_source", function() {
    var src = $("#image_source").attr("src");
    src = src.replace("/thumb", "");
    $('#image_cropper').attr('src', src);
    $('#image_edit').val("yes");
    $("#myModal").modal("show");
});
///// Destroy Cropper on Model Hide
$("#myModal").on("hide.bs.modal", function() {
    //$(".cropper-container").remove();
    //$("#image_cropper").attr('src','');
    cropper.destroy();
});


/// Show Cropper on Model Show
 $("#myModal").on("show.bs.modal", function() {
    var image = document.getElementById('image_cropper');
    cropper = new Cropper(image, options);
});
///// Rotate Image 
$("body").on("click", ".rotate", function() {
     var degree = $(this).attr("data-option");
     cropper.rotate(degree);
 });
///// Saving Image with Ajax Call
$("body").on("click", "#Save", function() {
	//var url = "{{ route('user.storeavatar') }}"
    var form_data = $('#FileUpload')[0];
    $.ajax({
        url: "{{ route('user.storeavatar') }}", // Url to which the request is send
        type: "POST",
        mimeType: "multipart/form-data",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, // Type of request to be send, called as method
        data: new FormData(form_data), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        success: function(res) // A function to be called if request succeeds
        {
          //console.log("Image Crop with Laravel5.4 Intervention and CropperJS jQuery Success");
            $("#myModal").hide();
            cropper.destroy();
            location.reload();
        }
    });
 });

////// When user upload image 
$(document).on("change", "#cropper", function() {
     var imagecheck = $(this).data('imagecheck'),
     file = this.files[0],
     //file = this.file ,
     //alert(file);
     imagefile = file.type,
     _URL = window.URL || window.webkitURL;
     img = new Image();
     img.src = _URL.createObjectURL(file);
     img.onload = function() {
     var match = ["image/jpeg", "image/png", "image/jpg"];
     if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
        alert('Please Select A valid Image File');
        return false;
     } else {
       var reader = new FileReader();
       reader.readAsDataURL(file);
       //alert(file);
       reader.onloadend = function() { // set image data as background of div
       $(document).find('#image_cropper').attr('src', "");
       $(document).find('#image_cropper').attr('src', this.result);
       $('#image_edit').val("")
       $("#myModal").modal("show");
     }
   }
  }
  });
});

</script>
@endsection