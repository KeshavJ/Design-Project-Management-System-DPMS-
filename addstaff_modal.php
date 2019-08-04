<!-- Add New -->
    <div class="modal fade" id="addnewstaff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h5 class="modal-title" id="myModalLabel">Add New Staff</h5></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="addnewstaff.php">
					<div class="form-group">
                        <label for="staffname">Last Name</label>
                        <input type="text" placeholder="Last Name" class="form-control" name="name">
                    </div>

                    <div class="form-group">
                         <label for="initials">Initials</label>
                         <input type="text" placeholder="Initials" class="form-control" name="initials">
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a>
				</form>
                </div>
				
            </div>
        </div>
    </div>
