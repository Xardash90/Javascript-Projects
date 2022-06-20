<script>
$(document).ready(function() {
	$('#live_data').load('lists/01_cimcorp_faults/fetch.php');
	$('#overview').load('lists/01_cimcorp_faults/top_button.php'); 
	$('#shiftreport_open').load('lists/01_cimcorp_faults/open_shiftreport.php');
	$('#shiftreport_progress').load('lists/01_cimcorp_faults/progress_shiftreport.php');
	$('#shiftreport_done').load('lists/01_cimcorp_faults/done_shiftreport.php');
	 $(".refresh_tab").click(function(){ 
		NProgress.start();
		$('#live_data').load('lists/01_cimcorp_faults/fetch.php');
		$('#overview').load('lists/01_cimcorp_faults/top_button.php'); 
		$('#shiftreport_open').load('lists/01_cimcorp_faults/open_shiftreport.php');
	$('#shiftreport_progress').load('lists/01_cimcorp_faults/progress_shiftreport.php');
	$('#shiftreport_done').load('lists/01_cimcorp_faults/done_shiftreport.php');
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
					 $('#mp_11').val(data.mp_11);
					 $('#mp_12').val(data.mp_12);
					 $('#mp_13').val(data.mp_13);
					 $('#mp_14').val(data.mp_14);
					 $('#mp_15').val(data.mp_15);
					 $('#mp_16').val(data.mp_16);
					 $('#mp_17').val(data.mp_17);
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
				$('#shiftreport_open').load('lists/01_cimcorp_faults/open_shiftreport.php');
				$('#shiftreport_progress').load('lists/01_cimcorp_faults/progress_shiftreport.php');
				$('#shiftreport_done').load('lists/01_cimcorp_faults/done_shiftreport.php');
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

 // $('#mp_17').blur(function() {
    // $('.alert_text').show();
// });

 $('#mp_17').mouseenter(function() {
    $('.alert_text').show();
});

 $('#mp_17').mouseleave(function() {
    $('.alert_text').hide();
});







	   
</script>

<script>
	 $(document).ready(function() {

        $(".select2_multiple_area").select2({
			theme: "classic",
			tags: true,
			tokenSeparators: [',', ' '],
			 placeholder: "Bereich auswählen...",
			 allowClear: true
        });
		$(".select2_multiple_code").select2({
			theme: "classic",
			tags: true,
			tokenSeparators: [',', ' '],
			 placeholder: "Fehlercode auswählen...",
			 allowClear: true
        });
		$(".select2_multiple_status").select2({
			theme: "classic",
			tags: true,
			tokenSeparators: [',', ' '],
			 placeholder: "Status auswählen...",
			 allowClear: true
        });
		$(".select2_multiple_part").select2({
			theme: "classic",
			tags: true,
			tokenSeparators: [',', ' '],
			 placeholder: "Ersatzteil auswählen...",
			 allowClear: true
        });
    });
	

</script>
<script>
// Button Priorität Details 
$(document).on('click','.PrioDetails',function (){
	$(".BestandproLagerbereich").show();
	$('#InboundDetails').collapse('hide');
	$('#BestandproLagerbereich').collapse('hide');
	$('#live_data').load('lists/01_shiftreport/fetch.php'); 
	});
$(document).ready(function(){
$("#btnP").html('<i class="fa fa-angle-up"></i>');
$("#btnPD").html('<i class="fa fa-angle-down"></i>');
$("#btnBPL").html('<i class="fa fa-angle-down"></i>');
  $("#PrioDetails").on("hide.bs.collapse", function(){
    $("#btnPD").html('<i class="fa fa-angle-down"></i>');
  });
  $("#PrioDetails").on("show.bs.collapse", function(){
    $("#btnPD").html('<i class="fa fa-angle-up"></i>');
  });
});

// Button Performance Details 
$(document).on('click','.InboundDetails',function (){
	$(".BestandproLagerbereich").show();
	$('#PrioDetails').collapse('hide');
	$('#BestandproLagerbereich').collapse('hide');
	$('#shiftreport_open').load('lists/01_cimcorp_faults/open_shiftreport.php');
	$('#shiftreport_progress').load('lists/01_cimcorp_faults/progress_shiftreport.php');
	$('#shiftreport_done').load('lists/01_cimcorp_faults/done_shiftreport.php');
	});
$(document).ready(function(){
$("#btnP").html('<i class="fa fa-angle-up"></i>');
$("#btnBPL").html('<i class="fa fa-angle-down"></i>');
  $("#InboundDetails").on("hide.bs.collapse", function(){
    $("#btnP").html('<i class="fa fa-angle-up"></i>');
  });
  $("#InboundDetails").on("show.bs.collapse", function(){
    $("#btnP").html('<i class="fa fa-angle-down"></i>');
  });
});
</script>





