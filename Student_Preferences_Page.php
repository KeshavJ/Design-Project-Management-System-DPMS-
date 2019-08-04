<?php  include "admin_header.php"; ?>
<?php  include "database_connection.php"; ?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <?php  include "admin_nav.php"; ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="mt-5 font-weight-light text-center">Student Preferences</h2>
                    <br>
                    <?php

                    $choice1 = '';
                    $choice2 = '';
                    $choice3 = '';
                    $choice4 = '';
                    $assignedtopic = '';
                    $stdno = '';
                    $choice = '';
                    $name = '';
                    $surname = '';
                    $initial = '';


                    if(isset($_POST['viewconflicts']))
                    {
                    ?>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th> </th>
                                <th>Student Number</th>
                                <th>Surname</th>
                                <th>Name</th>
                                <th>1st Choice</th>
                                <th>2nd Choice</th>
                                <th>3rd Choice</th>
                                <th>4th Choice</th>
                                <th>Motivation</th>
                                <th>Assigned Topic</th>
                                <th> </th>

                            </tr>
                        </thead>
                        <?php

                        $query = "SELECT StudentNo, Surname, FirstName, Discipline, FirstChoice, SecondChoice, ThirdChoice, FourthChoice, Motivation, AssignedTopic FROM student_details WHERE FirstChoice IN (select FirstChoice from student_details group by FirstChoice having count(*) > 1 and FirstChoice != '' and AssignedTopic = 0) OR SecondChoice IN (select SecondChoice from student_details group by SecondChoice having count(*) > 1 and SecondChoice != '' and AssignedTopic = 0) OR ThirdChoice IN (select ThirdChoice from student_details group by ThirdChoice having count(*) > 1 and ThirdChoice != '' and AssignedTopic = 0) OR FourthChoice IN (select FourthChoice from student_details group by FourthChoice having count(*) > 1 and FourthChoice != '' and AssignedTopic = 0) ";


                        $result = $connection->query($query);
                        if (!$result) die($connection->error);

                        while($row = mysqli_fetch_array($result))
                        {

                            $choice1 = $row['FirstChoice'];
                            $choice2 = $row['SecondChoice'];
                            $choice3 = $row['ThirdChoice'];
                            $choice4 = $row['FourthChoice'];
                            $assignedtopic = $row['AssignedTopic'];
                            $stdno = $row['StudentNo'];
                            $firstName = $row['FirstName'];
                            $surname = $row['Surname'];
                            $motivation = $row['Motivation']

                        ?>

                        <tr>
                            <td> <img src='resources/img/error.png' alt='Error Icon'  style="width:20px;"></td>

                            <td><?php echo $stdno; ?></td>
                            <td><?php echo $surname; ?></td>
                            <td><?php echo $firstName; ?></td>
                            <td><?php echo $choice1; ?></td>
                            <td><?php echo $choice2; ?></td>
                            <td><?php echo $choice3; ?></td>
                            <td><?php echo $choice4; ?></td>
                            <td><?php echo $motivation; ?></td> 
                            <?php


                            if($assignedtopic != '0')
                            {
                            ?>
                            <td><?php echo $assignedtopic; ?></td> 
                            <td></td>
                            <?php
                            }

                            else
                            {
                            ?>
                            <td>
                                <form method='post' action='#' class="form-inline"> 
                                    <select name='assigned' id='assignedtopic' class="form-control"> 
                                        <option value="<?php echo $choice1; ?>"> Topic <?php echo $choice1; ?></option> 
                                        <option value="<?php echo $choice2; ?>"> Topic <?php echo $choice2; ?></option> 
                                        <option value="<?php echo $choice3; ?>"> Topic <?php echo $choice3; ?></option> 
                                        <option value="<?php echo $choice4; ?>"> Topic <?php echo $choice4; ?></option> 
                                        <option value=' ' disabled selected hidden>Assign...</option> 
                                    </select>


                                    <td>
                                        <input type= hidden name= indexkey  value="<?php echo $stdno; ?>">
                                        <button class="btn btn-success btn-sm" name="assign" type="submit">OK</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                            }

                            if(isset($_POST['assign']))
                            {
                                $stdno = $_REQUEST['indexkey'];
                                $choice = $_REQUEST['assigned'];

                                $query2 = "UPDATE student_details SET AssignedTopic = '$choice' WHERE StudentNo = '$stdno'";

                                $result2 = $connection->query($query2);
                                if (!$result2) die($connection->error);

                                $query3 = "UPDATE project_list SET Available = 'No' WHERE TopicNumber = '$choice'";

                                $result3 = $connection->query($query3);
                                if (!$result3) die($connection->error);
                        ?>
                        <meta http-equiv='refresh' content='0'>
                        <?php
                            } 



                        }
                        ?>
                    </table>
                    <?php
                        $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
                    ?>
                    <div></div><br><a href= "<?php echo $url;?>" class = "btn btn-info">Back</a>
                    <?php
                    }

                    else
                    {
                        $query = "SELECT StudentNo, Surname, FirstName, Discipline, FirstChoice, SecondChoice, ThirdChoice, FourthChoice, Motivation, AssignedTopic FROM student_details WHERE Submitted != ''";

                        $result = $connection->query($query);
                        if (!$result) die($connection->error);
                    ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th> </th>
                                <th>Student Number</th>
                                <th>Surname</th>
                                <th>Name</th>
                                <th>1st Choice</th>
                                <th>2nd Choice</th>
                                <th>3rd Choice</th>
                                <th>4th Choice</th>
                                <th>Motivation</th>
                                <th>Assigned Topic</th>
                                <th> </th>
                            </tr>
                        </thead>

                        <?php

                        while($row = mysqli_fetch_array($result))
                        {
                            $choice1 = $row['FirstChoice'];
                            $choice2 = $row['SecondChoice'];
                            $choice3 = $row['ThirdChoice'];
                            $choice4 = $row['FourthChoice'];
                            $assignedtopic = $row['AssignedTopic'];
                            $stdno = $row['StudentNo'];
                            $firstName = $row['FirstName'];
                            $surname = $row['Surname'];
                            $motivation = $row['Motivation']
                        ?>
                        <tr>
                            <td></td>
                            <td><?php echo $stdno; ?></td>
                            <td><?php echo $surname; ?></td>
                            <td><?php echo $firstName; ?></td>
                            <td><?php echo $choice1; ?></td>
                            <td><?php echo $choice2; ?></td>
                            <td><?php echo $choice3; ?></td>
                            <td><?php echo $choice4; ?></td>
                            <td><?php echo $motivation; ?></td> 




                            <?php
                            if($assignedtopic != '0')
                            {
                            ?>
                            <td><?php echo $assignedtopic; ?></td> 
                            <td></td>
                            <?php
                            }

                            else
                            {
                            ?>
                            <td>
                                <form method='post' action='#' class="form-inline"> 
                                    <select name='assigned' id='assignedtopic' class="form-control"> 
                                        <option value="<?php echo $choice1; ?>"> Topic <?php echo $choice1; ?></option> 
                                        <option value="<?php echo $choice2; ?>"> Topic <?php echo $choice2; ?></option> 
                                        <option value="<?php echo $choice3; ?>"> Topic <?php echo $choice3; ?></option> 
                                        <option value="<?php echo $choice4; ?>"> Topic <?php echo $choice4; ?></option> 
                                        <option value=' ' disabled selected hidden>Assign...</option> 
                                    </select>


                                    <td>
                                        <input type= hidden name= indexkey  value="<?php echo $stdno; ?>">
                                        <button class="btn btn-success btn-sm" name="assign" type="submit">OK</button>
                                </form>
                            </td>
                        </tr>

                        <?php
                            }

                            if(isset($_POST['assign']))
                            {
                                $stdno = $_REQUEST['indexkey'];
                                $choice = $_REQUEST['assigned'];

                                $query2 = "UPDATE student_details SET AssignedTopic = '$choice' WHERE StudentNo = '$stdno'";

                                $result2 = $connection->query($query2);
                                if (!$result2) die($connection->error);



                        ?>
                        <meta http-equiv='refresh' content='0'>
                        <?php
                            } 

                        }

                        ?>

                    </table>


                    <form method="post" action="#">


                        <div class="form-group">

                            <button class="btn btn-success" name="confirmtopics" type="submit">Confirm Topics</button>

                            <button class="btn btn-info" name="viewconflicts" type="submit">View Conflicts</button>

                        </div>





                    </form>

                    <?php
                        if(isset($_POST['confirmtopics']))
                        {
                            $query = "SELECT StudentNo, Surname, FirstName, Initials, AssignedTopic FROM student_details WHERE AssignedTopic != 0";

                            $result = $connection->query($query);
                            if (!$result) die($connection->error);

                            while($row = mysqli_fetch_assoc($result))
                            {
                                $topic = $row['AssignedTopic'];
                                $stdno = $row['StudentNo'];
                                $surname = $row['Surname'];
                                $name = $row['FirstName'];
                                $initial = $row['Initials'];


                                $query2 = "UPDATE project_list SET Available = 'No' WHERE TopicNumber = '$topic'";

                                $result2 = $connection->query($query2);
                                if (!$result2) die($connection->error);

                                $query3 = "UPDATE project_allocation SET StudentNo = '$stdno', Surname = '$surname', FirstName = '$name', Initials = '$initial' WHERE TopicNumber = '$topic'";

                                $result3 = $connection->query($query3);
                                if (!$result3) die($connection->error); 

                            }
                            header("Location: Project_Allocation_Page.php");

                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php 
        mysqli_close($connection);
        
        include "admin_footer.php"; ?>
    </div>



</body>


</html>
