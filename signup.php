<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page

    </title>
</head>
<body>
    <form  method="post" action="">
        
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
        <br><br>
        <label for="pwd">Password:</label>
        <input type="password" id="pwd" name="pwd" required>
        <br><br>
        <button type="submit" name="submit">Submit</button>
        <button name="signup" onClick="window.location.href='login.php';">Already have Account </button>

    </form>
    <script>
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
        $email=addslashes($_POST["email"]);
        $pwd=addslashes($_POST["pwd"]);

        $sql = "SELECT MAX(uid) AS largest_value FROM usercred"; 
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            
            $row = $result->fetch_assoc();
            $uid = $row['largest_value']+1;

            

        } else {
            $uid = 1;


            }
            $role =4;

        $stmt = $conn->prepare("insert into usercred (uid,email,pwd,role) values (?,?,?,?)");
        $stmt->bind_param("sssi", $uid,$email,$pwd,$role );
        $stmt->execute(); 

        echo "<script>showMessage('Registered Successfully !!!');</script>";
        echo '<script>window.location = "login.php";</script>';


    
      }
?>