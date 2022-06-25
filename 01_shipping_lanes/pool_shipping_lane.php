<?php session_start();?>
 <div class="row">
<div class="col-md-12 col-sm-12 col-xs-12" >
    <div class="x_panel" >
        <div class="row x_title">

            <div class="col-md-7">
                <h2><i class="fa fa-columns"></i>&nbsp;Versandbahnen - Pool (SDM)<small>Niederlassung - <?php echo $_SESSION["location"] ; ?></small></h2>
            </div>
			<div align="right">
				<button type="button" name="add" id="add" class="btn btn-success btn-sm"><i class="fa fa-columns"></i> - hinzufügen</button>
			</div>

            <div class="clearfix"></div>

        </div>
		
			<div class="clearfix"></div>
		<span id="availability"></span>		  
    <div class="x_content">
				  
		<div class="table-responsive">
								
				<table id="table_data" class="table table-bordered table-striped" width="100%">
					<thead>
						<tr>
							<th>Versandbahn-ID	</th>
							<th>Stellplatzinformation</th>
							<th>Sortierung</th>
							<th>Aktivieren / Deaktivieren</th>
							<th>#</th>
						</tr>
					</thead>
				</table>
		</div>
	</div>
</div>

<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
  
  fetch_data();

  function fetch_data()
  {
   var dataTable = $('#table_data').DataTable({
    "serverSide" : true,
	"order": [[ 0, "asc" ]],
		"columnDefs": [
            { orderable: false, targets: [1,2,3,4] }
          ],
	paging: true,
		dom: "Bfrtip",
              buttons: [ 
						{
						  extend: "pageLength",text: '...',
						  className: "btn-sm"
						},
						{
						  extend: "copy", text: 'Kopie',
						  className: "btn-sm"
						},
						{
						  extend: "csv",
						  className: "btn-sm"
						},
						{
						  extend: "excel",
						  className: "btn-sm"
						},
						{
						  extend: "print",text: 'Drucken',
						  className: "btn-sm"
						},
						{
						  extend: "pdf",
						  className: "btn-sm"
						},
					  ],
					  
	"language": {
					"search": "_INPUT_",
					"searchPlaceholder": "Suchen...",
					"sEmptyTable":   	"Keine Daten vorhanden !",
					"sInfo":         	"_START_ bis _END_ von _TOTAL_ Einträgen",
					"sInfoEmpty":    	"0 bis 0 von 0 Einträgen",
					"sInfoFiltered": 	"(gefiltert von _MAX_ Einträgen)",
					"sInfoPostFix":  	"",
					"sInfoThousands":  	".",
					"sLengthMenu":   	"_MENU_", //_MENU_ Einträge anzeigen
					"sLoadingRecords": 	"Wird geladen...",
					"sProcessing":   	"Bitte warten...",
					"sSearch":       	" ", // Suchen
					"sZeroRecords":  	"Keine Einträge vorhanden.",
					"oPaginate": {
						"sFirst":    	"Erste",
						"sPrevious": 	"Zurück",
						"sNext":     	"Nächste",
						"sLast":     	"Letzte"
			},
	"oAria": {
				"sSortAscending":  ": aktivieren, um Spalte aufsteigend zu sortieren",
				"sSortDescending": ": aktivieren, um Spalte absteigend zu sortieren"
			}
		},
	"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
	"fixedHeader": true,
	"stateSave": true,
    "responsive": false,
	"bPaginate": true,
	"bLengthChange": true,
	"iDisplayLength": 10,
	"bFilter": true,
	"bInfo": true,
	"bAutoWidth": true,
	"ordering": true,
	"scrollCollapse": false,
	"pageResize": false,
    "ajax" : {
     url:"lists/01_shipping_lanes/pool_fetch.php",
     type:"POST"
    }
   });
  }
  
  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"lists/01_shipping_lanes/pool_update.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {	
	NProgress.start();
	 /* swal({ title: "", text: "Daten wurden erfolgreich gespeichert.", type: "success", timer: 1000, showCancelButton: false, showConfirmButton: false }); */	
     $('#table_data').DataTable().destroy();
     fetch_data();
	 $('#add').show();
	NProgress.done();
    }
   });
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  
  $('#add').click(function(){
	$('#add').hide();
   var html = '<tr>';
   html += '<td contenteditable id="data1"></td>';
   html += '<td contenteditable id="data2"></td>';
   html += '<td contenteditable id="data3"></td>';
   html += '<td class="warning" style="cursor: not-allowed;" ></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs btn-block">Speichern</button></td>';
   html += '</tr>';
   $('#table_data tbody').prepend(html);
  });
  
  $(document).on('click', '#insert', function(){
   var O_GATE = $('#data1').text();
   var O_TEXT = $('#data2').text();
   var O_AUTO = $('#data3').text();
   if( O_GATE  != '')  
   {
    $.ajax({
     url:"lists/01_shipping_lanes/pool_insert.php",
     method:"POST",
     data:{O_GATE:O_GATE, O_TEXT:O_TEXT ,O_AUTO:O_AUTO },
	 cache:false,
     success:function(data)
     {
		/* alert(data);  
         if(data == 'Yes') 
            { 
			
			 swal({ title: "", text: "Datensatz ist schon vorhanden ! .", type: "error", timer: 3000, showCancelButton: false, showConfirmButton: false });	
			 $('#table_data').DataTable().destroy();
			  $('#add').show();
            }  
        else  if(data == 'No') 
			{               
			  swal({ title: "", text: "Daten wurden erfolgreich gespeichert.", type: "success", timer: 1000, showCancelButton: false, showConfirmButton: false }); 

			  $('#add').show();
			} */
		swal({ title: "", text: "Daten wurden erfolgreich gespeichert. Doppelte Daten werden nicht übernommen !", type: "success", timer: 3000, showCancelButton: false, showConfirmButton: true }); 		
		$('#table_data').DataTable().destroy();
		fetch_data();
		$('#add').show();		
	 }
    });
   }
   else
   {
    swal({ title: "", text: "Versandbahn muß ausgefüllt werden !.", type: "warning", timer: 2000, showCancelButton: false, showConfirmButton: false });
   }
  });
  
  $(document).on('click','.delete',function (){
	var id 	= $(this).attr('id');
			  swal({
				  title: "Datensatz löschen ? ",
				  text: "Bestätigen Sie, wird der Datensatz gelöscht!",
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
			url:"lists/01_shipping_lanes/pool_delete.php",
			method:"POST",
			data:{id:id},
			success:function(data){
			$('#table_data').DataTable().destroy();
				fetch_data();	
			}
		});  
		swal({ title: "", text: "Datensatz wurde erfolgreich gelöscht !", type: "success", timer: 1000, showCancelButton: false, showConfirmButton: false });
		
		 } else {
			   swal({ title: "", text: "Datensatz löschen wurde abgebrochen!", type: "error", timer: 1000, showCancelButton: false, showConfirmButton: false });
          } 
      });
    });
	
 $(document).on('click','.aktiv',function (){
	var id 	= $(this).attr('id');
	var name = $(this).attr('name');
	NProgress.start();
		$.ajax({
			url : 'lists/01_shipping_lanes/pool_update_state.php',
			method:"POST",
			data:{id:id,name:name},
			success:function(data){
				$('#table_data').DataTable().destroy();
				fetch_data();
				NProgress.done();
			}
		});  
      });	

});
</script>


