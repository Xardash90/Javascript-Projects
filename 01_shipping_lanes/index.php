<?php
session_start();


if(isset($_SESSION['location'])){
	include ('modals.php');
	}
	else{
	  header("location: ../../");
	}	
?>
<style>

/* Gruppe */
div.lines {
 width: 134px;
 min-width: 134px;
 height: 90px;
 min-height: 90px;
 margin: 4px;
 float: Left; 
 overflow: Auto;
 resize: Both;
 padding: 4px;
 box-shadow: 0px 0px 2px 1px #555555, inset 0px 0px 2px 1px #DADADA;
 /*color: #717171;*/
 cursor: Default;
 /*scrollbar-width: Thin;*/
}
</style>
	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="x_panel" >
                  <div class="row x_title">

                  <div class="col-md-7">
                    <h2>Versandbahnen Übersicht <small>Niederlassung - <?php echo $_SESSION["location"] ; ?></small></h2>
                  </div>
				  
				  <div class="form-group pull-right">
						<label id="cnt_color" ></label>
						<a class="btn btn-default text-success btn-xs refresh_tab" role="button" name="refresh_tab" id="refresh_tab" ><i class="text-success fa fa-spinner fa-pulse" ></i> - Auffrischen</a> 
						<button type="button" class="btn btn-danger btn-xs pull-right reset_color" >Reset</button>
						<div class="clearfix"></div>
					</div>

                    <div class="clearfix"></div>

                  </div>
				  
				  <div class="lines" style ="background-color:#F2F2F2;color:#71717;" ><p> <i class="fa fa-search" aria-hidden="true"></i> Suche :</p>
										<input type="text" name="search_text" id="search_text" placeholder="Filiale / Bahn" class="form-control" />
										<span id="AUFTRAGSSTAND" title="Auftragsstand - Automation ( Abarbeitung )" ></span>
						  </div>
 
				  <div id="result"></div>

			
			  </div>
               <div class="clearfix"></div>
           </div>
	</div>	   
<script>
$(document).ready(function() {	
		//$('#menu_toggle').click();
		$('#result').load('lists/01_shipping_lanes/lanes.php');	
		$('#cnt_color').load('lists/01_shipping_lanes/cnt_color.php');
	$(".refresh_tab").click(function(){ 
		NProgress.start();	
			$('#result').load('lists/01_shipping_lanes/lanes.php');	
			$('#cnt_color').load('lists/01_shipping_lanes/cnt_color.php');		
		NProgress.done();
			swal({ title: "", text: "Daten wurden erfolgreich aufgefrischt.", type: "success", timer: 1000, showCancelButton: false, showConfirmButton: false });
		});

		
		 function load_data(query)
		 {
		  $.ajax({
		   url:"lists/01_shipping_lanes/lanes.php",
		   method:"POST",
		   data:{query:query},
		   success:function(data)
		   {
			$('#result').html(data);
		   }
		  });
		 }
		 $('#search_text').keyup(function(){
		  var search = $(this).val();
		  if(search != '')
		  {
		   load_data(search);
		  }
		  else
		  {
		   load_data();
		  }
		 });
		 
});	

$(document).on('click', '.view_data', function(){  
		  var id = $(this).attr("id");		  
		   var name = $(this).attr("name");	
		    NProgress.start();
                $.ajax({  
                     url:"lists/01_shipping_lanes/search_details.php",  
                     method:"POST",  
                     data:{"id":id,"name":name },
                     success:function(data){ 
                          $('#view_detail').html(data);
						  $('#view_detail_open').modal('show'); 
						  NProgress.done();
                     }  
                });            
      });

$(document).on('click', '.BTNCOLOR', function(){  
		  var id = $(this).attr("id");		  
		   var name = $(this).attr("name");	
		    NProgress.start();
                $.ajax({  
                     url:"lists/01_shipping_lanes/update_color.php",  
                     method:"POST",  
                     data:{"id":id,"name":name },
                     success:function(data){ 
                          $('#result').load('lists/01_shipping_lanes/lanes.php');	
						  $('#cnt_color').load('lists/01_shipping_lanes/cnt_color.php');					  
						  $('#view_detail_open').modal('hide'); 
						  NProgress.done();
                     }  
                });            
      });

$(document).on('click', '.BTNVIP', function(){  
		  var id = $(this).attr("id");		  
		   var name = $(this).attr("name");	
		    NProgress.start();
                $.ajax({  
                     url:"lists/01_shipping_lanes/update_vip.php",  
                     method:"POST",  
                     data:{"id":id,"name":name },
                     success:function(data){ 
                          $('#result').load('lists/01_shipping_lanes/lanes.php');	
						  $('#cnt_color').load('lists/01_shipping_lanes/cnt_color.php');					  
						  $('#view_detail_open').modal('hide'); 
						  NProgress.done();
                     }  
                });            
      });
	  
</script>
<script>
    $(document).on('click','.reset_color',function (){
		var id = $(this).attr('id');	
			var name = $(this).attr('name');
				NProgress.start(); // wait Loader  Modal	
			  swal({
				  title: "Wollen Sie die Farben auf Default Wert wirklich zurücksetzen?",
				  text: "",
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
			url:"lists/01_shipping_lanes/reset_color.php",
			method:"POST",
			data:{"id":id,"name":name},
			success:function(data){
				$('#result').load('lists/01_shipping_lanes/lanes.php');	
				$('#cnt_color').load('lists/01_shipping_lanes/cnt_color.php');	
				NProgress.done();
			}
		});  
		swal({ title: "", text: "Zurücksetzung wurde erfolgreich abgeschlossen.", type: "success", timer: 1000, showCancelButton: false, showConfirmButton: false });
		
		 } else {
				$('#result').load('lists/01_shipping_lanes/lanes.php');	
				NProgress.done();
				swal({ title: "", text: "Zurücksetzen wurde abgebrochen!", type: "error", timer: 1000, showCancelButton: false, showConfirmButton: false });
          } 
      });
    });
</script>