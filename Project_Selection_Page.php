<?php  include "header.php"; ?>
<?php  include "database_connection.php"; ?>


<body>

    <!-- Navigation -->
    <?php  include "navigation.php"; ?>

    <!-- Page Content -->
    <br>
    <div class="container">

        <div class="row">


            <?php
            $discipline ="";
            $studentNo = "";
            $firstName = "";
            $surname = "";

            if (isset($_POST['getStdno'])) 
            {

                $discipline  = "";
                $_SESSION['std'] = $_REQUEST['stdno'];
                if( $_SESSION['std'] != "")
                {
                    $query = "SELECT StudentNo, FirstName, Surname, Discipline FROM student_details WHERE StudentNo = '".mysqli_real_escape_string($connection, $_REQUEST['stdno'])."'";

                    $result = $connection->query($query);
                    if (!$result) die($connection->error);

                    while($row = mysqli_fetch_assoc($result))
                    {
                        $discipline = $row['Discipline'];
                        $studentNo = $row['StudentNo'];
                        $firstName = $row['FirstName'];
                        $surname = $row['Surname'];
                    }
                    if($studentNo != ""){
            ?>

            Student Number: <?php echo $studentNo;?><br>
            Name: <?php echo $firstName;?><br>
            Surname: <?php echo $surname;?><br>
            Discipline: <?php echo $discipline; ?> Engineering<br>

            <?php


                    }
                    if($discipline == "")
                    {
                        echo "Error could not find student details. <br> Only students registered in this module can view topics.";
                    }


                    else
                    {
            ?>
        </div>

        <section>

            <div class="row">
                <div class="col-lg-7">
                    <div class="box">

                        <div class="row">
                            <div class="col-lg-12">

                                <?php
                        $query = "SELECT TopicNumber, Topic, Description, Supervisor FROM project_list WHERE Available != 'No' AND Discipline = '".mysqli_real_escape_string($connection, $discipline)."' OR Discipline = 'Both'";

                        $result = $connection->query($query);

                        if (!$result) die($connection->error);

                                ?>

                                <div><h2 class="font-weight-light text-center"> <?php echo $discipline;?> Engineering Design Project Topics</h2><br></div>

                                <?php

                        while($row = mysqli_fetch_assoc($result))
                        {
                            $topicNumber = $row['TopicNumber'];
                            $topic = $row['Topic'];
                            $supervisor = $row['Supervisor'];
                            $description = $row['Description'];

                                ?>
                                <br><b>Topic <?php echo $topicNumber.": " . $topic;?></b><br>
                                <br>Supervisor: <?php echo $supervisor;?><br>
                                <br>Description: <?php echo $description;?><br>

                                <?php
                        }
                    }
                }
                else{
                    header("Location: index.html");
                }
            }



                                ?>


                                <?php

                                if (isset($_POST['stdno'])) 
                                {
                                    $assignedTopic= "";

                                    $query = "SELECT AssignedTopic FROM student_details WHERE StudentNo = '".mysqli_real_escape_string($connection, $_REQUEST['stdno'])."'";

                                    $result = $connection->query($query);
                                    if (!$result) die($connection->error);

                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        $assignedTopic = $row['AssignedTopic'];
                                    }

                                    if($assignedTopic == 0)
                                    {



                                        if($discipline != "")
                                        {
                                ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="box">

                        <div class="row">
                            <div class="col-lg-12">
                                <?php

                                            $query = "SELECT TopicNumber, Topic FROM project_list WHERE Available != 'No' AND Discipline = '".mysqli_real_escape_string($connection, $discipline)."' OR Discipline = 'Both'";

                                ?>

                                <div><h2 class="font-weight-light text-center">Selection</h2><br></div>

                                <form  method="post" action="Save_choices.php">

                                    <!-- Choice 1 -->
                                    <div class="form-group">
                                        <label>1st Choice</label>

                                        <select class="form-control" name="choice1" id="choice1">

                                            <?php

                                            $result = $connection->query($query);

                                            if (!$result) die($connection->error);

                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                                $topicNumber = $row['TopicNumber'];
                                                $topic = $row['Topic'];

                                            ?>
                                            <option value="<?php echo $topicNumber; ?>"> Topic <?php echo $topicNumber.":  ".$topic;?></option>

                                            <?php
                                            }
                                            ?>

                                            <option value="" disabled selected hidden>Choose...</option>
                                        </select>
                                        <br>


                                        <!-- Choice 2 -->
                                        <div class="form-group">
                                            <label>2nd Choice</label>

                                            <select class="form-control" name="choice2" id="choice2">

                                                <?php
                                            $result = $connection->query($query);
                                            if (!$result) die($connection->error);


                                            while($row = mysqli_fetch_assoc($result))
                                            {

                                                $topicNumber = $row['TopicNumber'];
                                                $topic = $row['Topic'];

                                                ?>

                                                <option value="<?php echo $topicNumber; ?>"> Topic <?php echo $topicNumber.":  ".$topic;?></option>

                                                <?php
                                            }
                                                ?>
                                                <option value="" disabled selected hidden>Choose...</option>
                                            </select>
                                            <br>


                                            <!-- Choice 3 -->
                                            <div class="form-group">
                                                <label>3rd Choice</label>

                                                <select class="form-control" name="choice3" id="choice3">

                                                    <?php

                                            $result = $connection->query($query);
                                            if (!$result) die($connection->error);

                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                                $topicNumber = $row['TopicNumber'];
                                                $topic = $row['Topic'];
                                                    ?>

                                                    <option value="<?php echo $topicNumber; ?>"> Topic <?php echo $topicNumber.":  ".$topic;?></option>

                                                    <?php
                                            }
                                                    ?>
                                                    <option value="" disabled selected hidden>Choose...</option>
                                                </select>
                                                <br>


                                                <!-- Choice 4 -->
                                                <div class="form-group">
                                                    <label>4th Choice</label>

                                                    <select class="form-control" name="choice4" id="choice4">

                                                        <?php

                                            $result = $connection->query($query);
                                            if (!$result) die($connection->error);

                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                                $topicNumber = $row['TopicNumber'];
                                                $topic = $row['Topic'];

                                                        ?>

                                                        <option value="<?php echo $topicNumber; ?>"> Topic <?php echo $topicNumber.":  ".$topic;?></option>

                                                        <?php
                                            }

                                                        ?>
                                                        <option value="" disabled selected hidden>Choose...</option>
                                                    </select>
                                                    <br>

                                                    <div class="form-group">
                                                        <label for="date">Motivation</label>

                                                        <textarea name="motivation" placeholder="Your Motivation" class = "form-control" cols="30" rows="8"></textarea>

                                                    </div>

                                                    <div class="form-group">
                                                        <button class="btn btn-success" name="preferenceSubmit" type="submit">Submit</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <?php
                                        }
                                    }

                                    else
                                    {
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">

                    <div><h2 class="font-weight-light text-center">Your Selection</h2><br></div>
                    <?php

                                        $query = "SELECT FirstChoice, SecondChoice, ThirdChoice, FourthChoice FROM student_details WHERE StudentNo = '".mysqli_real_escape_string($connection, $_REQUEST['stdno'])."'";

                                        $result = $connection->query($query);

                                        if (!$result) die($connection->error);

                                        while($row = mysqli_fetch_array($result))
                                        {

                                            $choice1 = $row['FirstChoice'];
                                            $choice2 = $row['SecondChoice'];
                                            $choice3 = $row['ThirdChoice'];
                                            $choice4 = $row['FourthChoice'];
                                        }

                                        $query = "SELECT TopicNumber, Topic, Description, Supervisor FROM project_list WHERE TopicNumber = '".mysqli_real_escape_string($connection, $choice1)."'";

                                        $result = $connection->query($query);

                                        if (!$result) die($connection->error);
                    ?> 
                    <h3 class="text-center">1st Choice</h3>
                    <?php
                                        while($row = mysqli_fetch_array($result))
                                        {
                    ?>

                    <p><b>Topic <?php echo $row['TopicNumber'].": " . $row['Topic'];?></b></p><br>
                    <p><b>Supervisor: </b><?php echo $row['Supervisor'];?></p><br>
                    <p><b>Decription:</b><br><?php echo $row['Description'];?></p><br>


                    <?php
                                        }

                                        $query = "SELECT TopicNumber, Topic, Description, Supervisor FROM project_list WHERE TopicNumber = '".mysqli_real_escape_string($connection, $choice2)."'";

                                        $result = $connection->query($query);

                                        if (!$result) die($connection->error);
                    ?> 
                    <h3 class="text-center">2nd Choice</h3>
                    <?php
                                        while($row = mysqli_fetch_array($result))
                                        {
                    ?>

                    <p><b>Topic <?php echo $row['TopicNumber'].": " . $row['Topic'];?></b></p><br>
                    <p><b>Supervisor: </b><?php echo $row['Supervisor'];?></p><br>
                    <p><b>Decription:</b><br><?php echo $row['Description'];?></p><br>


                    <?php
                                        }

                                        $query = "SELECT TopicNumber, Topic, Description, Supervisor FROM project_list WHERE TopicNumber = '".mysqli_real_escape_string($connection, $choice3)."'";

                                        $result = $connection->query($query);

                                        if (!$result) die($connection->error);

                    ?> 
                    <h3 class="text-center">3rd Choice</h3>
                    <?php
                                        while($row = mysqli_fetch_array($result))
                                        {
                    ?>

                    <p><b>Topic <?php echo $row['TopicNumber'].": " . $row['Topic'];?></b></p><br>
                    <p><b>Supervisor: </b><?php echo $row['Supervisor'];?></p><br>
                    <p><b>Decription:</b><br><?php echo $row['Description'];?></p><br>


                    <?php
                                        }
                                        $query = "SELECT TopicNumber, Topic, Description, Supervisor FROM project_list WHERE TopicNumber = '".mysqli_real_escape_string($connection, $choice4)."'";

                                        $result = $connection->query($query);

                                        if (!$result) die($connection->error);

                    ?> 
                    <h3 class="text-center">4th Choice</h3>
                    <?php
                                        while($row = mysqli_fetch_array($result))
                                        {
                    ?>

                    <p><b>Topic <?php echo $row['TopicNumber'].": " . $row['Topic'];?></b></p><br>
                    <p><b>Supervisor: </b><?php echo $row['Supervisor'];?></p><br>
                    <p><b>Decription:</b><br><?php echo $row['Description'];?></p><br>


                    <?php
                                        }

                                        $query = "SELECT Motivation FROM student_details WHERE StudentNo = '".mysqli_real_escape_string($connection, $_REQUEST['stdno'])."'";

                                        $result = $connection->query($query);

                                        if (!$result) die($connection->error);
                    ?> 

                    <h3 class="text-center">Motivation</h3>
                    <?php
                                        while($row = mysqli_fetch_array($result))
                                        {
                    ?>


                    <p><br><?php echo $row['Motivation'];?></p><br>


                    <?php
                                        }




                                    }


                                }



                    ?>

                </div>
            </div>



        </section>


    </div>


    <?php  include "footer.php"; ?>

</body>
</html>