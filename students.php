<?php  include "admin_header.php"; ?>
<?php  include "database_connection.php"; ?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <?php  include "admin_nav.php"; ?>
    <div class="content-wrapper">
        <div class="container-fluid">

            <h2 class="mt-5 font-weight-light text-center">Students</h2>
            <br>
            <div class="pull-right"><a href="#addnewstudent" data-toggle="modal" class="btn btn-primary"><div class="glyphicon glyphicon-plus"></div> Add New Student </a></div>

            <div class="table-responsive">
                <br>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Student Number</th>
                            <th>Surname</th>
                            <th>Name</th>
                            <th>Initials</th>
                            <th>Discipline</th>
                        </tr>
                    </thead>
                    <?php
                    $query = "SELECT StudentNo, Surname, FirstName, Initials, Discipline FROM student_details ORDER BY StudentNo";
                    $result = $connection->query($query);
                    if (!$result) die($connection->error);

                    while($row = mysqli_fetch_assoc($result))
                    {
                        $studentNo = $row['StudentNo'];
                        $firstName = $row['FirstName'];
                        $surname = $row['Surname'];
                        $initials = $row['Initials'];
                        $discipline = $row['Discipline'];
                    ?>


                    <tr>
                        <td> <?php echo $studentNo;?></td>
                        <td> <?php echo $surname;?></td>
                        <td> <?php echo $firstName;?></td>
                        <td> <?php echo $initials;?></td>
                        <td> <?php echo $discipline;?></td>
                        <td><a href="#editstudent<?php echo $studentNo; ?>" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
                            <td>
							<a href="#delstudent<?php echo $studentNo; ?>" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
							<?php include('editdelete_student_modal.php'); ?>
                   </td>



                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>

        <?php  include "admin_footer.php"; ?>
    </div>
<?php  include "addnewstudent_modal.php"; ?>


</body>


</html>
