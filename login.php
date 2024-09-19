<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page

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

        <button name="signup" onClick="window.location.href='signup.php';">Create Account </button>
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
      
      if (isset($_POST['submit'])) {
          $email = $_POST["email"];
          $pwd = $_POST["pwd"];
      
          // Prepare and execute the SQL statement
          $sql = "SELECT * FROM usercred WHERE email = ? AND pwd = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("ss", $email, $pwd);
          $stmt->execute();
          $result = $stmt->get_result();
          $user = $result->fetch_assoc();
      
          if ($user) {
              // Check user role and redirect accordingly
              switch ($user['role']) {
                  case 1:
                      echo '<script>window.location = "mentor1.php";</script>';
                      break;
                  case 2:
                      echo '<script>window.location = "mentor2.php";</script>';
                      break;
                  case 3:
                      echo '<script>window.location = "mentor3.php";</script>';
                      break;
                  
                
                  default:
                  ?>
                  <script>window.location = "sport.php?email=<?php echo urlencode($email); ?>";</script>
                  <?php              }
          } else {
              echo '<script>alert("Invalid email or password.");</script>';
          }
      
          $stmt->close();
      }
      
      
      
?>