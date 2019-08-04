<?php  include "admin_header.php"; ?>
<?php  include "database_connection.php"; ?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <?php  include "admin_nav.php"; ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <h2 class="mt-5 font-weight-light text-center">Project Allocation</h2>
            <br>
            <div class="table-responsive">

                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Student Number</th>
                            <th>Surname</th>
                            <th>Name</th>
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
                        $studentNo = $row['StudentNo'];
                        $firstName = $row['FirstName'];
                        $surname = $row['Surname'];
                        $initials = $row['Initials'];
                        $topicNumber = $row['TopicNumber'];
                        $topic = $row['Topic'];
                        $supervisor = $row['Supervisor'];
                        $description = $row['Description'];
                        $examiner = $row['Examiner'];
                        $day = $row['Day'];
                        $time=date("H:i ",strtotime($row['Time']));
                        $venue = $row['Venue'];
                    ?>


                    <tr>
                        <td> <?php echo $studentNo;?></td>
                        <td> <?php echo $surname;?></td>
                        <td> <?php echo $firstName;?></td>
                        <td> <?php echo "Topic ".$topicNumber.": ". $topic;?></td>
                        <td> <?php echo $supervisor;?></td>
                        <td> <?php echo $examiner;?></td>
                        <td> <?php echo $day." ".$time;?></td>
                        <td> <?php echo $venue;?></td>



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
