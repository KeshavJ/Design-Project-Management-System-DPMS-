<?php  include "admin_header.php"; ?>
<?php  include "database_connection.php"; ?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <?php  include "admin_nav.php"; ?>
    <div class="content-wrapper">
        <div class="container-fluid">

            <h2 class="mt-5 font-weight-light text-center">Staff</h2>
            <br>
            <div class="pull-right"><a href="#addnewstaff" data-toggle="modal" class="btn btn-primary"><div class="glyphicon glyphicon-plus"></div> Add New Staff </a></div>

            <div class="table-responsive">
                <br>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Staff Member</th>
                        </tr>
                    </thead>

                    <?php
                    $query = "SELECT StaffID, StaffName, Initials FROM staff_details ORDER BY StaffID";
                    $result = $connection->query($query);
                    if (!$result) die($connection->error);

                    while($row = mysqli_fetch_assoc($result))
                    {

                        $staffid = $row['StaffID'];
                        $staffName = $row['StaffName'];
                        $initials = $row['Initials'];
                    ?>

                    <tr>

                        <td> <?php echo $initials.". ".$staffName;?></td>
                        <td><a href="#editstaff<?php echo $staffid; ?>" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
                            <td>
							<a href="#delstaff<?php echo $staffid; ?>" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
							<?php include('editdelete_staff_modal.php'); ?>
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
<?php  include "addstaff_modal.php"; ?>


</body>


</html>
