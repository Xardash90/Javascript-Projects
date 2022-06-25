<div id="FormModalUploadFile" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop='true' >  
      <div class="modal-dialog modal-sm" role="document" >  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Upload Dokument</h4>  
                </div>  
                <div class="modal-body">  
					 <div class="form-group">
						<span id="message_file"></span>
						
		<form id="file_form" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <div class="form-group">
         <input type="file" name="upload" id="upload" />
        </div>
		<p>
		<span id ="uploadinfo" ></span>
		</p>
		<div  class="alertupload"><center>Bitte warten Upload Datei.<i class="fa fa-spinner fa-spin" aria-hidden="true"></i></center></div>
	    <input type="hidden" name="uploadID" id="uploadID" /> 
						<div class="clearfix"></div>
                     </div> 
                </div>  
                <div class="modal-footer">
					<input type="hidden" name="hidden_field" value="1" />
					<input type="submit" name="upload_file" id="upload_file" class="btn btn-success" value="Upload" />
                     <button type="button" class="btn btn-default reclose_upload" data-dismiss="modal">Close</button>  
                </div>  
				  </form>
           </div>  
      </div>  
 </div>  	