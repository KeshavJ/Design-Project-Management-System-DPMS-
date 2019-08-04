<!-- Edit -->
    <div class="modal fade" id="editexaminer<?php echo $topicNumber; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h5 class="modal-title" id="myModalLabel">Edit</h5></center>
                </div>
                <div class="modal-body">
				
				<div class="container-fluid">
				<form method="POST" action="update_examiner_allocation.php?id=<?php echo $topicNumber; ?>">
				
				<div class="form-group">
                        <label for="staffname">Examiner</label>
                        <select class="form-control" name="examiner">
                                    <?php
                        $queryUpdateStaff = "SELECT StaffID, StaffName FROM staff_details";
                        $resultUpdateStaff = $connection->query($queryStaff);
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
                         <label for="initials">Day &amp; Time</label>
                          <select class="form-control" name="time">
                                    <?php
                        $queryUpdateTime = "SELECT TimeId, StartTime, Days FROM time";
                        $resultUpdateTime = $connection->query($queryUpdateTime);
                        if (!$resultUpdateTime) die($connection->error);  

                        while($rowUpdateTime = mysqli_fetch_assoc($resultUpdateTime)) {

                            $timeIdN = $rowUpdateTime['TimeId'];
                            $timeN = date("H:i ",strtotime($rowUpdateTime['StartTime']));
                            $dayN = $rowUpdateTime['Days'];
                                    ?>
                                    <option value="<?php echo $timeIdN; ?>" > <?php echo $dayN." ".$timeN;?></option>
                                     <option value="" disabled selected hidden>Choose...</option>

                                    <?php
                        }
                                    ?>
                                </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Venue</label>
<input type="text" placeholder="Venue" class="form-control" name="venue" value="<?php echo $venue; ?>">
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