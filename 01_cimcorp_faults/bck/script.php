<script>
$(document).ready(function() {




	$('#live_data').load('lists/01_cimcorp_faults/fetch.php');
	$('#overview').load('lists/01_cimcorp_faults/top_button.php'); 
	 $(".refresh_tab").click(function(){ 
		NProgress.start();
		$('#live_data').load('lists/01_cimcorp_faults/fetch.php');
		$('#overview').load('lists/01_cimcorp_faults/top_button.php'); 
		NProgress.done();
		});
		
		
	$(".segment_list").click(function(){ 
		NProgress.start();
		$('#live_data').load('lists/01_cimcorp_faults/fetch_segment.php');
		NProgress.done();
	});
	


	    $(document).on('click', '.edit_data', function(){		
           var id = $(this).attr("id");
           $.ajax({  
                url:"lists/01_cimcorp_faults/search.php",  
                method:"POST",  
                data:{"id":id},  
                dataType:"json",  
                success:function(data){ 
					 $('#mp_5').show();
					 $('.mp_5_text').show();				
                     $('#mp_3').val(data.mp_3);  
                     $('#mp_4').val(data.mp_4);  
                     $('#mp_5').val(data.mp_5);  
					 $('#mp_7').val(data.mp_7);  
					 $('#mp_8').val(data.mp_8);
					 $('#mp_12').val(data.mp_12);
					 $('#mp_13').val(data.mp_13);
                     $('#id').val(data.nr); 
                     $('#insert').val("Aktualisieren");  
                     $('#add_data_Modal').modal('show');
                }  
           });  
      }); 

	   $('#insert').on('click', function(event){ 
		event.preventDefault();
		   if($('#mp_3').val() == '')  
			   {  
					swal({ title: "", text: "Bitte Problembeschreibung eintragen !", type: "error",  showCancelButton: false, showConfirmButton: true });
			   } else {    
			$.ajax({
				url:"lists/01_cimcorp_faults/insert.php",  
				type: "POST",
				data:$('#insert_form').serialize(),  
				 beforeSend:function(){  
                    $('#insert').val("Speichert");  			
                    },  
				success: function(data){
				$('#add_data_Modal').modal('hide'); 
				$('#insert_form')[0].reset();  
				$('#live_data').load('lists/01_cimcorp_faults/fetch.php');		 
				$('#overview').load('lists/01_cimcorp_faults/top_button.php'); 	
				$('#employee_id').val('');

				}
			});
		}
	});
	
	//insert FORM Segment
	$('#segment_form').on('submit', function(event){ 
		event.preventDefault();
		   if($('#mp_10').val() == '')  
			   {  
					swal({ title: "", text: "Bitte Segment eintragen !", type: "error",  showCancelButton: false, showConfirmButton: true });
			   } else {    
			$.ajax({
				url:"lists/01_cimcorp_faults/insert_segment.php",  
				type: "POST",
				data:$('#segment_form').serialize(),  
				 beforeSend:function(){  
                          $('#insert').val("Speichert ...");  			
                     },  
				success: function(data){
		
				 $('#segment_form')[0].reset();  
				 $('#add_segment_Modal').modal('hide');				 
				 $('#live_data').load('lists/01_cimcorp_faults/fetch_segment.php');	
		
				}
			});
		}
	});
	//Edit FOrm Segment
	$(document).on('click', '.edit_segment_data', function(){
			$('#insert_form')[0].reset();  			
           var id = $(this).attr("id");
           $.ajax({  
                url:"lists/01_cimcorp_faults/search_segment.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"json",  
                success:function(data){ 				
                     $('#mp_10').val(data.mp_10);  
                     $('#id').val(data.nr); 
                     $('#insert').val("Aktualisieren");  
                     $('#add_segment_Modal').modal('show');
					 $('#overview').load('lists/01_cimcorp_faults/top_button.php'); 
                }  
           });  
      }); 
	
	
	 //Button Filter 
	 $(document).on('click','.OPEN',function (){
		 var id = $(this).attr("id");
		 var name = $(this).attr("name");
	 NProgress.start();
		$.ajax({ 
			url:"lists/01_cimcorp_faults/fetch.php",
			method:"POST", 
			data:{"id":id,"name":name},
			success:function(data){
				$('#live_data').html(data);  	
				 NProgress.done();
			}
		});
	}); 
	
	
	$(document).on('click','.OPEN',function (){
		 var id = $(this).attr("id");
		 var name = $(this).attr("name");
		NProgress.start();
		$.ajax({ 
			url:"lists/01_cimcorp_faults/fetch.php",
			method:"POST", 
			data:{"id":id,"name":name},
			success:function(data){
			$('#live_data').html(data);  	
			NProgress.done();
			}
		});
	}); 
	
	
	$(document).on('click','.WATCH',function (){
     var id = $(this).attr("id");
	 var name = $(this).attr("name");
	 NProgress.start();
		$.ajax({ 
			url:"lists/01_cimcorp_faults/fetch.php",
			method:"POST", 
			data:{"id":id,"name":name},
			success:function(data){
				$('#live_data').html(data);  	
				 NProgress.done();
			}
		});
	}); 
	
	$(document).on('click','.DONE',function (){
     var id = $(this).attr("id");
	 var name = $(this).attr("name");
	 NProgress.start();
		$.ajax({ 
			url:"lists/01_cimcorp_faults/fetch.php",
			method:"POST", 
			data:{"id":id,"name":name},
			success:function(data){
				$('#live_data').html(data);  	
				$('html, body').animate({ scrollTop: 0 }, 500);
				 NProgress.done();
			}
		});
	});
	$(document).on('click','.ALL',function (){
		 var id = $(this).attr("id");
		 var name = $(this).attr("name");
		 NProgress.start();
			$.ajax({ 
				url:"lists/01_cimcorp_faults/fetch.php",
				method:"POST", 
				data:{"id":id,"name":name},
				success:function(data){
					$('#live_data').html(data);  	
					$('html, body').animate({ scrollTop: 0 }, 500);
					 NProgress.done();
				}
			});
		});

// function secondCall() {
    // var OPEN = $('.OPEN').val();
                    // $.ajax({  
                    // url: "lists/01_cimcorp_faults/fetch.php",
                     // method:"POST",  
                     // data: {OPEN:OPEN}, 
                     // success:function(data) {
                     // $('#live_data').html(data);
					// }
			   // });
// } 			
	
	//Button Filter Ende
	
		//Delete Button Shiftreport
$(document).on('click','.delete_data',function (){
	var id 	= $(this).attr('id');
			  swal({
				  title: "Eintrag löschen ? ",
				  text: "Bestätigen Sie, wird der Eintrag gelöscht!",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonClass: "btn-danger",
				  confirmButtonText: "Bestätigen Sie",
				  cancelButtonText: "Abbrechen",
				  closeOnConfirm: false,
				  closeOnCancel: false
				},
        function(isConfirm) {
			 if (isConfirm) {	
		$.ajax({
			url:"lists/01_cimcorp_faults/delete.php",
			method:"POST",
			data:{id:id},
			success:function(data){
				$('#insert_form')[0].reset();
				$('#live_data').load('lists/01_cimcorp_faults/fetch.php');		
				$('#overview').load('lists/01_cimcorp_faults/top_button.php'); 
				
			}
		});  
		swal({ title: "", text: "Eintrag wurde erfolgreich gelöscht !", type: "success", timer: 1000, showCancelButton: false, showConfirmButton: false });
		
		 } else {
			   swal({ title: "", text: "Eintrag löschen wurde abgebrochen!", type: "error", timer: 1000, showCancelButton: false, showConfirmButton: false });
          } 
      });
    });
	//Delete Data Segment
	$(document).on('click','.delete_segment_data',function (){
	var id 	= $(this).attr('id');
			  swal({
				  title: "Eintrag löschen ? ",
				  text: "Bestätigen Sie, wird der Eintrag gelöscht!",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonClass: "btn-danger",
				  confirmButtonText: "Bestätigen Sie",
				  cancelButtonText: "Abbrechen",
				  closeOnConfirm: false,
				  closeOnCancel: false
				},
        function(isConfirm) {
			 if (isConfirm) {	
		$.ajax({
			url:"lists/01_cimcorp_faults/delete.php",
			method:"POST",
			data:{id:id},
			success:function(data){
				$('#live_data').load('lists/01_cimcorp_faults/fetch_segment.php');		
				$('#overview').load('lists/01_cimcorp_faults/top_button.php'); 
		
			}
		});  
		swal({ title: "", text: "Eintrag wurde erfolgreich gelöscht !", type: "success", timer: 1000, showCancelButton: false, showConfirmButton: false });
		
		 } else {
			   swal({ title: "", text: "Eintrag löschen wurde abgebrochen!", type: "error", timer: 1000, showCancelButton: false, showConfirmButton: false });
          } 
      });
    });
	
	// Upload
	
$(document).on('click','.uploadFile',function (){
	  $('#message_file').html('');
      var id = $(this).attr('id');
		$.ajax({
			url:'lists/01_cimcorp_faults/search_upload.php',
			method:"POST",
			data:{id:id},
			dataType:"json",  
			success:function(data){
				 $('.alertupload').hide(); 
				 $('#uploadinfo').html( ''+data.id+ ' / ' +data.mp_18  );
				 $('#uploadID').val(data.nr);
				 $('.reclose').attr('disabled',false);
				 $('#FormModalUploadFile').modal('show');	
			}
		});
		

  $('#file_form').on('submit', function(event){
   $('#message_file').html('');
   event.preventDefault();
   $.ajax({
    url:"lists/01_cimcorp_faults/upload_file.php",
    method:"POST",
    data: new FormData(this),
    dataType:"json",
    contentType:false,
    cache:false,
    processData:false,
    beforeSend:function(){
     $('#upload_file').attr('disabled','disabled');
     $('#upload_file').val('Uploading');
    },
    success:function(data)
    {
     if(data.success)
     {
     $('.alertupload').show(); 
	 $('.reclose_upload').attr('disabled',true);
	 $('#FormModalUploadFile').modal('hide');
	 $('#upload').val('');
	 $('#message_file').html('');	
	 $('#live_data').load('lists/01_cimcorp_faults/fetch.php');		
	$('#overview').load('lists/01_cimcorp_faults/top_button.php');
     }
     if(data.error)
     {
      $('#message_file').html('<div class="alert alert-danger">'+data.error+'</div>');
      $('#upload_file').attr('disabled',false);
      $('#upload_file').val('Upload');
     }
    }
   })
  });
  
	});	
  	
$(document).on('click','.reclose',function (){	
	  $('#file').val('');
	  $('#message').html('');
      $('#live_data').html(data);	  
	});
	
//// Dokumenten Upload	

});

$(document).ready(function() {	
	function blink_text() {
		$('.blink').fadeOut(500);
		$('.blink').fadeIn(500);
	}
	setInterval(blink_text, 1000);
});	


	   
</script>

<script>
	 $(document).ready(function() {

        $(".select2_multiple").select2({
		theme: "classic",
		tags: true,
		tokenSeparators: [',', ' '],
         placeholder: "Ersatzteil aussuchen",
         allowClear: true
        });
      });	
</script>






