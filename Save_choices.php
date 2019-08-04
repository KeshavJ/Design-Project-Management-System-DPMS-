<?php  include "header.php"; ?>
<?php  include "database_connection.php"; ?>



<body>

    <!-- Navigation -->
    <?php  include "navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2></h2>
                <br>
                <?php

                $stdno = "";
                $stdno = $_SESSION['std'];

                if(isset($_POST['preferenceSubmit']))
                { 



                    $query = "SELECT StudentNo, FirstName, Surname, Discipline FROM student_details WHERE StudentNo = '".mysqli_real_escape_string($connection, $stdno)."'";

                    $result = $connection->query($query);
                    if (!$result) die($connection->error);

                    while($row = mysqli_fetch_array($result))
                    {

                        echo "Student Number: ".$row['StudentNo']."<br>";
                        echo "Name: ".$row['FirstName']."<br>";
                        echo "Surname: ".$row['Surname']."<br>";
                        echo "Discipline: ".$row['Discipline']." Engineering";
                    }
                }
                ?>  
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">


                <?php

                $choice1 = "";
                $choice2 = "";
                $choice3 = "";
                $choice4 = "";
                $motive = "";


                if(isset($_POST['preferenceSubmit']))
                {   
                ?> 

                <h3 class="text-center">1st Choice</h3>
                <?php
                    if(!isset($_POST['choice1']))
                    {
                        echo "You forgot to select your 1st Choice!";
                ?>
                <br>
                <?php
                    }

                    else
                    {
                        $query = "SELECT TopicNumber, Topic, Description, Supervisor FROM project_list WHERE TopicNumber = '".mysqli_real_escape_string($connection, $_REQUEST['choice1'])."'";

                        $result = $connection->query($query);

                        if (!$result) die($connection->error);


                        while($row = mysqli_fetch_array($result))
                        {
                            $_SESSION['choice1'] = $row['TopicNumber'];
                ?>

                <p><b>Topic <?php echo $row['TopicNumber'].": " . $row['Topic'];?></b></p><br>
                <p><b>Supervisor: </b><?php echo $row['Supervisor'];?></p><br>
                <p><b>Decription:</b><br><?php echo $row['Description'];?><br></p>


                <?php
                        }

                    }
                ?> 

                <h3 class="text-center">2nd Choice</h3>
                <?php
                    if(!isset($_POST['choice2']))
                    {
                        echo "You forgot to select your 2nd Choice!";
                ?>
                <br>
                <?php
                    }

                    else
                    {
                        $query = "SELECT TopicNumber, Topic, Description, Supervisor FROM project_list WHERE TopicNumber = '".mysqli_real_escape_string($connection, $_REQUEST['choice2'])."'";

                        $result = $connection->query($query);

                        if (!$result) die($connection->error);


                        while($row = mysqli_fetch_array($result))
                        {
                            $_SESSION['choice2'] = $row['TopicNumber'];
                ?>

                <p><b>Topic <?php echo $row['TopicNumber'].": " . $row['Topic'];?></b></p><br>
                <p><b>Supervisor: </b><?php echo $row['Supervisor'];?></p><br>
                <p><b>Decription:</b><br><?php echo $row['Description'];?><br></p>


                <?php
                        }

                    }
                ?> 
                <h3 class="text-center">3rd Choice</h3>
                <?php
                    if(!isset($_POST['choice3']))
                    {
                        echo "You forgot to select your 3rd Choice!";
                ?>
                <br>
                <?php
                    }

                    else
                    {
                        $query = "SELECT TopicNumber, Topic, Description, Supervisor FROM project_list WHERE TopicNumber = '".mysqli_real_escape_string($connection, $_REQUEST['choice3'])."'";

                        $result = $connection->query($query);

                        if (!$result) die($connection->error);


                        while($row = mysqli_fetch_array($result))
                        {
                            $_SESSION['choice3'] = $row['TopicNumber'];
                ?>

                <p><b>Topic <?php echo $row['TopicNumber'].": " . $row['Topic'];?></b></p><br>
                <p><b>Supervisor: </b><?php echo $row['Supervisor'];?></p><br>
                <p><b>Decription:</b><br><?php echo $row['Description'];?><br></p>


                <?php
                        }

                    }
                ?> 

                <h3 class="text-center">4th Choice</h3>
                <?php
                    if(!isset($_POST['choice4']))
                    {
                        echo "You forgot to select your 4th Choice!";
                ?>
                <br>
                <?php
                    }

                    else
                    {
                        $query = "SELECT TopicNumber, Topic, Description, Supervisor FROM project_list WHERE TopicNumber = '".mysqli_real_escape_string($connection, $_REQUEST['choice4'])."'";

                        $result = $connection->query($query);

                        if (!$result) die($connection->error);


                        while($row = mysqli_fetch_array($result))
                        {
                            $_SESSION['choice4'] = $row['TopicNumber'];
                ?>

                <p><b>Topic <?php echo $row['TopicNumber'].": " . $row['Topic'];?></b></p><br>
                <p><b>Supervisor: </b><?php echo $row['Supervisor'];?></p><br>
                <p><b>Decription:</b><br><?php echo $row['Description'];?><br></p>


                <?php
                        }

                    }

                ?>

                <h3 class="text-center">Motivation</h3>
                <?php
                    if(!strlen(trim($_POST['motivation'])))
                    {

                        echo "Please provide some motivation";
                        echo"<br>";
                    }

                    else
                    { 

                        echo $_REQUEST['motivation'];
                        $_SESSION['motive'] = $_REQUEST['motivation'];
                ?>
                <p><?php echo $row['Description'];?><br></p>
                <?php



                    }

                    if(isset($_POST['choice1']) && isset($_POST['choice2']) && isset($_POST['choice3']) && isset($_POST['choice4']) && isset($_POST['motivation']))
                    {
                ?>
                <br>
                <form  method="post" action="Save_choices.php" class="form-inline">

                    <button class="btn btn-success save-btn" name="preferenceSave" type="submit">Save</button>

                </form>

                <?php
                    }
                    $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
                ?>
                <br>
                <a href= "<?php echo $url;?>" class = "btn btn-danger back-btn">Cancel</a>
                <?php

                }


                if(isset($_POST['preferenceSave']))
                {
                    $c1 = $_SESSION['choice1'];
                    $c2 = $_SESSION['choice2'];
                    $c3 = $_SESSION['choice3'];
                    $c4 = $_SESSION['choice4'];
                    $m = $_SESSION['motive'];


                    $query = "UPDATE student_details SET FirstChoice = '$c1', SecondChoice = '$c2', ThirdChoice = '$c3', FourthChoice = '$c4', Motivation = '$m', Submitted  = 'Yes', AssignedTopic = '$c1' WHERE StudentNo = '$stdno'";


                    $result = $connection->query($query);

                    if (!$result) die($connection->error);

                    $query2 = "SELECT AssignedTopic FROM student_details WHERE AssignedTopic = '$c1'";


                    $result2 = $connection->query($query2);

                    if (!$result2) die($connection->error);

                    $rowcount=mysqli_num_rows($result2);

                    if($rowcount > 1)
                    {
                        $query3 = "UPDATE student_details SET AssignedTopic = '0' WHERE AssignedTopic = '$c1'";
                        $result3 = $connection->query($query3);

                        if (!$result3) die($connection->error);
                    }



                    echo "Your choices have been saved<br>";
                ?>

                <br>
                <form  method="post" action="index.html" class="form-inline">

                    <button class="btn btn-info"  type="submit">Ok</button>

                </form>
                <?php

                }


                ?>  
            </div>
        </div>
    </div>
    </div>


<?php  include "footer.php"; ?>

</body>
</html>