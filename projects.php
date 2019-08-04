<?php  include "admin_header.php"; ?>
<?php  include "database_connection.php"; ?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <?php  include "admin_nav.php"; ?>
    <div class="content-wrapper">
        <div class="container-fluid">

            <h2 class="mt-5 font-weight-light text-center">Projects</h2>
            <br>
            <div class="pull-right"><a href="#addnewproject" data-toggle="modal" class="btn btn-primary"><div class="glyphicon glyphicon-plus"></div> Add New Project </a></div>

            <div class="table-responsive">
                <br>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Topic</th>
                            <th>Description</th>
                            <th>Supervisor</th>

                        </tr>
                    </thead>
                    <?php
                    
                    $query = "SELECT TopicNumber, Topic, Description, Supervisor FROM project_list ORDER BY TopicNumber";
                    $result = $connection->query($query);
                    if (!$result) die($connection->error);

                    while($row = mysqli_fetch_assoc($result))
                    {
                        $topicNumber = $row['TopicNumber'];
                        $topic = $row['Topic'];
                        $supervisor = $row['Supervisor'];
                        $description = $row['Description'];
                    ?>


                    <tr>
                        <td> <?php echo "Topic ".$topicNumber.": ". $topic;?></td>
                        <td> <?php echo $description;?></td>
                        <td> <?php echo $supervisor;?></td>
                        <td>
                            <a href="#editproject<?php echo $topicNumber; ?>" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
                            <td>
							<a href="#delproject<?php echo $topicNumber; ?>" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
							<?php include('editdelete_project_modal.php'); ?>
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

    <?php include "addproject_modal.php"; ?>
    
   
   



    

</body>


</html>
