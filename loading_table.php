<?php  include "admin_header.php"; ?>
<?php  include "database_connection.php"; ?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <?php  include "admin_nav.php"; ?>
    <div class="content-wrapper">
        <div class="container-fluid">

            <h2 class="mt-5 font-weight-light text-center">Staff Loading</h2>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Lecturer</th>
                            <th>Examining</th>
                            <th>Supervising</th>
                            <th>Total</th>


                        </tr>
                    </thead>

                    <?php
                    $query = "SELECT * FROM staff_details ORDER BY StaffID";
                    $result = $connection->query($query);
                    if (!$result) die($connection->error);

                    while($row = mysqli_fetch_assoc($result))
                    {

                        $staffName = $row['StaffName'];
                        $supervising = $row['Supervising'];
                        $examining = $row['Examining'];
                        $totalNo = $row['Total'];

                    ?>

                    <tr>

                        <td> <?php echo $staffName;?></td>
                        <td> <?php echo $examining;?></td>
                        <td> <?php echo  $supervising;?></td>
                        <td> <?php echo $totalNo;?></td>


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
