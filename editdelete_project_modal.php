<!-- Delete -->
    <div class="modal fade" id="delproject<?php echo $topicNumber; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    
                </div>
                <div class="modal-body">
				
				<div class="container-fluid">
					<h5><center><strong><?php echo "Topic ".$topicNumber.": ".$topic;?> </strong></center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <a href="delete_project.php?id=<?php echo $topicNumber; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                </div>
            </div>
        </div>
    </div>
<!-- /.modal -->

<!-- Edit -->
    <div class="modal fade" id="editproject<?php echo $topicNumber; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h5 class="modal-title" id="myModalLabel">Edit</h5></center>
                </div>
                <div class="modal-body">
				
				<div class="container-fluid">
				<form method="POST" action="update_project.php?id=<?php echo $topicNumber; ?>">
				
				<div class="form-group">
                        <label for="topic">Topic</label>
                        <input type="text" placeholder="Topic" class="form-control" name="topic" value="<?php echo $topic; ?>">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>

                        <textarea name="description" id = "description" class = "form-control" cols="30" rows="5" placeholder="Enter Description" ><?php echo $description; ?></textarea>

                    </div>

                    <div class="form-group">
                        <label for="supervisor">Supervisor</label>
                        <!--                        <input type="text" id="supervisor" placeholder="Supervisor" class="form-control">-->

                        <select class="form-control" id="supervisor" name="supervisor">
                            <?php
                            $queryUpdateStaff = "SELECT StaffID, StaffName FROM staff_details";
                            $resultUpdateStaff = $connection->query($queryUpdateStaff);
                            if (!$resultUpdateStaff) die($connection->error);  

                            while($rowUpdateStaff = mysqli_fetch_assoc($resultUpdateStaff)) {

                                $staffIdN = $rowUpdateStaff['StaffID'];
                                $staffNameN = $rowUpdateStaff['StaffName'];

                            ?>
                            <option value="<?php echo $staffIdN; ?>" > <?php echo $staffNameN;?></option>
                            <option value="" disabled selected hidden>Choose...</option>

                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Discipline">Discipline</label>

                        <select class="form-control" name="discipline">

                            <option value="Electronic">Electronic</option>
                            <option value="Computer">Computer</option>
                            <option value="Both">Both</option>
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