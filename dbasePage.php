<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Database Page</title>
</head>

<body>
  <h1>1. Connect Database</h1>

  <?php
  $con = new mysqli("localhost", "root", "", "wad");
  // Check connection
  if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
  } else echo "<h2>Database Connected<h2><br>";
  ?>

  <h1>2. Fetch Record(s) from a Table</h1>
  <?php

  $qry = "SELECT * FROM users WHERE 1 ORDER BY userType ASC";
  $run = $con->query($qry);

  echo '<table width="50%" border="1">';
  while ($obj = $run->fetch_object()) {
    echo '<tr><td>' . $obj->userID . '</td><td>' . $obj->userName . '</td><td>' . $obj->FullName . '</td><td>' . $obj->userEmail . '</td><td>' . $obj->userMobile . '</td></tr>';
  }
  echo '</table>';
  ?>


  <br>
  <h1>3. Insert Record into a Table</h1>
  <?php
  if (isset($_POST['sbmBtn'])) {
    $uName = $_POST['uName'];
    $fName = $_POST['fName'];
    $pWord = $_POST['pWord'];
    $eMail = $_POST['eMail'];
    $Mobile = $_POST['Mobile'];
    $uType = $_POST['uType'];
    $InQry = "INSERT INTO users (userID, userName, FullName, userPassword, userEmail, userMobile, userType) VALUES (NULL, '$uName', '$fName', '$pWord', '$eMail', '$Mobile', '$uType')";
    $runQry = $con->query($InQry);
    if ($runQry) echo "<script>alert('Record Inserted, successfully!')</script>";
    else echo "<script>alert('Sorry, Record NOT Inserted!')</script>";
  }
  echo '<br>';
  ?>

  <form action="dbasePage.php" method="post">
    <table border="0" width="40%">
      <tr>
        <td>User Name</td>
        <td><input type="text" name="uName" id="uName" maxlength="10"></td>
      </tr>
      <tr>
        <td>Full Name</td>
        <td><input type="text" name="fName" id="fName" maxlength="30"></td>
      </tr>
      <tr>
        <td>Password</td>
        <td><input type="password" name="pWord" id="pWord"></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><input type="email" name="eMail" id="eMail"></td>
      </tr>
      <tr>
        <td>Mobile</td>
        <td><input type="text" name="Mobile" id="Mobile" maxlength="10"></td>
      </tr>
      <tr>
        <td>User Type</td>
        <td><select name="uType" id="uType">
            <option value="Admin">Admin</option>
            <option selected value="Student">Student</option>
            <option value="Faculty">Faculty</option>
          </select>
        </td>
      </tr>
      <tr>
        <td align="center"><input type="submit" value="Submit" name="sbmBtn"></td>
        <td></td>
      </tr>
    </table>
  </form>


  <h1>4. Update an existing Record in a Table</h1>
  <?php
  $UpdQry = "UPDATE users SET userMobile='9876543210' WHERE userName='Admin'";
  $runUpdQry = $con->query($UpdQry);
  if ($runUpdQry) echo "<h3>Record Updated, successfully!<h3>";
  else echo "<h3>Record NOT Updated</h3>";
  ?>

  <h1>5. Delete a Record from a existing table </h1>
  <?php
  $DelQry = "DELETE FROM users WHERE userID='11'";
  $runDelQry = $con->query($DelQry);
  if ($runDelQry) echo "<h3>Record Deleted, successfully!</h3>";
  else echo "<h3>Record NOT Deleted</h3>";
  ?>

  <h1>6. Login Approach</h1>
  <?php
  if (isset($_POST['LoginBtn'])) {
    $usrName = $_POST['usrName'];
    $usrPswd = $_POST['usrPswd'];
    $LogQry = "SELECT * FROM users WHERE userName='$usrName' AND userPassword='$usrPswd'";
    $runLogQry = $con->query($LogQry);
    $numRec = $runLogQry->num_rows;
    if ($numRec == 1) echo "<h3>You are Authorised to Login</h3>";
    else echo "<h3>You are NOT authorised to Login</h3>";
  }

  ?>
  <form action="dbasePage.php" method="post" name="LoginForm">
    <table border="0" width="40%">
      <tr>
        <td>User Name</td>
        <td><input type="text" name="usrName" id="uName" maxlength="10"></td>
      </tr>
      <tr>
        <td>Password</td>
        <td><input type="password" name="usrPswd" id="pWord"></td>
      </tr>
    </table>
    <input type="submit" value="Login" name="LoginBtn">

</body>

</html>