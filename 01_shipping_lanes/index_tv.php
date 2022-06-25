<?php
session_start();

if(isset($_SESSION['location'])){
	  include ('modals.php');
	}
	else{
	  header("location: ../../");
	}
	
?>

	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="x_panel" >
				 <div class="">
				  
							<label id="clock" ></label>
							<label id="cnt_color" ></label>
							<a class="btn btn-default text-success btn-xs refresh_tab pull-right" role="button" name="refresh_tab" id="refresh_tab" ><i class="text-success fa fa-spinner fa-pulse" ></i> - Auffrischen</a>
							<input type="text" name="search_text" id="search_text" placeholder="Suche = Filiale / Bahn" class="form-control" />
							<span id="AUFTRAGSSTAND" title="Auftragsstand - Automation ( Abarbeitung )" ></span>

					 </div>	  
				  <div class="clearfix"></div>
				  <div id="result"></div>

			
			  </div>
              
           </div>
	</div>	 

 
<script>
$(document).ready(function() {		
		$('#menu_toggle').click();
		$('#result').load('lists/01_shipping_lanes/lanes_tv.php');
		$('#clock').load('lists/01_shipping_lanes/clock.php');			
		$('#cnt_color').load('lists/01_shipping_lanes/cnt_color.php');
	$(".refresh_tab").click(function(){ 
		NProgress.start();	
			$('#result').load('lists/01_shipping_lanes/lanes_tv.php');	
			$('#cnt_color').load('lists/01_shipping_lanes/cnt_color.php');	
		    $('#clock').load('lists/01_shipping_lanes/clock.php');			
		NProgress.done();
			swal({ title: "", text: "Daten wurden erfolgreich aufgefrischt.", type: "success", timer: 1000, showCancelButton: false, showConfirmButton: false });
		});
	
		setInterval(function () {
			NProgress.start();
				$('#clock').load('lists/01_shipping_lanes/clock.php?' + 1*new Date())
				$('#result').load('lists/01_shipping_lanes/lanes_tv.php?' + 1*new Date())
				$('#cnt_color').load('lists/01_shipping_lanes/cnt_color.php?' + 1*new Date())
				NProgress.done();
			}, 30000);
		
		 function load_data(query)
		 {
		  $.ajax({
		   url:"lists/01_shipping_lanes/lanes_tv.php",
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
                          $('#result').load('lists/01_shipping_lanes/lanes_tv.php');	
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
                          $('#result').load('lists/01_shipping_lanes/lanes_tv.php');	
						  $('#cnt_color').load('lists/01_shipping_lanes/cnt_color.php');					  
						  $('#view_detail_open').modal('hide'); 
						  NProgress.done();
                     }  
                });            
      });
</script>