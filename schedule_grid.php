<?php  include "admin_header.php"; ?>
<?php  include "database_connection.php"; ?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <?php  include "admin_nav.php"; 
    $staff = "";
    ?>
    <div class="content-wrapper">
        <div class="container-fluid">

            <h2 class="mt-5 font-weight-light text-center">Staff Schedule</h2>
            <br>


            <form method='post' action='#' class="form-inline">
                <select class="form-control" name="post_staff">
                    <?php

                    $query = "SELECT StaffID, StaffName FROM staff_details";
                    $result = $connection->query($query);
                    if (!$result) die($connection->error);

                    while($row = mysqli_fetch_assoc($result))
                    {
                        $staffId = $row['StaffID'];
                        $staffName = $row['StaffName'];

                    ?>
                    <option value="<?php echo $staffId; ?>" > <?php echo $staffName;?></option>

                    <?php
                    }
                    ?>
                </select>

                <button class="btn btn-info btn-sm go-btn" name="select_staff" type="submit">Ok</button>
            </form> 
            <br>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Staff</th>
                            <th>Day &amp; Time</th>
                            <th>Status</th>
                            <th>Room</th>
                            <th></th>


                        </tr>
                    </thead>

                    <?php
                    if(isset($_POST['select_staff']))
                    {

                        $staff = $_REQUEST['post_staff'];
                    }



                    $query = "SELECT sched_id, time_id, day, status, room FROM lecturer_schedule Where staff_id = '$staff' ORDER BY time_id";
                    $result = $connection->query($query);
                    if (!$result) die($connection->error);

                    while($row = mysqli_fetch_assoc($result))
                    {
                        $schedId = $row['sched_id'];
                        $timeId = $row['time_id'];
                        $status = $row['status'];
                        $room = $row['room'];

                        $query2 = "SELECT StartTime, Days FROM time Where TimeId = '$timeId'";
                        $result2 = $connection->query($query2);
                        if (!$result2) die($connection->error);
                        while($row2 = mysqli_fetch_assoc($result2))
                        {
                            $time = date("H:i ",strtotime($row2['StartTime']));
                            $day = $row2['Days'];
                        }


                        $query3 = "SELECT StaffName FROM staff_details Where StaffID = '$staff'";
                        $result3 = $connection->query($query3);
                        if (!$result3) die($connection->error);
                        while($row3 = mysqli_fetch_assoc($result3))
                        {

                            $name = $row3['StaffName'];
                        }
                    ?>


                    <tr>
                        <td> <?php echo $name;?></td>
                        <td> <?php echo $day." ".$time;?></td>
                        <td> <?php echo $status;?></td>
                        <td> <?php echo $room;?></td>
                        <td> 

                            <form method='post' action='#' class="form-inline">
                                <input type= hidden name= indexkey  value="<?php echo $schedId; ?>"> 
                                <button class="btn btn-danger btn-sm" name="delete" type="submit">Delete</button>
                            </form> 

                        </td>

                    </tr>
                    <?php
                    }

                    if(isset($_POST['delete']))
                    {
                        $id = $_REQUEST['indexkey'];

                        $queryDelete= "DELETE FROM lecturer_schedule WHERE sched_id = '$id'";
                        $resultDelete = $connection->query($queryDelete);
                        if (!$resultDelete) die($connection->error);  

                    ?>

                    <meta http-equiv='refresh' content='0'>
                    <?php

                    }

                    ?>
                </table>
            </div>
        </div>
        <?php  include "admin_footer.php"; ?>
    </div>



</body>


</html>
