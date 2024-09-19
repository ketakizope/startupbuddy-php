<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Startup Idea Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

    <form action="" method="post">
    
        <fieldset>
            <legend>Student Information</legend>
            
            <label for="student_name">Student Name:</label>
            <input type="text" id="student_name" name="student_name" required><br><br>
            <?php

            $email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
?>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly><br><br>


            <label for="branch">Branch:</label>

            <select id="student_branch" name="student_branch" required>
                <option value="" disabled selected>Select a Branch</option>
                <option value="1">IT</option>
                <option value="2">COMPS</option>
                <option value="3">EXTC </option>
                <option value="4">MECH </option>
            </select><br><br>


            <label for="student_year">Student Year:</label>
<select id="student_year" name="student_year" required>
                <option value="" disabled selected>Select a Branch</option>
                <option value="1">FE</option>
                <option value="2">SE</option>
                <option value="3">TE</option>
                <option value="4">BE</option>
            </select><br><br>        </fieldset>
        
        <fieldset>
            <legend>Startup Idea Details</legend>
            
            <label for="idea">Idea:</label>
            <input type="text" id="idea" name="idea" required><br><br>
            
            <label for="purpose">Purpose:</label>
            <textarea  id="purpose" name="purpose" rows="1" cols="100" required></textarea><br><br>
            
            <label for="mentor">Select Mentor:</label>
            <select id="mentor" name="mentor_id" required>
                <option value="" disabled selected>Select a mentor</option>
                <option value="1">Mentor 1</option>
                <option value="2">Mentor 2</option>
                <option value="3">Mentor 3</option>
            </select><br><br>
            
        </fieldset>
        
        <button type="submit" name="submit">Submit</button>
    </form><script>
        function showMessage(message) {
            alert(message);
        }
    </script>
</body>
</html>
<?php include 'connect.php'; ?>

<?php
      if(isset($_POST['submit']))

      {


        $student_name = addslashes($_POST['student_name']);
        $student_branch = addslashes($_POST['student_branch']);
        $student_year = addslashes($_POST['student_year']);
        $idea = addslashes($_POST['idea']);
        $purpose = addslashes($_POST['purpose']);
        $mentor_id = addslashes($_POST['mentor_id']);


        $sql = "SELECT MAX(stid) AS largest_value FROM idea_details"; 
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            
            $row = $result->fetch_assoc();
            $stid = $row['largest_value']+1;

            

        } else {
            $stid = 1;


            }
        $status="Pending";

        $stmt = $conn->prepare("insert into idea_details (stid,stud_name,stud_email,stud_br,stud_yr,stidea,stdpur,men,status) values (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssiissis", $stid,$student_name,$email,$student_branch,$student_year,$idea,$purpose,$mentor_id,$status );
        $stmt->execute(); 

        echo "<script>showMessage('Startup Idea Successfully sent to Mentor !');</script>";

    
      }
?>