<!-- Add New -->
    <div class="modal fade" id="addnewstudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h5 class="modal-title" id="myModalLabel">Add New Student</h5></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="addnewstudent.php">
					<div class="form-group">
                        <label for="studentNo">Student Number</label>
                        <input type="text" placeholder="Student Number" class="form-control" name="studentno">
                    </div>

                    <div class="form-group">
                        <label for="surname">Surname</label>
<input type="text" placeholder="Surname" class="form-control" name="surname">

                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
<input type="text" placeholder="Name" class="form-control" name="name">
                    </div>

                    <div class="form-group">
                         <label for="initials">Initials</label>
                         <input type="text" placeholder="Initials" class="form-control" name="initials">
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
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a>
				</form>
                </div>
				
            </div>
        </div>
    </div>
