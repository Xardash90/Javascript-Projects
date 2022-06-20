 <script>
 
      $(document).ready(function() {
        $('#datatable-header-cimcorp').DataTable({
		dom: '<"top"fl>rt<"bottom"ip><"clear">',
        order: [[ 1, "DESC" ]],
		columnDefs: [
            { orderable: true, targets: [3] }
          ],
		paging: true,
		 dom: "Bfrtip",
              buttons: [ 
						
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
					
					  ], 
					  
		language: {
					"search": "_INPUT_",
					"searchPlaceholder": "Eingabe.....",
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
			oAria: {
				"sSortAscending":  ": aktivieren, um Spalte aufsteigend zu sortieren",
				"sSortDescending": ": aktivieren, um Spalte absteigend zu sortieren"
			}
		},
        lengthMenu : [[10, 25, 50, -1], [10, 25, 50, "Alles"]],
		fixedHeader: true,
		stateSave: true,
        responsive: false,
		bPaginate: false,
		bLengthChange: false,
		iDisplayLength: -1,
		bFilter: true,
		bInfo: true,
		bAutoWidth: false,
		ordering: false,
		scrollCollapse: false,
		pageResize: false,
		
		
        });
		
      });




$(document).ready(function() {
	swal.close();
	NProgress.done();
});
</script>