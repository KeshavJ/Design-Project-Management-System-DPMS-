<!-- Delete -->
    <div class="modal fade" id="delstaff<?php echo $staffid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    
                </div>
                <div class="modal-body">
				
				<div class="container-fluid">
					<h5><center><strong><?php echo "Delete ".$initials.". ".$staffName."?";?> </strong></center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <a href="delete_staff.php?id=<?php echo $staffid; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                </div>
            </div>
        </div>
    </div>
<!-- /.modal -->

<!-- Edit -->
    <div class="modal fade" id="editstaff<?php echo $staffid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h5 class="modal-title" id="myModalLabel">Edit</h5></center>
                </div>
                <div class="modal-body">
				
				<div class="container-fluid">
				<form method="POST" action="update_staff.php?id=<?php echo $staffid; ?>">
				
				<div class="form-group">
                        <label for="staffname">Last Name</label>
                        <input type="text" placeholder="Last Name" class="form-control" name="name" value="<?php echo $staffName; ?>">
                    </div>

                    <div class="form-group">
                         <label for="initials">Initials</label>
                         <input type="text" placeholder="Initials" class="form-control" name="initials" value="<?php echo $initials; ?>">
                    </div>
                    
					
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-check"></span> Save</button>
                </div>
				</form>
            </div>
        </div>
    </div>
<!-- /.modal -->