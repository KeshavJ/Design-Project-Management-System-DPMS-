<?php  include "admin_header.php"; ?>
<?php  include "database_connection.php"; ?>


<?php


$arrayTimeId = array();

$queryTime = "SELECT TimeID, StartTime, Days FROM time";
$resultTime = $connection->query($queryTime);
if (!$resultTime) die($connection->error);

while($rowTime = mysqli_fetch_assoc($resultTime))
{
    $arrayTimeId[] = $rowTime['TimeID'];
}

$queryStaff = "SELECT StaffID, StaffName FROM staff_details";
$resultStaff = $connection->query($queryStaff);
if (!$resultStaff) die($connection->error);

$countNumStaff = mysqli_num_rows($resultStaff);

$queryTopics = "SELECT TopicNumber FROM project_allocation WHERE Edited = ''";
$resultTopics = $connection->query($queryTopics);
if (!$resultTopics) die($connection->error);

$countNumTopics = mysqli_num_rows($resultTopics);

$numMax = ceil(($countNumTopics/$countNumStaff)*2);

while($rowTopics = mysqli_fetch_assoc($resultTopics)){

    $arrayTemp = array();
    $arrayTimeIdSupervisorAvail = array();

    $topicNumber = $rowTopics['TopicNumber'];


    $querySupervisor = "SELECT SupervisorId FROM project_list WHERE TopicNumber = '$topicNumber'";
    $resultSupervisor = $connection->query($querySupervisor);
    if (!$resultSupervisor) die($connection->error);

    while($rowSupervisor = mysqli_fetch_assoc($resultSupervisor))
    {

        $supervisorId = $rowSupervisor['SupervisorId'];

    }

    $querySupervisorTopics = "SELECT TopicNumber FROM project_list WHERE SupervisorId = '$supervisorId'";
    $resultSupervisorTopics = $connection->query($querySupervisorTopics);
    if (!$resultSupervisorTopics) die($connection->error);

    $countSupervisorTopics = mysqli_num_rows($resultSupervisorTopics);


    $queryTimeSupervisorUnavail = "SELECT time_id FROM lecturer_schedule WHERE staff_id = '$supervisorId'";
    $resultTimeSupervisorUnavail = $connection->query($queryTimeSupervisorUnavail);
    if (!$resultTimeSupervisorUnavail) die($connection->error);

    while($rowTimeSupervisorUnavail = mysqli_fetch_assoc($resultTimeSupervisorUnavail))
    {

        $arrayTemp[] = $rowTimeSupervisorUnavail['time_id'];
    }

    $intersect = array_intersect($arrayTimeId, $arrayTemp);
    $arrayTimeIdSupervisorAvail = array_merge(array_diff($arrayTimeId, $intersect), array_diff($arrayTemp, $intersect));

    $queryExaminers = "SELECT StaffID, StaffName FROM staff_details WHERE StaffID != '$supervisorId'";

    $resultExaminers = $connection->query($queryExaminers);
    if (!$resultExaminers) die($connection->error);

    while($rowExaminers = mysqli_fetch_assoc($resultExaminers))
    {
        $arrayExaminerTimeId = array();
        $arrayExaminerTimeAvailId = array();
        $arrayTimeIdy = array();
        $arrayTime = array();

        $examinerId = $rowExaminers['StaffID'];
        $examinerName = $rowExaminers['StaffName'];

        $queryExaminerTimeUnavail = "SELECT time_id, room FROM lecturer_schedule WHERE staff_id = '$examinerId'";

        $resultExaminerTimeUnavail = $connection->query($queryExaminerTimeUnavail);
        if (!$resultExaminerTimeUnavail) die($connection->error);

        while($row = mysqli_fetch_assoc($resultExaminerTimeUnavail))
        {

            $arrayExaminerTimeId[] = $row['time_id'];
            $room = $row['room'];

        }

        $intersect = array_intersect($arrayTimeId, $arrayExaminerTimeId);
        $arrayTimeIdy = array_merge(array_diff($arrayTimeId, $intersect), array_diff($arrayExaminerTimeId, $intersect));

        $arrayTimeAvailId = array_merge(array_intersect($arrayTimeIdSupervisorAvail, $arrayTimeIdy));


        if(count($arrayTimeAvailId) != 0)
        {

            for ($t = 0; $t < count($arrayTimeAvailId); $t++){
                $query = "SELECT StartTime FROM time WHERE TimeId = '$arrayTimeAvailId[$t]'";

                $result = $connection->query($query);
                if (!$result) die($connection->error);

                while($row = mysqli_fetch_assoc($result))
                {
                    $arrayTime[] = date("H:i ",strtotime($row['StartTime']));

                }

            }

            $querycountExamining = "SELECT ExaminerId FROM project_allocation where ExaminerId = '$examinerId'";
            $resultcountExamining = $connection->query($querycountExamining);
            if (!$resultcountExamining) die($connection->error);

            $countExamining = mysqli_num_rows($resultcountExamining);


            $querycountSupervising = "SELECT SupervisorId FROM project_allocation where SupervisorId = '$examinerId'";
            $resultcountSupervising = $connection->query($querycountSupervising);
            if (!$resultcountSupervising) die($connection->error);

            $countSupervising = mysqli_num_rows($resultcountSupervising);

            $total = $countSupervising + $countExamining;


            if($countExamining < count($arrayTimeIdy))
            {
                if($total <= $numMax)
                {

                    $id = @$arrayTimeAvailId[$countExamining];
                    $queryDay = "SELECT Days FROM time WHERE TimeId = '$id'";
                    $resultDay = $connection->query($queryDay);
                    if (!$resultDay) die($connection->error);

                    while($row = mysqli_fetch_assoc($resultDay)){

                        $day = $row['Days'];
                    }


                    $time =  @$arrayTime[$countExamining];
                    $timeid =  @$arrayTimeAvailId[$countExamining];
                    $queryUpdateProjectAlloc = "UPDATE project_allocation SET ExaminerId = '$examinerId', Examiner = '$examinerName', Day = '$day', Time= '$time', TimeId = '$timeid', Venue = '$room' WHERE TopicNumber = '$topicNumber'";

                    $resultUpdateProjectAlloc = $connection->query($queryUpdateProjectAlloc);
                    if (!$resultUpdateProjectAlloc) die($connection->error);

                    $total = $countSupervising + $countExamining;
                    $countExamining++;
                }
            }
        }
    }
}


$resultStaff = $connection->query($queryStaff);
if (!$resultStaff) die($connection->error);

while($rowStaff = mysqli_fetch_assoc($resultStaff))
{
    $staffId = $rowStaff['StaffID']; 

    $querycountExaminingNew = "SELECT ExaminerId FROM project_allocation where ExaminerId = '$staffId'";
    $resultcountExaminingNew = $connection->query($querycountExaminingNew);
    if (!$resultcountExaminingNew) die($connection->error);

    $countExaminingNew = mysqli_num_rows($resultcountExaminingNew);


    $querycountSupervisingNew = "SELECT SupervisorId FROM project_allocation where SupervisorId = '$staffId'";
    $resultcountSupervisingNew = $connection->query($querycountSupervisingNew);
    if (!$resultcountSupervisingNew) die($connection->error);

    $countSupervisingNew = mysqli_num_rows($resultcountSupervisingNew);

    $totalNew = $countSupervisingNew + $countExaminingNew;

    $queryUpdateStaffDetails = "UPDATE staff_details SET Supervising = '$countSupervisingNew', Examining = '$countExaminingNew', Total = '$totalNew' WHERE StaffID = '$staffId'";
    $resultUpdateStaffDetails = $connection->query($queryUpdateStaffDetails);
    if (!$resultUpdateStaffDetails) die($connection->error);

}

?>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <?php  include "admin_nav.php"; ?>
    <div class="content-wrapper">
        <div class="container-fluid">


            <h2 class="mt-5 font-weight-light text-center">Allocation</h2>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Topic</th>
                            <th>Supervisor</th>
                            <th>Examiner</th>
                            <th>Day &amp; Time</th>
                            <th>Venue</th>
                        </tr>
                    </thead>

                    <?php
                    $query = "SELECT * FROM project_allocation ORDER BY TopicNumber";
                    $result = $connection->query($query);
                    if (!$result) die($connection->error);

                    while($row = mysqli_fetch_assoc($result))
                    {

                        $topicNumber = $row['TopicNumber'];
                        $topic = $row['Topic'];
                        $supervisor = $row['Supervisor'];
                        $examiner = $row['Examiner'];


                        $day = $row['Day'];
                        $time=date("H:i ",strtotime($row['Time']));
                        $venue = $row['Venue'];
                    ?>


                    <tr>

                        <td> <?php echo "Topic ".$topicNumber.": ". $topic;?></td>
                        <td> <?php echo $supervisor;?></td>
                        <td> <?php echo $examiner;?></td>
                        <td> <?php echo $day." ".$time;;?></td>
                        <td> <?php echo $venue;?></td>
                       <td>
                            <a href="#editexaminer<?php echo $topicNumber; ?>" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
                            <?php include('editexaminer_allocation_modal.php'); ?>
                            
                    </tr>
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