<?php
    session_start();

    include("config.php");
    if(!isset($_SESSION['valid'])){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-=UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Change Profile</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p> <a href="home.php">Logo</a></p>
        </div>

        <div class="right-links">
            <a href="#">Change Profile</a>
            <a href="logout.php"><button class="btn">Logout</button></a>
        </div>
    </div>

    <div class="container">
        <div class="box form-box">
            <?php
                if(isset($_POST['submit'])){
                    $studentNumber = $_POST['studentNumber'];
                    $firstName = $_POST['firstName'];
                    $middleInitial = $_POST['middleInitial'];
                    $lastName = $_POST['lastName'];
                    $courseEnrolled = $_POST['courseEnrolled'];
                    $enrollStatus = $_POST['enrollStatus'];
                    $id = $_SESSION['iD'];

                    $edit_query = mysqli_query($con,"UPDATE users SET studentNumber='$studentNumber', firstName='$firstName', middleInitial='$middleInitial', lastName='$lastName', courseEnrolled='$courseEnrolled', enrollStatus='$enrollStatus' WHERE iD=$id ") or die("Error Occured");
                    if($edit_query){
                        echo "<div class='message'>
                                <p>Your Profile is Up to date!</p>
                            </div> <br>";
                        echo "<a href='home.php'><button class='btn'>Go Home</button>";
                        }
                } else{
                    $id = $_SESSION['iD'];
                    $query = mysqli_query($con,"SELECT * FROM users WHERE iD=$id");

                    while($result = mysqli_fetch_assoc($query)){
                        $res_studentNumber = $result['studentNumber'];
                        $res_firstName = $result['firstName'];
                        $res_middleInitial = $result['middleInitial'];
                        $res_lastName = $result['lastName'];
                        $res_courseEnrolled = $result['courseEnrolled'];
                        $res_enrollStatus = $result['enrollStatus'];
                    }
            ?>
            <header>Edit Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="studentNumber">Student Number</label>
                    <input type="text" name="studentNumber" id="studentNumber" value="<?php echo $res_studentNumber; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" id="firstName" value="<?php echo $res_firstName; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="middleInitial">Middle Initial</label>
                    <input type="text" name="middleInitial" id="middleInitial" value="<?php echo $res_middleInitial; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" id="lastName" value="<?php echo $res_lastName; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="courseEnrolled">Enrolled Course</label>
                    <input type="text" name="courseEnrolled" id="courseEnrolled" value="<?php echo $res_courseEnrolled; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="enrollStatus">Enrollment Status</label>
                    <input type="text" name="enrollStatus" id="enrollStatus" value="<?php echo $res_enrollStatus; ?>" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" name="submit" class="btn" value="Update" required>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>