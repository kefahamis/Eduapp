<div class="modal" tabindex="-1" role="dialog" id="paper_instructions_modal">
	<div class="modal-dialog" role="document" style="max-width: 680px;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Paper Instructions</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="edit" method="post">

					<label for="edit_paper_instructions">Edit Paper instructions</label>
					<textarea class="form-control" name="edit_paper_instructions" id="edit_paper_instructions"><?php echo $paper_instructions; ?></textarea>
					<input type="hidden" name="oid" value="<?php echo $order_code; ?>">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> 
					<button type="submit" class="btn btn-info btncol">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Remove file modal -->
<div class="modal" tabindex="-1" role="dialog" id="popup_hide_order_file">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Remove file?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Do you really want to remove the file?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
				<button type="button" class="btn btn-danger btncol" id="deleteThisFile" onclick="deleteThisFile(this.id);">Yes</button>
			</div>
		</div>
	</div>
</div>
<!-- end modal -->