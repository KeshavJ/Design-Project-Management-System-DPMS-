<?php  include "admin_header.php"; ?>
<?php  include "database_connection.php"; ?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <?php  include "admin_nav.php"; ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <form  method="post" id="time-form" action="#">
                <div class="row">
                    <div class="col-lg-8">

                        <div>
                            <h2 class="mt-5 font-weight-light text-center">Schedule</h2>

                            <div class="row">
                                <div class="col-lg-6">




                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Time</th>
                                                <th><input id= "selectAllMon" type="checkbox" > Monday</th>

                                            </tr>
                                        </thead>

                                        <?php

                                        $query = "SELECT TimeId, StartTime, EndTime FROM time WHERE Days = 'Mon' ORDER BY StartTime";

                                        $result = $connection->query($query);
                                        if (!$result) die($connection->error);

                                        while($row=mysqli_fetch_array($result)){
                                            $id=$row['TimeId'];
                                            $start=date("H:i ",strtotime($row['StartTime']));

                                        ?>      
                                        <tr >
                                            <td><?php echo $start;?></td>
                                            <td><input type="checkbox" class="checkMon" id="check" name="M[]" value="<?php echo $id;?>"></td>



                                        </tr>

                                        <?php }?>					  
                                    </table> 
                                    <div class="result" id="form">
                                    </div>   
                                </div>

                                <div class="col-lg-6">



                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Time</th>
                                                <th><input id= "selectAllTue" type="checkbox"> Tuesday</th>


                                            </tr>
                                        </thead>

                                        <?php

                                        $query = "SELECT TimeId, StartTime, EndTime FROM time WHERE Days = 'Tues' ORDER BY StartTime";

                                        $result = $connection->query($query);
                                        if (!$result) die($connection->error);

                                        while($row=mysqli_fetch_array($result)){
                                            $id=$row['TimeId'];
                                            $start=date("H:i ",strtotime($row['StartTime']));

                                        ?>      
                                        <tr >
                                            <td><?php echo $start;?></td>
                                            <td><input type="checkbox" class="checkTue" id="check" name="T[]" value="<?php echo $id;?>" ></td>

                                        </tr>

                                        <?php }?>					  
                                    </table> 
                                    <div class="result" id="form">
                                    </div>   
                                </div>

                            </div>

                        </div>
                    </div>


                    <div class="col-lg-">
                        <div class="box">



                            <div class="row">
                                <div class="col-lg-12">
                                    <h2 class="mt-5 font-weight-light text-center">Details</h2>
                                    <div class="form-group">
                                        <label>Lecturer</label>

                                        <select class="form-control" name="lecturer">
                                            <?php 

                                            $query = "SELECT * FROM staff_details";

                                            $result = $connection->query($query);
                                            if (!$result) die($connection->error);

                                            while($row=mysqli_fetch_array($result)){
                                            ?>
                                            <option value="<?php echo $row['StaffID'];?>"><?php echo $row['StaffName'];?></option>
                                            <option value="" disabled selected hidden>Choose...</option>
                                            <?php }

                                            ?>
                                        </select>
                                        <?php 
                                        if($_POST)
                                        {

                                            if (isset($_POST['lecturer'])){
                                                $member = $_POST['lecturer'];
                                            }
                                            else{
                                                echo "Please choose a lecturer";
                                            }
                                        }
                                        ?>

                                        <label for="date">Room</label>

                                        <textarea name="venue" class = "form-control" cols="30" rows="1" placeholder="Enter Venue"></textarea>
                                        <?php 
                                        if($_POST)
                                        {

                                            if(!strlen(trim($_POST['venue']))){
                                                echo "Please enter a venue";
                                            }
                                            else{

                                                $room = $_POST['venue'];
                                            }
                                        }
                                        ?>
                                    </div>

                                    <div class="form-group">

                                        <button class="btn btn-info" name="save" type="submit">Save</button>


                                        <button class="uncheck btn btn-danger" type="reset">Uncheck All</button>

                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php  include "admin_footer.php"; 


        if($_POST)
        {


            //Monday
            if (isset($_POST['M']) && strlen(trim($_POST['venue'])) && isset($_POST['lecturer'])){

                $m = $_POST['M'];
                foreach($m as $daym) {


                    $query = "INSERT INTO lecturer_schedule(time_id,day,staff_id, status, room) VALUES('$daym','Mon','$member','unavailable','".mysqli_real_escape_string($connection, $room)."')";
                    $result = $connection->query($query);
                    if (!$result) die($connection->error);
                }

            }


            //Tuesday
            if (isset($_POST['T']) && strlen(trim($_POST['venue'])) && isset($_POST['lecturer'])){
                $t = $_POST['T'];
                foreach($t as $daym) {


                    $query = "INSERT INTO lecturer_schedule(time_id,day,staff_id, status, room) VALUES('$daym','Tues','$member','unavailable','".mysqli_real_escape_string($connection, $room)."')";
                    $result = $connection->query($query);
                    if (!$result) die($connection->error);
                }
            }

        }

        ?>


    </div>

</body>


</html>
