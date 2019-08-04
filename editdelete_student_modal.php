<!-- Delete -->
    <div class="modal fade" id="delstudent<?php echo $studentNo; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    
                </div>
                <div class="modal-body">
				
				<div class="container-fluid">
					<h5><center><strong><?php echo $firstName." ".$surname." (".$studentNo.")";?> </strong></center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <a href="delete_student.php?id=<?php echo $studentNo; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                </div>
            </div>
        </div>
    </div>
<!-- /.modal -->

<!-- Edit -->
    <div class="modal fade" id="editstudent<?php echo $studentNo; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h5 class="modal-title" id="myModalLabel">Edit</h5></center>
                </div>
                <div class="modal-body">
				
				<div class="container-fluid">
				<form method="POST" action="update_student.php?id=<?php echo $studentNo; ?>">
				
				<div class="form-group">
                        <label for="studentNo">Student Number</label>
                        <input type="text" placeholder="Student Number" class="form-control" name="studentno" value="<?php echo $studentNo; ?>">
                    </div>

                    <div class="form-group">
                        <label for="surname">Surname</label>
<input type="text" placeholder="Surname" class="form-control" name="surname" value="<?php echo $surname; ?>">

                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
<input type="text" placeholder="Name" class="form-control" name="name" value="<?php echo $firstName; ?>">
                    </div>

                    <div class="form-group">
                         <label for="initials">Initials</label>
                         <input type="text" placeholder="Initials" class="form-control" name="initials" value="<?php echo $initials; ?>">
                    </div>
                    <div class="form-group">
                        <label for="Discipline">Discipline</label>

                        <select class="form-control" name="discipline">

                            <option value="Electronic">Electronic</option>
                            <option value="Computer">Computer</option>
                            <option value="" disabled selected hidden>Choose...</option>
                        </select>
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